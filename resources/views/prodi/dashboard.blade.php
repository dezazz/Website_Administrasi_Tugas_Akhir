@extends('prodi/layout')

@section('title')
    <title>Prodi - Dashboard</title>
@endsection

@section('sidebar')
    <li class="sidebar-item active">
        <a href="/prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub">
        <a href="/prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/kaprodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item ">
        <a href="/prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/prodi/undangan_daftar_peserta" class='sidebar-link'>

            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li>
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            {{-- <li class="submenu-item ">
                <a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a>
            </li> --}}
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
    </li>
@endsection

@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Dashboard</h3>
                        <p class="text-subtitle text-muted"> </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/prodi/dashboard">Dashboard</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <!-- SHORTCUT 1 -->
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Mahasiswa Tingkat Akhir</h4>
                                        <p class="card-text">
                                            Daftar mahasiswa tingkat akhir.
                                        </p>
                                        <a href="/prodi/menu_mahasiswa" class="btn btn-primary btn-sm"><i
                                                class="bi bi-check-circle"></i> Akses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SHORTCUT 1 -->

                        <!-- SHORTCUT 2 -->
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Berita Acara</h4>
                                        <p class="card-text">
                                            Berita acara seminar proposal, seminar hasil, dan sidang meja hijau
                                        </p>
                                        <a href="/prodi/beritaacara" class="btn btn-primary btn-sm"><i
                                                class="bi bi-check-circle"></i> Akses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SHORTCUT 2 -->

                        <!-- SHORTCUT 3 -->
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Undangan dan Daftar Peserta</h4>
                                        <p class="card-text">
                                            Undangan seminar proposal, seminar hasil, dan sidang meja hijau.
                                        </p>
                                        <a href="/prodi/undangan_daftar_peserta" class="btn btn-primary btn-sm"><i
                                                class="bi bi-check-circle"></i> Akses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SHORTCUT 4 -->

                        <!-- SHORTCUT 4 -->
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Input Nilai</h4>
                                        <p class="card-text">
                                            Input nilai IPK, input nilai seminar proposal, input nilai seminar hasil, input
                                            nilai sidang meja hijau.
                                        </p>
                                        <a href="/prodi/input_nilai" class="btn btn-primary btn-sm"><i
                                                class="bi bi-check-circle"></i> Akses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SHORTCUT 4 -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
