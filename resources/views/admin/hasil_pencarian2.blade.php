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
                    <p class="text-subtitle text-muted">Pendaftaran dosbing hanya dilakukan oleh admin.</p>
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
        <!-- END FORM CARI-->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR RIWAYAT PENDAFTARAN DOSBING -->
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
                                                        Admin <i>{{ $result->nama_admin }}</i> mendaftarkan dosen
                                                        pembimbing untuk mahasiswa <br>
                                                        Nama / NIM : <i> {{ $result->nama }} {{ $result->nim }} </i><br>
                                                        dengan NIP dosbing sebagai berikut. <br>
                                                        NIP Dosbing 1 : <i>{{ $result->nip_dosbing1 }}</i> <br>
                                                        NIP Dosbing 2 : <i>{{ $result->nip_dosbing2 }}</i> <br>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                </div>
                            @endif
                            <div class="d-felx justify-content-center">
                                <a href="{{ route('log_pendaftaran_dosbing') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
