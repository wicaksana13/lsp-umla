<nav class="navbar">

    <div class="nav-container">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="nav-logo">
            <img
                src="{{ asset('assets/Logo LSP.png') }}"
                alt="Logo LSP UMLA"
            >
        </a>


        {{-- HAMBURGER MOBILE --}}
        <button
            class="hamburger"
            id="hamburger"
            type="button"
            aria-label="Buka menu navigasi"
            aria-expanded="false"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>


        {{-- NAVIGATION --}}
        <ul class="nav-menu" id="nav-menu">

            <li>
                <a
                    href="{{ url('/') }}"
                    class="{{ request()->is('/') ? 'active' : '' }}"
                >
                    Beranda
                </a>
            </li>


            <li>
                <a
                    href="{{ url('/profil') }}"
                    class="{{ request()->is('profil') ? 'active' : '' }}"
                >
                    Profil LSP
                </a>
            </li>


            <li>
                <a
                    href="{{ url('/skema') }}"
                    class="{{ request()->is('skema') ? 'active' : '' }}"
                >
                    Skema
                </a>
            </li>


            <li>
                <a
                    href="{{ url('/jadwal') }}"
                    class="{{ request()->is('jadwal') ? 'active' : '' }}"
                >
                    Jadwal
                </a>
            </li>


            {{-- DROPDOWN INFORMASI --}}
            <li class="dropdown" id="information-dropdown">

                <a
                    href="#"
                    class="dropdown-toggle {{ request()->is('informasi*') ? 'active' : '' }}"
                    id="information-toggle"
                >
                    <span>Informasi</span>

                    <span class="arrow"></span>
                </a>


                <ul class="dropdown-menu">

                    <li>
                        <a href="{{ url('/informasi/pengumuman') }}">
                            Pengumuman / Berita
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/informasi/prosedur') }}">
                            Prosedur
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/informasi/biaya') }}">
                            Biaya
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/informasi/tuk') }}">
                            TUK
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/informasi/asesor') }}">
                            Asesor
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/informasi/sertifikat') }}">
                            Sertifikat Dikeluarkan
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('daftar') }}">
                            Daftar Akun
                        </a>
                    </li>

                </ul>

            </li>

        </ul>

    </div>

</nav>