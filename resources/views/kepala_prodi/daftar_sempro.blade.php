@extends('kepala_prodi/layout')

@section('title')
    <title>Sekretaris Prodi - Daftar Jadwal Seminar Proposal</title>
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
                        <h3>Daftar Peserta dan Undangan Seminar Proposal</h3>
                        <p class="text-subtitle text-muted">Berikut Data Jadwal Seminar Proposal</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <?php $i; ?>
            @foreach ($tanggal as $dt)
                <div class="card ">
                    <div class="card-body">
                        <h5>{{ Carbon::parse($dt->tanggal_sempro)->translatedFormat('l, d F Y') }}</h5>

                        <a href="/kepala_prodi/undangan_daftar_peserta/undangan_seminar_proposal/{{ $dt->tanggal_sempro }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Undangan</button></a>
                        &nbsp; &nbsp;
                        <a href="/kepala_prodi/undangan_daftar_peserta/peserta_seminar_proposal/{{ $dt->tanggal_sempro }}"
                            target="blank"><button type="button" class="btn btn-success"><i
                                    class="bi bi-printer-fill"></i>&nbsp;Cetak Daftar Peserta</button></a>
                        <h5 class="mt-3 text-center">Daftar Mahasiswa Peserta Seminar Proposal</h5>
                        <table class="table mt-3" id="table1">
                            <thead class="table-success">
                                <tr class="text-center">
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th width="350">Judul Skripsi</th>
                                    <th>Dosen Pembimbing I</th>
                                    <th>Dosen Pembimbing II</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($query as $mhs)
                                    @for ($i = 0; $i <= count($nim) - 1; $i += 2)
                                        @if ($nim[$i]->nim == $mhs->nim && $nim[$i]->tanggal_sempro == $dt->tanggal_sempro)
                                            <tr class="text-center">
                                                <td>{{ $mhs->nim }}</td>
                                                <td>{{ $mhs->nama_mhs }}</td>
                                                <td width="350">{{ $nim[$i]->judul_skripsi }}</td>
                                                <td>{{ $mhs->nama_dosbing1 }} <br>Nip. {{ $mhs->nip_dosbing1 }}</td>
                                                <td>{{ $mhs->nama_dosbing2 }} <br>Nip. {{ $mhs->nip_dosbing2 }}</td>
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
