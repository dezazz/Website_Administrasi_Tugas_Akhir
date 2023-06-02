@extends('admin/layout')

@section('title')
    <title>Admin - Manajemen Administrator</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen User Admin</h3>
                    <p class="text-subtitle text-muted">Manajemen User untuk Pegawai & Staff</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-xl-12 mb-6">
                            <!-- DAFTAR ADMIN    -->
                            <h5>Daftar Admin</h5>
                            @if (Auth::user()->admin->status == 'super admin')
                                <a href="/admin/add_admin" class="btn btn-success btn-sm"><i
                                        class="bi bi-plus-circle"></i>&nbsp;&nbsp;Tambah Admin</a>
                            @endif
                            <br><br>
                            <div class="table-responsive">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <i class="bi bi-check-circle"></i> {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-bordered mb-0 text-center">
                                    <thead>
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $admin->nama }}</td>
                                                <td>{{ $admin->status }}</td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                @if (Auth::user()->admin->status == 'super admin' || Auth::user()->id == $admin->id_user)
                                                                    <td>
                                                                        <form action="/admin/edit_admin">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $admin->id }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i>&nbsp;&nbsp;Edit</button>
                                                                        </form>
                                                                    </td>
                                                                @else
                                                                    <p>Anda tidak memiliki akses mengupdate atau menghapus
                                                                        data ini.</p><br>
                                                                @endif
                                                                <td>
                                                                    @if (Auth::user()->admin->status == 'super admin')
                                                                        @if (Auth::user()->admin->id !== $admin->id && $admin->status !== 'super admin')
                                                                            <form action="{{ '/admin/delete_adm' }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $admin->id_user }}">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#deleteModal{{ $admin->id }}"><i
                                                                                        class="bi bi-trash"></i>&nbsp;&nbsp;Hapus</button>
                                                                                <!-- Modal -->
                                                                                <div class="modal fade text-left"
                                                                                    id="deleteModal{{ $admin->id }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="myModalLabel1"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div
                                                                                                class="modal-header bg-danger">
                                                                                                <h5 class="modal-title white"
                                                                                                    id="myModalLabel1">
                                                                                                    Konfirmasi Hapus Data
                                                                                                    Admin</h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <i data-feather="x"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <p>Apakah Anda yakin ingin
                                                                                                    menghapus data admin
                                                                                                    ini? Anda tidak akan
                                                                                                    dapat mengembalikan
                                                                                                    data yang telah
                                                                                                    dihapus.</p>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-light-secondary"
                                                                                                    data-bs-dismiss="modal">
                                                                                                    <i
                                                                                                        class="bx bx-x d-block d-sm-none"></i>
                                                                                                    <span
                                                                                                        class="d-none d-sm-block">Batal</span>
                                                                                                </button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger ml-1">
                                                                                                    <i
                                                                                                        class="bx bx-check d-block d-sm-none"></i>
                                                                                                    <span
                                                                                                        class="d-none d-sm-block">Hapus</span>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                {{-- <button type="submit"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data admin ini? Anda tidak akan dapat mengembalikan data yang telah dihapus.')"><i
                                                                                        class="bi bi-trash"></i>&nbsp;&nbsp;Hapus</button> --}}
                                                                            </form>
                                                                        @endif
                                                                </td>
                                        @endif
                                        </tr>
                                </table>
                                </center>
                                </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                </tbody>
                                </table><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $admins->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
