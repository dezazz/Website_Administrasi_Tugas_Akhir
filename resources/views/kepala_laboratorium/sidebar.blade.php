@section('sidebar')
    <li class="sidebar-item">
        <a href="dashboard" class='sidebar-link'>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item ">
        <a href="{{ route('kepala_lab_exum') }}" class='sidebar-link'>
            <span>Daftar Executive Summary Belum Diperiksa</span>
        </a>
    </li>
    <li class="sidebar-item ">
        <a href="{{ route('daftar_exum_diterima') }}" class='sidebar-link'>
            <span>Daftar Executive Summary Disetujui</span>
        </a>
    </li>
    <li class="sidebar-item ">
        <a href="{{ route('daftar_exum_ditolak') }}" class='sidebar-link'>
            <span>Daftar Executive Summary Ditolak</span>
        </a>
    </li>
    {{-- <li class="sidebar-item has-sub ">
        <a href="/jadwalSeminarSidang" class='sidebar-link'>
            <span>Jadwal</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/penguji/jadwal_kelayakan_isi_proposal">Penilaian Kelayakan Isi Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/penguji/jadwal_semhas_penguji">Penilaian Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/penguji/jadwal_sidang_penguji">Penilaian Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <span>Penilaian</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('penguji_nilai_uji_kelayakan') }}">Input Nilai Kelayakan Isi Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('penguji_nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('penguji_nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li> --}}
    <li class="sidebar-item  ">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="sidebar-link">
            @csrf
            <button class="btn btn-primary" type="submit"> Logout </button>
        </form>
    </li>
@endsection
