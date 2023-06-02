@extends('admin/layout')

@section('title')
    <title>Admin - Riwayat Penghapusan Skripsi</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Aktivitas Penghapusan Skripsi</h3>
                    <p class="text-subtitle text-muted">Judul skripsi hanya dapat dihapus oleh admin.</p>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI RIWAYAT -->
        <div class="row">
            <form action="{{ route('cariLogHapusSkripsi') }}">
                @csrf
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Cari Riwayat Pendaftaran...">
                        </td>
                        <td>
                            <button class="btn btn-primary" type="submit"><i class="b bi-search"></i> </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- END FORM CARI -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR RIWAYAT PENGHAPUSAN SKRIPSI -->
                            <h3>Menampilkan hasil pencarian:</h3>
                            @if ($counter == 0)
                                <h5>Tidak ada hasil yang sesuai</h5>
                            @else
                                <p><i>Jumlah data yang sesuai: {{ $counter }} </i></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-center">
                                            <tr class="text-center table-success">
                                                <th>No.</th>
                                                <th>ID Admin</th>
                                                <th>Nama Admin</th>
                                                <th>Detail Aktivitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="text-bold-500">{{ $result->id_admin }}</td>
                                                    <td>{{ $result->nama_admin }}</td>
                                                    <td>
                                                        <p> Melakukan penghapusan judul skripsi pada tanggal
                                                            {{ $result->created_at }} mahasiswa dengan NIM
                                                            <b>{{ $result->nim }}</b>. Data yang tersimpan sebelum dihapus
                                                            sebagai berikut. <br>
                                                            Judul : {{ $result->judul_skripsi }} <br>
                                                            Bidang Ilmu: {{ $result->bidang_ilmu }}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                </div>
                            @endif
                            <div class="d-felx justify-content-center">
                                <a href="{{ route('log_penghapusan_skripsi') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
