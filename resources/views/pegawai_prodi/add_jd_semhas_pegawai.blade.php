<?php use Carbon\Carbon; ?>
@extends('dosen/layout')

@section('title')
    <title>Pegawai Prodi - Atur Penjadwalan Seminar Hasil</title>
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
                <div class="card col-xl-12 card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-5">
                            <!-- FORM DAFTAR JADWAL SEMHAS -->
                            <form class="form form-horizontal" method="post"
                                action="{{ route('store_jd_semhas_pegawai') }}">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama">Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nama" class="form-control"
                                                value="{{ $mahasiswa->nama }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nim">NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nim" class="form-control" name="nim"
                                                value="{{ $mahasiswa->nim }}" disabled>
                                            @error('nim')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date">Tangal Seminar Hasil</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="date"
                                                class="form-control  @error('date') is-invalid @enderror" name="date"
                                                required autocomplete="date">
                                            @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" id="waktu"
                                                class="form-control  @error('waktu') is-invalid @enderror" name="waktu"
                                                required autocomplete="waktu">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tempat">Tempat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="tempat"
                                                class="form-control  @error('tempat') is-invalid @enderror" name="tempat"
                                                required autocomplete="tempat">
                                            @error('tempat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br><br>
                                        <center>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM DAFTAR JADWAL SEMHAS -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
