@extends('admin/layout')

@section('title')
    <title>Admin - Edit Data Dosen</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Dosen</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <br>
                            <!-- FORM UPDATE DOSEN -->
                            <form class="form form-horizontal" action="{{ route('update_dosen') }}" method="POST">
                                @csrf
                                <input type="hidden" name="old_nip" value="{{ $dosen->nip }}">
                                <input type="hidden" name="old_nidn" value="{{ $dosen->nidn }}">
                                <input type="hidden" name="old_kode" value="{{ $dosen->kode }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-6">
                                            <div class="row">
                                                @csrf
                                                <div class="col-md-4">
                                                    <label for="nama">Nama Lengkap</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" value="{{ $dosen->nama }}">
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_nip">NIP</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="new_nip"
                                                        class="form-control @error('new_nip') is-invalid @enderror"
                                                        name="new_nip" value="{{ $dosen->nip }}">
                                                    @error('new_nip')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_nidn">NIDN</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="new_nidn"
                                                        class="form-control @error('new_nidn') is-invalid @enderror"
                                                        name="new_nidn" value="{{ $dosen->nidn }}">
                                                    @error('new_nidn')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_kode">Kode</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="new_kode"
                                                        class="form-control @error('new_kode') is-invalid @enderror"
                                                        name="new_kode" value="{{ $dosen->kode }}">
                                                    @error('new_kode')
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
                                                            @if ($dosen->jenis_kelamin == 'laki-laki')
                                                                <option value="laki-laki">Laki-laki</option>
                                                                <option value="perempuan">Perempuan</option>
                                                            @else
                                                                <option value="perempuan">Perempuan</option>
                                                                <option value="laki-laki">Laki-laki</option>
                                                            @endif
                                                        </select>
                                                        @error('sex')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </fieldset>
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
                            <!-- END OF FORM UPDATE DOSEN -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    </div>
@endsection
