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
                    <h3>Mahasiswa Tingkat Akhir</h3>
                    <br><br>
                </div>
            </div>
        </div>

        <!-- FORM UNTUK CARI DATA MAHASISWA -->
        <div class="row">
            <form action="{{ route('cari_mhs') }}">
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
        </div>
        <!-- END FORM CARI MAHASISWA -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5></br>
                            <div class="table-responsive">
                                <!-- ALERT SECTION -->
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
                                <!-- END ALERT SECTION -->
                                <table class="table table-bordered mb-0">
                                    <thead class="text-center">
                                        <tr class="text-center table-success">
                                            <th>No.</th>
                                            <th>Nama / NIM</th>
                                            <th>Judul Skripsi</th>
                                            <th>Doping 1</th>
                                            <th>Doping 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td class="text-bold-500">{{ $mahasiswa->nama_mhs }}
                                                    ({{ $mahasiswa->nim }})
                                                </td>
                                                <td>{{ $mahasiswa->judul_skripsi }}</td>
                                                <td>{{ $mahasiswa->nama_dosbing1 }}</td>
                                                <td>{{ $mahasiswa->nama_dosbing2 }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table><br><br><br>
                            </div>
                            <div class="d-felx justify-content-center">
                                {{ $mahasiswas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <div class="row">
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
        </div>
    </div>
@endsection
