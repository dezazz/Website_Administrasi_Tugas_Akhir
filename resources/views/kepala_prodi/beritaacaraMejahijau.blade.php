@extends('kepala_prodi/layout')

@section('title')
    <title>Kepala Prodi - Berita Acara Sidang Meja Hijau</title>
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
                        <h3>Berita Acara Sidang Meja Hijau</h3>
                        <p class="text-subtitle text-muted">Berita acara sidang meja hijau mahasiswa-mahasiswa</p>
                    </div>
                </div>
            </div>

            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar acara sidang meja hijau</h5><br>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 text-center">
                                    <thead>
                                        <tr class="table-success">
                                            <th width="100">NIM</th>
                                            <th width="150">Nama</th>
                                            <th width="200">Tahap Skripsi</th>
                                            <th width="150">Berita Acara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i; ?>
                                        @for ($i = 0; $i <= count($query) - 1; $i += 2)
                                            <tr>
                                                <td>{{ $query[$i]->nim }}</td>
                                                <td>{{ $query[$i]->nama }}</td>
                                                <td>{{ $query[$i]->keterangan }}</td>
                                                <td>
                                                    <a href="/kepala_prodi/beritaacara/mejahijau/{{ $query[$i]->nim }}"><button
                                                            type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                class="bi bi-printer"></i>&nbsp;&nbsp;Cetak</button></a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table><br><br><br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
