@extends('dosen/layout')

@section('title')
    <title>Dosen Penguji - Daftar Mahasiswa</title>
@endsection

@include('dosen_penguji/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Mahasiswa</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
            </div>
        </section>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            {{-- <th>Keterangan</th> --}}
                            <th>Detail Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- tampilkan data mahasiswa --}}
                        @for ($i = 0; $i <= count($mahasiswa) - 1; $i++)
                            <tr class="text-center">
                                <td>{{ $i + 1 }}.</td>
                                <td>{{ $mahasiswa[$i]->nim }}</td>
                                <td>{{ $mahasiswa[$i]->nama_mhs }}</td>
                                {{-- <td>{{ $mahasiswa[$i]->keterangan }}</td> --}}
                                <td>
                                    <a href="/dosen_penguji/detail_mahasiswa_penguji/{{ $mahasiswa[$i]->nim }}"><button
                                            type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"><i
                                                class="bi bi-eye"></i>&nbsp;Detail</button></a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
