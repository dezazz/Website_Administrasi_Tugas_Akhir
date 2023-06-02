@extends('admin/layout')

@section('title')
    <title>Admin - Riwayat Pendaftaran Dosbing</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Aktivitas Pendaftaran Dosbing</h3>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI RIWAYAT -->
        <div class="row">
            <form action="{{ route('cariLogDaftarDosbing') }}">
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
        <!-- END FORM CARI MAHASISWA -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR RIWAYAT  PENDAFTARAN DOSBING -->
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 text-justify">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th width="50">No.</th>
                                            <th width="50">ID Admin</th>
                                            <th width="150">Nama Admin</th>
                                            <th width="500">Detail Aktivitas</th>
                                            <th width="150">Tanggal / waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($logs as $log)
                                            <tr class="text-center">
                                                <td width="50">{{ $i }}</td>
                                                <td width="50" class="text-bold-500">{{ $log->id_admin }}</td>
                                                <td width="150">{{ $log->nama_admin }}</td>
                                                <td width="500" style="text-align: left">
                                                    Admin <b>{{ $log->nama_admin }}</b> mendaftarkan dosen pembimbing untuk
                                                    mahasiswa bernama <b>{{ $log->nama }}</b>,
                                                    NIM <b>{{ $log->nim }}</b>,
                                                    dengan NIP dosen pembimbing sebagai berikut: <br>
                                                    NIP Dosbing 1 : {{ $log->nip_dosbing1 }} <br>
                                                    NIP Dosbing 2 : {{ $log->nip_dosbing2 }} <br>
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
