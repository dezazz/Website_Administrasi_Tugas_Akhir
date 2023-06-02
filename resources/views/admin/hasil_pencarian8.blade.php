@extends('admin/layout')

@section('title')
    <title>Admin -Alumni</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Daftar Mahasiswa Lulus / Alumni</h3>
                    <br><br>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI DATA MAHASISWA -->
        <div class="row">
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
        <!-- END FORM CARI MAHASISWA -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5>
                            <div class="table-responsive">
                                @if ($counter != 0)
                                    <p class="text-muted"><i>Hasil pencarian: {{ $counter }} data yang sesuai</i></p>
                                    <table class="table table-bordered mb-0 text-center">
                                        <thead>
                                            <tr class="text-center table-success">
                                                <th>No.</th>
                                                <th>Nama / NIM</th>
                                                <th>Judul Skripsi</th>
                                                <th>Bidang Ilmu</th>
                                                <th>Dosbing 1</th>
                                                <th>Dosbing 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="text-bold-500">{{ $result->nama }} ({{ $result->nim }})
                                                    </td>
                                                    <td>{{ $result->judul_skripsi }}</td>
                                                    <td>{{ $result->bidang_ilmu }}</td>
                                                    <td>{{ $result->nama_dosbing1 }} ({{ $result->nip_dosbing1 }})</td>
                                                    <td>{{ $result->nama_dosbing2 }} ({{ $result->nip_dosbing2 }})</td>
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
                                <a href="{{ route('alumni') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
