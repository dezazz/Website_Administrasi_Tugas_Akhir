@extends('admin/layout')

@section('title')
    <title>Admin - Input Nilai Uji Program</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Nilai Uji Program</h3>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <div class="table-responsive">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <i class="bi bi-check-circle"></i> {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif(session('prohibited'))
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <i class="bi bi-exclamation-triangle"></i> {{ session('prohibited') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-bordered mb-0">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama / NIM</th>
                                            <th>Nama/NIP</th>
                                            <th>Nilai Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mhs)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $mhs->nama }} ({{ $mhs->nim }})</td>
                                                <td>
                                                    @if ($mhs->nip != null)
                                                        {{ $mhs->nama_dsn }} ({{ $mhs->nip }})
                                                    @else
                                                        Doping I/II belum melakukan penilaian.
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mhs->total != null)
                                                        {{ $mhs->total }}
                                                    @else
                                                        <p>-</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                @if ($mhs->total != null)
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('adm_edit_nilai_uji_program') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mhs->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i></button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('adm_delete_nilai_uji_program') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mhs->nim }}">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#deleteModal{{ $mhs->nim }}"><i
                                                                                    class="bi bi-trash"></i></button>
                                                                            <div class="modal fade text-left"
                                                                                id="deleteModal{{ $mhs->nim }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="myModalLabel1"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header bg-danger">
                                                                                            <h5 class="modal-title white"
                                                                                                id="myModalLabel1">
                                                                                                Konfirmasi Hapus</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <i data-feather="x"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body text-center">
                                                                                            <p>Apakah Anda yakin ingin
                                                                                                menghapus data ini?</p>
                                                                                            <p>Data yang telah dihapus tidak
                                                                                                dapat dikembalikan.</p>
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
                                                                                onclick="return confirm('Yakin ingin menghapus? Anda tidak dapat mengembalikan data yang telah dihapus.')"><i
                                                                                    class="bi bi-trash"></i></button> --}}
                                                                        </form>
                                                                    </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>
                                                                    <form action="{{ route('adm_add_nilai_uji_program') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <input type="hidden" name="nim"
                                                                            value="{{ $mhs->nim }}">
                                                                        <button type="submit"
                                                                            class="btn btn-success btn-sm"><i
                                                                                class="bi bi-plus-square"></i>
                                                                            Daftar</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                        @endif
                                </table>
                                </center>
                                </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                </tbody>
                                </table><br><br><br>
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
