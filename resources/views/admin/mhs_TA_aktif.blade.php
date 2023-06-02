@extends('admin/layout')

@section('title')
    <title>Admin - Mahasiswa Tingkat Akhir</title>
@endsection

@include('admin/sidebar')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Mahasiswa Tugas Akhir</h3>
                    <br><br>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
            <div class="col-xl-5">
                <form action="{{ route('cari_mhs') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-11">
                            <input type="text" class="form-control" name="keyword"
                                placeholder="Cari berdasarkan nama, nim, angkatan, status skripsi, dsb...">
                        </div>
                        <div class="col-xl-1">
                            <button class="btn btn-primary" type="submit"><i class="b bi-search"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END FORM CARI MAHASISWA -->

            <div class="col-xl-1"></div>

            <!-- FORM  FILTER -->
            <div class="col-xl-5">
                <form action="{{ route('filter_mhs') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-11">
                            <select class="form-control  @error('angkatan') is-invalid @enderror" id="angkatan"
                                name="angkatan" required placeholder="Filter berdasarkan angkatan ">
                                <option value="">Filter berdasarkan tahun angkatan</option>
                                @foreach ($angkatan as $akt)
                                    <option value="{{ $akt->angkatan }}">{{ $akt->angkatan }}</option>
                                @endforeach
                            </select>
                            @error('angkatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-xl-1">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END FORM FILTER -->
        </div>

        <br><br>

        <!-- DAFTAR MAHASISWA -->
        <div class="row">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr class="text-center table-success">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Judul</th>
                            <th>Dosbing I</th>
                            <th>Dosbing II</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $mahasiswa)
                            <tr class="text-center table-light">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->nama_mhs }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->angkatan }}</td>
                                <td>{{ $mahasiswa->judul_skripsi }}</td>
                                <td>{{ $mahasiswa->nama_dosbing1 }}</td>
                                <td>{{ $mahasiswa->nama_dosbing2 }}</td>
                                <td>{{ $mahasiswa->keterangan }}</td>
                                {{-- <td>{{ $mahasiswa->persentase_skripsi }}%</td> --}}
                                {{-- <td>
                                    <a href="{{ route('detail_mhs', $mahasiswa->nim) }}" class="btn btn-primary btn-sm"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('edit_mhs', $mahasiswa->nim) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('delete_mhs', $mahasiswa->nim) }}" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="row">
            @foreach ($mahasiswas as $mahasiswa)
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body py-4 px-5">
                            <div class="d-flex align-items-top">
                                <div class="avatar avatar-xl">
                                    @if ($mahasiswa->foto != null)
                                        <img src="../main/photos/{{ $mahasiswa->foto }}" alt="Face 1">
                                    @else
                                        <img src="../main/photos/graduate_student.png" alt="Face 1">
                                    @endif
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ $mahasiswa->nama_mhs }}</h5>
                                    <h6 class="text-muted mb-0"> {{ $mahasiswa->nim }}</h6>
                                    <br>
                                    <div class="progress progress-primary  mb-4">
                                        <div class="progress-bar progress-label" role="progressbar"
                                            style="width: {{ $mahasiswa->persentase_skripsi }}%"
                                            aria-valuenow="{{ $mahasiswa->persentase_skripsi }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <h6 class="text-muted mb-0"> {{ $mahasiswa->keterangan }}</h6>
                                    <p class="text-muted text-sm">
                                    <table class="table mb-0">
                                        <tr>
                                            <td>Angkatan</td>
                                            <td>:</td>
                                            <td>{{ $mahasiswa->angkatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Judul</td>
                                            <td>:</td>
                                            <td>{{ $mahasiswa->judul_skripsi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Doping I</td>
                                            <td>:</td>
                                            <td>{{ $mahasiswa->nama_dosbing1 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Doping II</td>
                                            <td>:</td>
                                            <td>{{ $mahasiswa->nama_dosbing2 }}</td>
                                        </tr>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <!-- END OF DAFTAR MAHASISWA -->
    </div>
@endsection
