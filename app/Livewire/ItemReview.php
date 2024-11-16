<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ItemReview extends Component
{

    use LivewireAlert;

    public $show = false;
    public $booking;
    public $message = '';
    public $rating = 5.0;
    public $itemName;
    public $itemImage;
    public $isEditing = false;
    public $existingReview = null;

    protected $listeners = ['openReviewModal'];

    protected function rules()
    {
        return [
            'message' => 'required|min:10|max:500',
            'rating' => ['required', 'numeric', 'min:0.5', 'max:5', function ($attribute, $value, $fail) {
                // Pastikan nilai adalah kelipatan 0.5
                if (($value * 10) % 5 !== 0) {
                    $fail('Rating harus berupa angka bulat atau setengah.');
                }
            }],
        ];
    }

    protected $messages = [
        'message.required' => 'Please provide your review message',
        'message.min' => 'Review message must be at least 10 characters',
        'message.max' => 'Review message must not exceed 500 characters',
        'rating.required' => 'Please provide a rating',
        'rating.numeric' => 'Rating must be a number',
        'rating.min' => 'Rating must be at least 0.5',
        'rating.max' => 'Rating must not exceed 5',
    ];

    public function openReviewModal($bookingDetails)
    {
        $this->booking = $bookingDetails;
        $this->itemName = $bookingDetails['item']['name'];
        $this->itemImage = isset($bookingDetails['item']['photos'])
            ? json_decode($bookingDetails['item']['photos'])[0]
            : 'frontend/images/default.jpg';

        // Check for existing review
        $existingReview = Review::where([
            'user_id' => auth()->id(),
            'booking_id' => $bookingDetails['id']
        ])->first();

        if ($existingReview) {
            $this->isEditing = true;
            $this->existingReview = $existingReview;
            $this->message = $existingReview->message;
            $this->rating = $existingReview->rating;
        } else {
            $this->isEditing = false;
            $this->existingReview = null;
            $this->reset(['message', 'rating']);
        }

        $this->show = true;
    }

    public function setRating($value)
    {
        // Konversi ke float dan pastikan hanya menerima nilai .0 atau .5
        $value = (float) $value;
        $decimal = $value - floor($value);
        if ($decimal > 0 && $decimal < 0.5) {
            $value = floor($value) + 0.5;
        } else if ($decimal > 0.5) {
            $value = ceil($value);
        }
        $this->rating = max(0.5, min(5, $value));
    }

    public function submitReview()
    {
        $this->validate();

        try {
            if ($this->isEditing) {
                // Update existing review
                $this->existingReview->update([
                    'message' => $this->message,
                    'rating' => (float) $this->rating,
                ]);
                $successMessage = 'Review updated successfully!';
            } else {
                // Create new review
                Review::create([
                    'user_id' => auth()->id(),
                    'item_id' => $this->booking['item']['id'],
                    'booking_id' => $this->booking['id'],
                    'message' => $this->message,
                    'rating' => (float) $this->rating,
                ]);
                $successMessage = 'Thank you for your review!';
            }

            $this->alert('success', $successMessage);
            $this->closeModal();
            $this->dispatch('reviewSubmitted');
        } catch (\Exception $e) {
            $this->alert('error', 'Failed to submit review. Please try again.');
        }
    }



    public function handleStarClick($event, $position)
    {
        // Get click position within the star element
        $rect = json_decode($event['detail']);
        $clickX = $event['clientX'] - $rect['left'];
        $halfWidth = $rect['width'] / 2;

        // Set rating based on click position
        if ($clickX < $halfWidth) {
            $this->rating = $position - 0.5;
        } else {
            $this->rating = $position;
        }
    }

    public function closeModal()
    {
        $this->show = false;
        $this->reset(['message', 'rating', 'isEditing', 'existingReview']);
    }


    public function render()
    {
        return view('livewire.item-review');
    }
}
