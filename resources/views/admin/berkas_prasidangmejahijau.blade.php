@extends('admin/layout')

@section('title')
    <title>Admin - Pra Sidang Meja Hijau</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Berkas Administrasi Sidang</h3>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5>Daftar Peserta Sidang : </h5>
                <a href="/admin/cetakSidang"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="bi bi-printer"></i>&nbsp;Cetak
                        Undangan dan Peserta Sidang</button></a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <i class="bi bi-check-circle"></i> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('prohibited'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <i class="bi bi-exclamation-triangle"></i> {{ session('prohibited') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table" id="table1">
                    <thead class="text-center">
                        <tr class="text-center table-success">
                            <th>Nama / NIM </th>
                            <th>Form Persetujuan</th>
                            <th>Berita Acara</th>
                            <th>Lembar Kendali</th>
                            <th>Kata Pengantar Sidang</th>
                            <th>Form Penilaian</th>
                            <th>Status Sidang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i; ?>
                        @for ($i = 0; $i <= count($query) - 1; $i += 2)
                            <tr>
                                <td>{{ $query[$i]->nama }} ({{ $query[$i]->nim }})</td>
                                <td>
                                    <center>
                                        <a href="/admin/formPersetujuanSidang/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                @if ($nilai[$i]->total_semhas != null)
                                    <td>
                                        <center>
                                            <a href="/admin/beritaAcaraSidang/{{ $query[$i]->nim }}"><button type="button"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i
                                                        class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                        </center>
                                    </td>
                                @else
                                    <td>
                                        <center>
                                            <a href="/admin/beritaAcaraSidang/{{ $query[$i]->nim }}"><button type="button"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i
                                                        class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                        </center>
                                    </td>
                                @endif
                                <td>
                                    <center>
                                        <a href="/admin/lembarKendaliSidang/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="/admin/kataPengantarSidang/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="/admin/formPenilaianSidang/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    @if ($query[$i]->no_statusAkses == 7)
                                        <p>Mahasiswa dinyatakan lulus.</p>
                                    @else
                                        <center>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <a href="/admin/approveSidang/{{ $query[$i]->nim }}"><button
                                                                type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                    class="bi bi-check-circle"></i>
                                                                &nbsp;Terima</button></a>
                                                    </td>
                                                    <td>
                                                        <a href="/admin/declineSidang/{{ $query[$i]->nim }}"><button
                                                                type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                    class="bi bi-x-circle"></i> &nbsp; Tolak</button></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
