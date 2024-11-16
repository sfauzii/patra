<div x-data="{ rating: @entangle('rating') }">
    @if ($show)
        <div class="modal show" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $isEditing ? 'Edit Your Review' : 'Write a Review' }}
                        </h5>
                        <button type="button" class="close" wire:click="closeReviewModal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <!-- Modal Form -->
                    <form wire:submit.prevent="submitReview">
                        <div class="modal-body">
                            <!-- Review Message -->
                            <div class="form-group mb-3">
                                <label for="review">Your Review</label>
                                <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" rows="4"
                                    placeholder="Share your experience..."></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rating Stars -->
                            <div class="form-group">
                                <label>Rating</label>
                                <div class="rating-stars d-flex gap-2" style="font-size: 24px;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="star-wrapper position-relative"
                                            style="cursor: pointer; width: 24px; height: 24px;" x-data
                                            x-on:click="
                                                const rect = $el.getBoundingClientRect();
                                                const clickX = event.clientX - rect.left;
                                                const half = rect.width / 2;
                                                const value = clickX < half ? {{ $i - 0.5 }} : {{ $i }};
                                                $wire.setRating(value)
                                            ">
                                            <!-- Empty star (background) -->
                                            <i class="fas fa-star position-absolute text-secondary"></i>

                                            <!-- Filled star (overlay) -->
                                            <div class="position-absolute overflow-hidden"
                                                style="width: {{ $rating >= $i ? '100%' : ($rating > $i - 1 ? '50%' : '0%') }};">
                                                <i class="fas fa-star text-warning"></i>
                                            </div>
                                        </div>
                                    @endfor
                                    <input type="hidden" wire:model="rating">
                                </div>
                                <div class="small text-muted mt-1">Rating: {{ number_format($rating, 1) }}</div>
                                @error('rating')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ $isEditing ? 'Update Review' : 'Submit Review' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
