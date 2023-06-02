@extends('admin/layout')

@section('title')
    <title>Pendaftaran Dosen Penguji</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pra Seminar Hasil</h3>
                    <p class="text-subtitle text-muted">Menu seminar hasil</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa dan Dosen Penguji</h5></br>
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
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama / NIM</th>
                                            <th>Nama / NIP Dosen Penguji I</th>
                                            <th>Nama / NIP Dosen Penguji II</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $j; ?>
                                        <?php $i = 1; ?>
                                        @for ($j = 0; $j <= count($mahasiswas) - 1; $j++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $mahasiswas[$j]->nama }}
                                                    ({{ $mahasiswas[$j]->nim }})</td>
                                                <td>
                                                    @if ($mahasiswas[$j]->nip_dosen_penguji1 != null)
                                                        {{ $mahasiswas[$j]->nama_dosen_penguji1 }} -
                                                        {{ $mahasiswas[$j]->nip_dosen_penguji1 }}
                                                    @else
                                                        <p>Belum didaftarkan.</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mahasiswas[$j]->nip_dosen_penguji2 != null)
                                                        {{ $mahasiswas[$j]->nama_dosen_penguji2 }} -
                                                        {{ $mahasiswas[$j]->nip_dosen_penguji2 }}
                                                    @else
                                                        <p>Belum didaftarkan</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            @if ($mahasiswas[$j]->nip_dosen_penguji1 != null && $mahasiswas[$j]->nip_dosen_penguji2 != null)
                                                                <tr>
                                                                    <td>
                                                                        <form action="{{ route('edit_dosen_penguji') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$j]->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswas[$j]->nama }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i></button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('delete_dosen_penguji') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$j]->nim }}">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#danger"><i
                                                                                    class="bi bi-trash"></i></button>

                                                                            <section class="section">
                                                                                <div class="modal fade text-left"
                                                                                    id="danger" tabindex="-1"
                                                                                    role="dialog"
                                                                                    aria-labelledby="myModalLabel120"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div
                                                                                                class="modal-header bg-danger">
                                                                                                <h5 class="modal-title white"
                                                                                                    id="myModalLabel120">
                                                                                                    Konfirmasi Hapus
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <i data-feather="x"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <p>Apakah anda yakin
                                                                                                    ingin menghapus
                                                                                                    data?</p>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-light-secondary"
                                                                                                    data-bs-dismiss="modal">
                                                                                                    <i
                                                                                                        class="bx bx-x d-block d-sm-none"></i>
                                                                                                    <span
                                                                                                        class="d-none d-sm-block">Tidak</span>
                                                                                                </button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger ml-1">
                                                                                                    <i
                                                                                                        class="bx bx-check d-block d-sm-none"></i>
                                                                                                    <span
                                                                                                        class="d-none d-sm-block">Ya</span>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>

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
                                                                        <form action="{{ route('add_dosen_penguji') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$j]->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mahasiswas[$j]->nama }}">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="bi bi-plus-square"></i>
                                                                                Daftarkan</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endfor
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
