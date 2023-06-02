@extends('kepala_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Mahasiswa Alumni</title>
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
                        <h3>Mahasiswa Lulus</h3>
                        <p class="text-subtitle text-muted">Daftar mahasiswa-mahasiswa lulus.</p>
                    </div>
                </div>
            </div>
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
            <div class="row">
                <form action="/kepala_prodi/menu_mahasiswa/mahasiswa_alumni/search">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="keyword" placeholder="Cari mahasiswa ...">
                            </td>
                            <td>
                                <button class="btn btn-primary" type="submit"><i class="b bi-search"></i> </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <!-- END FORM CARI MAHASISWA -->

            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-3">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5>
                            <div class="table-responsive">
                                @if ($counter != 0)
                                    <p class="text-muted"><b>Hasil pencarian yang sesuai: {{ $counter }} mahasiswa</b>
                                    </p>
                                    <table class="table table-bordered mb-0 text-center">
                                        <thead>
                                            <tr class="table-success">
                                                <th>No.</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th width="400">Judul Skripsi</th>
                                                <th>Dosen Pembimbing I</th>
                                                <th>Dosen Pembimbing II</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $result->nim }}</td>
                                                    <td class="text-bold-500">{{ $result->nama }}</td>
                                                    <td width="400">{{ $result->judul_skripsi }}</td>
                                                    <td>{{ $result->nama_dosbing1 }}</td>
                                                    <td>{{ $result->nama_dosbing2 }}</td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted"><i>Tidak ada hasil yang sesuai.</i></p>
                                @endif
                                <br>
                            </div>
                            <div class="d-felx justify-content-center">
                                <a href="/kepala_prodi/menu_mahasiswa/mahasiswa_alumni" class="btn btn-primary btn-sm"><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
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
