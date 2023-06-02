@extends('admin/layout')

@section('title')
    <title>Admin - Tambahkan Akun</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Akun</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- REGISTERATION FORM PRODI -->
                            <form class="form form-horizontal" method="POST" action="{{ route('store_prodi') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <!-- DATA AKUN -->
                                        <h3>1. Data User </h3>
                                        <div class="row ms-3">

                                            <div class="col-md-3">
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="username"
                                                    class="form-control  @error('username') is-invalid @enderror"
                                                    name="username" value="{{ old('username') }}" autocomplete="name">
                                                @error('username')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" autocomplete="email">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="pw">Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="pw"
                                                    class="form-control @error('pw') is-invalid @enderror" name="pw"
                                                    value="{{ old('pw') }}" autocomplete="pw">
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> <br>
                                        <hr><br>
                                        <!-- END DATA AKUN -->

                                        <!-- DATA PRIBADI ADMIN -->
                                        <h3>2. Data Diri</h3>
                                        <div class="row ms-3">
                                            <div class="col-md-3">
                                                <label for="nama">Nama Lengkap</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama"
                                                    class="form-control  @error('nama') is-invalid @enderror" name="nama"
                                                    required value="{{ old('nama') }}" autocomplete="nama">
                                                @error('nama')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="nip">NIP</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nip"
                                                    class="form-control  @error('nip') is-invalid @enderror" name="nip"
                                                    required value="{{ old('nip') }}" autocomplete="nip">
                                                @error('nip')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-md-3">
                                                <label for="nidn">NIDN</label>
                                            </div> 
                                            <div class="col-md-8 form-group">
                                                <input type="hidden" id="nidn"
                                                    class="form-control  @error('nidn') is-invalid @enderror" name="nidn"
                                                    required value="{{ old('nidn') }}" autocomplete="nidn">
                                                @error('nidn')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="kode">Kode Dosen</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="kode"
                                                    class="form-control  @error('kode') is-invalid @enderror" name="kode"
                                                    required value="{{ old('kode') }}" autocomplete="kode">
                                                @error('kode')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-md-3">
                                                <label for="sex">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control  @error('sex') is-invalid @enderror"
                                                    id="sex" name="sex" required value="{{ old('sex') }}"
                                                    autocomplete="sex">
                                                    <option value=""></option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                @error('sex')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row ms-3">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3 mt-2">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                            </div>
                                        </div>
                                        <!-- END DATA PRIBADI PRODI -->
                                    </div>
                                </div>
                            </form>
                            <!-- END REGISTERATION FORM DOSEN -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
