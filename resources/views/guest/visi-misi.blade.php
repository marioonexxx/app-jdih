@extends('layouts.navbar-guest')
@section('title', 'Visi & Misi - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Visi & Misi</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="starter-section" class="starter-section section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Profil Instansi</span>
                <h2>Visi & Misi</h2>
            </div>
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="content card border-0 shadow-sm p-4 p-md-5 bg-white">
                            <div class="mb-5">
                                <h4 class="fw-bold text-primary border-start border-4 border-primary ps-3 mb-3">VISI</h4>
                                <div class="ps-4">
                                    {!! $profil->visi ?? '<p class="text-muted">Data visi belum diisi.</p>' !!}
                                </div>
                            </div>

                            <div>
                                <h4 class="fw-bold text-primary border-start border-4 border-primary ps-3 mb-3">MISI</h4>
                                <div class="ps-4">
                                    {!! $profil->misi ?? '<p class="text-muted">Data misi belum diisi.</p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <style>
        /* Tambahan agar konten dari CKEditor tetap rapi di sisi user */
        .content p {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
        }

        .content ul,
        .content ol {
            margin-bottom: 1.5rem;
        }
    </style>
@endsection
