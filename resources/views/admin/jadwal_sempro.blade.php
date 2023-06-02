@extends('admin/layout')

@section('title')
    <title>Cetak Peserta Sempro</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Undangan & Daftar Peserta Sempro</h3>
                    <p class="text-subtitle text-muted">Cetak Undangan dan Daftar Peserta Seminar Proposal</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="card card-outline-secondary">
                            <div class="row align-items-center m-5">
                                <div class="col-md mb-5">
                                    <?php use Carbon\Carbon; ?>
                                    <!-- FORM DAFTAR JADWAL SEMPRO -->
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakUndanganSempro') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_sempro">Cetak Undangan Seminar Proposal</label>
                                                </div>
                                                <div class="col-md-6">
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
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form><br><br>
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakJadwalSempro') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_sempro">Cetak Peserta Seminar Proposal</label>
                                                </div>
                                                <div class="col-md-6">
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
