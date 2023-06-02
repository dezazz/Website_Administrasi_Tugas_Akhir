@extends('admin/layout')

@section('title')
    <title>Admin - Dashboard</title>
@endsection

@include('admin/sidebar')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Nilai Sidang Meja Hijau</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENGEDITAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_upd_nilai_sidang_admin') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data[0]->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai Sidang Meja Hijau</h3>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Mahasiswa</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control" required
                                                    value="{{ $data[0]->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>NIM</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control" required
                                                    value="{{ $data[0]->nim }}" name="nim" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="tanggal">Tanggal Penilaian</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="date"
                                                    class="form-control @error('tanggal') is-invalid @enderror"
                                                    id="tanggal" name="tanggal" required value="{{ $data[0]->tanggal }}">
                                                @error('tanggal')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="waktu">Waktu</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="time"
                                                    class="form-control @error('waktu') is-invalid @enderror" id="waktu"
                                                    name="waktu" required value="{{ $data[0]->waktu }}">
                                                @error('waktu')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h6>Silakan input nilai sesuai dengan urutan komponen berikut:</h6>

                                        <!-- NILAI DOSEN 1 -->

                                        <div class="row">
                                            <p class="text-muted"> 1. Nilai 1: Sistematika penulisan (1-25)</p>

                                            <div class="col-md-2">
                                                <label style="font-weight: bold" for="n1">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n1"
                                                    class="form-control  @error('n1') is-invalid @enderror"
                                                    value="{{ $data[0]->n1 }}" name="n1" autocomplete="n1">
                                                @error('n1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 2. Nilai 2: Substansi (1-25) </p>

                                            <div class="col-md-2">
                                                <label style="font-weight: bold" for="n2">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n2"
                                                    class="form-control  @error('n2') is-invalid @enderror"
                                                    value="{{ $data[0]->n2 }}" name="n2" autocomplete="n2">
                                                @error('n2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 3. Nilai 3: Kemampuan menguasai substansi (1-25)</p>

                                            <div class="col-md-2">
                                                <label style="font-weight: bold" for="n3">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n3"
                                                    class="form-control  @error('n3') is-invalid @enderror"
                                                    value="{{ $data[0]->n3 }}" name="n3" autocomplete="n3">
                                                @error('n3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 4. Nilai 4: Kemampuan mengemukakan pendapat (1-25)</p>
                                            <div class="col-md-2">
                                                <label style="font-weight: bold" for="n4">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n4"
                                                    class="form-control  @error('n4') is-invalid @enderror"
                                                    value="{{ $data[0]->n4 }}" name="n4" autocomplete="n4">
                                                @error('n4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label style="font-weight: bold" for="nip">Pemberi Nilai</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control  @error('nip') is-invalid @enderror"
                                                    id="nip" name="nip" required value="{{ old('nip') }}"
                                                    autocomplete="nip">
                                                    <option value="{{ $data[0]->nip }}">{{ $data[0]->nama_dosen }}
                                                    </option>
                                                    <option value="{{ $data[0]->nip_dosbing1 }}">Dosen Pembimbing I -
                                                        {{ $data[0]->nama_dosbing1 }}</option>
                                                    <option value="{{ $data[0]->nip_dosbing2 }}">Dosen Pembimbing II -
                                                        {{ $data[0]->nama_dosbing2 }}</option>
                                                    <option value="{{ $data[0]->nip_dosen_penguji1 }}">Dosen Pembanding I
                                                        -
                                                        {{ $data[0]->nama_dosen_penguji1 }}</option>
                                                    <option value="{{ $data[0]->nip_dosen_penguji2 }}">Dosen Pembanding II
                                                        -
                                                        {{ $data[0]->nama_dosen_penguji2 }}</option>
                                                </select>
                                                @error('nip')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </form>
                            <!-- END FORM EDIT NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
