<?php
// File: app/Livewire/CheckBookingDetails.php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DocumentValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckBookingDetails extends Component
{
    use WithFileUploads, LivewireAlert;

    public $bookingDetails;
    public $duration;
    public $ktpBooking;
    public $identityBooking;
    public $selfieBooking;
    public $rejectedDocuments = [];
    public $isUploading = false;
    public $documentStatus = null;

    protected $listeners = [
        'bookingFound' => 'showBookingDetails',
        'reviewSubmitted' => '$refresh',
    ];

    const REQUIRED_DOCUMENTS = [
        'ktp_booking',
        'identity_booking',
        'selfie_booking'
    ];

    protected function rules()
    {
        $rules = [];

        // Only add validation rules for rejected documents that need re-upload
        foreach (self::REQUIRED_DOCUMENTS as $document) {
            if (isset($this->rejectedDocuments[$document])) {
                $rules[lcfirst(str_replace('_', '', ucwords($document, '_')))] = 'required|image|max:2048';
            }
        }

        return $rules;
    }

    protected $messages = [
        'ktpBooking.required' => 'KTP document is required',
        'ktpBooking.image' => 'KTP document must be an image',
        'ktpBooking.max' => 'KTP document must not exceed 2MB',
        'identityBooking.required' => 'Identity document is required',
        'identityBooking.image' => 'Identity document must be an image',
        'identityBooking.max' => 'Identity document must not exceed 2MB',
        'selfieBooking.required' => 'Selfie document is required',
        'selfieBooking.image' => 'Selfie document must be an image',
        'selfieBooking.max' => 'Selfie document must not exceed 2MB',
    ];

    public function openReview()
    {
        $this->dispatch('openReviewModal', $this->bookingDetails);
    }

    // Tambahkan method untuk mengecek status review
    public function hasReviewed()
    {
        if (!$this->bookingDetails) {
            return false;
        }

        return Review::where([
            'user_id' => auth()->id(),
            'booking_id' => $this->bookingDetails['id']
        ])->exists();
    }

    public function getExistingReview()
    {
        if (!$this->bookingDetails) {
            return null;
        }

        return Review::where([
            'user_id' => auth()->id(),
            'booking_id' => $this->bookingDetails['id']
        ])->first();
    }

    public function mount($bookingId = null)
    {
        if ($bookingId) {
            $this->loadBookingDetails($bookingId);
        }
    }

    private function loadBookingDetails($bookingId)
    {
        $this->bookingDetails = Booking::with(['documentValidations', 'item.type'])
            ->findOrFail($bookingId)
            ->toArray();

        $this->calculateDuration();
        $this->loadRejectedDocuments();
        $this->calculateDocumentStatus();
    }

    public function showBookingDetails($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
        $this->calculateDuration();
        $this->loadRejectedDocuments();
        $this->calculateDocumentStatus();
    }

    private function calculateDuration()
    {
        if ($this->bookingDetails) {
            $this->duration = \Carbon\Carbon::parse($this->bookingDetails['start_date'])
                ->diffInDays(\Carbon\Carbon::parse($this->bookingDetails['end_date'])) + 1; // Tambahkan +1 agar inklusif
        }
    }

    private function loadRejectedDocuments()
    {
        $this->rejectedDocuments = [];

        if (!$this->bookingDetails) {
            return;
        }

        $rejected = DocumentValidation::where('booking_id', $this->bookingDetails['id'])
            ->where('status', 'REJECTED')
            ->get();

        foreach ($rejected as $doc) {
            $this->rejectedDocuments[$doc->document_type] = $doc->rejection_reason;
        }
    }

    public function calculateDocumentStatus()
    {
        if (!$this->bookingDetails) {
            $this->documentStatus = null;
            return;
        }

        $documentValidations = DocumentValidation::where('booking_id', $this->bookingDetails['id'])
            ->whereIn('document_type', self::REQUIRED_DOCUMENTS)
            ->get();

        $totalDocuments = count(self::REQUIRED_DOCUMENTS);
        $approvedCount = 0;
        $rejectedDocuments = [];
        $waitingDocuments = [];
        $missingDocuments = self::REQUIRED_DOCUMENTS;

        foreach ($documentValidations as $validation) {
            // Remove from missing documents as we found a validation
            $missingDocuments = array_diff($missingDocuments, [$validation->document_type]);

            switch ($validation->status) {
                case 'APPROVED':
                    $approvedCount++;
                    break;
                case 'REJECTED':
                    $rejectedDocuments[] = $validation->document_type;
                    break;
                case 'WAITING':
                    $waitingDocuments[] = $validation->document_type;
                    break;
            }
        }

        $this->documentStatus = [
            'status' => $this->determineOverallStatus(
                $approvedCount,
                $totalDocuments,
                $rejectedDocuments,
                $waitingDocuments,
                $missingDocuments
            ),
            'details' => [
                'approved_count' => $approvedCount,
                'total_documents' => $totalDocuments,
                'rejected_documents' => $rejectedDocuments,
                'waiting_documents' => $waitingDocuments,
                'missing_documents' => $missingDocuments
            ]
        ];
    }

    private function determineOverallStatus($approvedCount, $totalDocuments, $rejectedDocs, $waitingDocs, $missingDocs)
    {
        if (!empty($rejectedDocs)) {
            return 'REJECTED';
        }

        if ($approvedCount === $totalDocuments) {
            return 'APPROVED';
        }

        if (!empty($missingDocs)) {
            return 'INCOMPLETE';
        }

        if (!empty($waitingDocs)) {
            return 'WAITING';
        }

        return 'WAITING';
    }

    public function uploadDocuments()
    {
        if (empty($this->rejectedDocuments)) {
            return;
        }

        $this->isUploading = true;

        try {
            $this->validate();

            DB::beginTransaction();

            $bookingUpdates = [];

            foreach (self::REQUIRED_DOCUMENTS as $docType) {
                $propertyName = lcfirst(str_replace('_', '', ucwords($docType, '_')));

                if (isset($this->rejectedDocuments[$docType]) && $this->{$propertyName}) {
                    $filePath = $this->processDocument(
                        $docType,
                        $this->{$propertyName},
                        'documents/' . str_replace('_booking', '', $docType)
                    );
                    $bookingUpdates[$docType] = $filePath;
                }
            }

            if (!empty($bookingUpdates)) {
                Booking::where('id', $this->bookingDetails['id'])
                    ->update($bookingUpdates);
            }

            DB::commit();

            $this->resetUploadFields();
            $this->alert('success', 'Documents uploaded successfully! Please wait for admin verification.');
            $this->refreshBookingDetails();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', 'Failed to upload documents: ' . $e->getMessage());
        } finally {
            $this->isUploading = false;
        }
    }

    private function processDocument($documentType, $uploadedFile, $storageFolder)
    {
        $filePath = $uploadedFile->store($storageFolder, 'public');

        if (!empty($this->bookingDetails[$documentType])) {
            Storage::disk('public')->delete($this->bookingDetails[$documentType]);
        }

        DocumentValidation::updateOrCreate(
            [
                'booking_id' => $this->bookingDetails['id'],
                'document_type' => $documentType
            ],
            [
                'status' => 'WAITING',
                'rejection_reason' => null
            ]
        );

        return $filePath;
    }

    private function resetUploadFields()
    {
        $this->reset(['ktpBooking', 'identityBooking', 'selfieBooking']);
        $this->rejectedDocuments = [];
    }

    private function refreshBookingDetails()
    {
        $this->loadBookingDetails($this->bookingDetails['id']);
    }

    public function downloadBookingPDF()
    {
        if (!$this->bookingDetails || $this->bookingDetails['payment_status'] !== 'success') {
            $this->alert('error', 'Cannot generate PDF. Payment status must be successful.');
            return;
        }

        try {
            // Load the booking with all necessary relationships
            $booking = Booking::with(['user', 'item.type'])
                ->findOrFail($this->bookingDetails['id'])
                ->toArray();

            // Perhitungan durasi
            $start = Carbon::parse($booking['start_date']);
            $end = Carbon::parse($booking['end_date']);
            $duration = $start->diffInDays($end) + 1; // Tambahkan +1 agar hari pertama selalu terhitung

            $data = [
                'booking' => $booking,
                'duration' => $duration, // Kirim durasi yang sudah diperhitungkan
                'generated_at' => now()->format('d F Y H:i:s')
            ];

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.reports.booking-receipt', $data);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'booking-receipt-' . $this->bookingDetails['booking_code'] . '.pdf');
        } catch (\Exception $e) {
            $this->alert('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.check-booking-details', [
            'hasReviewed' => $this->hasReviewed(),
            'canDownloadPDF' => $this->bookingDetails && $this->bookingDetails['payment_status'] === 'success'
        ]);
    }
}
