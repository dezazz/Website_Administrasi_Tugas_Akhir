@extends('admin/layout')

@section('title')
    <title>Cetak Peserta Sidang</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Undangan & Daftar Peserta Sidang</h3>
                    <p class="text-subtitle text-muted">Cetak Undangan & Daftar Peserta Sidang Meja Hijau</p>
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
                                    <!-- FORM -->
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakUndanganSidang') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_sidang">Cetak Undangan Sidang Meja Hijau</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select
                                                        class="form-control  @error('tanggal_sidang') is-invalid @enderror"
                                                        id="tanggal_sidang" name="tanggal_sidang" required
                                                        value="{{ old('tanggal_sidang') }}" autocomplete="tanggal_sidang">
                                                        <option value="">-- Pilih Jadwal Sidang Meja Hijau --
                                                        </option>
                                                        <?php $i; ?>
                                                        @for ($i = 0; $i <= count($query) - 1; $i++)
                                                            <option value="{{ $query[$i]->tanggal_sidang }}">
                                                                {{ Carbon::parse($query[$i]->tanggal_sidang)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_sidang')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <br><br>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form><br><br>
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('cetakJadwalSidang') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="tanggal_sidang">Cetak Daftar Peserta Sidang Meja
                                                        Hijau</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select
                                                        class="form-control  @error('tanggal_sidang') is-invalid @enderror"
                                                        id="tanggal_sidang" name="tanggal_sidang" required
                                                        value="{{ old('tanggal_sidang') }}" autocomplete="tanggal_sidang">
                                                        <option value="">-- Pilih Jadwal Sidang Meja Hijau --
                                                        </option>
                                                        <?php $j; ?>
                                                        @for ($j = 0; $j <= count($query) - 1; $j++)
                                                            <option value="{{ $query[$j]->tanggal_sidang }}">
                                                                {{ Carbon::parse($query[$j]->tanggal_sidang)->translatedFormat('l / d F Y') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('tanggal_sidang')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <br><br>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
