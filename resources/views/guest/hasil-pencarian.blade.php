@extends('layouts.navbar-guest')
@section('title', 'Pencarian Produk Hukum - JDIH MBD')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Hasil Pencarian</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="section bg-light">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px; z-index: 10;">
                            <h5 class="fw-bold mb-3"><i class="bi bi-filter-left me-2"></i>Filter Pencarian</h5>
                            <hr>
                            <form action="{{ route('guest.peraturan.search') }}" method="GET">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Kata Kunci</label>
                                    <input type="text" name="judul" class="form-control form-control-sm"
                                        placeholder="Judul atau Nomor..." value="{{ request('judul') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Jenis Peraturan</label>
                                    <select name="jenis" class="form-select form-select-sm">
                                        <option value="">Semua Jenis</option>
                                        <option value="perda" {{ request('jenis') == 'perda' ? 'selected' : '' }}>Peraturan
                                            Daerah</option>
                                        <option value="perbup" {{ request('jenis') == 'perbup' ? 'selected' : '' }}>
                                            Peraturan Bupati</option>
                                        <option value="sk" {{ request('jenis') == 'sk' ? 'selected' : '' }}>Surat
                                            Keputusan</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Tahun</label>
                                    <select name="tahun" class="form-select form-select-sm">
                                        <option value="">Semua Tahun</option>
                                        @for ($i = date('Y'); $i >= 2010; $i--)
                                            <option value="{{ $i }}"
                                                {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-bold">
                                    <i class="bi bi-search me-2"></i>Terapkan Filter
                                </button>
                                <a href="{{ route('guest.peraturan.search') }}"
                                    class="btn btn-light w-100 mt-2 small">Reset</a>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold m-0">Menampilkan {{ $results->total() }} Dokumen</h5>
                            <span class="text-muted small">Halaman {{ $results->currentPage() }} dari
                                {{ $results->lastPage() }}</span>
                        </div>

                        @forelse($results as $item)
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 item-peraturan">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="mb-2">
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill mb-2">
                                                {{ $item->jenis->nama ?? 'Produk Hukum' }}
                                            </span>
                                            <span class="ms-2 small text-muted"><i class="bi bi-calendar3 me-1"></i> Tahun
                                                {{ $item->tahun }}</span>
                                        </div>
                                        <h5 class="fw-bold mb-2">
                                            <a href="#" class="text-dark hover-blue">{{ $item->judul }}</a>
                                        </h5>
                                        <div class="text-muted small mb-3">
                                            <strong>Nomor:</strong> {{ $item->nomor }} |
                                            <strong>Status:</strong>
                                            @if ($item->status == 'berlaku')
                                                <span class="text-success fw-bold">Berlaku</span>
                                            @else
                                                <span class="text-danger fw-bold">Tidak Berlaku</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex flex-column justify-content-center border-start ps-md-4">
                                        <a href="{{ asset('storage/peraturan/' . $item->file) }}"
                                            class="btn btn-outline-danger btn-sm mb-2 w-100" target="_blank">
                                            <i class="bi bi-file-pdf me-1"></i> Lihat PDF
                                        </a>
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-info-circle me-1"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                                <i class="bi bi-file-earmark-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">Data tidak ditemukan. Cobalah mengubah filter pencarian Anda.</p>
                            </div>
                        @endforelse

                        <div class="mt-4">
                            {{ $results->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <style>
        .sticky-top {
            transition: all 0.3s ease;
        }

        .item-peraturan {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 4px solid transparent !important;
        }

        .item-peraturan:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
            border-left: 4px solid #0061f2 !important;
        }

        .hover-blue:hover {
            color: #0061f2 !important;
        }

        .bg-primary-subtle {
            background-color: #eef5ff !important;
        }
    </style>
@endsection
