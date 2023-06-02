@extends('sekretaris_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Lembar Kendali</title>
@endsection

@include('sekretaris_prodi/sidebar')

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
                        <h3>Lembar Kendali Bimbingan Skripsi</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- submenu 1 -->
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h5>01. Lembar Kendali Bimbingan Pra Seminar Proposal</h5>
                    </div>
                    <div class="card-body">
                        <p>Silahkan cetak Lembar kendali bimbingan skripsi pra seminar proposal.</p>
                        <hr>
                        <a href="/sekretaris_prodi/lembar_kendali_sempro/{{ $nim }}" class="btn btn-primary"><i
                                class="bi bi-printer-fill"></i> Cetak </a>

                    </div>
                </div>
            </div>
        </div>
        <!-- end submenu 1 -->

        <!-- submenu 2 -->
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h5>02. Lembar Kendali Bimbingan Pra Seminar Hasil</h5>
                    </div>
                    <div class="card-body">
                        <p>Silahkan cetak Lembar kendali bimbingan skripsi pra seminar hasil.</p>
                        <hr>
                        <a href="/sekretaris_prodi/lembar_kendali_semhas/{{ $nim }}" class="btn btn-primary"><i
                                class="bi bi-printer-fill"></i> Cetak </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end submenu 2 -->

        <!-- submenu 3 -->
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h5>03. Lembar Kendali Bimbingan Pra Sidang Meja Hijau</h5>
                    </div>
                    <div class="card-body">
                        <p>Silahkan cetak Lembar kendali bimbingan skripsi pra sidang meja hijau.</p>
                        <hr>
                        <a href="/sekretaris_prodi/lembar_kendali_sidang/{{ $nim }}" class="btn btn-primary"><i
                                class="bi bi-printer-fill"></i> Cetak </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end submenu 3 -->
    @endsection
