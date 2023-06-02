@extends('admin/layout')

@section('title')
    <title>Admin - Tambahkan Admini</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Admin</h3>
                    <p class="text-subtitle text-muted">Tambahkan admninistrator baru</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM REGISTERATION OF ADMIN -->
                            <form class="form form-horizontal" action="{{ route('add_admin') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <!-- DATA AKUN -->
                                        <h3>1. Data Akun Administrator</h3>
                                        <div class="col-md-4">
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

                                        <div class="col-md-4">
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

                                        <div class="col-md-4">
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
                                        <br>
                                        <hr><br>
                                        <!-- END DATA AKUN -->

                                        <!-- DATA PRIBADI ADMIN -->
                                        <h3>2. Data Pribadi</h3>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <label for="sex">Status</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control  @error('status') is-invalid @enderror"
                                                id="sex" name="status" required value="{{ old('status') }}"
                                                autocomplete="status">
                                                <option value=""></option>
                                                <option value="admin">Admin</option>
                                                <option value="super admin">Super Admin</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 mt-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </div>

                                        <!-- END DATA PRIBADI ADMIN -->

                                        <br><br><br>
                                        <center>

                                        </center>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM REGISTERATION -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
