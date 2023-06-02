@extends('dosen.layout')

@section('title')
    <title>Dosen - Bimbingan Seminar Proposal</title>
@endsection

@section('sidebar')
    <li class="sidebar-item ">
        <a href="dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item ">
        <a href="{{ route('mhs_bimbingan') }}" class='sidebar-link'>
            <span>Mahasiswa Bimbingan</span>
        </a>
    </li>
    <li class="sidebar-item has-sub active">
        <a href="{{ route('mahasiswa_ta') }}" class='sidebar-link active'>
            {{-- <i class="bi bi-people-fill"></i> --}}
            <span>Bimbingan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item active">
                <a href="{{ route('bimbingan_sempro') }}">Pra Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('bimbingan_semhas') }}">Pra Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('bimbingan_sidang') }}">Pra Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item has-sub ">
        <a href="/jadwalSeminarSidang" class='sidebar-link '>
            {{-- <i class="bi bi-people-fill"></i> --}}
            <span>Jadwal</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/dosen/sempro">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/dosen/semhas">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/dosen/sidang">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item has-sub ">
        <a href="#" class='sidebar-link '>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('v_nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('v_nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('v_nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>

    {{-- <li class="sidebar-item  ">
        <a href="jadwalSeminarSidang" class='sidebar-link'>
            <span>Jadwal Seminar/Sidang</span>
        </a>
    </li> --}}
    <li class="sidebar-item  ">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="sidebar-link">
            @csrf
            <button class="btn btn-primary" type="submit"> Logout
                {{-- <span>Logout</span> --}}
            </button>
        </form>
    </li>
@endsection

@section('content')
    <?php use Carbon\Carbon; ?>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12 col-md-6 order-md-1 order-last">
                    <h3>Bimbingan Pra Seminar Proposal</h3>
                    <p class="text-subtitle text-muted text-right">Dosen dapat mengisikan kendali bimbingan skripsi
                        mahasiswa sebelum melakukan seminar proposal</p>
                </div>
                {{-- Form berisikan tanggal penyerahan, tanggal selesai diperiksa, tanggal diterima kembali, dan catatan --}}

                {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="jadwalSeminarSidang">Jadwal Seminar/Sidang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dosen</li>
                        </ol>
                    </nav>
                </div> --}}
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                {{-- alert success_bimbingan_sempro --}}
                @if (session('success_bimbingan_sempro'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_bimbingan_sempro') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- alert error_bimbingan_sempro --}}
                @if (session('error_bimbingan_sempro'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error_bimbingan_sempro') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('simpan_bimbingan_sempro') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{ Auth::user()->id }}"> --}}
                    {{-- field nim mahasiswa --}}
                    {{-- select mahasiswa --}}
                    <div class="form-group mt-3">
                        <label for="nim">Nama Mahasiswa</label>
                        <select class="form-control" id="nim" name="nim">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach ($mahasiswa as $mhs)
                                <option value="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                            @endforeach
                        </select>
                        @error('nim')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggalPenyerahan">Tanggal Penyerahan</label>
                        <input type="date" class="form-control" id="tanggalPenyerahan" name="tanggalPenyerahan"
                            value="{{ old('tanggalPenyerahan') }}">
                        @error('tanggalPenyerahan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggalSelesaiDiperiksa">Tanggal Selesai Diperiksa</label>
                        <input type="date" class="form-control" id="tanggalSelesaiDiperiksa"
                            name="tanggalSelesaiDiperiksa" value="{{ old('tanggalSelesaiDiperiksa') }}">
                        @error('tanggalSelesaiDiperiksa')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="tanggalDiterimaKembali">Tanggal Diterima Kembali</label>
                        <input type="date" class="form-control" id="tanggalDiterimaKembali" name="tanggalDiterimaKembali"
                            value="{{ old('tanggalDiterimaKembali') }}">
                        @error('tanggalDiterimaKembali')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
    </div>

    </div>
    </div>
@endsection
