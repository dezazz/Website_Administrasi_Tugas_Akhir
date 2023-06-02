@extends('sekretaris_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Mahasiswa Aktif</title>
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
                    <div class="col-md-12 col-md-6 order-md-1 order-last">
                        <h3>Mahasiswa Aktif</h3>
                        <p class="text-subtitle text-muted">Daftar mahasiswa-mahasiswa aktif tingkat akhir yang melakukan
                            administrasi tugas akhir.</p>
                    </div>
                </div>
            </div>
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
            <div class="row">
                <div class="col-xl-8">
                    <form action="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif/search">
                        @csrf
                        <div class="row">
                            <div class="col-xl-11">
                                <input type="text" class="form-control" name="keyword"
                                    placeholder="Cari Berdasarkan Nama Mahasiswa, NIM, Judul Skripsi, dan Nama Dosen Pembimbing.">
                            </div>
                            <div class="col-xl-1">
                                <button class="btn btn-primary" type="submit"><i class="b bi-search"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END FORM CARI MAHASISWA -->

                <div class="col-xl-1"></div>
                <!-- FORM  FILTER -->

                <!-- END FORM FILTER -->

            </div>
            <div class="row mt-3">
                <div class="col-xl-8">
                    <form action="/sekretaris_prodi/hasil_filter" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-xl-11">
                                <select class="form-control   @error('angkatan') is-invalid @enderror" id="angkatan"
                                    style="color: gray" name="angkatan" required placeholder="Filter Tahun Angkatan ">
                                    <option value="">Filter Tahun Angkatan</option>
                                    @foreach ($angkatan as $akt)
                                        <option value="{{ $akt->angkatan }}">{{ $akt->angkatan }}</option>
                                    @endforeach
                                </select>
                                @error('angkatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-1">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <br><br>

            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-3">
                        <div class="col-md mb-6">
                            <h5 class="text-center">Daftar Mahasiswa</h5><br>
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
                                <table class="table table-bordered mb-0 text-center">
                                    <thead>
                                        <tr class="table-success">
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Judul Skripsi</th>
                                            <th>Pembimbing I</th>
                                            <th>Pembimbing II</th>
                                            <th>Lembar Kendali Bimbingan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td class="text-bold-500">{{ $mahasiswa->nama_mhs }}</td>
                                                <td width="300">{{ $mahasiswa->judul_skripsi }}</td>
                                                <td>{{ $mahasiswa->nama_dosbing1 }}</td>
                                                <td>{{ $mahasiswa->nama_dosbing2 }}</td>
                                                <td>
                                                    <a href="/sekretaris_prodi/lembar_kendali/{{ $mahasiswa->nim }}"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="bi bi-printer-fill"></i>&nbsp;Cetak</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br><br><br>
                            </div>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-primary  justify-content-center">
                                    <li class="page-item">
                                        {{ $mahasiswas->links() }}
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection
