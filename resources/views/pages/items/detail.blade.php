@extends('layouts.app')

@section('content')

    <!-- Login Popup (this part is added to the index.html) -->
    <div id="login-popup" class="login-popup">
        <button class="close-button-popup" onclick="document.getElementById('login-popup').style.display='none';">
            &times;
        </button>
        <div class="card login-card">
            <div class="row no-gutters">
                <!-- Left side with background image -->
                <div class="col-md-6 login-image"></div>

                <!-- Right side with login form -->
                <div class="col-md-6">
                    <div class="card-body login-content">
                        <!-- <img src="frontend/images/logo.svg" alt="Logo" class="logo-img-login"> -->
                        <h2 class="title-login">Login</h2>
                        <!-- <p class="desc-login">Lengkapi form di bawah dengan menggunakan data Anda yang valid</p> -->
                        <!-- <div class="card-form-login"> -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror rounded-input" id="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email"
                                    autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror rounded-input"
                                    id="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                            @endif
                            <div class="action-buttons">
                                <button type="submit" class="login-button">Login</button>
                                <button type="button" class="register-button"
                                    onclick="window.location.href = '{{ route('register') }}';">Register</button>
                            </div>

                            <hr>
                            <div class="action-buttons">
                                <button type="button" class="btn-dark google"
                                    onclick="window.location.href = 'register.html';">
                                    <img src="{{ url('frontend/images/icon-google.svg') }}" alt="Google Icon"
                                        class="google-icon">
                                    Masuk/Daftar</button>
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Footer -->
    <footer class="footer-section car_details_footer">
        <div class="footer-container details__cars">
            <div class="footer-column">
                <img src="{{ url('frontend/images/logo-white.svg') }}" alt="Footer Logo" class="footer-logo">
                <p>Stay connected with us through social media.</p>
                <div class="footer-social-icons">
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/instagram.svg') }}" alt="Icon 1">
                    </div>
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/facebook.svg') }}" alt="Icon 2">
                    </div>
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/whatsapp.svg') }}" alt="Icon 3">
                    </div>
                </div>
            </div>

            <div class="footer-column">
                <h3>Menu</h3>
                <ul class="footer-menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Company</h3>
                <ul class="footer-company">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Location</h3>
                <p class="location-foot"><iframe class="footer-alternatives"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63305.747583945726!2d109.20915013591537!3d-7.397607689588339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655fa48add3e9b%3A0x6719bc889b9b1458!2sPATRA%20Rental%20Mobil%20%26%20Motor%20Purwokerto!5e0!3m2!1sid!2sid!4v1728910690790!5m2!1sid!2sid"
                        width="300" height="150" style="border:0; border-radius: 20px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Your Company Name. All rights reserved.</p>
        </div>
    </footer>

@endsection
