<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckBookingDetails extends Component

{
    use LivewireAlert;

    public $bookingDetails;
    public $duration;

    protected $listeners = ['bookingFound' => 'showBookingDetails'];

    public function showBookingDetails($bookingDetails)
    {
        $this->alert('success', 'Booking Found', [
            'text' => 'Booking found. Please check your booking details.',
            'toast' => true,
        ]);

        $this->bookingDetails = $bookingDetails;

        // Calculate the duration in days
        $this->duration = \Carbon\Carbon::parse($bookingDetails['start_date'])
            ->diffInDays(\Carbon\Carbon::parse($bookingDetails['end_date']));
    }

    public function render()
    {
        return view('livewire.check-booking-details');
    }
}
