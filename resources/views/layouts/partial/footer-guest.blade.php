<footer id="footer" class="footer position-relative light-background">

    <div class="container">
        <div class="row gy-5">

            <div class="col-lg-4">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-3 text-decoration-none">
                        <img src="{{ asset('img/logo-awal-jdihn-small.png') }}" alt="Logo JDIH" class="me-2"
                            style="height: 40px;">
                        <span class="sitename fw-bold text-white">JDIH Kab. MBD</span>
                    </a>

                    <p class="tagline">
                        Jaringan Dokumentasi dan Informasi Hukum Kabupaten Maluku Barat Daya.
                        Mewujudkan pelayanan informasi hukum yang lengkap, akurat, dan terintegrasi secara digital.
                    </p>

                    <div class="social-links mt-4">
                        <a href="#" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" target="_blank" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="footer-links-grid">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h5>Profil</h5>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/profil/visi-misi') }}">Visi & Misi</a></li>
                                <li><a href="{{ url('/profil/struktur-organisasi') }}">Struktur Organisasi</a></li>
                                <li><a href="{{ url('/profil/tugas-fungsi') }}">Tugas & Fungsi</a></li>
                                <li><a href="{{ url('/profil/dasar-hukum') }}">Dasar Hukum</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h5>Produk Hukum</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Peraturan Daerah</a></li>
                                <li><a href="#">Peraturan Bupati</a></li>
                                <li><a href="#">Keputusan Bupati</a></li>
                                <li><a href="#">Instruksi Bupati</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h5>Lainnya</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Berita Terkini</a></li>
                                <li><a href="#">Galeri</a></li>
                                <li><a href="#">Kontak Kami</a></li>
                                <li><a href="https://jdihn.go.id" target="_blank">JDIH Nasional</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 text-center text-lg-start">
                <div class="footer-cta">
                    <h5>Layanan</h5>
                    <p class="small text-muted">Butuh bantuan terkait informasi hukum?</p>
                    <a href="{{ url('/kontak') }}" class="btn btn-primary rounded-pill px-4">Hubungi Kami</a>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="footer-bottom-content">
                        <p class="mb-0">© {{ date('Y') }} <strong>JDIH Kabupaten Maluku Barat Daya</strong>. All rights reserved.</p>
                        <div class="credits mt-2">
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>