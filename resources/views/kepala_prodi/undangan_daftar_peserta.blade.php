@extends('prodi/layout')

@section('title')
    <title>Prodi - Undangan dan Daftar Peserta</title>
@endsection

@section('sidebar')
    <li class="sidebar-item">
        <a href="/kepala_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub">
        <a href="/kepala_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/kepala_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/kaprodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item ">
        <a href="/kepala_prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item active">
        <a href="/kepala_prodi/undangan_daftar_peserta" class='sidebar-link'>

            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li>
    <li class="sidebar-item has-sub ">
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
                        <h3>Undangan dan Daftar Peserta</h3>
                        <p class="text-subtitle text-muted">Berkas administrasi undangan dan daftar peserta</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/kepala_prodi/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Undangan dan Daftar Peserta</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- submenu 1 -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>01. Undangan dan Daftar Peserta Seminar Proposal</h4>
                        </div>
                        <div class="card-body">
                            <p> Daftar jadwal seminar proposal</p>

                            <div class="d-grid gap-2 d-md-flex justify-content">
                                <a href="/kepala_prodi/undangan_daftar_peserta/seminar_proposal"
                                    class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i> Akses </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end submenu 1 -->
            <!-- submenu 2 -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>02. Undangan dan Daftar Peserta Seminar Hasil</h4>
                        </div>
                        <div class="card-body">
                            <p> Daftar jadwal seminar hasil</p>

                            <div class="d-grid gap-2 d-md-flex justify-content">
                                <a href="/kepala_prodi/undangan_daftar_peserta/seminar_hasil"
                                    class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i> Akses </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end submenu 2 -->
            <!-- submenu 3 -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>03. Undangan dan Daftar Peserta Sidang Meja Hijau</h4>
                        </div>
                        <div class="card-body">
                            <p> Daftar jadwal sidang meja hijau</p>

                            <div class="d-grid gap-2 d-md-flex justify-content">
                                <a href="/kepala_prodi/undangan_daftar_peserta/sidang_meja_hijau"
                                    class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i> Akses </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end submenu 3-->
        </div>
    </div>
    </div>
@endsection
