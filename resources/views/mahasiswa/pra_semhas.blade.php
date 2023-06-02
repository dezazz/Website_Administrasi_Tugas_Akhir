@extends('mahasiswa/layout');

@section('title')
    <title>Mahasiswa - Seminar Hasil</title>
@endsection

@section('sidebar')
    <li class="sidebar-item">
        <a href="/mahasiswa/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="/mahasiswa/pra_sempro" class='sidebar-link'>

            <span>Seminar Proposal</span>
        </a>
    </li>

    <li class="sidebar-item  active">
        <a href="/mahasiswa/pra_semhas" class='sidebar-link'>

            <span>Seminar Hasil</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/mahasiswa/pra_sidang" class='sidebar-link'>

            <span>Sidang Meja Hijau</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/mahasiswa/pasca_meja_hijau" class='sidebar-link'>

            <span>Pasca Sidang Meja Hijau</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="{{ route('profile_mhs') }}" class='sidebar-link'>

            <span>Profil</span>
        </a>
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
                        <h3>Seminar Hasil</h3>
                        <p class="text-subtitle text-muted">Berkas Administrasi Seminar Hasil</p>
                    </div>
                    {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/mahasiswa/dashboard">Mahasiswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seminar Hasil</li>
                            </ol>
                        </nav>
                    </div> --}}
                </div>
            </div>

            <!-- submenu 3 -->
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- progress seminar hasil akan didapat pada fitur ini -->
                            <h5>1. Lembar Kendali Bimbingan Skripsi Seminar Hasil</h5>
                            <p> Formulir ini merupakan riwayat bimbingan yang dilakukan mahasiswa dengan dosen pembimbing
                                sebelum melakukan seminar hasil. Pastikan data yang diisikan merupakan data yang sebenarnya
                                sesuai dengan hasil bimbingan dengan dosen pembimbing </p>
                            @if ($mhs->no_statusAkses > 2 && $bimbingan_check > 0)
                                <div class="d-grid gap-2 d-md-flex justify-content">
                                    <a href="{{ '/mahasiswa/lembar_kendali_semhas' }}" target="blank"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-printer-fill"></i> Cetak</a>
                                </div>
                            @else
                                {{-- pemberitahuan dosen pembimbing belum mengisi lembar kendali --}}
                                <div class="alert alert-info alert-dismissible show fade">
                                    <div class="alert-body">
                                        <i>Pemberitahuan!</i> Dosen pembimbing belum mengisi lembar kendali bimbingan
                                        seminar
                                        hasil.
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content">
                                    <a href="#" target="blank" class="btn btn-success disabled btn-sm">
                                        <i class="bi bi-printer-fill"></i> Cetak</a>
                                </div>
                            @endif

                            <hr>

                            <h5>2. Jadwal Seminar Hasil</h5>
                            <p> Jadwal seminar hasil akan ditentukan oleh Pegawai Program Studi apabila berkas yang
                                diajukan
                                untuk melakukan seminar hasil telah lengkap. </p>

                            @if ($mhs->no_statusAkses > 3)
                                <div class="d-grid gap-2 d-md-flex justify-content">
                                    <!-- preview akan membawa mahasiswa ke halaman form yang ingin diunduh -->
                                    <a href="{{ '/mahasiswa/jadwal_semhas' }}" target="blank"
                                        class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Cek Jadwal</a>
                                </div>
                            @else
                                <div class="d-grid gap-2 d-md-flex justify-content">
                                    <!-- preview akan membawa mahasiswa ke halaman form yang ingin diunduh -->
                                    <a href="#" class="btn btn-primary btn-sm disabled"><i class="bi bi-eye"></i>
                                        Cek Jadwal</button></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end submenu 3 -->
        @endsection
