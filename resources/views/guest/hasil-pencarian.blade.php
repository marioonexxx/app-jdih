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

                    {{-- SIDEBAR FILTER --}}
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

                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Tahun</label>
                                    <select name="tahun" class="form-select form-select-sm">
                                        <option value="">Semua Tahun</option>
                                        @for ($i = date('Y'); $i >= 2010; $i--)
                                            <option value="{{ $i }}"
                                                {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm mb-2">
                                    <i class="bi bi-search me-2"></i>Terapkan Filter
                                </button>
                                <a href="{{ route('guest.peraturan.search') }}"
                                    class="btn btn-outline-secondary btn-sm w-100">Reset</a>
                            </form>
                        </div>
                    </div>

                    {{-- LIST HASIL PENCARIAN --}}
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold m-0 text-dark">Ditemukan {{ $results->total() }} Dokumen</h5>
                            <span class="badge bg-white text-dark shadow-sm border px-3 py-2 rounded-pill">
                                Halaman {{ $results->currentPage() }} dari {{ $results->lastPage() }}
                            </span>
                        </div>

                        @forelse($results as $item)
                            <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 item-peraturan">
                                <div class="row align-items-center">
                                    {{-- Konten Utama --}}
                                    <div class="col-md-9">
                                        <div class="mb-2 d-flex align-items-center gap-2 flex-wrap">
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                                {{ $item->jenis }}
                                            </span>
                                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>
                                                {{ $item->tahun }}</small>
                                            <small class="text-muted border-start ps-2">No: {{ $item->nomor }}</small>
                                        </div>

                                        <h5 class="fw-bold mb-3">
                                            <a href="{{ route('guest.peraturan.show', $item->id) }}"
                                                class="text-dark hover-blue text-decoration-none lh-base">
                                                {{ $item->judul }}
                                            </a>
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <span class="small text-muted me-2">Status:</span>
                                            @if ($item->status == 'Berlaku' || $item->status == 'Tetap')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $item->status }}
                                                </span>
                                            @elseif($item->status == 'Berlaku (Diubah)')
                                                <span
                                                    class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                                                    <i class="bi bi-info-circle-fill me-1"></i>{{ $item->status }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">
                                                    <i class="bi bi-x-circle-fill me-1"></i>{{ $item->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tombol Aksi --}}
                                    <div class="col-md-3 mt-3 mt-md-0 border-start-md ps-md-4 d-grid gap-2">
                                        <a href="{{ route('guest.peraturan.show', $item->id) }}"
                                            class="btn btn-primary btn-sm rounded-3">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                        <a href="{{ route('guest.peraturan.download', $item->id) }}"
                                            class="btn btn-outline-danger btn-sm rounded-3">
                                            <i class="bi bi-download me-1"></i> PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                                <i class="bi bi-search text-muted opacity-25" style="font-size: 4rem;"></i>
                                <h5 class="mt-3 fw-bold">Data Tidak Ditemukan</h5>
                                <p class="text-muted">Cobalah menggunakan kata kunci lain atau reset filter pencarian Anda.
                                </p>
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
        .item-peraturan {
            transition: all 0.3s ease;
            border-left: 5px solid transparent !important;
        }

        .item-peraturan:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08) !important;
            border-left: 5px solid #0d6efd !important;
        }

        .hover-blue:hover {
            color: #0d6efd !important;
        }

        .bg-primary-subtle {
            background-color: #eef5ff !important;
        }

        .bg-success-subtle {
            background-color: #e6f9ed !important;
        }

        .bg-danger-subtle {
            background-color: #fff2f2 !important;
        }

        @media (min-width: 768px) {
            .border-start-md {
                border-left: 1px solid #dee2e6 !important;
            }
        }
    </style>
@endsection
