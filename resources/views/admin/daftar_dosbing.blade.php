@extends('admin/layout')

@section('title')
    <title>Admin - Pendaftaran Doping</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pra Seminar Proposal</h3>
                    <p class="text-subtitle text-muted">Daftar Dosen Pembimbing</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-3">
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
                                            <th>Nama / NIP Doping I</th>
                                            <th>Nama / NIP Doping II</th>
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
                                                    @if ($mhs->nip_dosbing1 != null)
                                                        {{ $mhs->nama_dosbing1 }} ({{ $mhs->nip_dosbing1 }})
                                                    @else
                                                        <p><i>Belum didaftarkan.</i></p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($mhs->nip_dosbing2 != null)
                                                        {{ $mhs->nama_dosbing2 }} ({{ $mhs->nip_dosbing2 }})
                                                    @else
                                                        <p><i>Belum didaftarkan</i></p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            @if ($mhs->nip_dosbing1 != null && $mhs->nip_dosbing2 != null)
                                                                <tr>
                                                                    <td>
                                                                        <form action="{{ route('edit_dosbing') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mhs->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mhs->nama }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i></button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('delete_dosbing') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mhs->nim }}">
                                                                            {{-- pop up delete konfirmasi delete --}}

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
                                                                        <form action="{{ route('add_dosbing') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mhs->nim }}">
                                                                            <input type="hidden" name="nama"
                                                                                value="{{ $mhs->nama }}">
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
