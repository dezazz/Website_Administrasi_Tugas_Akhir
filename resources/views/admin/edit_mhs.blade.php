@extends('admin/layout')

@section('title')
    <title>Admin - Edit Mahasiswa</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Mahasiswa</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <br>
                            <!-- FORM UPDATE MHS -->
                            <form class="form form-horizontal" action="{{ route('update_mhs') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-6">
                                            <!-- DISPLAY FAULT PHOTO OR USER'S UPLOADED PHOTO -->
                                            <center>
                                                @if ($mhs->foto != null)
                                                    <img class="img-fluid" src="../main/photos/{{ $mhs->foto }}"
                                                        alt="Card image cap" style="width:200px;height:200px">
                                                @else
                                                    <img class="img-fluid" src="../main/assets/images/1.jpg"
                                                        alt="Card image cap" style="width:200px;height:200px">
                                                @endif
                                            </center>
                                            <!-- END OF PHOTO DISPLAY -->
                                            <br><br><br>
                                            <div class="row">
                                                @csrf
                                                <input type="hidden" name="old_nim" value="{{ $mhs->nim }}">
                                                <input type="hidden" name="old_foto" value="{{ $mhs->foto }}">
                                                <br><br>
                                                <div class="col-md-4">
                                                    @if ($mhs->foto != null)
                                                        <label for="foto">Ubah Foto Mahasiswa</label>
                                                    @else
                                                        <label for="foto">Tambahkan Foto Mahasiswa</label>
                                                    @endif
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="file" id="foto" class="form-control"
                                                        name="foto">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nama">Nama Lengkap</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" value="{{ $mhs->nama }}">
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_nim">NIM</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="new_nim"
                                                        class="form-control @error('nim') is-invalid @enderror"
                                                        name="new_nim" value="{{ $mhs->nim }}">
                                                    @error('new_nim')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="angkatan">Angkatan</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="angkatan"
                                                        class="form-control @error('angkatan') is-invalid @enderror"
                                                        name="angkatan" value="{{ $mhs->angkatan }}">
                                                    @error('angkatan')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Jenis Kelamin</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="form-select @error('sex') is-invalid @enderror"
                                                            id="basicSelect" name="sex">
                                                            @if ($mhs->jenis_kelamin == 'Laki-laki')
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            @else
                                                                <option value="Perempuan">Perempuan</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                            @endif
                                                        </select>
                                                        @error('sex')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Status Mahasiswa</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect" name="status">
                                                            @if ($mhs->status == 'Aktif')
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Lulus">Lulus</option>
                                                                <option value="Drop out">Drop Out</option>
                                                            @elseif($mhs->status == 'Lulus')
                                                                <option value="Lulus">Lulus</option>
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Drop out">Drop Out</option>
                                                            @else
                                                                <option value="Drop out">Drop Out</option>
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Lulus">Lulus</option>
                                                            @endif
                                                        </select>
                                                    </fieldset><br>
                                                </div>
                                            </div>
                                            <div class="col=xl-8">
                                                <center><button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END OF FORM UPDATE MHS -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
