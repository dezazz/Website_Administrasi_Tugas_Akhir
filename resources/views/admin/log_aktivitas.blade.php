@extends('admin/layout')

@section('title')
    <title>Admin - Riwayat Aktivitas</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Aktivitas</h3>
                    <br><br>
                </div>
            </div>
        </div>

        <section id="content-types">
            <div class="row justify-content-start">
                <!-- SHORTCUT 1 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Riwayat Pendaftaran Dosen Pembimbing</h4>
                                <p>Lihat admin mana yang mendaftarkan dosen pembimbing mahasiswa disini! </p>
                                <hr>
                                <a href="{{ route('log_pendaftaran_dosbing') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
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
                                <h4 class="card-title">Riwayat Pengubahan Dosen Pembimbing</h4>
                                <p>Lihat admin mana yang mengubah dosen pembimbing mahasiswa disini! </p>
                                <hr>
                                <a href="{{ route('log_pengubahan_dosbing') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 2-->

                <!-- SHORTCUT 3 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Riwayat Penghapusan Dosen Pembimbing</h4>
                                <p>Lihat admin mana yang menghapus dosen pembimbing mahasiswa disini! </p>
                                <hr>
                                <a href="{{ route('log_penghapusan_dosbing') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
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
                                <h4 class="card-title">Riwayat Pendaftaran Judul Skripsi</h4>
                                <p>Judul Skripsi dapat didaftarkan oleh mahasiswa dan admin. Lihat disini untuk mengetahui
                                    siapa yang mendaftarkan judul skripsi mahasiswa! </p>
                                <hr>
                                <a href="{{ route('log_pendaftaran_skripsi') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
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
                                <h4 class="card-title">Riwayat Pengubahan Judul Skripsi</h4>
                                <p>Judul skripsi yang sudah didaftarkan juga dapat dilakukan oleh mahasiswa dan admin! Lihat
                                    riwayat perubahan skripsi disini</p>
                                <hr>
                                <a href="{{ route('log_pengubahan_skripsi') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
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
                                <h4 class="card-title">Riwayat Penghapusan Judul Skripsi</h4>
                                <p>Lihat disini untuk mengetahui penghapusan data skripsi yang dilakukan oleh admin!</p>
                                <hr>
                                <a href="{{ route('log_penghapusan_skripsi') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 6 -->
            </div>
        </section>
    </div>
@endsection
