@extends('layouts.navbar-guest')
@section('title', 'Selamat Datang di JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <section id="blog-hero" class="blog-hero section">
            <div class="container-fluid p-0" data-aos="fade">
                <div class="blog-hero-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 1000,
              "effect": "fade",
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 1,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
            </script>

                    <div class="swiper-wrapper">
                        @forelse($sliders as $slide)
                            <div class="swiper-slide">
                                <div class="blog-hero-item">
                                    {{-- Perbaikan path gambar: pastikan symlink sudah benar --}}
                                    <img src="{{ asset('storage/public/sliders/' . $slide->image) }}" alt="{{ $slide->title }}"
                                        class="img-fluid">

                                    <div class="blog-hero-content">
                                        <h1 data-aos="fade-up" data-aos-delay="100">{{ $slide->title }}</h1>

                                        <p class="text-white mb-4" data-aos="fade-up" data-aos-delay="200">
                                            {{ $slide->description }}</p>

                                        <div class="meta mb-4" data-aos="fade-up" data-aos-delay="300">
                                            <span class="date"><i
                                                    class="bi bi-calendar-event me-2"></i>{{ $slide->created_at->format('d M, Y') }}</span>
                                        </div>

                                        @if ($slide->button_link)
                                            <div data-aos="fade-up" data-aos-delay="400">
                                                <a href="{{ url($slide->button_link) }}"
                                                    class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center transition-all shadow-lg hover-translate-y">
                                                    {{ $slide->button_text ?? 'Lihat Selengkapnya' }}
                                                    <i class="bi bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="blog-hero-item">
                                    <img src="{{ asset('img/slider/slider-1.jpg') }}" alt="Default Image" class="img-fluid">
                                    <div class="blog-hero-content">
                                        <h1>Selamat Datang di JDIH</h1>
                                        <p>Silakan tambahkan gambar slider melalui dashboard operator.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </section>
        {{-- Search Produk Hukum --}}
        <section id="search-regulation" class="search-regulation section py-0">
            <div class="container" data-aos="fade-up">
                <div class="search-wrapper shadow-lg rounded-4 p-4 p-md-5 bg-white"
                    style="margin-top: -80px; position: relative; z-index: 10;">
                    <div class="row mb-4 text-center">
                        <div class="col-12">
                            <h3 class="fw-bold">Pencarian Produk Hukum</h3>
                            <p class="text-muted">Temukan Peraturan Daerah, Peraturan Bupati, dan Dokumen Hukum lainnya</p>
                        </div>
                    </div>

                    <form action="{{ route('guest.peraturan.search') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                                    <input type="text" name="judul" class="form-control bg-light border-0 py-3"
                                        placeholder="Masukkan judul atau kata kunci..." value="{{ request('judul') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <select name="jenis" class="form-select bg-light border-0 py-3">
                                    <option value="">Semua Jenis</option>
                                    @foreach ($listJenis as $kelompok => $items)
                                        <optgroup label="{{ $kelompok }}">
                                            @foreach ($items as $item)
                                                <option value="{{ $item->nama }}"
                                                    {{ request('jenis') == $item->nama ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="tahun" class="form-select bg-light border-0 py-3">
                                    <option value="">Semua Tahun</option>
                                    @php $currentYear = date('Y'); @endphp
                                    @for ($i = $currentYear; $i >= 2010; $i--)
                                        <option value="{{ $i }}"
                                            {{ request('tahun') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm">
                                    CARI DATA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        {{-- SECTION STATISTIK & PERATURAN TERBARU --}}
        <section id="stats-latest" class="stats-latest section light-background">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    {{-- SISI KIRI: STATISTIK --}}
                    <div class="col-lg-7">
                        <div class="section-title text-start mb-4">
                            <h2 class="fw-bold">Statistik Produk Hukum</h2>
                            <p>Jumlah dokumen hukum yang terintegrasi di JDIH MBD</p>
                        </div>

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div
                                    class="stats-item d-flex align-items-center w-100 h-100 p-4 shadow-sm bg-white rounded-4 border-0">
                                    <i class="bi bi-file-earmark-text text-primary flex-shrink-0"
                                        style="font-size: 40px;"></i>
                                    <div class="ms-3">
                                        <span
                                            class="d-block fs-2 fw-bold text-dark">{{ number_format($totalPerda ?? 0) }}</span>
                                        <p class="mb-0 text-muted fw-medium">Peraturan Daerah</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="stats-item d-flex align-items-center w-100 h-100 p-4 shadow-sm bg-white rounded-4 border-0">
                                    <i class="bi bi-file-earmark-check text-success flex-shrink-0"
                                        style="font-size: 40px;"></i>
                                    <div class="ms-3">
                                        <span
                                            class="d-block fs-2 fw-bold text-dark">{{ number_format($totalPerbup ?? 0) }}</span>
                                        <p class="mb-0 text-muted fw-medium">Peraturan Bupati</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="stats-item d-flex align-items-center w-100 h-100 p-4 shadow-sm bg-white rounded-4 border-0">
                                    <i class="bi bi-journal-text text-info flex-shrink-0" style="font-size: 40px;"></i>
                                    <div class="ms-3">
                                        <span
                                            class="d-block fs-2 fw-bold text-dark">{{ number_format($totalSkBupati ?? 0) }}</span>
                                        <p class="mb-0 text-muted fw-medium">Keputusan Bupati</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div
                                    class="stats-item d-flex align-items-center w-100 h-100 p-4 shadow-sm bg-white rounded-4 border-0">
                                    <i class="bi bi-people text-warning flex-shrink-0" style="font-size: 40px;"></i>
                                    <div class="ms-3">
                                        <span
                                            class="d-block fs-2 fw-bold text-dark">{{ number_format($totalPengunjung ?? 0) }}</span>
                                        <p class="mb-0 text-muted fw-medium">Total Kunjungan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SISI KANAN: PERATURAN TERBARU --}}
                    <div class="col-lg-5">
                        <div class="section-title text-start mb-4">
                            <h2 class="fw-bold">Peraturan Terbaru</h2>
                            <p>Regulasi terbaru yang telah diundangkan</p>
                        </div>

                        <div class="latest-regulations-list shadow-sm bg-white rounded-4 p-3 border-0">
                            @if (isset($latestRegulations) && $latestRegulations->count() > 0)
                                @foreach ($latestRegulations as $reg)
                                    <div
                                        class="reg-item d-flex align-items-start border-bottom py-3 px-2 transition-all hover-bg-light">
                                        <div class="reg-icon bg-light rounded-3 p-2 text-danger me-3 shadow-sm">
                                            <i class="bi bi-file-earmark-pdf-fill fs-4"></i>
                                        </div>
                                        <div class="reg-info">
                                            <h6 class="mb-1">
                                                <a href="{{ route('guest.peraturan.show', $reg->id) }}"
                                                    class="text-dark fw-bold text-decoration-none"
                                                    style="font-size: 0.95rem;">
                                                    {{ Str::limit($reg->judul, 70) }}
                                                </a>
                                            </h6>
                                            <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                                <span
                                                    class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2"
                                                    style="font-size: 0.75rem;">
                                                    No. {{ $reg->nomor }} Thn {{ $reg->tahun }}
                                                </span>
                                                <span class="text-muted small">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ $reg->created_at->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-center mt-3 p-2">
                                    <a href="{{ route('guest.peraturan.search') }}"
                                        class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">
                                        Lihat Semua Produk Hukum <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-folder-x fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">Belum ada peraturan terbaru.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="latest-posts" class="latest-posts section">
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Berita Terbaru</span>
                <h2>Berita Terbaru</h2>
                <p>Informasi terkini seputar kegiatan JDIH Kabupaten Maluku Barat Daya.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4 align-items-stretch">
                    @if ($posts->count() > 0)
                        @php $featured = $posts->first(); @endphp
                        {{-- FEATURED POST --}}
                        <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="150">
                            <article class="featured-post position-relative h-100 shadow-sm rounded-4 overflow-hidden">
                                <figure class="featured-media m-0">
                                    <img src="{{ $featured->featured_image ? asset('storage/' . $featured->featured_image) : asset('img/blog/blog-hero-4.webp') }}"
                                        alt="{{ $featured->title }}" class="img-fluid w-100" loading="lazy"
                                        style="height: 450px; object-fit: cover;">
                                </figure>
                                <div class="featured-content p-4">
                                    <div class="date-badge mb-3">
                                        <span class="day fw-bold fs-4">{{ $featured->created_at->format('d') }}</span>
                                        <span
                                            class="mon text-uppercase small">{{ $featured->created_at->format('M') }}</span>
                                    </div>
                                    <span class="badge bg-primary mb-2">{{ $featured->category->name }}</span>
                                    <h3 class="title h4 fw-bold text-white">{{ $featured->title }}</h3>
                                    <p class="excerpt d-none d-md-block text-white-50">
                                        {{ Str::limit(strip_tags($featured->content), 120) }}
                                    </p>
                                    <a href="{{ route('berita.detail', $featured->slug) }}"
                                        class="readmore stretched-link text-white text-decoration-none fw-bold">
                                        <span>Lanjutkan Membaca</span><i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </article>
                        </div>

                        {{-- COMPACT & GRID POSTS --}}
                        <div class="col-lg-5">
                            <div class="row gy-4">
                                @foreach ($posts->skip(1)->take(2) as $post)
                                    <div class="col-12" data-aos="fade-left" data-aos-delay="200">
                                        <article
                                            class="compact-post h-100 d-flex align-items-center bg-white p-3 rounded-4 shadow-sm border">
                                            <div class="thumb flex-shrink-0">
                                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('img/blog/blog-post-square-2.webp') }}"
                                                    class="rounded-3" alt="{{ $post->title }}" loading="lazy"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="content ms-3">
                                                <div class="meta small text-muted mb-1">
                                                    <span>{{ $post->created_at->format('d M Y') }}</span>
                                                    <span class="mx-1">•</span>
                                                    <span class="text-primary">{{ $post->category->name }}</span>
                                                </div>
                                                <h5 class="title h6 fw-bold mb-2">{{ Str::limit($post->title, 45) }}</h5>
                                                <a href="{{ route('berita.detail', $post->slug) }}"
                                                    class="small fw-bold text-primary text-decoration-none">
                                                    Baca Artikel <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- EXTRA GRID POSTS (Jika ada lebih dari 3 berita) --}}
                        @foreach ($posts->skip(3) as $post)
                            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                                <article class="card-post h-100 border rounded-4 overflow-hidden shadow-sm bg-white">
                                    <div class="post-img position-relative overflow-hidden">
                                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('img/blog/blog-post-2.webp') }}"
                                            class="img-fluid w-100" alt="{{ $post->title }}" loading="lazy"
                                            style="height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="content p-3">
                                        <div class="meta d-flex align-items-center mb-2">
                                            <span
                                                class="badge bg-light text-primary border">{{ $post->category->name }}</span>
                                            <span class="small text-muted ms-auto"><i
                                                    class="bi bi-calendar me-1"></i>{{ $post->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        <h3 class="title h6 fw-bold">{{ Str::limit($post->title, 55) }}</h3>
                                        <a href="{{ route('berita.detail', $post->slug) }}"
                                            class="btn btn-link p-0 text-decoration-none fw-bold small">
                                            Selengkapnya <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-journal-x fs-1 text-muted"></i>
                            <p class="text-muted mt-2 italic">Belum ada berita yang diterbitkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </main>

    {{-- Tambahkan sedikit CSS custom agar hover lebih halus --}}
    <style>
        .hover-translate-y:hover {
            transform: translateY(-3px);
            transition: 0.3s;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
@endsection
