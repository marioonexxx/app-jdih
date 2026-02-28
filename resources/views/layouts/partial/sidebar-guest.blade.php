<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>

        <li class="dropdown">
            <a href="#">
                <span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
                <li>
                    <a href="{{ route('guest.visi-misi') }}">Visi & Misi</a>
                </li>
                <li>
                    <a href="{{ route('guest.struktur') }}">Struktur Organisasi</a>
                </li>
                <li>
                    <a href="{{ route('guest.hukum') }}">Dasar Hukum</a>
                </li>
            </ul>
        </li>

        <li class="dropdown"><a href="#"><span>Produk Hukum</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Peraturan Daerah</a></li>
                <li><a href="#">Peraturan Bupati</a></li>
                <li><a href="#">Keputusan Bupati</a></li>


            </ul>
        </li>

        <li class="dropdown"><a href="#"><span>Informasi</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Berita JDIH</a></li>
                <li><a href="#">Artikel Hukum</a></li>
                <li><a href="#">Galeri Kegiatan</a></li>
                <li><a href="#">Infografis</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('guest.kontak') ? 'active' : '' }}"
                href="{{ route('guest.kontak') }}">Kontak</a>
        </li>

        @guest
            <li><a href="{{ route('login') }}" class="btn-getstarted"
                    style="margin-left: 15px; padding: 8px 20px; background: #0061f2; color: white; border-radius: 50px;">Login</a>
            </li>
        @else
            <li><a href="{{ route('dashboard') }}">Dashboard Admin</a></li>
        @endguest
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
