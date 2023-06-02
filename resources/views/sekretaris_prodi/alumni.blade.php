@extends('sekretaris_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Mahasiswa Alumni</title>
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
                        <h3>Mahasiswa Lulus</h3>
                        <p class="text-subtitle text-muted">Daftar mahasiswa-mahasiswa lulus.</p>
                    </div>
                </div>
            </div>
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
            <div class="row">
                <form action="/sekretaris_prodi/menu_mahasiswa/mahasiswa_alumni/search">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="keyword"
                                    placeholder="Cari Berdasarkan Nama Mahasiswa, NIM, Judul Skripsi, Bidang Ilmu dan Nama Dosen Pembimbing.">
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
                    <div class="row align-items-center m-2">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5></br>
                            <div class="table-responsive">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <i class="bi bi-check-circle"></i> {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('prohibited'))
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <i class="bi bi-exclamation-triangle"></i> {{ session('prohibited') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-bordered mb-0">
                                    <thead class="text-center">
                                        <tr class="table-success">
                                            <th>No.</th>
                                            <th width="200">Nama / NIM</th>
                                            <th>Judul Skripsi</th>
                                            <th>Bidang Ilmu</th>
                                            <th width="220">Dosen Pembimbing I</th>
                                            <th width="220">Dosen Pembimbing II</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-justify">
                                        <?php $i = 1; ?>
                                        @foreach ($alumnus as $alumni)
                                            <tr class="text-center">
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500" width="200">
                                                    <p>{{ $alumni->nama }}</p>
                                                    <p>NIM. {{ $alumni->nim }}</p>
                                                </td>
                                                <td>{{ $alumni->judul_skripsi }}</td>
                                                <td>{{ $alumni->bidang_ilmu }}</td>
                                                <td width="220">
                                                    <p>{{ $alumni->nama_dosbing1 }}</p>
                                                    <p>Nip. {{ $alumni->nip_dosbing1 }}</p>
                                                </td>
                                                <td width="220">
                                                    <p>{{ $alumni->nama_dosbing2 }}</p>
                                                    <p>Nip. {{ $alumni->nip_dosbing2 }}</p>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br><br><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $alumnus->links() }}
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
