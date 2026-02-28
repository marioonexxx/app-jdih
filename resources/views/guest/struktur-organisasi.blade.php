@extends('layouts.navbar-guest')
@section('title', 'Struktur Organisasi - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Struktur Organisasi</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="starter-section" class="starter-section section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Profil Instansi</span>
                <h2>Struktur Organisasi</h2>
            </div>
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="content card border-0 shadow-sm p-3 p-md-4 bg-white text-center">

                            @if ($profil && $profil->struktur_organisasi)
                                <a href="{{ asset('storage/profil/' . $profil->struktur_organisasi) }}" class="glightbox"
                                    data-gallery="structure-gallery">
                                    <img src="{{ asset('storage/profil/' . $profil->struktur_organisasi) }}"
                                        alt="Struktur Organisasi JDIH MBD" class="img-fluid rounded shadow-sm hover-zoom">
                                </a>
                                <p class="text-muted mt-3 small">
                                    <i class="bi bi-zoom-in me-1"></i> Klik gambar untuk memperbesar
                                </p>
                            @else
                                <div class="py-5">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Data struktur organisasi belum tersedia.</p>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <style>
        .hover-zoom {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .hover-zoom:hover {
            transform: scale(1.01);
        }

        /* Menyesuaikan area card agar gambar maksimal */
        .content img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
