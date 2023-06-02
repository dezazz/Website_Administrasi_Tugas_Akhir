@extends('admin/layout')

@section('title')
    <title>Admin - Manajemen User</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Manajemen User</h3>
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
                                <h4 class="card-title">Manajemen Mahasiswa</h4>
                                <p>Tambahkan, edit, atau hapus akun serta data mahasiswa </p>
                                <hr>
                                <a href="/admin/manajemen_mhs" class="btn btn-primary"><i class="bi bi-hand-index"></i>
                                    Access</a>
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
                                <h4 class="card-title">Manajemen Dosen</h4>
                                <p>Tambahkan, edit, dan hapus akun serta data dosen </p>
                                <hr>
                                <a href="/admin/manajemen dosen" class="btn btn-primary"><i class="bi bi-hand-index"></i>
                                    Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 2-->

                @if (Auth::user()->admin->status == 'super admin')
                    <!-- SHORTCUT 3 -->
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">Manajemen Admin</h4>
                                    <p>Tambahkan, edit, dan hapus akun serta data admin </p>
                                    <hr>
                                    <a href="/admin/manajemen_admin" class="btn btn-primary"><i
                                            class="bi bi-hand-index"></i> Access</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SHORTCUT 3 -->
                @endif

                <!-- SHORTCUT 4 -->
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">Manajemen Prodi</h4>
                                <p>Tambahkan, edit, dan hapus akun serta data prodi </p>
                                <hr>
                                <a href="/admin/manajemen_prodi" class="btn btn-primary"><i class="bi bi-hand-index"></i>
                                    Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 4 -->

            </div>
        </section>
    </div>
@endsection
