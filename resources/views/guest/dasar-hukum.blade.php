@extends('layouts.navbar-guest')
@section('title', 'Dasar Hukum - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Dasar Hukum</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="starter-section" class="starter-section section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Profil Instansi</span>
                <h2>Dasar Hukum</h2>
            </div>
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="content card border-0 shadow-sm p-4 p-md-5 bg-white">
                            <div class="mb-2">
                                <h4 class="fw-bold text-primary border-start border-4 border-primary ps-3 mb-4">
                                    DASAR HUKUM PEMBENTUKAN
                                </h4>
                                <div class="ps-md-4 legal-text">
                                    @if ($profil && $profil->dasar_hukum)
                                        {!! $profil->dasar_hukum !!}
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-3">Data dasar hukum belum tersedia.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <style>
        /* Styling khusus untuk teks hukum agar lebih formal */
        .legal-text {
            line-height: 1.8;
            font-size: 1.05rem;
            color: #333;
            text-align: justify;
        }

        .legal-text p {
            margin-bottom: 1.2rem;
        }

        /* Merapikan bullet points jika ada list peraturan */
        .legal-text ul,
        .legal-text ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .legal-text li {
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
