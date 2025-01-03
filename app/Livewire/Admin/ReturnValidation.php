<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;use App\Models\Booking;

class ReturnValidation extends Component
{

    use LivewireAlert;

    public $booking;
    public $returnDate;
    public $returnCondition;
    public $returnNotes;
    public $showReturnModal = false;
    public $startDate;
    public $endDate;

    protected $rules = [
        'returnDate' => 'required|date',
        'returnCondition' => 'required|in:good,damaged',
        'returnNotes' => 'nullable|string|max:500'
    ];

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
        // Set default return date to today
        $this->returnDate = now()->format('Y-m-d');


        // Handle date formatting
        $this->startDate = $this->formatDate($booking->start_date);
        $this->endDate = $this->formatDate($booking->end_date);
    }

    private function formatDate($date)
    {
        if ($date instanceof Carbon) {
            return $date->format('d M Y');
        }
        return Carbon::parse($date)->format('d M Y');
    }

    public function openReturnModal()
    {
        $this->showReturnModal = true;
    }

    public function closeReturnModal()
    {
        $this->showReturnModal = false;
        $this->reset(['returnCondition', 'returnNotes']);
        $this->returnDate = now()->format('Y-m-d');
    }


    public function confirmReturn()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Create return validation record
            $this->booking->returnValidation()->create([
                'return_date' => $this->returnDate,
                'return_condition' => $this->returnCondition,
                'return_notes' => $this->returnNotes,
                'status' => 'completed',
                'validated_by' => auth()->id()
            ]);

            // Update booking status
            $this->booking->update([
                'return_status' => 'returned',
                'actual_return_date' => $this->returnDate
            ]);

            DB::commit();

            $this->alert('success', 'Pengembalian berhasil divalidasi!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);

            $this->closeReturnModal();
            $this->emit('returnValidated');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', 'Terjadi kesalahan!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.return-validation');
    }
}
