@extends('dosen/layout')

@section('title')
    <title>Dosen Penguji - Penilaian</title>
@endsection

@include('dosen_penguji/sidebar')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Input Nilai Uji Kelayakan Proposal</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
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
                            {{-- alert success_uji_kelayakan --}}
                            @if (session('success_uji_kelayakan'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success_uji_kelayakan') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- alert error_uji_kelayakan --}}
                            @if (session('error_uji_kelayakan'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error_uji_kelayakan') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- FORM PENDATAAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_nilai_uji_kelayakan_penguji') }}"
                                method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai Uji Kelayakan Proposal</h3>
                                        {{-- select pilihan nama mahasiswa from tabel mahasiswa --}}
                                        <div class="col-md-4">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select" name="nim" id="nim" required>
                                                <option value="" selected disabled>Pilih Mahasiswa</option>
                                                @foreach ($mahasiswa as $mhs)
                                                    <option value="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal">Tanggal Penilaian</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                                name="tanggal" required value="{{ old('tanggal') }}">
                                            @error('tanggal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" class="form-control @error('time') is-invalid @enderror"
                                                id="waktu" name="waktu" required value="{{ old('waktu') }}">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br><br><br><br>
                                        <h6>Silakan input sesuai dengan urutan komponen berikut:</h6>
                                        <i class="text-sm text-muted">Semua kolom nilai Wajib Diisi</i><br>
                                    </div>
                                    <div class="row">
                                        {{-- form uji_kelayakans 
                                        1	Judul Skripsi
                                        2	Latar Belakang
                                        3	Rumusan Masalah
                                        4	Landasan Teori
                                        5	Penelitian Terdahulu
                                        6	Data yang Digunakan
                                        7	Metodologi (Arsitektur Umum)
                                        8	Daftar Pustaka

                                        -- 1	Judul Skripsi enum(terima, perbaiki, ganti)
                                        --  catatan_judul_skripsi text
                                        -- 2	Latar Belakang enum(terima, perbaiki, ganti)
                                        --  catatan_latar_belakang text
                                        -- 3	Rumusan Masalah enum(terima, perbaiki, ganti)
                                        -- catatan_rumusan_masalah text
                                        -- 4	Landasan Teori enum(terima, perbaiki, ganti)
                                        -- catatan_landasan_teoris text
                                        -- 5	Penelitian Terdahulu enum(terima, perbaiki, ganti)
                                        -- catatan_penelitian_terdahulu text
                                        -- 6	Data yang Digunakan enum(terima, perbaiki, ganti)
                                        -- catatan_data_yang_digunakan text
                                        -- 7	Metodologi (Arsitektur Umum) enum(terima, perbaiki, ganti)
                                        -- catatan_metodologi text
                                        -- 8	Daftar Pustaka ) enum(terima, perbaiki, ganti)
                                        -- catatan_daftar_pustaka text
                                        --}}

                                        <div class="row">
                                            <p class="text-muted"> 1. Judul Skripsi<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n1">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n1" id="n1" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="catatan_judul_skripsi">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_judul_skripsi" id="catatan_judul_skripsi" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 2. Latar Belakang<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n2">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n2" id="n2" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_latar_belakang">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_latar_belakang" id="catatan_latar_belakang" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted "> 3. Rumusan Masalah<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n3">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n3" id="n3" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_rumusan_masalah">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_rumusan_masalah" id="catatan_rumusan_masalah" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 4. Landasan Teori<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n4">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n4" id="n4" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_landasan_teori">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_landasan_teori" id="catatan_landasan_teori" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 5. Penelitian Terdahulu<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n5">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n5" id="n5" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_penelitian_terdahulu">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_penelitian_terdahulu" id="catatan_penelitian_terdahulu" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 6. Data yang Digunakan<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n6">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n6" id="n6" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_data_yang_digunakan">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_data_yang_digunakan" id="catatan_data_yang_digunakan" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 7. Metodologi<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n7">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n7" id="n7" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="catatan_metodologi">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_metodologi" id="catatan_metodologi" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 8. Daftar Pustaka<br> </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n8">Nilai 8</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                {{-- select terima, perbaiki, tolak --}}
                                                <select class="form-select" name="n8" id="n8" required>
                                                    <option value="" selected disabled>Pilih Nilai</option>
                                                    <option value="terima">Terima</option>
                                                    <option value="perbaiki">Perbaiki</option>
                                                    <option value="ganti">Ganti</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold"
                                                    for="catatan_daftar_pustaka">Catatan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" name="catatan_daftar_pustaka" id="catatan_daftar_pustaka" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <!-- END NILAI DOSEN 1 -->
                                        <br>
                                        <div class="row">
                                            <center>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                </div>
                                            </center>
                                        </div>

                                    </div>
                            </form>
                            <!-- END FORM NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
