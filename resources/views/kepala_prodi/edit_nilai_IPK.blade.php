@extends('admin/layout')

@section('title')
    <title>Prodi - Edit Nilai IPK</title>
@endsection

@section('sidebar')
    <li class="sidebar-item ">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/kaprodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item ">
        <a href="/sekretaris_prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/sekretaris_prodi/undangan_daftar_peserta" class='sidebar-link'>

            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li>
    <li class="sidebar-item has-sub active">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item has-sub active">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
@endsection


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Nilai IPK</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('input_nilai') }}">Input Nilai</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Nilai IPK</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENGEDITAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_upd_nilai_IPK') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai IPK Mahasiswa</h3> <br>
                                        <div class="col-md-4">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nama }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nim }}"
                                                disabled>
                                        </div><br><br><br>
                                        <div class="col-md-4">
                                            <label for="IPK">Nilai IPK</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="IPK"
                                                class="form-control  @error('IPK') is-invalid @enderror" name="IPK"
                                                value="{{ $data->IPK }}" required autocomplete="IPK">
                                            @error('IPK')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div><br><br><br>
                                        <center>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM EDIT NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
