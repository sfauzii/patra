<?php
// File: app/Livewire/CheckBookingDetails.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Livewire\WithFileUploads;
use App\Models\DocumentValidation;
use Illuminate\Support\Facades\DB;
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

    protected $listeners = ['bookingFound' => 'showBookingDetails'];

    const REQUIRED_DOCUMENTS = [
        'ktp_booking',
        'identity_booking',
        'selfie_booking'
    ];

    protected function rules()
    {
        $rules = [];

        if (isset($this->rejectedDocuments['ktp_booking'])) {
            $rules['ktpBooking'] = 'required|image|max:2048';
        }
        if (isset($this->rejectedDocuments['identity_booking'])) {
            $rules['identityBooking'] = 'required|image|max:2048';
        }
        if (isset($this->rejectedDocuments['selfie_booking'])) {
            $rules['selfieBooking'] = 'required|image|max:2048';
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

    public function mount($bookingId = null)
    {
        if ($bookingId) {
            $this->loadBookingDetails($bookingId);
        }
    }

    public function showBookingDetails($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
        $this->calculateDuration();
        $this->loadRejectedDocuments();
        $this->calculateDocumentStatus(); // Calculate document status when showing details
    }

    private function calculateDuration()
    {
        $this->duration = \Carbon\Carbon::parse($this->bookingDetails['start_date'])
            ->diffInDays(\Carbon\Carbon::parse($this->bookingDetails['end_date'])) + 1;
    }

    private function loadRejectedDocuments()
    {
        $rejected = DocumentValidation::where('booking_id', $this->bookingDetails['id'])
            ->where('status', 'REJECTED')
            ->get();

        foreach ($rejected as $doc) {
            $this->rejectedDocuments[$doc->document_type] = $doc->rejection_reason;
        }
    }

    /**
     * Calculate the overall document validation status
     */
    public function calculateDocumentStatus()
    {
        if (!$this->bookingDetails) {
            return;
        }

        $documentValidations = DocumentValidation::where('booking_id', $this->bookingDetails['id'])
            ->whereIn('document_type', self::REQUIRED_DOCUMENTS)
            ->get();

        // Initialize counters
        $totalDocuments = count(self::REQUIRED_DOCUMENTS);
        $approvedCount = 0;
        $rejectedDocuments = [];
        $waitingDocuments = []; // Changed from pendingDocuments
        $missingDocuments = [];

        // Create a map of existing validations
        $validationMap = $documentValidations->pluck('status', 'document_type')->toArray();

        // Check each required document
        foreach (self::REQUIRED_DOCUMENTS as $docType) {
            if (!isset($validationMap[$docType])) {
                $missingDocuments[] = $docType;
                continue;
            }

            $status = $validationMap[$docType];

            switch ($status) {
                case 'APPROVED':
                    $approvedCount++;
                    break;
                case 'REJECTED':
                    $rejectedDocuments[] = $docType;
                    break;
                case 'WAITING': // Changed from PENDING
                    $waitingDocuments[] = $docType;
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
                'waiting_documents' => $waitingDocuments, // Changed from pending_documents
                'missing_documents' => $missingDocuments
            ]
        ];
    }

    /**
     * Determine the overall status based on document validation counts
     */
    private function determineOverallStatus($approvedCount, $totalDocuments, $rejectedDocs, $pendingDocs, $missingDocs)
    {
        // If any document is rejected, overall status is REJECTED
        if (!empty($rejectedDocs)) {
            return 'REJECTED';
        }

        // If all documents are approved, overall status is APPROVED
        if ($approvedCount === $totalDocuments) {
            return 'APPROVED';
        }

        // If there are missing documents, status is INCOMPLETE
        if (!empty($missingDocs)) {
            return 'INCOMPLETE';
        }

        // If there are waiting documents, status is WAITING
        if (!empty($waitingDocs)) {
            return 'WAITING'; // Changed from PENDING
        }

        // Default status
        return 'WAITING'; // Changed from PENDING
    }

    public function uploadDocuments()
    {
        $this->isUploading = true;

        try {
            $this->validate();

            DB::beginTransaction();

            $bookingUpdates = [];

            // Process KTP Document
            if (isset($this->rejectedDocuments['ktp_booking']) && $this->ktpBooking) {
                $ktpPath = $this->processDocument(
                    'ktp_booking',
                    $this->ktpBooking,
                    'documents/ktp'
                );
                $bookingUpdates['ktp_booking'] = $ktpPath;
            }

            // Process Identity Document
            if (isset($this->rejectedDocuments['identity_booking']) && $this->identityBooking) {
                $identityPath = $this->processDocument(
                    'identity_booking',
                    $this->identityBooking,
                    'documents/identity'
                );
                $bookingUpdates['identity_booking'] = $identityPath;
            }

            // Process Selfie Document
            if (isset($this->rejectedDocuments['selfie_booking']) && $this->selfieBooking) {
                $selfiePath = $this->processDocument(
                    'selfie_booking',
                    $this->selfieBooking,
                    'documents/selfie'
                );
                $bookingUpdates['selfie_booking'] = $selfiePath;
            }

            // Update booking record
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
        // Store new file
        $filePath = $uploadedFile->store($storageFolder, 'public');

        // Delete old file if exists
        if (!empty($this->bookingDetails[$documentType])) {
            Storage::disk('public')->delete($this->bookingDetails[$documentType]);
        }

        // Update document validation status
        DocumentValidation::where('booking_id', $this->bookingDetails['id'])
        ->where('document_type', $documentType)
            ->update([
                'status' => 'WAITING', // Changed from PENDING
                'rejection_reason' => null
            ]);

        return $filePath;
    }

    private function resetUploadFields()
    {
        $this->reset(['ktpBooking', 'identityBooking', 'selfieBooking']);
        $this->rejectedDocuments = [];
    }

    private function refreshBookingDetails()
    {
        $this->bookingDetails = Booking::with(['documentValidations', 'item.type'])
            ->find($this->bookingDetails['id'])
            ->toArray();

        $this->loadRejectedDocuments();
        $this->calculateDocumentStatus(); // Recalculate document status after refresh
    }

    public function render()
    {
        return view('livewire.check-booking-details');
    }
}
