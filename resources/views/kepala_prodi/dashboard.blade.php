@extends('kepala_prodi/layout')

@section('title')
    <title>Kepala Prodi - Dashboard</title>
@endsection

@include('kepala_prodi/sidebar')

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
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <!-- SHORTCUT 1 -->
                        <div class="col-xl-8 col-md-8 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">SELAMAT DATANG DI SISTEM ADMINISTRASI TUGAS AKHIR</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SHORTCUT 1 -->
                        {{-- 
                        <!-- SHORTCUT 2 -->
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Berita Acara</h4>
                                        <p class="card-text">
                                            Berita acara seminar proposal, seminar hasil, dan sidang meja hijau
                                        </p>
                                        <a href="/sekretaris_prodi/beritaacara" class="btn btn-primary btn-sm"><i
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
                                        <a href="/sekretaris_prodi/undangan_daftar_peserta" class="btn btn-primary btn-sm"><i
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
                                        <a href="/sekretaris_prodi/input_nilai" class="btn btn-primary btn-sm"><i
                                                class="bi bi-check-circle"></i> Akses</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- END SHORTCUT 4 -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
