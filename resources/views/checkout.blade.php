@extends('layouts.app')

@php
    $showFooter = false;
@endphp



@section('content')
    <div id="terms-popup" class="terms-popup">
        <button class="close-button-popup" onclick="document.getElementById('terms-popup').style.display='none';">
            &times;
        </button>
        <div class="card terms-card">
            <div class="terms-content">
                <h2>Terms and Conditions</h2>
                <p class="fw-normal mb-3 text-center">Last Updated at 30 August 2023</p>
                <p class="subtitle-primary mb-lg-5">Pelajari dengan baik agar proses transaksi di PT. Patra
                    Transportasi
                    Nusantara lebih mudah dan nyaman</p>
                <p>Syarat dan Ketentuan ini merupakan perjanjian antara pengguna dan PT Patra Transportasi
                    Nusantara
                    (“Kami”). Syarat dan
                    Ketentuan ini mengatur Anda saat mengakses dan menggunakan seluruh layanan, fitur dan produk
                    yang kami sediakan (untuk
                    selanjutnya secara bersama-sama akan disebut sebagai “Platform”).

                    Harap membaca Syarat dan Ketentuan ini secara seksama sebelum Anda mulai menggunakan Platform
                    Kami, karena peraturan ini
                    berlaku pada penggunaan Anda terhadap Platform Kami.

                    Anda mengerti dan setuju bahwa Syarat dan Ketentuan ini merupakan perjanjian dalam bentuk
                    elektronik dan tindakan Anda
                    menekan tombol ‘daftar’ saat pembukaan Akun atau tombol ‘masuk’ saat akan mengakses Akun Anda
                    merupakan persetujuan
                    aktif Anda untuk mengikatkan diri dalam perjanjian dengan Kami sehingga keberlakuan Syarat dan
                    Ketentuan ini dan
                    Kebijakan Privasi adalah sah dan mengikat secara hukum dan terus berlaku sepanjang penggunaan
                    Platform oleh Anda. Bila
                    Anda tidak setuju dengan Syarat dan Ketentuan Penggunaan ini, maka Anda tidak diperkenankan
                    menggunakan Platform kami.

                    Kami dapat mengubah Syarat dan Ketentuan ini dari waktu ke waktu, perubahan akan diberitahukan
                    kepada Anda melalui
                    email, melalui pemberitahuan yang diunggah di Platform, atau sebagaimana yang diwajibkan oleh
                    hukum yang berlaku; dan
                    Anda setuju bahwa Anda bertanggung jawab untuk meninjau Syarat dan Ketentuan ini secara berkala.
                    Penggunaan secara
                    berkelanjutan oleh Anda atas layanan yang diberikan dalam Platform setelah perubahan dan/atau
                    penambahan Syarat dan
                    Ketentuan yang berlaku, akan dianggap sebagai persetujuan dan penerimaan Anda atas perubahan
                    dan/atau penambahan
                    tersebut. Anda dapat menyampaikan keberatan atas perubahan dan/atau penambahan atas Syarat dan
                    Ketentuan yang berlaku
                    yang dianggap merugikan Anda secara komersial dan material dalam jangka waktu 14 (empat belas)
                    hari kalender sejak
                    perubahan dan/atau penambahan tersebut dipublikasikan. Kami berhak untuk menghentikan akses Anda
                    terhadap Platform dalam
                    hal Anda berkeberatan atas perubahan dan/atau penambahan Syarat dan Ketentuan yang berlaku
                    tersebut.</p>
                <!-- Add more paragraphs as needed to make it scrollable -->

                <div class="list-terms">
                    <div class="text-left-terms">
                        <h2>1. Akun</h2>
                        <p>Anda harus berusia minimal 18 (delapan belas) tahun atau sudah menikah dan tidak berada
                            di
                            bawah perwalian atau
                            pengampuan agar Anda secara hukum memiliki kapasitas dan berhak untuk mengikatkan diri
                            pada
                            Syarat dan Ketentuan ini.
                            Jika Anda tidak memenuhi ketentuan tersebut, maka tindakan Anda mendaftar, mengakses,
                            menggunakan atau melakukan
                            aktivitas lain dalam Platform Kami harus dalam sepengetahuan, pengawasan dan persetujuan
                            yang sah dari orang tua atau
                            wali atau pengampu Anda. Orang tua, wali atau pengampu yang memberikan persetujuan bagi
                            Anda
                            yang berusia di bawah 18
                            (delapan belas) tahun bertanggung jawab secara penuh atas seluruh tindakan Anda dalam
                            penggunaan dan akses terhadap
                            Platform.

                            Dengan mendaftar dan/atau menggunakan Platform Kami, maka Anda dan/atau orang tua, wali
                            atau
                            pengampu Anda (jika Anda
                            berusia di bawah 18 tahun) dianggap telah membaca, mengerti, memahami dan menyetujui
                            semua
                            isi dalam Syarat dan
                            Ketentuan ini.

                            Sebelum menggunakan Platform, kami meminta Anda untuk menyetujui Syarat dan Ketentuan
                            beserta Kebijakan Privasi untuk
                            Anda dapat mendaftarkan diri Anda dengan memberikan informasi yang Kami butuhkan. Saat
                            melakukan pendaftaran, Kami akan
                            meminta Anda untuk memberikan nama lengkap, foto profil dan alamat surat elektronik
                            Anda.
                            Kami juga dapat menghentikan
                            penggunaan Platform jika dikemudian hari data-data yang Anda berikan kepada Kami
                            terbukti
                            tidak benar.

                            Keamanan dan kerahasiaan akun Anda, termasuk namun tidak terbatas pada seluruh data
                            pribadi
                            yang Anda berikan kepada
                            kami melalui formulir pendaftaran pada Platform kami, sepenuhnya merupakan tanggung
                            jawab
                            pribadi Anda. Segala kerugian
                            dan risiko yang timbul akibat atau sehubungan dengan kelalaian Anda dalam menjaga
                            keamanan
                            dan kerahasiaan akun Anda
                            ditanggung oleh Anda sendiri dan/atau orang tua, wali atau pengampu Anda (bagi Pengguna
                            yang
                            berada di bawah Usia
                            Dewasa). Dengan demikian, kami akan menganggap setiap penggunaan atau pesanan yang
                            dilakukan
                            melalui akun Anda sebagai
                            permintaan yang sah dari Anda.</p>

                    </div>
                    <div class="text-left-terms">
                        <h2>2. Layanan dan Biaya</h2>
                        <p>Anda mengakui bahwa kelas tertentu dari Platform kami mungkin tidak tersedia untuk Anda
                            kecuali Anda mengikuti kelas
                            premium yang tersedia pada Platform kami, yang sekarang dikenakan biaya sekali bayar
                            untuk akses kelas tertentu
                            selamanya. Anda setuju dan mengakui bahwa setiap ketentuan yang disampaikan kepada Anda
                            pada saat proses menggunakan
                            pada Platform kami dianggap sebagai bagian dari Ketentuan Penggunaan ini.

                            Akses Anda terhadap kelas premium yang tersedia pada Platform kami hanya akan aktif
                            setelah Anda mengisi dan
                            menyampaikan seluruh data dan dokumen wajib yang diperlukan dan menyelesaikan seluruh
                            pembayaran biaya kelas atau paket
                            secara tepat waktu. Anda setuju untuk membayar biaya kelas atau paket yang berlaku tanpa
                            pengurangan atau pemotongan
                            pajak. Jika pengurangan atau pemotongan pajak adalah wajib, Anda akan bertanggung jawab
                            untuk membayarkan jumlah
                            tambahan sebagaimana diperlukan agar kami menerima pembayaran penuh dari biaya kelas
                            yang berlaku. Anda memahami bahwa
                            PT Angga Membangun Indonesia dari waktu ke waktu dapat mengubah harga atau memberikan
                            uji coba dan penawaran khusus yang
                            dapat mengakibatkan jumlah yang dikenakan kepada Pengguna tertentu menjadi berbeda.</p>

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
                <h1>Start Booking Your Car</h1>
                <h3>Home > Car Details > Start Booking</h3>
            </div>

            @livewire('checkout', ['item' => $item])
            <!-- Two Column Content Section -->
            {{-- <div class="content-columns">
                <!-- Left Column -->
                <div class="column-left">
                    <div class="card-form-booking">
                        <div class="card-header">
                            <img src="{{ url('frontend/images/civic.jpg') }}" alt="Image" class="booking-image">
                            <div class="title-badge">
                                <h3>{{ ucwords($item->name) }} </h3>
                                <span class="badge-category">{{ ucwords($item->type->name) }}</span>
                            </div>
                        </div>
                        <hr class="hr-booking">

                        <h4 class="details-title">Complete the details</h4>
                        <form action="">
                            <div class="form-group">
                                <label for="input-field">Name</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-profile-circle.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="name" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="input-field">WhatsApp Number</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-whatsapp.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="phone" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="input-field">Address</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-location.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="address" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="start-date">Start Date</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="date" name="start_date" id="start-date" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="until-date">Until Date</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="date" name="end_date" id="until-date" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <div class="icon-information">
                                    <img src="{{ url('frontend/images/icon-shield-tick.svg') }}" alt="Info Icon"
                                        class="info-icon">
                                    <p>Kami akan melindungi privasi Anda sebaik mungkin
                                        sehingga dapat melanjutkan proses upload dokumen!</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file-upload">Upload KTP</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="ktp_booking" id="file-upload" class="form-input">
                                </div>
                                <label for="file-upload">Upload Identitas Lainnya (KK/BPJS)</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="identity_booking" id="file-upload" class="form-input">
                                </div>
                                <label for="file-upload">Upload Photo Selfie</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="selfie_booking" id="file-upload" class="form-input">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="column-right">
                    <div class="car-informations booking-right" id="scrolling-card">

                        <h3>Your Order Details</h3>
                        <!-- Booking Details List -->
                        <div class="booking-details">

                            <div class="detail-item">
                                <h3>Booking Price</h3>
                                <p>Rp 450,00/day</p>
                            </div>
                            <div class="detail-item">
                                <h3>Duration</h3>
                                <p>4 day</p>
                            </div>
                            <div class="detail-item">
                                <h3>Sub Total</h3>
                                <p>Rp 1,000,000</p>
                            </div>
                            <div class="detail-item unique-code">
                                <h3>Unique Code</h3>
                                <p>-Rp 289</p>
                            </div>
                            <div class="detail-item payment-service">
                                <div class="tooltip-wrapper">
                                    <h3>Payment Service</h3>
                                    <span class="tooltip-icon">?</span>
                                    <div class="tooltip-text">Biaya untuk fee payment gateway dan platform service
                                        lainnya!</div>
                                </div>
                                <p>+Rp 10,000</p>
                            </div>
                            <!-- <hr> -->
                            <div class="detail-item grand-total">
                                <h3>Grand Total</h3>
                                <p>Rp 1,000,000</p>
                            </div>

                            <!-- Add radio button with text -->
                            <div class="detail-item terms-condition">
                                <input type="radio" name="terms" value="agree">
                                <p>Saya setuju dengan <a href="#">Terms & Condition</a></p>
                            </div>
                        </div>
                        <button class="btn-book" onclick="window.location.href='well-dones.html';">Proceed to
                            Payment</button>
                    </div>
                </div>
            </div> --}}


            <!-- Modal -->
            <div id="imageModal" class="modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
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
