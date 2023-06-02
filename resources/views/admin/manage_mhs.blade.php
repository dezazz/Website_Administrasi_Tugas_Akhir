@extends('admin/layout')

@section('title')
    <title>Admin - Manajemen Mahasiswa</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen User Mahasiswa</h3>
                    <p class="text-subtitle text-muted">Manajemen User untuk Mahasiswa Tahap Akhir</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5></br>
                            <a href="/admin/add_mhs" class="btn btn-success btn-sm "><i
                                    class="bi bi-plus-circle"></i>&nbsp;&nbsp;Tambah Mahasiswa</a>
                            <br><br>
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
                                <table class="table table-bordered mb-0 text-center">
                                    <thead>
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $mahasiswa->nama }}</td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td>{{ $mahasiswa->status }}</td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <form action="/admin/edit_mhs">
                                                                        @csrf
                                                                        <input type="hidden" name="nim"
                                                                            value="{{ $mahasiswa->nim }}">
                                                                        <button type="submit"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="bi bi-pencil-square"></i>&nbsp;&nbsp;Edit</button>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ '/admin/delete_mhs' }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="old_foto"
                                                                            value="{{ $mahasiswa->foto }}">
                                                                        <input type="hidden" name="nim"
                                                                            value="{{ $mahasiswa->nim }}">
                                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini? Anda tidak akan dapat mengembalikan data yang telah dihapus.')"><i
                                                                                class="bi bi-trash"></i>&nbsp;&nbsp;Hapus</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $mahasiswas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
