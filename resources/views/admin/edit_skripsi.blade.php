@extends('admin/layout')

@section('title')
    <title>Admin - Edit Judul Skripsi</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Judul Skripsi</h3>
                    <p class="text-subtitle text-muted">Menu pra seminar proposal</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM EDIT JUDUL SKRIPSI -->
                            <form class="form form-horizontal" action="{{ route('storeNewSkripsi') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $mahasiswa->nim }}" name="nim">
                                <input type="hidden" value="{{ $mahasiswa->judul_skripsi }}" name="old_judul_skripsi">
                                <input type="hidden" value="{{ $mahasiswa->eng_judul_skripsi }}"
                                    name="old_eng_judul_skripsi">
                                <input type="hidden" value="{{ $mahasiswa->bidang_ilmu }}" name="old_bid_ilmu">
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
                                            <label for="new_judul_skripsi">Judul Skripsi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="new_judul_skripsi"
                                                class="form-control  @error('new_judul_skripsi') is-invalid @enderror"
                                                value="{{ $mahasiswa->judul_skripsi }}" name="new_judul_skripsi"
                                                autocomplete="new_judul_skripsi">
                                            @error('new_judul_skripsi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="new_eng_judul_skripsi">Judul Skripsi Bahasa Inggris</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="new_eng_judul_skripsi"
                                                class="form-control  @error('new_eng_judul_skripsi') is-invalid @enderror"
                                                value="{{ $mahasiswa->eng_judul_skripsi }}" name="new_eng_judul_skripsi"
                                                autocomplete="new_eng_judul_skripsi">
                                            @error('new_eng_judul_skripsi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="new_bid_ilmu">Bidang Ilmu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select id="new_bid_ilmu"
                                                class="form-control  @error('new_bid_ilmu') is-invalid @enderror"
                                                value="{{ $mahasiswa->bidang_ilmu }}" name="new_bid_ilmu"
                                                autocomplete="new_bid_ilmu">
                                                <option value="{{ $mahasiswa->bidang_ilmu }}">
                                                    {{ $mahasiswa->bidang_ilmu }}</option>
                                                @foreach ($bidang_ilmu as $bid)
                                                    <option value="{{ $bid->bidang_ilmu }}">{{ $bid->bidang_ilmu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('new_bid_ilmu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM EDIT JUDUL SKRIPSI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection
