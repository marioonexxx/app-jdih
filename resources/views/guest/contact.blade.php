@extends('layouts.navbar-guest')
@section('title', 'Kontak - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Kontak</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="contact" class="contact section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Hubungi Kami</span>
                <h2>Kontak Kami</h2>
                <p>Silakan hubungi kami untuk informasi lebih lanjut mengenai produk hukum Kabupaten Maluku Barat Daya</p>
            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">
                        <div class="info-wrap p-4 shadow-sm h-100 bg-white rounded">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Alamat</h3>
                                    <p>Tiakur, Kabupaten Maluku Barat Daya, Maluku</p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Telepon</h3>
                                    <p>+62 812-XXXX-XXXX</p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>jdih.mbdkab@gmail.com</p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                                <i class="bi bi-clock flex-shrink-0"></i>
                                <div>
                                    <h3>Jam Operasional</h3>
                                    <p>Senin - Jumat: 08:00 - 16:00 WIT</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="p-2 shadow-sm bg-white rounded h-100">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126620.370334584!2d127.848035!3d-8.218556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d2e1329b3a3c261%3A0x4030bf45bc62880!2sTiakur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </div>

            </div>

        </section>
    </main>

    <style>
        .info-wrap .info-item i {
            font-size: 20px;
            color: #0061f2;
            float: left;
            width: 44px;
            height: 44px;
            background: #eef5ff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            margin-right: 15px;
        }

        .info-wrap .info-item h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }

        .info-wrap .info-item p {
            padding: 0;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .info-item:hover i {
            background: #0061f2;
            color: #fff;
        }
    </style>
@endsection
