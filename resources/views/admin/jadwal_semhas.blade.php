@extends('admin/layout')

@section('title')
    <title>Cetak Peserta Semhas</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Undangan & Daftar Peserta Semhas</h3>
                </div>
            </div>
        </div>
        <?php use Carbon\Carbon; ?>
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="card card-outline-secondary">
                            <div class="row align-items-center m-5">
                                <div class="col-md mb-5">
                                    <!-- FORM DAFTAR JADWAL SEMHAS -->
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakUndanganSemhas') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_semhas">Cetak Undangan Seminar Hasil</label>
                                                </div>
                                                <div class="col-md-6">
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
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form><br><br>
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakJadwalSemhas') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_semhas">Cetak Daftar Peserta Seminar Hasil</label>
                                                </div>
                                                <div class="col-md-6">
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
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM DAFTAR JADWAL SEMPRO
                                                     -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
