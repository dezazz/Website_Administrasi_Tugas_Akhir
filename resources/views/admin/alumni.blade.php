@extends('admin/layout')

@section('title')
    <title>Admin - Mahasiswa Lulus</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Mahasiswa yang sudah lulus sidang / alumni </h3>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI DATA MAHASISWA -->
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('cari_alumni') }}">
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
        </div>
        <!-- END FORM CARI MAHASISWA -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
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
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama / NIM</th>
                                            <th>Judul Skripsi</th>
                                            <th>Bidang Ilmu</th>
                                            <th>Doping 1</th>
                                            <th>Doping 2</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-justify">
                                        <?php $i = 1; ?>
                                        @foreach ($alumnus as $alumni)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $alumni->nama }} ({{ $alumni->nim }})</td>
                                                <td>{{ $alumni->judul_skripsi }}</td>
                                                <td>{{ $alumni->bidang_ilmu }}</td>
                                                <td>{{ $alumni->nama_dosbing1 }} ({{ $alumni->nip_dosbing1 }})</td>
                                                <td>{{ $alumni->nama_dosbing2 }} ({{ $alumni->nip_dosbing2 }})</td>
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
        </section>
    </div>
@endsection
