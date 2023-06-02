@extends('admin/layout')

@section('title')
    <title>Admin - Input Nilai</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Input Nilai</h3>
                    <br><br>
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
                                <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i>
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
                                <a href="{{ route('adm_nilai_uji_program') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i>Access</a>
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
                                <a href="#" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i>Access</a>
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
                                <a href="/admin/daftar_nilai_sidang" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i>Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 4 -->
            </div>
        </section>
    </div>
@endsection
