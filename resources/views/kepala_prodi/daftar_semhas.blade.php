@extends('kepala_prodi/layout')

@section('title')
    <title>Kepala Prodi - Undangan dan Daftar Peserta Seminar Hasil</title>
@endsection

@include('kepala_prodi/sidebar')

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
                        <h3>Undangan dan Daftar Peserta Seminar Hasil</h3>
                        <p class="text-subtitle text-muted">Berikut Data Jadwal Seminar Hasil mahasiswa.</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <?php $i; ?>
            @foreach ($tanggal as $dt)
                <div class="card">
                    <div class="card-body">
                        <h5>{{ Carbon::parse($dt->tanggal_semhas)->translatedFormat('l, d F Y') }}</h5>

                        <a href="/kepala_prodi/undangan_daftar_peserta/undangan_seminar_hasil/{{ $dt->tanggal_semhas }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Undangan</button></a>
                        &nbsp;&nbsp;
                        <a href="/kepala_prodi/undangan_daftar_peserta/peserta_seminar_hasil/{{ $dt->tanggal_semhas }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Daftar Peserta</button></a>
                        <h5 class="mt-3 text-center">Daftar Mahasiswa Peserta Seminar Hasil</h5>
                        <table class="table mt-3" id="table1">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th width="350">Judul Skripsi</th>
                                    <th style="text-align: left">Dosen Pembimbing</th>
                                    <th style="text-align: left">Dosen Penguji</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($query as $mhs)
                                    @for ($i = 0; $i <= count($nim) - 1; $i += 2)
                                        @if ($nim[$i]->nim == $mhs->nim && $nim[$i]->tanggal_semhas == $dt->tanggal_semhas)
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
