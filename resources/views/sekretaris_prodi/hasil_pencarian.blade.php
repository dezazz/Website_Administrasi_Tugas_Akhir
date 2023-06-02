@extends('sekretaris_prodi/layout')

@section('title')
    <title>Prodi - Mahasiswa Aktif</title>
@endsection

@include('sekretaris_prodi/sidebar')

@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Mahasiswa Aktif</h3>
                        <p class="text-subtitle text-muted">Daftar mahasiswa-mahasiswa aktif tingkat akhir.</p>
                    </div>
                </div>
            </div>
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
            {{-- <div class="row">
                <form action="/sekretaris/menu_mahasiswa/mahasiswa_aktif/search">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="keyword" placeholder="Cari mahasiswa ...">
                            </td>
                            <td>
                                <button class="btn btn-primary" type="submit"><i class="b bi-search"></i> </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div> --}}
            <!-- END FORM CARI MAHASISWA -->

            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h4>Hasil Pencarian</h4>
                            @if ($counter == 0)
                                <p><b>Tidak ada hasil pencarian yang sesuai.</b></p>
                            @else
                                <p><b>Jumlah hasil pencarian yang sesuai: {{ $counter }} mahasiswa</b></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-center">
                                        <thead>
                                            <tr class="table-success">
                                                <th>No.</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th width="400">Judul Skripsi</th>
                                                <th>Dosen Pembimbing I</th>
                                                <th>Dosen Pembimbing II</th>
                                                <th>Lembar Kendali Bimbingan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $result->nim }}</td>
                                                    <td class="text-bold-500">{{ $result->nama_mhs }}</td>
                                                    <td width="400">{{ $result->judul_skripsi }}</td>
                                                    <td>{{ $result->nama_dosbing1 }}</td>
                                                    <td>{{ $result->nama_dosbing2 }}</td>
                                                    <td>
                                                        <a href="/sekretaris/lembar_kendali/{{ $result->nim }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="bi bi-printer-fill"></i>&nbsp;Cetak</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                            @endif
                            <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif" class="btn btn-primary "><i
                                    class="fa fa-arrow-left"></i>&nbsp;&nbsp; Kembali</a>
                            <br>
                        </div>
                        <div class="d-felx justify-content-center">
                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>

@endsection
