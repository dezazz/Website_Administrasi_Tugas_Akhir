@extends('admin/layout')

@section('title')
    <title>Admin - Edit Data Admin</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Administrator</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-5">
                            <br>
                            <!-- FORM EDIT ADMIN -->
                            <form class="form form-horizontal" action="{{ route('update_admin') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-6">
                                            <div class="row">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                                <div class="col-md-4">
                                                    <label for="nama">Nama Lengkap</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" value="{{ $admin->nama }}">
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <fieldset class="form-group">
                                                        <select class="form-select @error('status') is-invalid @enderror"
                                                            id="basicSelect" name="status">
                                                            @if ($admin->status == 'admin')
                                                                <option value="admin">Admin</option>
                                                                <option value="super admin">Super Admin</option>
                                                            @else
                                                                <option value="super admin">Super admin</option>
                                                                <option value="admin">Admin</option>
                                                            @endif
                                                        </select>
                                                        @error('status')
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
                            <!-- END OF FORM EDIT ADMIN -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
