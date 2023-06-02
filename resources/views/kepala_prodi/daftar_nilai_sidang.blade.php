@extends('admin/layout')

@section('title')
    <title>Kepala Prodi - Input Nilai Sidang Meja Hijau</title>
@endsection

@include('kepala_prodi/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Nilai Sidang Meja Hijau</h3>
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
                                    <thead class="text-center table-success">
                                        <tr>
                                            <th>No.</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th colspan="3">Nilai </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i; ?>
                                        <?php $j; ?>
                                        <?php $k = 1; ?>
                                        @for ($i = 0; $i <= count($mahasiswas) - 1; $i++)
                                            <tr class="text-center">
                                                <td>{{ $k }}</td>
                                                <td>{{ $mahasiswas[$i]->nim }}</td>
                                                <td class="text-bold-500">{{ $mahasiswas[$i]->nama }}
                                                </td>
                                                <td colspan="3">
                                                    @if ($mahasiswas[$i]->total != null)
                                                        <p>{{ $mahasiswas[$i]->nama_dsn }} : {{ $mahasiswas[$i]->total }}
                                                        </p>
                                                    @else
                                                        <center>
                                                            <p> <i>Mahasiswa Belum Memiliki Nilai !</i> </p>
                                                        </center>
                                                    @endif
                                                </td>
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                @if ($mahasiswas[$i]->total != null)
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('edit_nilai_sidang_kaprodi') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$i]->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm"><i
                                                                                    class="bi bi-pencil-square"></i></button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('delete_nilai_sidang_kaprodi') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$i]->nim }}">
                                                                            <input type="hidden" name="nip"
                                                                                value="{{ $mahasiswas[$i]->nip }}">
                                                                            {{-- window pop up delete konfirmasi  --}}
                                                                            <section class="bs-callout bs-callout-danger">
                                                                                <div class="modal fade text-left"
                                                                                    id="danger{{ $mahasiswas[$i]->nim }}"
                                                                                    tabindex="-1" role="dialog"
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
                                                                                                    Data</h5>
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
                                                                                                <p>Apakah anda yakin
                                                                                                    ingin menghapus
                                                                                                    data ini ?</p>
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
                                                                            {{-- end window pop up delete konfirmasi  --}}
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#danger{{ $mahasiswas[$i]->nim }}"><i
                                                                                    class="bi bi-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('add_nilai_sidang_kaprodi') }}"
                                                                            method="GET">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$i]->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="bi bi-plus-square"></i>
                                                                                Beri Nilai</button>
                                                                        </form>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('add_nilai_sidang_kaprodi') }}"
                                                                            method="GET">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$i]->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="bi bi-plus-square"></i>
                                                                                Beri Nilai</button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php $k++; ?>
                                        @endfor
                                    </tbody>
                                </table><br><br><br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
