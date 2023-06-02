@extends('admin/layout')

@section('title')
    <title>Admin - Pra Semhas</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Pra Seminar Hasil</h3>
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
                                <h4 class="card-title">Pendaftaran Dosen Penguji</h4>
                                <p>Tambahkan, edit, dosen penguji untuk mahasiswa tingkat akhir.</p>
                                <hr>
                                <a href="{{ route('daftar_dosenPenguji') }}" class="btn btn-primary"><i
                                        class="bi bi-hand-index"></i> Access</a>
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
                                <h4 class="card-title">Berkas Administrasi</h4>
                                <p>Semua berkas administrasi sebelum seminar hasil dapat diakses di menu ini. </p>
                                <hr>
                                <a href="/admin/validasi_semhas" class="btn btn-primary"><i class="bi bi-hand-index"></i>
                                    Access</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SHORTCUT 2-->
            </div>
        </section>
        <!-- Basic Card types section end -->
    </div>
@endsection
