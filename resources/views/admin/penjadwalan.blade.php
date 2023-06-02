@extends('admin/layout')

@section('title')
    <title>Admin - Penjadwalan</title>
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
                                <h4 class="card-title">Penjadwalan seminar proposal</h4>
                                <p>Tambahkan, edit, dan hapus jadwal seminar proposal</p>
                                <hr>
                                <a href="{{ route('jadwal_sempro') }}" class="btn btn-primary"><i
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
                                <h4 class="card-title">Penjadwalan seminar hasil</h4>
                                <p>Tambahkan, edit, dan hapus jadwal seminar </p>
                                <hr>
                                <a href="{{ route('jadwal_semhas') }}" class="btn btn-primary"><i
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
                                <h4 class="card-title">Penjadwalan Sidang</h4>
                                <p>Tambahkan, edit, dan hapus jadwal sidang </p>
                                <hr>
                                <a href="{{ route('jadwal_sidang') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 3 -->

            </div>
        </section>
    </div>
@endsection
