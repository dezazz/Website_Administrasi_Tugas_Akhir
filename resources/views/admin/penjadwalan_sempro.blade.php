<?php use Carbon\Carbon; ?>
@extends('admin/layout')

@section('title')
    <title>Admin - Penjadwalan Seminar Proposal</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penjadwalan Seminar Proposal</h3>
                    <p class="text-subtitle text-muted">Penjadwalan Seminar Proposal Mahasiswa</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR ADMIN    -->
                            <h5>Jadwal Seminar Proposal Mahasiswa</h5></br>
                            <table>
                                <tr>
                                    <th class="text-sm">Cetak Undangan</th>
                                    <th colspan="3"></th>
                                    <th class="text-sm">Cetak Daftar Peserta</th>
                                </tr>
                                <tr>
                                    <td>
                                        <form method="post" action="{{ route('cetakUndanganSempro') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <select
                                                        class="form-control  @error('tanggal_sempro') is-invalid @enderror"
                                                        id="tanggal_sempro" name="tanggal_sempro" required
                                                        value="{{ old('tanggal_sempro') }}" autocomplete="tanggal_sempro">
                                                        <option value="">-- Pilih Jadwal Sempro --</option>
                                                        <?php $i; ?>
                                                        @for ($i = 0; $i <= count($query) - 1; $i++)
                                                            <option value="{{ $query[$i]->tanggal_sempro }}">
                                                                {{ Carbon::parse($query[$i]->tanggal_sempro)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_sempro')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-xl-4">
                                                    <button type="submit" class="btn btn-primary btn-sm text-sm"><i
                                                            class="bi bi-printer-fill"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                        </form>
                                    </td>
                                    <td colspan="3">
                                        &nbsp; &nbsp;
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('cetakJadwalSempro') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <select
                                                        class="form-control  @error('tanggal_sempro') is-invalid @enderror"
                                                        id="tanggal_sempro" name="tanggal_sempro" required
                                                        value="{{ old('tanggal_sempro') }}" autocomplete="tanggal_sempro">
                                                        <option value="">-- Pilih Jadwal Sempro --</option>
                                                        <?php $j; ?>
                                                        @for ($j = 0; $j <= count($query) - 1; $j++)
                                                            <option value="{{ $query[$j]->tanggal_sempro }}">
                                                                {{ Carbon::parse($query[$j]->tanggal_sempro)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_sempro')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-xl-4">
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
                                @endif
                                <table class="table table-bordered mb-0">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama/NIM</th>
                                            <th>Tanggal Sempro</th>
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
                                                    @if ($mahasiswa->tanggal_sempro == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ $mahasiswa->tanggal_sempro }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_sempro == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ date('H.i', strtotime($mahasiswa->waktu)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_sempro == null)
                                                        <p>Belum terdaftar.</p>
                                                    @else
                                                        {{ $mahasiswa->tempat }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                @if ($mahasiswa->tanggal_sempro == null)
                                                                    <td>
                                                                        <form action="{{ route('add_jd_sempro') }}">
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
                                                                @if ($mahasiswa->tanggal_sempro != null)
                                                                    <td>
                                                                        <form action="{{ route('edit_jd_sempro') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswa->nama }}">
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i>&nbsp;&nbsp;Edit</button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('delete_jd_sempro') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#deleteModal{{ $mahasiswa->nim }}"><i
                                                                                    class="bi bi-trash"></i>&nbsp;&nbsp;Hapus</button>
                                                                            <div class="modal fade
                                                                                text-left"
                                                                                id="deleteModal{{ $mahasiswa->nim }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="myModalLabel1"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header bg-danger">
                                                                                            <h5 class="modal-title white"
                                                                                                id="myModalLabel1">Hapus
                                                                                                Jadwal Sempro</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <i data-feather="x"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div
                                                                                            class="modal-body
                                                                                            text-center">
                                                                                            <p>Apakah Anda yakin ingin
                                                                                                menghapus jadwal ini? Anda
                                                                                                tidak akan dapat
                                                                                                mengembalikan data yang
                                                                                                telah dihapus.</p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-light-secondary"
                                                                                                data-bs-dismiss="modal">
                                                                                                <i
                                                                                                    class="bx bx-x d-block d-sm-none"></i>
                                                                                                <span
                                                                                                    class="d-none d-sm-block">Batal</span>
                                                                                            </button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger ml-1">
                                                                                                <i
                                                                                                    class="bx bx-check d-block d-sm-none"></i>
                                                                                                <span
                                                                                                    class="d-none d-sm-block">Hapus</span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            {{-- <button type="submit"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini? Anda tidak akan dapat mengembalikan data yang telah dihapus.')"><i
                                                                                    class="bi bi-trash"></i>&nbsp;&nbsp;</button> --}}
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
