@extends('admin/layout')

@section('title')
    <title>Admin - Profil</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profil</h3>
                    {{-- <p class="text-subtitle text-muted">Data Anda sebagai admin.</p> --}}
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="card card-outline-secondary">
                            <center>
                                {{-- <img class="card-img-top img-fluid" src="../assets/images/staff.jpg" alt="lecturer_image"
                                    style="height: 500px;" />
                                <br><br><br> --}}
                                <div class="col-xl-6 mb-6">
                                    <div class="table-responsive">
                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible show fade">
                                                <i class="bi bi-check-circle"></i> {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('prohibited'))
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                <i class="bi bi-exclamation-triangle"></i> {{ session('prohibited') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </center>
                            <div class="row align-items-center m-5">
                                <div class="col-md mb-5">
                                    <!-- FORM EDIT PROFILE -->
                                    <form class="form form-horizontal" method="post"
                                        action="{{ route('store_new_admin') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="old_email" value="{{ Auth::user()->email }}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nama">ID Administrator</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="id" class="form-control"
                                                        value="{{ Auth::user()->id }}" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nama">Nama</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="text" id="nama" class="form-control" name="nama"
                                                        value="{{ Auth::user()->admin->nama }}">
                                                    @error('nama')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="new_email">Email</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="email" id="new_email" class="form-control"
                                                        name="new_email" value="{{ Auth::user()->email }}">
                                                    @error('new_email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <br><br>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8">

                                                    <table>
                                                        <td>
                                                            <a href="/admin/dashboard" class="btn btn-success"><i
                                                                    class="fa fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan
                                                                Perubahan</button><br>
                                                        </td>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM EDIT PROFILE -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
