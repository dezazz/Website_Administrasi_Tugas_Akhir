@extends('admin/layout')

@section('title')
    <title>Admin - Manajemen Kepala Laboratorium</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen User Kepala Laboratorium</h3>
                    <p class="text-subtitle text-muted">Manajemen Data Kepala Laboratorium</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Kepala Laboratorium</h5>
                            <a href="/admin/add_kepala_lab" class="btn btn-success btn-sm"><i
                                    class="bi bi-plus-circle"></i>&nbsp;&nbsp;Tambah Kepala Laboratorium</a>
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
                                <table class="table table-bordered mb-0">
                                    <thead class=" text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>NIDN</th>
                                            <th>Laboratorium</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($dosens as $dosen)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $dosen->nama }}</td>
                                                <td>{{ $dosen->nip }}</td>
                                                <td>{{ $dosen->nidn }}</td>
                                                <td>{{ $dosen->bidang_ilmu }}</td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <form action="/admin/edit_kepala_lab">
                                                                        @csrf
                                                                        <input type="hidden" name="nip"
                                                                            value="{{ $dosen->nip }}">
                                                                        <button type="submit"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="bi bi-pencil-square"></i>Edit</button>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ '/admin/delete_kepala_lab' }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="nip"
                                                                            value="{{ $dosen->nip }}">
                                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteModal{{ $i }}"><i
                                                                                class="bi bi-trash"></i>Hapus</button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade text-left"
                                                                            id="deleteModal{{ $i }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="myModalLabel1"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-danger">
                                                                                        <h5 class="modal-title white"
                                                                                            id="myModalLabel1">
                                                                                            Hapus Data Kepala Laboratorium
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <i data-feather="x"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div
                                                                                        class="modal-body
                                                                                        text-center">
                                                                                        <p>Apakah anda yakin ingin
                                                                                            menghapus data
                                                                                            kepala laboratorium
                                                                                            {{ $dosen->nama }}?</p>
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
                                </table><br>
                                <br>

                                <div class="d-felx justify-content-center">
                                    {{ $dosens->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
