@extends('kepala_prodi/layout')

@section('title')
    <title>Kepala Prodi - Berita Acara</title>
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
                <a href="/kepala_prodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item active">
        <a href="/kepala_prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/kepala_prodi/undangan_daftar_peserta" class='sidebar-link'>

            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li>
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="#">Input Nilai IPK</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="#">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="#">Input Nilai Sidang Meja Hijau</a>
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
                        <h3>Berita Acara</h3>
                        <p class="text-subtitle text-muted">Berita acara seminar proposal, seminar hasil, dan sidang meja
                            hijau</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/kepala_prodi/dashboard">Berita Acara</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section id="content-types">
                <div class="row justify-content-start">
                    <!-- SHORTCUT 1 -->
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Berita Acara Sempro</h4>
                                    <p>Form Berita Acara Seminar Proposal dapat diakses melalui menu ini.</p>
                                    <hr>
                                    <a href="/kepala_prodi/beritaacara/sempro" class="btn btn-primary"><i
                                            class="bi bi-hand-index"></i>&nbsp;&nbsp;Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 1 -->

                    <!-- SHORTCUT 2 -->
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Berita Acara Semhas</h4>
                                    <p>Form Berita Acara Seminar Hasil dapat diakses melalui menu ini.</p>
                                    <hr>
                                    <a href="/kepala_prodi/beritaacara/semhas" class="btn btn-primary"><i
                                            class="bi bi-hand-index"></i>&nbsp;&nbsp;Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 2-->

                    <!-- SHORTCUT 3 -->
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Berita Acara Meja Hijau</h4>
                                    <p>Form Berita Acara Sidang Meja Hijau dapat diakses melalui menu ini.</p>
                                    <hr>
                                    <a href="/kepala_prodi/beritaacara/mejahijau" class="btn btn-primary"><i
                                            class="bi bi-hand-index"></i>&nbsp;&nbsp;Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 3-->
                </div>
            </section>

        </div>
    </div>
    </div>
    </div>
@endsection
