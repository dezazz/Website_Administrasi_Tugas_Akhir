@extends('admin/layout')

@section('title')
    <title>Edit Dosen Penguji</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Perbarui dosen penguji</h3>
                    <p class="text-subtitle text-muted">Menu pra seminar hasil</p>
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
                                        action="{{ route('store_new_dosen_penguji') }}">
                                        @csrf
                                        <input type="hidden" name="nim" value="{{ $nim }}">
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
                                                    <label for="dosen_penguji1">Dosen Penguji I</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('dosen_penguji1') is-invalid @enderror"
                                                        id="dosen_penguji1" name="dosen_penguji1" required
                                                        value="{{ old('dosen_penguji1') }}" autocomplete="dosen_penguji1">
                                                        <option value="{{ $dosen_penguji1->nip }}">
                                                            {{ $dosen_penguji1->nama }} - {{ $dosen_penguji1->nip }}
                                                        </option>
                                                        @foreach ($dosens as $dosen)
                                                            <option value="{{ $dosen->nip }}">{{ $dosen->nama }} -
                                                                {{ $dosen->nip }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosen_penguji1')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="dosen_penguji2">Dosen Penguji II</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select
                                                        class="form-control  @error('dosen_penguji2') is-invalid @enderror"
                                                        id="dosen_penguji2" name="dosen_penguji2" required
                                                        value="{{ old('dosen_penguji2') }}" autocomplete="dosen_penguji2">
                                                        <option value="{{ $dosen_penguji2->nip }}">
                                                            {{ $dosen_penguji2->nama }} - {{ $dosen_penguji2->nip }}
                                                        </option>
                                                        @foreach ($dosens as $dosen)
                                                            <option value="{{ $dosen->nip }}">{{ $dosen->nama }} -
                                                                {{ $dosen->nip }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dosen_penguji2')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mt-2"></div>
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-primary"><i
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
