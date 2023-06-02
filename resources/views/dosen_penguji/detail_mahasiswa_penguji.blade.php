@extends('dosen.layout')

@section('title')
    <title>Dosen Penguji - Detail Mahasiswa</title>
@endsection

@include('dosen_penguji/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Mahasiswa</h3>
                    <p class="text-subtitle text-muted">Berikut Data Detail Mahasiswa.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($query as $item)
                            @if ($i == 0)
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{ $item->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Skripsi</td>
                                    <td>{{ $item->judul_skripsi }}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>{{ $item->angkatan }}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing <?= $i + 1 ?></td>
                                    <td>{{ $item->dosen_pembimbing }}</td>
                                </tr>
                            @endif
                            <?php $i++; ?>
                            @if ($i == 2)
                                <tr>
                                    <td>Dosen Pembimbing <?= $i ?></td>
                                    <td>{{ $item->dosen_pembimbing }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{-- tombol kembali --}}
                <a href="/penguji/daftar_mahasiswa_penguji"><button type="button" class="btn btn-primary"><i
                            class="bi bi-arrow-left"></i>&nbsp;Kembali</button></a>
            </div>
        </div>

    </section>
@endsection
