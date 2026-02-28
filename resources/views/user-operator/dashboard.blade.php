@extends('layouts.navbar')
@section('title', 'Dashboard JDIH Kabupaten Maluku Barat Daya')
@section('content')
    <main>
        <div class="container-xl px-4 mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="me-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Dashboard Statistik</h1>
                    <div class="small">
                        <span class="fw-500 text-primary">{{ date('l') }}</span>
                        &middot; {{ date('F d, Y') }} &middot; {{ date('H:i A') }}
                    </div>
                </div>
            </div>

            <div class="card card-waves mb-4 mt-5">
                <div class="card-body p-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            <h2 class="text-primary">Selamat Datang, {{ auth()->user()->nama_lengkap }}!</h2>
                            <p class="text-gray-700">
                                Anda login sebagai
                                <strong>{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</strong>.
                                Gunakan dashboard ini untuk memantau publikasi produk hukum JDIH Kabupaten Maluku Barat Daya
                                secara real-time.
                            </p>
                            <a class="btn btn-primary p-3" href="#!">
                                Lihat Semua Produk Hukum
                                <i class="ms-1" data-feather="arrow-right"></i>
                            </a>
                        </div>
                        <div class="col d-none d-lg-block mt-xxl-n4">
                            <img class="img-fluid px-xl-4"
                                src="{{ asset('sbadmin/assets/img/illustrations/statistics.svg') }}"
                                style="max-width: 250px; height: auto; display: block; margin-left: auto; margin-right: auto;" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-lg border-start-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small fw-bold text-primary mb-1">Peraturan Daerah (PERDA)</div>
                                    <div class="h5">128 Dokumen</div>
                                </div>
                                <div class="ms-2"><i class="fas fa-file-contract fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-lg border-start-secondary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small fw-bold text-secondary mb-1">Peraturan Bupati (PERBUP)</div>
                                    <div class="h5">342 Dokumen</div>
                                </div>
                                <div class="ms-2"><i class="fas fa-file-alt fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-lg border-start-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small fw-bold text-warning mb-1">Menunggu Validasi</div>
                                    <div class="h5">12 Data</div>
                                    <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                        <i class="me-1" data-feather="alert-circle"></i> Segera Periksa
                                    </div>
                                </div>
                                <div class="ms-2"><i class="fas fa-clock fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-start-lg border-start-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small fw-bold text-info mb-1">Total Operator Aktif</div>
                                    <div class="h5">8 Pegawai</div>
                                </div>
                                <div class="ms-2"><i class="fas fa-users fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Produk Hukum Terbaru yang Diinput</div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0">No. Produk</th>
                                            <th class="border-0">Judul / Tentang</th>
                                            <th class="border-0">Tahun</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PERDA No. 5</td>
                                            <td>Pengelolaan Sampah Terpadu</td>
                                            <td>2023</td>
                                            <td><span class="badge bg-success">Publik</span></td>
                                            <td><a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i
                                                        data-feather="eye"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>PERBUP No. 12</td>
                                            <td>Tata Kerja Organisasi Perangkat Daerah</td>
                                            <td>2024</td>
                                            <td><span class="badge bg-warning">Draft/Validasi</span></td>
                                            <td><a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i
                                                        data-feather="eye"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
