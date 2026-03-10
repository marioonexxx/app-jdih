@extends('layouts.navbar-guest')
@section('title', 'Selamat Datang di JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <!-- Blog Hero Section -->
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

                        <div class="swiper-slide">
                            <div class="blog-hero-item">
                                <img src="{{ asset('img/slider/slider-1.jpg') }}" alt="Blog Hero Image" class="img-fluid">
                                <div class="blog-hero-content">
                                    <span class="category">Lifestyle</span>
                                    <h1>5 Efficient Rules How to Organize Working Place Relationship</h1>
                                    <div class="meta">
                                        <span class="author">BY <a href="#">Dary Smith</a></span>
                                        <span class="date">02 Jan, 2024</span>
                                        <span class="read-time">3 Minute Read</span>
                                        <span class="views">1.9k views</span>
                                    </div>
                                    <a href="blog-details.html" class="read-more">Continue Reading <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!-- End slide item -->

                        <div class="swiper-slide">
                            <div class="blog-hero-item">
                                <img src="{{ asset('img/slider/slider-2.jpg') }}" alt="Blog Hero Image" class="img-fluid">
                                <div class="blog-hero-content">
                                    <span class="category">Business</span>
                                    <h1>The Future of Remote Work and Digital Transformation</h1>
                                    <div class="meta">
                                        <span class="author">BY <a href="#">Mark Johnson</a></span>
                                        <span class="date">12 Jan, 2024</span>
                                        <span class="read-time">4 Minute Read</span>
                                        <span class="views">2.3k views</span>
                                    </div>
                                    <a href="blog-details.html" class="read-more">Continue Reading <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!-- End slide item -->

                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            </div>

        </section><!-- /Blog Hero Section -->

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
                                        placeholder="Masukkan judul atau kata kunci...">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <select name="jenis" class="form-select bg-light border-0 py-3">
                                    <option value="">Semua Jenis</option>
                                    <option value="perda">Peraturan Daerah</option>
                                    <option value="perbup">Peraturan Bupati</option>
                                    <option value="sk">Surat Keputusan</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="tahun" class="form-select bg-light border-0 py-3">
                                    <option value="">Semua Tahun</option>
                                    @for ($i = date('Y'); $i >= 2010; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                                    CARI DATA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <!-- Latest Posts Section -->
        <section id="latest-posts" class="latest-posts section">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Berita Terbaru</span>
                <h2>Berita Terbaru</h2>
                <p>Informasi terkini seputar kegiatan dan perkembangan terbaru jaringan dokumentasi dan informasi hukum Kabupaten Maluku Barat Daya.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4 align-items-stretch">

                    @if ($posts->count() > 0)
                        {{-- 1. FEATURED POST (Postingan Pertama) --}}
                        @php $featured = $posts->first(); @endphp
                        <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="150">
                            <article class="featured-post position-relative h-100">
                                <figure class="featured-media m-0">
                                    <img src="{{ $featured->featured_image ? asset('storage/' . $featured->featured_image) : asset('story/assets/img/blog/blog-hero-4.webp') }}"
                                        alt="{{ $featured->title }}" class="img-fluid w-100" loading="lazy"
                                        style="height: 100%; object-fit: cover;">
                                </figure>

                                <div class="featured-content">
                                    <div class="date-badge">
                                        <span class="day">{{ $featured->created_at->format('d') }}</span>
                                        <span class="mon">{{ $featured->created_at->format('M') }}</span>
                                    </div>

                                    <span class="cat-badge inverse">{{ $featured->category->name }}</span>

                                    <h3 class="title">{{ $featured->title }}</h3>
                                    <p class="excerpt d-none d-md-block">
                                        {!! Str::limit(strip_tags($featured->content), 150) !!}
                                    </p>

                                    <div class="meta d-flex align-items-center gap-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person"></i><span
                                                class="ps-2">{{ $featured->author->name ?? 'Admin' }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('posts.show', $featured->slug) }}" class="readmore stretched-link">
                                        <span>Lanjutkan</span><i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>

                        {{-- 2. COMPACT POSTS (Postingan ke-2 dan ke-3) --}}
                        <div class="col-lg-5">
                            <div class="row gy-4">
                                @foreach ($posts->slice(1, 2) as $post)
                                    <div class="col-12" data-aos="fade-left" data-aos-delay="200">
                                        <article class="compact-post h-100">
                                            <div class="thumb">
                                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('story/assets/img/blog/blog-post-square-2.webp') }}"
                                                    class="img-fluid" alt="{{ $post->title }}" loading="lazy"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="content">
                                                <div class="meta">
                                                    <span class="date">{{ $post->created_at->format('d M') }}</span>
                                                    <span class="dot">•</span>
                                                    <span class="category">{{ $post->category->name }}</span>
                                                </div>
                                                <h4 class="title">{{ Str::limit($post->title, 50) }}</h4>
                                                <a href="{{ route('posts.show', $post->slug) }}"
                                                    class="readmore"><span>Baca Artikel</span><i
                                                        class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- 3. GRID POSTS (Postingan ke-4 dan seterusnya) --}}
                        @foreach ($posts->slice(3) as $post)
                            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                                <article class="card-post h-100">
                                    <div class="post-img position-relative overflow-hidden">
                                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('story/assets/img/blog/blog-post-2.webp') }}"
                                            class="img-fluid w-100" alt="{{ $post->title }}" loading="lazy"
                                            style="height: 240px; object-fit: cover;">
                                    </div>
                                    <div class="content">
                                        <div class="meta d-flex align-items-center flex-wrap gap-2">
                                            <span class="cat-badge">{{ $post->category->name }}</span>
                                            <div class="d-flex align-items-center ms-auto">
                                                <i class="bi bi-person"></i><span
                                                    class="ps-2">{{ $post->author->name ?? 'Admin' }}</span>
                                            </div>
                                        </div>
                                        <h3 class="title">{{ Str::limit($post->title, 60) }}</h3>
                                        <a href="{{ route('posts.show', $post->slug) }}" class="readmore"><span>Baca
                                                Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada berita yang diterbitkan.</p>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <!-- /Latest Posts Section -->

    </main>
@endsection
