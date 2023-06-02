@extends('admin/layout')

@section('title')
    <title>Prodi - Input Nilai</title>
@endsection

@section('sidebar')
    <li class="sidebar-item">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/kaprodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
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
    <li class="sidebar-item has-sub active">
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
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Input Nilai</h3>
                    <br><br>
                </div>
                <div class="col-xl-4 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/sekretaris_prodi/dashboard">Back to Dashboard</a></li>
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
                                <h4 class="card-title">Input Nilai IPK</h4>
                                <p>Daftar Mahasiswa Aktif, Judul Skripsi, dan Dosen Pembimbing </p>
                                <hr>
                                <a href="{{ route('nilai_IPK') }}" class="btn btn-primary"><i class="bi bi-hand-index"></i>
                                    Access</a>
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
                                <h4 class="card-title">Input Nilai Uji Program</h4>
                                <p>Daftar Mahasiswa Aktif, Judul Skripsi, dan Dosen Pembimbing </p>
                                <hr>
                                <a href="{{ route('nilai_uji_program') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i>Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 2 -->

                <!-- SHORTCUT 3 -->
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Input Nilai Seminar Hasil</h4>
                                <p>Daftar Mahasiswa Aktif, Judul Skripsi, dan Dosen Pembimbing </p>
                                <hr>
                                <a href="{{ route('nilai_semhas') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i>Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 3 -->

                <!-- SHORTCUT 4 -->
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Input Nilai Sidang Meja Hijau</h4>
                                <p>Daftar Mahasiswa Aktif, Judul Skripsi, dan Dosen Pembimbing </p>
                                <hr>
                                <a href="{{ route('nilai_sidang') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i>Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 4 -->
            </div>
        </section>
    </div>
@endsection
