@extends('dosen/layout')

@section('title')
    <title>Dosen Penguji - Penilaian</title>
@endsection

@include('dosen_penguji/sidebar')


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
                            {{-- alert success_nilai_semhas --}}
                            @if (session('success_nilai_semhas'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success_nilai_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- alert error_nilai_semhas --}}
                            @if (session('error_nilai_semhas'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error_nilai_semhas') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- FORM PENDATAAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_nilai_semhas_penguji') }}"
                                method="POST">
                                @csrf
                                {{-- <input type="hidden" name="nim" value="{{ $data->nim }}"> --}}
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai Seminar Hasil</h3>
                                        {{-- select pilihan nama mahasiswa from tabel mahasiswa --}}
                                        <div class="col-md-4">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select" name="nim" id="nim" required>
                                                <option value="" selected disabled>Pilih Mahasiswa</option>
                                                @foreach ($mahasiswa as $mhs)
                                                    <option value="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" class="form-control @error('time') is-invalid @enderror"
                                                id="waktu" name="waktu" required value="{{ old('waktu') }}">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br><br><br><br>
                                        <h6>Silakan input nilai sesuai dengan urutan komponen berikut:</h6>
                                        <i class="text-sm text-muted">Semua kolom nilai Wajib Diisi</i><br>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <p class="text-muted"> 1. Nilai 1: Abstrak (0-3)<br> </p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n1">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n1"
                                                    class="form-control  @error('n1') is-invalid @enderror" name="n1"
                                                    autocomplete="n1">
                                                @error('n1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted">2. Nilai 2: Bab I: Pendahuluan (0-10) <br> </p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n2">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n2"
                                                    class="form-control  @error('n2') is-invalid @enderror" name="n2"
                                                    autocomplete="n2">
                                                @error('n2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 3. Nilai 3: Bab II: Landasan Teori (0-15) <br></p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n3">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n3"
                                                    class="form-control  @error('n3') is-invalid @enderror" name="n3"
                                                    autocomplete="n3">
                                                @error('n3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted">4. Nilai 4: Bab III: Metodologi (0-25) <br> </p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n4">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n4"
                                                    class="form-control  @error('n4') is-invalid @enderror" name="n4"
                                                    autocomplete="n4">
                                                @error('n4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted">5. Nilai 5: Bab IV: Implementasi (0-35)<br> </p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n5">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n5"
                                                    class="form-control  @error('n5') is-invalid @enderror" name="n5"
                                                    autocomplete="n5">
                                                @error('n5')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted">6. Nilai 6: Bab V: Kesimpulan (0-2)<br> </p>

                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n6">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n6"
                                                    class="form-control  @error('n6') is-invalid @enderror" name="n6"
                                                    autocomplete="n6">
                                                @error('n6')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted"> 7. Nilai 7: Kemampuan mengemukakan substansi dan
                                                pendapat dan sikap
                                                (0-10) </p>
                                            <div class="col-md-1">
                                                <label style="font-weight: bold" for="n7">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="number" id="n7"
                                                    class="form-control  @error('n7') is-invalid @enderror" name="n7"
                                                    autocomplete="n7">
                                                @error('n7')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END NILAI DOSEN 1 -->
                                    <br>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                </div>
                            </form>
                            <!-- END FORM NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
