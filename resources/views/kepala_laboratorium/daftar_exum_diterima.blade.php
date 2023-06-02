@extends('dosen/layout')

@section('title')
    <title>Kepala Laboratorium - Daftar Executive Summary Disetujui</title>
@endsection

@include('kepala_laboratorium/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Executive Summary Disetujui</h3>
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
                {{-- success_terima_exum --}}
                @if (session('success_terima_exum'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_terima_exum') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- success_tolak_exum --}}
                @if (session('success_tolak_exum'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_tolak_exum') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- error --}}
                @if (session('error_terima_exum'))
                    <div class="alert alert-danger">
                        {{ session('error_terima_exum') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error_tolak_exum'))
                    <div class="alert alert-danger">
                        {{ session('error_tolak_exum') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Executive Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exum as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nim }}</td>
                                <td class="text-center">{{ $item->nama_mhs }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'Disetujui')
                                        <span class="badge bg-success">{{ $item->status }}</span>
                                    @elseif($item->status == 'Ditolak')
                                        <span class="badge bg-danger">{{ $item->status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $item->status }}</span>
                                    @endif
                                </td>
                                {{-- button download file --}}
                                <td class="text-center">
                                    <a href="{{ route('kepala_lab_exum_download', $item->nim) }}"
                                        class="btn btn-primary">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
