@extends('admin/layout')

@section('title')
    <title>Admin - Edit Nilai IPK</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Nilai IPK</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENGEDITAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('adm_store_upd_nilai_IPK') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai IPK Mahasiswa</h3> <br>
                                        <div class="col-md-4">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nama }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data->nim }}"
                                                disabled>
                                        </div><br><br><br>
                                        <div class="col-md-4">
                                            <label for="IPK">Nilai IPK</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="IPK"
                                                class="form-control  @error('IPK') is-invalid @enderror" name="IPK"
                                                value="{{ $data->IPK }}" required autocomplete="IPK">
                                            @error('IPK')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div><br><br><br>
                                        <center>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </center>
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
