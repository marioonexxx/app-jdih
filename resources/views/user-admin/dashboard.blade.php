@extends('layouts.navbar')
@section('title', 'Dashboard Superadmin JDIH Kabupaten Maluku Barat Daya')
@section('content')
    <main>
        <div class="container-xl px-4 mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="me-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Dashboard</h1>
                    <div class="small">
                        <span class="fw-500 text-primary">{{ date('l') }}</span>
                        &middot; {{ date('F d, Y') }} &middot; {{ date('h:i A') }}
                    </div>
                </div>
            </div>

            <div class="card card-waves mb-4 mt-5">
                <div class="card-body p-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            <h2 class="text-primary">Selamat Datang, Dashboard Administrator JDIH telah siap!</h2>
                            <p class="text-gray-700">Halo! Anda masuk sebagai Administrator Pengelola JDIH Kabupaten Maluku
                                Barat Daya.
                                Gunakan panel ini untuk mengelola dokumentasi hukum, menyusun produk hukum,
                                dan memantau penyebaran informasi hukum secara digital.</p>
                            <a class="btn btn-primary p-3" href="#!">
                                Mulai Kelola Data
                                <i class="ms-1" data-feather="arrow-right"></i>
                            </a>
                        </div>
                        <div class="col d-none d-lg-block mt-xxl-n4">
                            <img class="img-fluid px-xl-4 mt-xxl-n5" src="{{ asset('sbadmin/assets/img/illustrations/statistics.svg') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            </div>
        </div>
    </main>
@endsection
