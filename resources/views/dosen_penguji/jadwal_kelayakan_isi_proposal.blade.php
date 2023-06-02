@extends('dosen.layout')

@section('title')
    <title>Dosen Penguji - Jadwal Uji Kelayakan Seminar Proposal</title>
@endsection

@include('dosen_penguji/sidebar')

@section('content')
    <?php use Carbon\Carbon; ?>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Jadwal Uji Kelayakan Seminar Proposal</h3>
                    <p class="text-subtitle text-muted">Berikut Jadwal Uji Kelayakan Seminar Proposal yang akan Anda ikuti.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Judul Skripsi</th>
                            <th>Hari/Tanggal</th>
                            <th>Pukul</th>
                            <th>Tempat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($query as $qr)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $qr->nama }}</td>
                                <td>{{ $qr->nim }}</td>
                                <td>{{ $qr->judul_skripsi }}</td>
                                <td>{{ Carbon::parse($qr->tanggal)->translatedFormat('l , d F Y') }}</td>
                                <td>{{ Carbon::createFromFormat('H:i:s', $qr->waktu)->format('H:i') }} WIB</td>
                                <td>{{ $qr->tempat }}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
