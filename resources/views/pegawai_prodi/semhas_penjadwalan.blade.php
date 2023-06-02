<?php use Carbon\Carbon; ?>
@extends('dosen/layout')

@section('title')
    <title>Pegawai Prodi - Penjadwalan Seminar Hasil</title>
@endsection

@include('pegawai_prodi/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Penjadwalan Seminar Hasil</h3>
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
                            {{-- alert success_add_semhas --}}
                            @if (session('success_add_semhas'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success_add_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- alert failed_add_semhas --}}
                            @if (session('failed_add_semhas'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('failed_add_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- alert success_edit_semhas --}}
                            @if (session('success_edit_semhas'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success_edit_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- alert success_delete_semhas --}}
                            @if (session('success_delete_semhas'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success_delete_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <table>
                                <tr>
                                    <th class="text-sm">Cetak Undangan</th>
                                    <th colspan="3"></th>
                                    <th class="text-sm">Cetak Daftar Peserta</th>
                                </tr>
                                <tr>
                                    <td>
                                        <form method="post" action="{{ route('cetakUndanganSemhas_pegawai') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('tanggal_semhas') is-invalid @enderror"
                                                        id="tanggal_semhas" name="tanggal_semhas" required
                                                        value="{{ old('tanggal_semhas') }}" autocomplete="tanggal_semhas">
                                                        <option value="">Pilih Tanggal
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#9660;
                                                        </option>
                                                        <?php $i; ?>
                                                        @for ($i = 0; $i <= count($query) - 1; $i++)
                                                            @if ($query[$i]->tanggal_semhas != null)
                                                                <option value="{{ $query[$i]->tanggal_semhas }}">
                                                                    {{ Carbon::parse($query[$i]->tanggal_semhas)->translatedFormat('l / d F Y') }}
                                                                </option>
                                                            @endif
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
                                        </form>
                                    </td>
                                    <td colspan="3">
                                        &nbsp; &nbsp;
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('cetakJadwalSemhas_pegawai') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <select
                                                        class="form-control  @error('tanggal_semhas') is-invalid @enderror"
                                                        id="tanggal_semhas" name="tanggal_semhas" required
                                                        value="{{ old('tanggal_semhas') }}" autocomplete="tanggal_semhas">
                                                        <option value="">Pilih Tanggal
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#9660;
                                                        </option>
                                                        <?php $j; ?>
                                                        @for ($j = 0; $j <= count($query) - 1; $j++)
                                                            @if ($query[$j]->tanggal_semhas != null)
                                                                <option value="{{ $query[$j]->tanggal_semhas }}">
                                                                    {{ Carbon::parse($query[$j]->tanggal_semhas)->translatedFormat('l / d F Y') }}
                                                                </option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_semhas')
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
                                    <thead class="text-center ">
                                        <tr class="table-success">
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Tempat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr class="text-center">
                                                <td>{{ $i }}</td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td class="text-bold-500">{{ $mahasiswa->nama }}
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Tanggal Belum Ditentukan</p>
                                                    @else
                                                        {{ $mahasiswa->tanggal_semhas }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Waktu Belum Ditentukan</p>
                                                    @else
                                                        {{ date('H.i', strtotime($mahasiswa->waktu)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswa->tanggal_semhas == null)
                                                        <p>Tempat Belum Ditentukan</p>
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
                                                                        <form
                                                                            action="{{ route('add_jd_semhas_pegawai') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswa->nama }}">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="bi bi-plus-square"></i>&nbsp;&nbsp;Atur
                                                                                Jadwal</button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                                @if ($mahasiswa->tanggal_semhas != null)
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('edit_jd_semhas_pegawai') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswa->nama }}">
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            {{-- button edit --}}
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i>&nbsp;&nbsp;
                                                                                Edit</button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('delete_jd_semhas_pegawai') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswa->nim }}">
                                                                            {{-- window pop up delete --}}
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal{{ $mahasiswa->nim }}"><i
                                                                                    class="bi bi-trash"></i>&nbsp;&nbsp;Hapus</button>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade text-left"
                                                                                id="exampleModal{{ $mahasiswa->nim }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="myModalLabel1"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="myModalLabel1">
                                                                                                Hapus Jadwal
                                                                                                Seminar Hasil</h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p>Apakah anda yakin
                                                                                                ingin menghapus
                                                                                                jadwal seminar
                                                                                                hasil mahasiswa
                                                                                                {{ $mahasiswa->nama }}
                                                                                                ?</p>
                                                                                        </div>

                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-light-secondary"
                                                                                                data-bs-dismiss="modal">
                                                                                                <i
                                                                                                    class="bx bx-x d-block d-sm-none"></i>
                                                                                                <span
                                                                                                    class="d-none d-sm-block">Close</span>
                                                                                            </button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger ml-1">
                                                                                                <i
                                                                                                    class="bx bx-check d-block d-sm-none"></i>
                                                                                                <span
                                                                                                    class="d-none d-sm-block">Delete</span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

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
                                {{-- link pagination --}}
                                {{ $mahasiswas->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
