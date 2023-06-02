<?php use Carbon\Carbon; ?>
@extends('admin/layout')

@section('title')
    <title>Admin - Penjadwalan Seminar Hasil</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penjadwalan Seminar Hasil</h3>
                    <p class="text-subtitle text-muted">Penjadwalan Seminar Hasil Mahasiswa</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR ADMIN    -->
                            <h5>Jadwal Seminar Hasil Mahasiswa</h5></br>
                            <table>
                                <tr>
                                    <th class="text-sm">Cetak Undangan</th>
                                    <th colspan="3"></th>
                                    <th class="text-sm">Cetak Daftar Peserta</th>
                                </tr>
                                <tr>
                                    <td>
                                        <form method="post" action="{{ route('cetakUndanganSemhas') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('tanggal_semhas') is-invalid @enderror"
                                                        id="tanggal_semhas" name="tanggal_semhas" required
                                                        value="{{ old('tanggal_semhas') }}" autocomplete="tanggal_semhas">
                                                        <option value="">-- Pilih Jadwal Semhas --</option>
                                                        <?php $i; ?>
                                                        @for ($i = 0; $i <= count($query) - 1; $i++)
                                                            <option value="{{ $query[$i]->tanggal_semhas }}">
                                                                {{ Carbon::parse($query[$i]->tanggal_semhas)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_semhas')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-sm text-sm"><i
                                                            class="bi bi-printer-fill"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td colspan="3">
                                        &nbsp; &nbsp;
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('cetakJadwalSemhas') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('tanggal_semhas') is-invalid @enderror"
                                                        id="tanggal_semhas" name="tanggal_semhas" required
                                                        value="{{ old('tanggal_semhas') }}" autocomplete="tanggal_semhas">
                                                        <option value="">-- Pilih Jadwal Semhas --</option>
                                                        <?php $j; ?>
                                                        @for ($j = 0; $j <= count($query) - 1; $j++)
                                                            <option value="{{ $query[$j]->tanggal_semhas }}">
                                                                {{ Carbon::parse($query[$j]->tanggal_semhas)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_semhas')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-sm text-sm"><i
                                                            class="bi bi-printer-fill"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div class="table-responsive">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <i class="bi bi-check-circle"></i> {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif(session('prohibited'))
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <i class="bi bi-exclamation-triangle"></i> {{ session('prohibited') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-bordered mb-0 ">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama/NIM</th>
                                            <th>Tanggal Semhas</th>
                                            <th>Waktu</th>
                                            <th>Tempat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ $mahasiswa->tanggal_semhas }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ date('H.i', strtotime($mahasiswa->waktu)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ $mahasiswa->tempat }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                @if ($mahasiswa->tanggal_semhas == null)
                                                                    <td>
                                                                        <form action="{{ route('add_jd_semhas') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswa->nama }}">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="bi bi-plus-square"></i>&nbsp;&nbsp;Jadwalkan</button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                                @if ($mahasiswa->tanggal_semhas != null)
                                                                    <td>
                                                                        <form action="{{ route('edit_jd_semhas') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswa->nama }}">
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i>&nbsp;&nbsp;</button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('delete_jd_semhas') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini? Anda tidak akan dapat mengembalikan data yang telah dihapus.')"><i
                                                                                    class="bi bi-trash"></i>&nbsp;&nbsp;</button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br><br><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $mahasiswas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
