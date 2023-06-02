@extends('prodi/layout')

@section('title')
    <title>Prodi - Mahasiswa TA</title>
@endsection

@section('sidebar')
    <li class="sidebar-item">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub active">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item ">
        <a href="/sekretaris_prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/sekretaris_prodi/undangan_daftar_peserta" class='sidebar-link'>

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
                    <div class="col-xl-8 col-md-6 order-md-1 order-last">
                        <h3>Mahasiswa Tingkat Akhir</h3>
                        <br><br>
                    </div>
                    <div class="col-xl-4 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/sekretaris_prodi/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a>Mahasiswa TA</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section id="content-types">
                <div class="row justify-content-start">
                    <!-- SHORTCUT 1 -->
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Mahasiswa Aktif</h4>
                                    <p>Daftar Mahasiswa Aktif, Judul Skripsi, dan Dosen Pembimbing </p>
                                    <hr>
                                    <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif"
                                        class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i> Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 1 -->

                    <!-- SHORTCUT 2 -->
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Alumni</h4>
                                    <p>Daftar mahasiswa alumni, judul skripsi, dan dosen pembimbing. </p>
                                    <hr>
                                    <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_alumni"
                                        class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i> Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 2-->

                </div>
            </section>


        </div>
    </div>
    </div>
    </div>
@endsection
