@extends('layouts.app')

@section('content')

    <!-- Login Popup (this part is added to the index.html) -->
    <x-login-popup />

    <section class="details">
        <!-- Section Heading with Background Image -->
        <div class="details-background"></div>

        <!-- Content Section -->
        <div class="details-content">
            <div class="heading-content">
                <h1>Car Detail</h1>
                <h3>Home > Car Details</h3>
            </div>

            <!-- Thumbnail Section -->
            <div class="thumbnail-section">
                <div class="thumbnail-card">
                    <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                </div>
            </div>

            <!-- Image Grid Section -->
            <div class="image-grid">
                <!-- <h2>Image Grid Title</h2> -->
                <div class="scroll-container">
                    <!-- <button class="scroll-button left">&lt;</button> -->
                    <div class="grid-images">

                        @if ($item->photos)
                            @foreach (json_decode($item->photos) as $photo)
                                <img src="{{ asset('storage/' . $photo) }}" alt="Image 1"
                                    onclick="openModal('{{ asset('storage/' . $photo) }}')">
                            @endforeach
                        @endif
                    </div>

                    <!-- <button class="scroll-button right">&gt;</button> -->
                </div>
            </div>

            <!-- Two Column Content Section -->
            <div class="content-columns">
                <!-- Left Column -->
                <div class="column-left">
                    <div class="card-car-details">
                        <h2>{{ ucwords($item->name) }}</h2>
                        <span class="badge-category">{{ ucwords($item->type->name) }}</span>
                        <div class="card-rating car-details">
                            @php
                                $avgRating = number_format($avgRating ?? 0, 1); // Format ke 1 desimal
                                $fullStars = floor($avgRating); // Jumlah bintang penuh
                                $hasHalfStar = $avgRating - $fullStars >= 0.5; // Cek apakah ada setengah bintang
                                $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0)); // Hitung sisa bintang kosong
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
                            <!-- Tampilkan Jumlah Ulasan -->
                            <span class="review-count">{{ $reviewCount }} Reviews</span>
                        </div>
                        <h4>Description</h4>
                        <p class="description">
                            {!! ucfirst($item->description) !!}
                        </p>
                    </div>
                    <div class="column-left">
                        <div class="card-nav-tabs">
                            <!-- Nav tabs -->
                            <div class="nav-tabs">
                                <button class="tab-btn left-btn-tab active" data-tab="how-it-works">How it
                                    Works</button>
                                <button class="tab-btn right-btn-tab" data-tab="reviews">Reviews</button>
                            </div>
                            <hr class="nav__tabs" style="margin-bottom: 25px;">

                            <!-- Tab Content -->
                            <div class="tab-content" id="how-it-works">
                                <p class="description-how-it">1. Pengguna dapat mengunjungi situs web PT. Patra Transportasi
                                    dan menjelajahi berbagai jenis kendaraan yang tersedia untuk disewa.
                                    <br>2. Setelah
                                    memilih kendaraan, pengguna akan diminta untuk mengisi formulir booking. Formulir ini
                                    mencakup informasi penting seperti nama, nomor WhatsApp, alamat, serta tanggal mulai dan
                                    akhir penyewaan.
                                    <br>3. Sebagai langkah keamanan, pengguna harus mengunggah dokumen
                                    validasi, termasuk Kartu Tanda Penduduk (KTP), Kartu Keluarga (KK), dan foto selfie.
                                    <br>4. Setelah formulir diisi dan dokumen diunggah, pengguna akan diarahkan untuk
                                    melakukan pembayaran. Pilih metode pembayaran yang diinginkan, baik melalui transfer
                                    bank atau menggunakan payment gateway seperti Midtrans.
                                </p>
                                <div class="card-alert">
                                    <img class="alert-icon" src="{{ url('frontend/images/icon-notif.svg') }}"
                                        alt="Alert Icon">
                                    <p>Dengan mengikuti langkah-langkah ini, proses booking kendaraan di PT. Patra
                                        Transportasi Nusantara menjadi mudah dan cepat. </p>
                                </div>
                            </div>

                            <div class="tab-content" id="reviews" style="display:none;">
                                @foreach ($reviews as $review)
                                    <div class="review-card">
                                        <div class="review-content">
                                            <img class="profile-photo"
                                                src="{{ $review->user->profile_photo_url ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($review->user->name) }}"
                                                alt="Profile Photo">
                                            <div class="review-details">
                                                <p class="reviewer-name">{{ ucwords($review->user->name) }}</p>
                                                <div class="card-rating-navtabs">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($review->rating >= $i)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @elseif ($review->rating == $i - 0.5)
                                                            <i class="fas fa-star-half-alt text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-secondary"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="title__car">{{ ucwords($review->item->name) }}</h3>
                                        <p class="message__review">"{{ $review->message }}"</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="column-right">
                    <div class="car-informations">
                        <h2>Booking Price</h2>
                        <h2 class="price-car">Rp {{ number_format($item->price) }} <span class="per-day">/day</span></h2>
                        <hr>
                        <h3>The completeness of this car</h3>
                        <ul class="feature-list">
                            @php
                                $features = explode(',', $item->features);
                            @endphp
                            @foreach ($features as $feature)
                                <li><img src="{{ url('frontend/images/checklist.svg') }}" alt="Feature Icon">
                                    {{ ucwords($feature) }}</li>
                            @endforeach

                            <!-- Add more features as needed -->
                        </ul>
                        <button class="btn-book"
                            onclick="window.location.href='{{ route('checkout', $item->slug) }}';">Proceed to
                            Booking</button>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div id="imageModal" class="modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
            </div>




        </div>
    </section>


    <section class="great-project-section details__car">
        <div class="project-info heading__car__details">
            <h2 class="project-title">Other Cars</h2>
            <p class="project-description">This is a people-say of our awesome cars</p>
        </div>

        <div class="project-carousel">
            <!-- Card Row 1 (Scrolling Animation) -->
            <div class="card-container">
                @foreach ($similiarItems as $similiarItem)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($similiarItem->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($similiarItem->name) }} </h1>
                            <p class="card-description">Rp 450.000/day</p>
                            <div class="card-rating">
                                @php
                                    $avgRating = number_format($similiarItem->avg_rating, 1);
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
                                <span class="review-count">({{ $similiarItem->review_count }} Reviews)</span>
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $similiarItem->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <!-- Card Row 2 (Different Animation) -->
        <div class="project-carousel reverse">
            <div class="card-container">
                @foreach ($similiarItems as $similiarItem)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($similiarItem->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($similiarItem->name) }} </h1>
                            <p class="card-description">Rp 450.000/day</p>
                            <div class="card-rating">
                                @php
                                    $avgRating = number_format($similiarItem->avg_rating, 1);
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
                                <span class="review-count">({{ $similiarItem->review_count }} Reviews)</span>
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $similiarItem->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-footer-alternate />
@endsection
