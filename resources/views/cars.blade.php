@extends('layouts.app')

@section('title', 'Great Cars')

@php
    $showFooter = false;
@endphp

@section('content')
    <x-login-popup />

    <!-- Great Project -->
    <section class="great-project-section cars">
        <div class="project-info">
            <h2 class="project-title">Great Cars</h2>
            <p class="project-description">This is a people-say of our awesome cars</p>
        </div>


        <div class="project-carousel">
            <div class="card-cars">
                @foreach ($items as $item)
                    <div class="card cars">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title cars">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, ' ') }}/day</p>
                            <div class="card-rating">
                                @php
                                    $avgRating = number_format($item->avg_rating, 1);
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0));
                                @endphp

                                {{-- Bintang Penuh --}}
                                @for ($i = 1; $i <= $fullStars; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor

                                {{-- Setengah Bintang --}}
                                @if ($hasHalfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @endif

                                {{-- Bintang Kosong --}}
                                @for ($i = 1; $i <= $emptyStars; $i++)
                                    <i class="far fa-star text-secondary"></i>
                                @endfor

                                <!-- Jumlah Ulasan -->
                                <span class="review-count">({{ $item->review_count }} Reviews)</span>
                                <!-- Example of a half-star -->
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $item->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>

    <!-- Footer -->
    <x-footer-alternate />
@endsection
