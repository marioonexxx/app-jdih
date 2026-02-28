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
                                <img src="{{ asset('story/assets/img/blog/blog-hero-1.webp') }}" alt="Blog Hero Image"
                                    class="img-fluid">
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
                                <img src="{{ asset('story/assets/img/blog/blog-hero-2.webp') }}" alt="Blog Hero Image"
                                    class="img-fluid">
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

                        <div class="swiper-slide">
                            <div class="blog-hero-item">
                                <img src="{{ asset('story/assets/img/blog/blog-hero-3.webp') }}" alt="Blog Hero Image"
                                    class="img-fluid">
                                <div class="blog-hero-content">
                                    <span class="category">Technology</span>
                                    <h1>Artificial Intelligence in Modern Business Applications</h1>
                                    <div class="meta">
                                        <span class="author">BY <a href="#">Sarah Williams</a></span>
                                        <span class="date">10 Jan, 2024</span>
                                        <span class="read-time">5 Minute Read</span>
                                        <span class="views">3.1k views</span>
                                    </div>
                                    <a href="blog-details.html" class="read-more">Continue Reading <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!-- End slide item -->

                        <div class="swiper-slide">
                            <div class="blog-hero-item">
                                <img src="assets/img/blog/blog-hero-4.webp" alt="Blog Hero Image" class="img-fluid">
                                <div class="blog-hero-content">
                                    <span class="category">Leadership</span>
                                    <h1>Building High-Performance Teams in a Digital Age</h1>
                                    <div class="meta">
                                        <span class="author">BY <a href="#">David Chen</a></span>
                                        <span class="date">8 Jan, 2024</span>
                                        <span class="read-time">4 Minute Read</span>
                                        <span class="views">2.7k views</span>
                                    </div>
                                    <a href="blog-details.html" class="read-more">Continue Reading <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!-- End slide item -->

                        <div class="swiper-slide">
                            <div class="blog-hero-item">
                                <img src="{{ asset('story/assets/img/blog/blog-hero-5.webp') }}" alt="Blog Hero Image"
                                    class="img-fluid">
                                <div class="blog-hero-content">
                                    <span class="category">Innovation</span>
                                    <h1>Sustainable Business Practices for the Modern Enterprise</h1>
                                    <div class="meta">
                                        <span class="author">BY <a href="#">Emma Davis</a></span>
                                        <span class="date">6 Jan, 2024</span>
                                        <span class="read-time">3 Minute Read</span>
                                        <span class="views">2.5k views</span>
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

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Latest Posts</span>
                <h2>Latest Posts</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-stretch">

                    <div class="col-lg-7" data-aos="zoom-in" data-aos-delay="150">
                        <article class="featured-post position-relative h-100">
                            <figure class="featured-media m-0">
                                <img src="{{ asset('story/assets/img/blog/blog-hero-4.webp') }}" alt="Featured post image"
                                    class="img-fluid w-100" loading="lazy">
                            </figure>

                            <div class="featured-content">
                                <div class="date-badge">
                                    <span class="day">12</span>
                                    <span class="mon">Dec</span>
                                </div>

                                <span class="cat-badge inverse">Politics</span>

                                <h3 class="title">Veritatis maiores natus officiis sit, temporibus alias dicta
                                    voluptatum</h3>
                                <p class="excerpt d-none d-md-block">Quisquam perferendis officiis incidunt, facilisis
                                    aliquet consectetur lorem luctus. Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>

                                <div class="meta d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i><span class="ps-2">Jane Cooper</span>
                                    </div>
                                    <span class="sep">/</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i><span class="ps-2">Editorial</span>
                                    </div>
                                </div>

                                <a href="blog-details.html" class="readmore stretched-link"><span>Continue</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div><!-- End Featured Post -->

                    <div class="col-lg-5">
                        <div class="row gy-4">
                            <div class="col-12" data-aos="fade-left" data-aos-delay="200">
                                <article class="compact-post h-100">
                                    <div class="thumb">
                                        <img src="{{ asset('story/assets/img/blog/blog-post-square-2') }}.webp"
                                            class="img-fluid" alt="Post thumbnail" loading="lazy">
                                    </div>
                                    <div class="content">
                                        <div class="meta">
                                            <span class="date">05 Aug</span>
                                            <span class="dot">•</span>
                                            <span class="category">Sports</span>
                                        </div>
                                        <h4 class="title">Officia recusandae cumque, dolore asperiores ducimus</h4>
                                        <a href="blog-details.html" class="readmore"><span>Read Article</span><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </article>
                            </div><!-- End Compact Post -->

                            <div class="col-12" data-aos="fade-left" data-aos-delay="300">
                                <article class="compact-post h-100">
                                    <div class="thumb">
                                        <img src="{{ asset('story/assets/img/blog/blog-post-square-5') }}.webp"
                                            class="img-fluid" alt="Post thumbnail" loading="lazy">
                                    </div>
                                    <div class="content">
                                        <div class="meta">
                                            <span class="date">22 Jan</span>
                                            <span class="dot">•</span>
                                            <span class="category">Economics</span>
                                        </div>
                                        <h4 class="title">Elit pharetra diam quam, pretium tempor iaculis integer</h4>
                                        <a href="blog-details.html" class="readmore"><span>Read Article</span><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </article>
                            </div><!-- End Compact Post -->
                        </div>
                    </div><!-- End Right Column -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <article class="card-post h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('story/assets/img/blog/blog-post-2.webp') }}" class="img-fluid w-100"
                                    alt="Post image" loading="lazy">
                            </div>
                            <div class="content">
                                <div class="meta d-flex align-items-center flex-wrap gap-2">
                                    <span class="cat-badge">Economics</span>
                                    <div class="d-flex align-items-center ms-auto">
                                        <i class="bi bi-person"></i><span class="ps-2">Robert Fox</span>
                                    </div>
                                </div>
                                <h3 class="title">Quam impedit minus, cumque aliquam deleniti inventore</h3>
                                <a href="blog-details.html" class="readmore"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div><!-- End Grid Post -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="250">
                        <article class="card-post h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('story/assets/img/blog/blog-post-4.webp') }}" class="img-fluid w-100"
                                    alt="Post image" loading="lazy">
                            </div>
                            <div class="content">
                                <div class="meta d-flex align-items-center flex-wrap gap-2">
                                    <span class="cat-badge">Travel</span>
                                    <div class="d-flex align-items-center ms-auto">
                                        <i class="bi bi-person"></i><span class="ps-2">Courtney Henry</span>
                                    </div>
                                </div>
                                <h3 class="title">Dicta similique totam, suscipit soluta veritatis perferendis</h3>
                                <a href="blog-details.html" class="readmore"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div><!-- End Grid Post -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <article class="card-post h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('story/assets/img/blog/blog-post-6.webp') }}" class="img-fluid w-100"
                                    alt="Post image" loading="lazy">
                            </div>
                            <div class="content">
                                <div class="meta d-flex align-items-center flex-wrap gap-2">
                                    <span class="cat-badge">Lifestyle</span>
                                    <div class="d-flex align-items-center ms-auto">
                                        <i class="bi bi-person"></i><span class="ps-2">Wade Warren</span>
                                    </div>
                                </div>
                                <h3 class="title">Natus consequuntur, numquam adipisci cumque facilisis</h3>
                                <a href="blog-details.html" class="readmore"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div><!-- End Grid Post -->

                </div>

            </div>

        </section><!-- /Latest Posts Section -->

    </main>
@endsection
