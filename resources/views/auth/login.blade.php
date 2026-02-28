@extends('layouts.navbar-guest')
@section('title', 'Login Admin - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main class="main">

        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Login Admin</li>
                    </ol>
                </div>
            </nav>
        </div>
        <section id="login-section" class="login-section section bg-light">

            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Authentication</span>
                <h2>Login Administrator</h2>
                <p>Silakan masukkan akun Anda untuk mengelola data produk hukum.</p>
            </div>

            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-body p-4 p-md-5 bg-white">

                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i
                                                    class="bi bi-envelope"></i></span>
                                            <input id="email" type="email" name="email"
                                                class="form-control bg-light border-start-0 @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
                                        </div>
                                        @error('email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label fw-bold">Password</label>
                                            @if (Route::has('password.request'))
                                                <a class="small text-primary text-decoration-none"
                                                    href="{{ route('password.request') }}">
                                                    Lupa Password?
                                                </a>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i
                                                    class="bi bi-lock"></i></span>
                                            <input id="password" type="password" name="password"
                                                class="form-control bg-light border-start-0 @error('password') is-invalid @enderror"
                                                required autocomplete="current-password" placeholder="Masukkan password">
                                        </div>
                                        @error('password')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember_me">
                                            <label class="form-check-label small text-muted" for="remember_me">
                                                Ingat saya di perangkat ini
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary py-2 fw-bold rounded-3">
                                            MASUK SEKARANG
                                        </button>
                                        <a href="/" class="btn btn-light py-2 small">Kembali ke Beranda</a>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="small text-muted">&copy; {{ date('Y') }} JDIH Kab. Maluku Barat Daya</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection

<style>
    .input-group-text {
        color: #0061f2;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }

    .login-section {
        padding-bottom: 100px;
    }
</style>
