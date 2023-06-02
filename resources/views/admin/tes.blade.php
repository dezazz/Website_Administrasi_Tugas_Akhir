@extends('admin/layout')

@section('title')
    <title>Admin - Dashboard</title>
@endsection

@include('admin/sidebar')


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
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama / NIM</th>
                                            <th colspan="3">Nilai </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i; ?>
                                        <?php $j; ?>
                                        <?php $k = 1; ?>
                                        @for ($i = 0; $i <= count($mahasiswas) - 1; $i++)
                                            <tr>
                                                <td>{{ $k }}</td>
                                                <td class="text-bold-500">{{ $mahasiswas[$i]->nama_mhs }}
                                                    ({{ $mahasiswas[$i]->nim }})</td>
                                                <td colspan="3">
                                                    @if ($mahasiswas[$i]->nama != null)
                                                        @for ($j = $i; $j < 4; $j++)
                                                            <p>{{ $mahasiswas[$j]->nama }} : {{ $mahasiswas[$j]->total }}
                                                            </p>
                                                        @endfor
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
                                                                            action="{{ route('edit_nilai_sidang_admin') }}">
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
                                                                            action="{{ route('delete_nilai_sidang_admin') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="nim"
                                                                                value="{{ $mahasiswas[$i]->nim }}">
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="return confirm('Yakin ingin menghapus? Anda tidak dapat mengembalikan data yang telah dihapus.')"><i
                                                                                    class="bi bi-trash"></i></button>
                                                                        </form>
                                                                    </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>
                                                                    <form action="{{ route('add_nilai_sidang_admin') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <input type="hidden" name="nim"
                                                                            value="{{ $mahasiswas[$i]->nim }}">
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
