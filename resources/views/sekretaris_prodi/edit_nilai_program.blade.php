@extends('admin/layout')

@section('title')
    <title>Prodi - Edit Nilai Uji Program</title>
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
@endsection


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Nilai Uji Program</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('input_nilai') }}">Input Nilai</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('nilai_uji_program') }}">Input Nilai Uji
                                    Program</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Nilai Uji Program</li>
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
                            <form class="form form-horizontal" action="{{ route('store_upd_nilai_program') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Input Nilai Uji Program</h3> <br>
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
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal">Tanggal Penilaian</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                                name="tanggal" required value="{{ $data->tanggal }}">
                                            @error('tanggal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" class="form-control @error('waktu') is-invalid @enderror"
                                                id="waktu" name="waktu" required value="{{ $data->waktu }}">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br><br><br><br>
                                        <h6>Silakan input nilai sesuai dengan urutan komponen berikut:</h6>
                                        <p class="text-muted">
                                            1. Nilai 1: Kemampuan dasar pemrograman (0-40)<br>
                                            2. Nilai 2: Kecoockan metode/algoritma dengan sintaks program (0-10) <br>
                                            3. Nilai 3: Penguasaan pemrograman berdasarkan kasus pada skripsi (0-20) <br>
                                            4. Nilai 4: Penguasaan pembuatan <i>User Interface</i> (0-10) <br>
                                            5. Nilai 5: Validasi output program (0-20) <br>
                                            6. Nilai 6: Nilai total (0-100) * <br>
                                            <i class="text-muter">*) Wajib Diisi</i>
                                            <br>
                                        </p>
                                        <div class="col-md-4">
                                            <label for="n1">Nilai 1</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n1"
                                                class="form-control  @error('n1') is-invalid @enderror" name="n1"
                                                value="{{ $data->n1 }}" autocomplete="n1">
                                            @error('n1')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="n2">Nilai 2</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n2"
                                                class="form-control  @error('n2') is-invalid @enderror" name="n2"
                                                value="{{ $data->n2 }}" autocomplete="n2">
                                            @error('n2')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="n3">Nilai 3</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n3"
                                                class="form-control  @error('n3') is-invalid @enderror" name="n3"
                                                value="{{ $data->n3 }}">
                                            @error('n3')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="n4">Nilai 4</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n4"
                                                class="form-control  @error('n4') is-invalid @enderror" name="n4"
                                                value="{{ $data->n4 }}">
                                            @error('n4')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="n5">Nilai 5</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n5"
                                                class="form-control  @error('n5') is-invalid @enderror" name="n5"
                                                value="{{ $data->n5 }}">
                                            @error('n5')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="n6">Nilai 6</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n6"
                                                class="form-control  @error('n6') is-invalid @enderror" name="n6"
                                                value="{{ $data->n6 }}" required>
                                            @error('n6')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nip">Pemberi Nilai</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control  @error('nip') is-invalid @enderror"
                                                id="nip" name="nip" required autocomplete="nip">
                                                <option value="{{ $data->nip }}"> {{ $data->nama_doping }}</option>
                                                <option value="{{ $data->nip_dosbing1 }}">Doping I -
                                                    {{ $data->nama_dosbing1 }}</option>
                                                <option value="{{ $data->nip_dosbing2 }}">Doping II -
                                                    {{ $data->nama_dosbing2 }}</option>
                                            </select>
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> <br><br>
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
