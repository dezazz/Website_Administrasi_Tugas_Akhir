@extends('admin/layout')

@section('title')
    <title>Admin - Pra Seminar Hasil</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Validasi Berkas Mahasiswa</h3>
                    <p class="text-subtitle text-muted">Berkas administrasi sebagai persyaratan semhas</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5>Daftar Peserta Seminar Hasil : </h5>
                <a href="/admin/cetakSemhas"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="bi bi-printer"></i>&nbsp;Cetak
                        Undangan dan Peserta Semhas</button></a>
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
                            <th>Nama / Nim</th>
                            <th>Form Persetujuan</th>
                            <th>Berita Acara</th>
                            <th>Lembar Kendali</th>
                            <th>Form Penilaian Uji Program</th>
                            <th>Form Penilaian</th>
                            <th>Status Seminar Hasil </th>
                        </tr>
                    </thead>
                    <tbody class="text-justify">
                        <?php $i; ?>
                        @for ($i = 0; $i <= count($query) - 1; $i += 2)
                            <tr>
                                <td>{{ $query[$i]->nama }} ({{ $query[$i]->nim }})</td>
                                <td>
                                    <center>
                                        <a href="/admin/formPersetujuanSemhas/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="/admin/beritaAcaraSemhas/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="/admin/lembarKendaliSemhas/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                @if ($query[$i]->no_statusAkses <= 3)
                                    <td>
                                        <center>
                                            <a href="/admin/formPenilaianUjiProgramKosong/{{ $query[$i]->nim }}"><button
                                                    type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i class="bi bi-printer"></i>&nbsp;Belum
                                                    Ada Nilai</button></a>
                                        </center>
                                    </td>
                                @else
                                    <td>
                                        <center>
                                            <a href="/admin/formPenilaianUjiProgram/{{ $query[$i]->nim }}"><button
                                                    type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i
                                                        class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                        </center>
                                    </td>
                                @endif
                                <td>
                                    <center>
                                        <a href="/admin/formPenilaianSemhas/{{ $query[$i]->nim }}"><button type="button"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i
                                                    class="bi bi-printer"></i>&nbsp;cetak</button></a>
                                    </center>
                                </td>
                                <td>
                                    @if ($query[$i]->no_statusAkses > 4)
                                        <p>Mahasiswa dinyatakan lulus.</p>
                                    @else
                                        <center>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <a href="/admin/approveSemhas/{{ $query[$i]->nim }}"><button
                                                                type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                    class="bi bi-check-circle"></i>
                                                                &nbsp;Terima</button></a>
                                                    </td>
                                                    <td>
                                                        <a href="/admin/declineSemhas/{{ $query[$i]->nim }}"><button
                                                                type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                    class="bi bi-x-circle"></i>&nbsp; Tolak</button></a>
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
                <div class="d-felx justify-content-center">
                    {{ $query->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
