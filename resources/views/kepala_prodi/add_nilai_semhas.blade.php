@extends('admin/layout')

@section('title')
    <title>Kepala Prodi - Input Nilai Seminar Hasil</title>
@endsection

@include('kepala_prodi/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Input Nilai Seminar Hasil</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENDATAAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_nilai_semhas_kaprodi') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai Seminar Hasil mahasiswa</h3>
                                        <div class="col-md-3">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nama }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label>NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nim }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tanggal">Tanggal Penilaian</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                                name="tanggal" required value="{{ old('tanggal') }}">
                                            @error('tanggal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" class="form-control @error('time') is-invalid @enderror"
                                                id="waktu" name="waktu" required value="{{ old('waktu') }}">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                        <h6>Silakan input nilai sesuai dengan urutan komponen berikut:</h6>
                                        <p class="text-muted"><i>Semua Kolom nilai wajib diisi</i></p>

                                    </div>
                                    <!-- NILAI DOSEN 1 -->
                                    <br><br>
                                </div>

                                <div class="row">
                                    <p class="text-muted"> 1. Nilai 1: Abstrak (0-3)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n1">Nilai 1</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n1"
                                            class="form-control  @error('n1') is-invalid @enderror" name="n1"
                                            autocomplete="n1">
                                        @error('n1')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 2. Nilai 2: Bab I: Pendahuluan (0-10)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n2">Nilai 2</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n2"
                                            class="form-control  @error('n2') is-invalid @enderror" name="n2"
                                            autocomplete="n2">
                                        @error('n2')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 3. Nilai 3: Bab II: Landasan Teori (0-15)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n3">Nilai 3</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n3"
                                            class="form-control  @error('n3') is-invalid @enderror" name="n3"
                                            autocomplete="n3">
                                        @error('n3')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 4. Nilai 4: Bab III: Metodologi (0-25)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n4">Nilai 4</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n4"
                                            class="form-control  @error('n4') is-invalid @enderror" name="n4"
                                            autocomplete="n4">
                                        @error('n4')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 5. Nilai 5: Bab IV: Implementasi (0-35)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n5">Nilai 5</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n5"
                                            class="form-control  @error('n5') is-invalid @enderror" name="n5"
                                            autocomplete="n5">
                                        @error('n5')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 6. Nilai 6: Bab V: Kesimpulan (0-2)</p>

                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n6">Nilai 6</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n6"
                                            class="form-control  @error('n6') is-invalid @enderror" name="n6"
                                            autocomplete="n6">
                                        @error('n6')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="text-muted"> 7. Nilai 7: Kemampuan mengemukakan substansi dan pendapat dan
                                        sikap (0-10)</p>
                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="n7">Nilai 7</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="n7"
                                            class="form-control  @error('n7') is-invalid @enderror" name="n7"
                                            autocomplete="n7">
                                        @error('n7')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label style="font-weight: bold" for="nip">Pemberi Nilai</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- select option --}}
                                        <select class="form-control  @error('nip') is-invalid @enderror" id="nip"
                                            required name="nip" autocomplete="nip">
                                            <option value=""></option>
                                            <option value="{{ $data->nip_dosbing1 }}">Dosen Pembimbing I -
                                                {{ $data->nama_dosbing1 }}</option>
                                            <option value="{{ $data->nip_dosbing2 }}">Dosen Pembimbing II -
                                                {{ $data->nama_dosbing2 }}</option>
                                            <option value="{{ $data->nip_dosen_penguji1 }}">Dosen Pembanding I -
                                                {{ $data->nama_dosen_penguji1 }}</option>
                                            <option value="{{ $data->nip_dosen_penguji2 }}">Dosen Pembanding II -
                                                {{ $data->nama_dosen_penguji2 }}</option>
                                        </select>
                                        {{-- <select class="form-control  @error('nip') is-invalid @enderror" id="nip"
                                            required name="nip" value="{{ old('nip') }}" autocomplete="nip">
                                            <option value=""></option>
                                            <option value="{{ $data->nip_dosbing1 }}">Dosen Pembimbing I -
                                                {{ $data->nama_dosbing1 }}</option>
                                            <option value="{{ $data->nip_dosbing2 }}">Dosen Pembimbing II -
                                                {{ $data->nama_dosbing2 }}</option>
                                            <option value="{{ $data->nip_dosen_penguji1 }}">Dosen Pembanding I -
                                                {{ $data->nama_dosen_penguji1 }}</option>
                                            <option value="{{ $data->nip_dosen_penguji2 }}">Dosen Pembanding II -
                                                {{ $data->nama_dosen_penguji2 }}</option>
                                        </select> --}}
                                    </div>
                                    @error('nip')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-1">
                                        <label for="total1">Total</label>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <input type="text" id="total1"
                                            class="form-control  @error('total1') is-invalid @enderror" name="total1"
                                            required autocomplete="total1">
                                        @error('total1')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <!-- END NILAI DOSEN 1 -->

                                <center>

                                </center>
                            </form>
                        </div>
                        <!-- END FORM NILAI -->
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
