@extends('admin/layout')

@section('title')
    <title>Admin - Dashboard</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <br><br>
                </div>
            </div>
        </div>

        <section id="content-types">
            <div class="row justify-content-start">
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

                {{--    <!-- SHORTCUT 2 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Input Nilai</h4>
                                <p>Menginput nilai uji program, seminar hasil, dan sidang meja hijau disini! </p>
                                <hr>
                                <a href="{{ route('adm_input_nilai') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
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
                                <h4 class="card-title">Pra Seminar Proposal</h4>
                                <p>Mengurus administrasi mahasiswa pada masa pra seminar proposal disini! </p>
                                <hr>
                                <a href="{{ route('prasempro_menu') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 3-->

                <!-- SHORTCUT 4 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Pra Seminar Hasil</h4>
                                <p>Mengurus administrasi mahasiswa pada masa pra seminar hasil disini! </p>
                                <hr>
                                <a href="/admin/validasi_semhas" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 4 -->

                <!-- SHORTCUT 5 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Pra Sidang Meja Hijau</h4>
                                <p>Mengurus administrasi mahasiswa pada masa pra sidang meja hijau disini!</p>
                                <hr>
                                <a href="/admin/validasi_sidang" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 5 -->

                <!-- SHORTCUT 6 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Manajemen Pengguna</h4>
                                <p>Mendaftarkan mahasiswa, dosen, dan sebagainya disini!</p>
                                <hr>
                                <a href="/admin/mng_user" class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i>
                                    Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 6 -->

                <!-- SHORTCUT 7 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Penjadwalan</h4>
                                <p>Mendaftarkan jadwal seminar proposal, seminar hasil, dan sidang untuk mahasiswa disini!
                                </p>
                                <hr>
                                <a href="{{ route('penjadwalan') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 7 -->

                <!-- SHORTCUT 8 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Riwayat Aktivitas</h4>
                                <p>Riwayat pendaftaran, pengeditan hingga penghapusan data dosen pembimbing dan skripsi!</p>
                                <hr>
                                <a href="{{ route('log_aktivitas') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 8 -->

                <!-- SHORTCUT 9 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Profil</h4>
                                <p>Mengedit profile.</p>
                                <hr>
                                <a href="{{ route('profile_admin') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-check-circle"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 9 -->
--}}

            </div>
        </section>
    </div>
@endsection
