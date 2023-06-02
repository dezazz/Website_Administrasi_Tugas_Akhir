@extends('admin/layout')

@section('title')
    <title>Admin - Tambahkan Dosen Pembimbing</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftarkan dosen pembimbing</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="card card-outline-secondary">
                            {{-- <center>
                                <img class="card-img-top img-fluid" src="../assets/images/dosbing.jpg" alt="lecturer_image"
                                    style="height: 400px;" />
                            </center> --}}
                            <div class="row align-items-center m-5">
                                <div class="col-md mb-5">
                                    <!-- FORM DAFTAR JADWAL SEMPRO -->
                                    <form class="form form-horizontal" method="post" action="{{ route('store_dosbing') }}">
                                        @csrf
                                        <input type="hidden" name="nim" value="{{ $nim }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama" class="form-control"
                                                        value="{{ $nama_mhs }}" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nim">NIM</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nim" class="form-control" name="nim"
                                                        value="{{ $nim }}" disabled>
                                                    @error('nim')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="dosbing1">Dosen Pembimbing I</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control  @error('dosbing1') is-invalid @enderror"
                                                        id="dosbing1" name="dosbing1" required
                                                        value="{{ old('dosbing1') }}" autocomplete="dosbing1">
                                                        <option value=""></option>
                                                        @foreach ($dosens as $dosen)
                                                            <option value="{{ $dosen->nip }}">{{ $dosen->nama }} -
                                                                {{ $dosen->nip }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosbing1')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label for="dosbing2">Dosen Pembimbing II</label>
                                                </div>
                                                <div class="col-md-8 mt-2">
                                                    <select class="form-control  @error('dosbing2') is-invalid @enderror"
                                                        id="dosbing2" name="dosbing2" required
                                                        value="{{ old('dosbing2') }}" autocomplete="dosbing2">
                                                        <option value=""></option>
                                                        @foreach ($dosens as $dosen)
                                                            <option value="{{ $dosen->nip }}">{{ $dosen->nama }} -
                                                                {{ $dosen->nip }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosbing2')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-2"></div>
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM DAFTAR JADWAL SEMPRO -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
