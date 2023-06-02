@extends('admin/layout')

@section('title')
    <title>Admin - Riwayat Pendaftaran Skripsi</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Aktivitas Pendaftaran Skripsi</h3>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI RIWAYAT -->
        <div class="row">
            <form action="{{ route('cariLogDaftarSkripsi') }}">
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
        <!-- END FORM CARI-->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR RIWAYAT PENDAFTARAN SKRIPSI -->
                            <h3>Menampilkan hasil pencarian:</h3>
                            @if ($counter == 0)
                                <h5><i>Tidak ada hasil yang sesuai.</i></h5>
                            @else
                                <p><i>Jumlah data yang sesuai: {{ $counter }} </i></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-justify">
                                        <thead class="text-center">
                                            <tr class="text-center table-success">
                                                <th>No.</th>
                                                <th>ID Pengguna</th>
                                                <th>Nama Pendaftar</th>
                                                <th>Detail Aktivitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="text-bold-500">{{ $result->id_user }}</td>
                                                    <td>{{ $result->nama_pendaftar }}</td>
                                                    <td>
                                                        @if ($result->registered_by == 'mahasiswa')
                                                            <p>Mahasiswa bersangkutan ({{ $result->nama_pendaftar }} |
                                                                $result->nim) mendaftarkan judul skripsi pada tanggal
                                                                {{ $result->created_at }} sebagai berikut. <br>
                                                                Judul : {{ $result->judul_skripsi }}
                                                            </p>
                                                        @else
                                                            <p>Admin {{ $result->nama_pendaftar }} mendaftarkan judul
                                                                skripsi pada tanggal {{ $result->created_at }} untuk
                                                                mahasiswa dengan NIM <b>{{ $result->nim }}</b> sebagai
                                                                berikut. <br>
                                                                Judul : {{ $result->judul_skripsi }}
                                                            </p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                </div>
                            @endif
                            <div class="d-felx justify-content-center">
                                <a href="{{ route('log_pendaftaran_skripsi') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
