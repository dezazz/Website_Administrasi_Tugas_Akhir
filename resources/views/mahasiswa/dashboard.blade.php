@extends('mahasiswa/layout')

@section('title')
    <title>Mahasiswa - Dashboard</title>
@endsection

@section('sidebar')
    <li class="sidebar-item active"">
        <a href="/mahasiswa/dashboard" class='sidebar-link'>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="/mahasiswa/pra_sempro" class='sidebar-link'>
            <span>Seminar Proposal</span>
        </a>
    </li>

    <li class="sidebar-item ">
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
        <header class="mb-2">
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
                    {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/mahasiswa/dashboard">Dashboard</a></li>
                            </ol>
                        </nav>
                    </div> --}}
                </div>
            </div>


            <!-- PROFILE - PROGRESS -->
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title text-center mt-1">Selamat Datang di Sistem Administrasi Tugas Akhir</h4>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <br>
                        @if ($profile->foto != null)
                            <center>
                                <img class="" src="../main/photos/{{ $profile->foto }}" alt="student_image"
                                    style="height: 200px; width:200px " />
                            </center>
                        @else
                            <center>
                                <img class="card-img-top img-fluid" src="../main/photos/graduate_student.png"
                                    alt="default_student_image" style="height: 200px; width:200px" />
                            </center>
                        @endif
                        <div class="card-body mt-1">
                            <h4 class="card-title text-center mt-1">{{ $profile->nama }}</h4>
                            <p class="card-text mt-1">
                                {{-- <div class="progress progress-primary  mb-2">
                                <div class="progress-bar progress-label" role="progressbar"
                                    style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                                <br>
                                Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $profile->nama }} <br>
                                NIM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                {{ $profile->nim }} <br>
                                Angkatan &nbsp; &nbsp; : {{ $profile->angkatan }} <br>
                                Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $profile->status }}
                                <br><br>
                                Judul Skripsi&nbsp;&nbsp;: <br>
                                @if ($profile->judul_skripsi == null)
                                    <i>Judul Skripsi Belum Terdaftar</i><br><br>
                                @else
                                    <i>{{ $profile->judul_skripsi }}</i><br><br>
                                @endif

                                Tahap Tugas Akhir&nbsp;: <br>{{ $status_akses->keterangan }}.
                            </p>
                        </div>
                    </div>
                </div>
                {{-- beautiful card SELAMAT DATANG DI SISTEM ADMINISTRASI TUGAS AKHIR --}}

            </div>
        </div>
    @endsection
