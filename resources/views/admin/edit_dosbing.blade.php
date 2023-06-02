@extends('admin/layout')

@section('title')
    <title>Admin - Edit Dosen Pembimbing</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perbarui dosen pembimbing</h3>
                    <p class="text-subtitle text-muted">Menu seminar proposal</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="card card-outline-secondary">
                            {{-- <center>
                                <img class="card-img-top img-fluid" src="../assets/images/dosbing.jpg" alt="lecturer_image"
                                    style="height: 500px;" />
                            </center> --}}
                            <div class="row align-items-center m-5">
                                <div class="col-md mb-5">
                                    <!-- FORM EDIT DOSBING -->
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('store_new_dosbing') }}">
                                        @csrf
                                        <input type="hidden" name="nim" value="{{ $nim }}">
                                        <input type="hidden" name="old_dosbing1" value="{{ $dosbing1->nip }}">
                                        <input type="hidden" name="old_dosbing2" value="{{ $dosbing2->nip }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama" class="form-control" name="nama"
                                                        value="{{ $nama }}" disabled>
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
                                                    <label for="new_dosbing1">Doping I</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('new_dosbing1') is-invalid @enderror"
                                                        id="new_dosbing1" name="new_dosbing1" required
                                                        value="{{ old('new_dosbing1') }}" autocomplete="new_dosbing1">
                                                        <option value="{{ $dosbing1->nip }}"> {{ $dosbing1->nama }} -
                                                            {{ $dosbing1->nip }}</option>
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
                                                    <label for="new_dosbing2">Doping II</label>
                                                </div>
                                                <div class="col-md-8 mt-2">
                                                    <select
                                                        class="form-control  @error('new_dosbing2') is-invalid @enderror"
                                                        id="new_dosbing2" name="new_dosbing2" required
                                                        value="{{ old('new_dosbing2') }}" autocomplete="new_dosbing2">
                                                        <option value="{{ $dosbing2->nip }}">{{ $dosbing2->nama }} -
                                                            {{ $dosbing2->nip }}</option>
                                                        @foreach ($dosens as $dosen)
                                                            <option value="{{ $dosen->nip }}">{{ $dosen->nama }} -
                                                                {{ $dosen->nip }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosbing2')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-3">

                                                    <button type="submit" class="btn btn-primary mt-2"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM EDIT DOSBING -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
