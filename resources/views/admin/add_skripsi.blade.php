@extends('admin/layout')

@section('title')
    <title>Admin - Daftar Judul Skripsi</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Judul Skripsi</h3>
                    <p class="text-subtitle text-muted">Pendaftaran judul skripsi mahasiswa</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENDAFTARAN JUDUL SKRIPSI -->
                            <form class="form form-horizontal" action="{{ route('storeSkripsi') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $mahasiswa->nim }}" name="nim">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" value="{{ $mahasiswa->nim }}"
                                                autocomplete="nim" disabled>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="judul_skripsi">Judul Skripsi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="judul_skripsi"
                                                class="form-control  @error('judul_skripsi') is-invalid @enderror"
                                                value="{{ old('judul_skripsi') }}" name="judul_skripsi"
                                                autocomplete="judul_skripsi">
                                            @error('judul_skripsi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="eng_judul_skripsi">Judul Skripsi Bahasa Inggris</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="eng_judul_skripsi"
                                                class="form-control  @error('eng_judul_skripsi') is-invalid @enderror"
                                                value="{{ old('eng_judul_skripsi') }}" name="eng_judul_skripsi"
                                                autocomplete="eng_judul_skripsi">
                                            @error('eng_judul_skripsi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="bid_tulis">Bidang Tulis</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select id="bid_tulis"
                                                class="form-control  @error('bid_tulis') is-invalid @enderror"
                                                value="{{ old('bid_tulis') }}" name="bid_tulis" autocomplete="bid_tulis">
                                                <option value="">--Pilih Bidang Ilmu--</option>
                                                @foreach ($bidang_ilmu as $bid)
                                                    <option value="{{ $bid->bidang_ilmu }}">{{ $bid->bidang_ilmu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bid_tulis')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mt-2"></div>
                                        <div class="col-md-4 mt-2"><button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button></div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM PENDAFTARAN JUDUL SKRIPSI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
