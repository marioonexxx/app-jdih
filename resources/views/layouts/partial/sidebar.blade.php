<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">

        <div class="sidenav-menu-heading">Menu Utama</div>

        <a class="nav-link" href="{{ route('dashboard') }}">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Dashboard
        </a>

        @if (auth()->user()->role === 'superadmin')
            <div class="sidenav-menu-heading">PENGATURAN HALAMAN</div>

            <a class="nav-link" href="{{ route('admin.profil.index') }}">
                <div class="nav-link-icon"><i data-feather="target"></i></div>
                Profil
            </a>
            <div class="sidenav-menu-heading">Administrator</div>

            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                data-bs-target="#collapseUserMgmt" aria-expanded="false" aria-controls="collapseUserMgmt">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Manajemen User
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseUserMgmt" data-bs-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <a class="nav-link" href="#">Daftar Pegawai</a>
                    <a class="nav-link" href="#">Tambah User</a>
                </nav>
            </div>

            <a class="nav-link" href="#">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Pengaturan Sistem
            </a>
        @endif

        @if (auth()->user()->role === 'operator')
            <div class="sidenav-menu-heading">PERDA/PERBUP</div>

            <a class="nav-link" href="{{ route('produk-hukum.index') }}">
                <div class="nav-link-icon"><i data-feather="list"></i></div>
                Daftar Perda/Perbup
            </a>

            <a class="nav-link" href="{{ route('produk-hukum.create') }}">
                <div class="nav-link-icon"><i data-feather="plus-circle"></i></div>
                Input Produk Hukum
            </a>

            <div class="sidenav-menu-heading">BERITA & INFORMASI</div>

            <a class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}"
                href="{{ route('category.index') }}">
                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                Kategori Blog
            </a>

            <a class="nav-link {{ request()->routeIs('posts.index') || request()->routeIs('posts.edit') ? 'active' : '' }}"
                href="{{ route('posts.index') }}">
                <div class="nav-link-icon"><i data-feather="edit-3"></i></div>
                Daftar Postingan
            </a>

            <a class="nav-link {{ request()->routeIs('posts.create') ? 'active' : '' }}"
                href="{{ route('posts.create') }}">
                <div class="nav-link-icon"><i data-feather="plus-circle"></i></div>
                Input Post Baru
            </a>
        @endif

        @if (auth()->user()->role === 'kabag_hukum')
            <div class="sidenav-menu-heading">Validasi</div>

            <a class="nav-link" href="#">
                <div class="nav-link-icon"><i data-feather="check-square"></i></div>
                Persetujuan (Validasi)
                <span class="badge bg-warning-soft text-warning ms-auto">5 Baru</span>
            </a>
        @endif

        <div class="sidenav-menu-heading">Akun</div>
        <a class="nav-link" href="#">
            <div class="nav-link-icon"><i data-feather="user"></i></div>
            Profil Saya
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                Keluar
            </a>
        </form>

    </div>
</div>
