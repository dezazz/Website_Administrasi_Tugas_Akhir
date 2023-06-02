@extends('sekretaris_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Daftar Jadwal Sidang Meja Hijau</title>
@endsection

@include('sekretaris_prodi/sidebar')
<?php
use Carbon\Carbon;
$index = 1;
?>
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
                    <div class="col-md-12 order-md-1 order-last">
                        <h3>Undangan dan Daftar Peserta Sidang Meja Hijau</h3>
                        <p class="text-subtitle text-muted">Data Jadwal Sidang Meja Hijau</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <?php $i; ?>
            @foreach ($tanggal as $dt)
                <div class="card">
                    <div class="card-body">
                        <h5>{{ Carbon::parse($dt->tanggal_sidang)->translatedFormat('l, d F Y') }}</h5>
                        <a href="/sekretaris_prodi/undangan_daftar_peserta/undangan_sidang_meja_hijau/{{ $dt->tanggal_sidang }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Undangan</button></a>
                        &nbsp;&nbsp;
                        <a href="/sekretaris_prodi/undangan_daftar_peserta/peserta_sidang_meja_hijau/{{ $dt->tanggal_sidang }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Daftar Peserta</button></a>
                        <h5 class="text-center mt-2">Daftar Mahasiswa Peserta Sidang Meja Hijau </h5>
                        <table class="table mt-1" id="table1">
                            <thead>
                                <tr class="table-success text-center">
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul Skripsi</th>
                                    <th style="text-align: left">Dosen Pembimbing</th>
                                    <th style="text-align: left">Dosen Penguji</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($query as $mhs)
                                    @for ($i = 0; $i <= count($nim) - 1; $i += 2)
                                        @if ($nim[$i]->nim == $mhs->nim && $nim[$i]->tanggal_sidang == $dt->tanggal_sidang)
                                            <tr class="text-center">
                                                <td>{{ $mhs->nim }}</td>
                                                <td>{{ $mhs->nama_mhs }}</td>
                                                <td width="350">{{ $nim[$i]->judul_skripsi }}</td>
                                                <td style="text-align: left" class="text-right">1. {{ $mhs->nama_dosbing1 }}
                                                    <br>
                                                    2. {{ $mhs->nama_dosbing2 }}
                                                </td>
                                                <td style="text-align: left" class="text-right">1.
                                                    {{ $mhs->nama_dosen_penguji1 }} <br>
                                                    2. {{ $mhs->nama_dosen_penguji2 }}</td>
                                            </tr>
                                        @endif
                                    @endfor
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endforeach
        </section>
        <!-- Basic Tables end -->
    </div>

    </div>
    </div>
@endsection
