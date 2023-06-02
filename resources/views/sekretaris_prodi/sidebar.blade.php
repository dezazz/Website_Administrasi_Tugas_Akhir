@section('sidebar')
    <li class="sidebar-item">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item has-sub">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <span>Mahasiswa</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_alumni">Mahasiswa Lulus</a>
            </li>
        </ul>
    </li>
    {{-- list item --}}
    <li class="sidebar-item has-sub">
        <a href="" class='sidebar-link'>
            <span>Berita Acara</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/beritaacara/sempro">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/beritaacara/semhas">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/beritaacara/mejahijau">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    {{-- Daftar Peserta dan undangan --}}
    <li class="sidebar-item has-sub">
        <a href="" class='sidebar-link'>
            <span>Daftar Peserta dan Undangan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/seminar_proposal">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/seminar_hasil">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/sidang_meja_hijau">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    {{-- <li class="sidebar-item has-sub">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>
            <span>Berita Acara</span>
        </a>
        <ul class="submenu">
            <li class="sidebar-item ">
                <a href="/sekretaris_prodi/beritaacara/sempro">
                    Seminar Proposal
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="/sekretaris_prodi/beritaacara/semhas">
                    Seminar Hasil
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="/sekretaris_prodi/beritaacara/mejahijau">
                    Seminar Proposal
                </a>
            </li>
        </ul>
    </li> --}}
    {{-- <li class="sidebar-item  ">
        <a href="/sekretaris_prodi/undangan_daftar_peserta" class='sidebar-link'>
            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li> --}}
    {{-- list undangan daftar --}}
    {{-- <li class="sidebar-item has-sub">
        <span>Daftar Peserta dan Undangan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/seminar_proposal">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/seminar_hasil">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/undangan_daftar_peserta/sidang_meja_hijau">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li> --}}
    {{-- <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li> --}}
@endsection
