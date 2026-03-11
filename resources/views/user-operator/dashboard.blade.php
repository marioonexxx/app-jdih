@extends('layouts.navbar')

@section('title', 'Dashboard Operator JDIH')

@section('content')
    <main>
        <div class="container-xl px-4 mt-5">
            {{-- HEADER SECTION --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Ringkasan Produk Hukum</h1>
                    <p class="text-muted mb-0">Selamat bekerja, {{ auth()->user()->nama_lengkap }}. Berikut ikhtisar data
                        hari ini.</p>
                </div>
                <div class="small fw-500 text-primary">
                    <i class="bi bi-calendar3 me-1"></i> {{ now()->isoFormat('dddd, D MMMM Y') }}
                </div>
            </div>

            {{-- COUNTER CARDS --}}
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm border-start border-primary border-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">Peraturan Daerah</div>
                                    <div class="h3 mb-0 fw-bold text-gray-800">{{ number_format($totalPerda) }}</div>
                                </div>
                                <div class="bg-primary-soft p-3 rounded-circle">
                                    <i class="fas fa-file-contract text-primary fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm border-start border-success border-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-xs fw-bold text-success text-uppercase mb-1">Peraturan Bupati</div>
                                    <div class="h3 mb-0 fw-bold text-gray-800">{{ number_format($totalPerbup) }}</div>
                                </div>
                                <div class="bg-success-soft p-3 rounded-circle">
                                    <i class="fas fa-file-alt text-success fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm border-start border-info border-4 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">Keputusan Bupati</div>
                                    <div class="h3 mb-0 fw-bold text-gray-800">{{ number_format($totalKepbup) }}</div>
                                </div>
                                <div class="bg-info-soft p-3 rounded-circle">
                                    <i class="fas fa-gavel text-info fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                {{-- TABEL INPUT TERBARU --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 fw-bold text-primary">Input Terbaru</h6>
                            <a href="{{ route('produk-hukum.index') }}"
                                class="btn btn-sm btn-primary-soft text-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4 border-0">No. Peraturan</th>
                                            <th class="border-0">Tentang</th>
                                            <th class="border-0">Tahun</th>
                                            <th class="border-0 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestDocs as $doc)
                                            <tr>
                                                <td class="ps-4 fw-bold text-primary">{{ $doc->nomor }}</td>
                                                <td>
                                                    <div class="small fw-bold text-dark">{{ Str::limit($doc->judul, 75) }}
                                                    </div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $doc->jenis }}
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-light text-dark">{{ $doc->tahun }}</span></td>
                                                <td class="text-center">
                                                    <a href="{{ route('produk-hukum.show', $doc->id) }}"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark me-2">
                                                        <i class="fas fa-eye text-primary"></i>
                                                    </a>
                                                    <a href="{{ route('produk-hukum.edit', $doc->id) }}"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark">
                                                        <i class="fas fa-edit text-warning"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5 text-muted">Belum ada data masuk.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR DASHBOARD: QUICK ACTIONS --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm bg-primary text-white mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold">Aksi Cepat</h5>
                            <p class="small opacity-75">Gunakan tombol di bawah untuk mempercepat navigasi pengelolaan data.
                            </p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('produk-hukum.create') }}"
                                    class="btn btn-white text-primary fw-bold shadow-sm">
                                    <i class="fas fa-plus me-2"></i> Tambah Produk Hukum
                                </a>
                                <a href="{{ route('posts.create') }}"
                                    class="btn btn-primary-soft text-white fw-bold border-white">
                                    <i class="fas fa-newspaper me-2"></i> Buat Berita Baru
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Informasi Sistem</h6>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <div class="small text-muted">Server Status: <strong>Online</strong></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-shield text-info me-2"></i>
                                <div class="small text-muted">Role: <strong>{{ ucwords(auth()->user()->role) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
