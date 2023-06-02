@extends('admin/layout')

@section('title')
    <title>Admin - Riwayat Pengubahan Skripsi</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Aktivitas Pengubahan Skripsi</h3>
                    <p class="text-subtitle text-muted">Judul skripsi dapat diuba oleh admin dan mahasiswa.</p>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI RIWAYAT -->
        <div class="row">
            <form action="{{ route('cariLogUbahSkripsi') }}">
                @csrf
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Cari Riwayat Pengubahan...">
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
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR RIWAYAT PENGUBAHAN SKRIPSI -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th width="50">No.</th>
                                            <th width="50">ID Pengguna</th>
                                            <th width="150">Nama Pengubah</th>
                                            <th width="500">Detail Aktivitas</th>
                                            <th width="150">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($logs as $log)
                                            <tr class="text-center">
                                                <td width="50">{{ $i }}</td>
                                                <td width="50" class="text-bold-500">{{ $log->id_user }}</td>
                                                <td width="150">{{ $log->nama_pengubah }}</td>
                                                <td width="500" style="text-align: left">
                                                    @if ($log->edited_by == 'mahasiswa')
                                                        <p>Mahasiswa bersangkutan ({{ $log->nama_pengubah }} | $log->nim)
                                                            mengubah judul skripsi seperti berikut:<br><br>
                                                            {{ $log->old_judul_skripsi }} (judul lama) <b>menjadi</b>
                                                            {{ $log->new_judul_skripsi }} (judul_baru)
                                                        </p>
                                                    @else
                                                        <p>Admin <b>{{ $log->nama_pengubah }}</b> mengubah judul skripsi
                                                            mahasiswa dengan NIM {{ $log->nim }} untuk mahasiswa dengan
                                                            NIM
                                                            <b>{{ $log->nim }}</b> seperti berikut: <br><br>
                                                            <i>{{ $log->old_judul_skripsi }}</i> (judul lama)
                                                            <b>menjadi</b> <i>{{ $log->new_judul_skripsi }}</i> (judul
                                                            baru)
                                                        </p>
                                                    @endif
                                                </td>
                                                <td width="150">{!! date('d, M Y', strtotime($log->created_at)) !!}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br>

                                <br><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $logs->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
