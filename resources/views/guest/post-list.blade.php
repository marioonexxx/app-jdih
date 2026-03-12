@extends('layouts.navbar-guest')
@section('title', 'Berita & Kegiatan - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Berita & Kegiatan</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section id="starter-section" class="starter-section section">
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Informasi Terbaru</span>
                <h2>Berita & Kegiatan</h2>
            </div>

            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    @forelse ($posts as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100 overflow-hidden post-card">
                                <div class="position-relative">
                                    @if ($item->featured_image)
                                        <img src="{{ asset('storage/' . $item->featured_image) }}" class="card-img-top"
                                            alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm">
                                        {{ $item->category->name ?? 'Berita' }}
                                    </span>
                                </div>

                                <div class="card-body p-4">
                                    <div class="text-muted small mb-2">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') }}
                                    </div>
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ route('berita.detail', $item->slug) }}"
                                            class="text-dark text-decoration-none stretched-link">
                                            {{ Str::limit($item->title, 65) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit(strip_tags($item->content), 100) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <img src="{{ asset('assets/img/empty.svg') }}" alt="Empty" style="width: 150px;"
                                class="mb-3 opacity-50">
                            <p class="text-muted">Belum ada berita atau kegiatan yang dipublikasikan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    </main>

    <style>
        .post-card {
            transition: all 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .post-card img {
            transition: transform 0.5s ease;
        }

        .post-card:hover img {
            transform: scale(1.1);
        }
    </style>
@endsection
