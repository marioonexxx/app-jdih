@extends('layouts.navbar-guest')
@section('title', $post->title . ' - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="#">Berita</a></li>
                        <li class="current">Detail Berita</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section id="starter-section" class="starter-section section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">{{ $post->category->name }}</span>
                <h2>Detail Berita</h2>
            </div>

            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="content card border-0 shadow-sm p-4 p-md-5 bg-white">

                            {{-- Judul dan Meta --}}
                            <div class="mb-4">
                                <h2 class="fw-bold text-dark mb-3">{{ $post->title }}</h2>
                                <div class="d-flex flex-wrap gap-3 text-muted small border-bottom pb-3">
                                    <span><i class="bi bi-person me-1"></i> {{ $post->author->name ?? 'Admin' }}</span>
                                    <span><i class="bi bi-calendar3 me-1"></i>
                                        {{ $post->created_at->format('d M Y') }}</span>
                                    <span><i class="bi bi-tag me-1"></i> {{ $post->category->name }}</span>
                                </div>
                            </div>

                            {{-- Gambar Utama --}}
                            @if ($post->featured_image)
                                <div class="mb-5 text-center">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="img-fluid rounded-4 shadow-sm"
                                        style="max-height: 500px; width: 100%; object-fit: cover;">
                                </div>
                            @endif

                            {{-- Isi Konten --}}
                            <div class="article-body">
                                {!! $post->content !!}
                            </div>

                            {{-- Tombol Kembali --}}
                            <div class="mt-5 pt-4 border-top">
                                <a href="{{ url('/') }}#latest-posts" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Berita
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <style>
        /* Mengikuti styling konsisten Anda */
        .article-body p {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .article-body ul,
        .article-body ol {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
        }

        .article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
        }
    </style>
@endsection
