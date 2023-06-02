@extends('prodi/layout')

@section('title')
    <title>Prodi - Mahasiswa Alumni</title>
@endsection

@section('sidebar')
    <li class="sidebar-item">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub active">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/kaprodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item ">
        <a href="/sekretaris_prodi/beritaacara" class='sidebar-link'>

            <span>Berita Acara</span>
        </a>
    </li>

    <li class="sidebar-item  ">
        <a href="/sekretaris_prodi/undangan_daftar_peserta" class='sidebar-link'>

            <span>Undangan dan Daftar Peserta</span>
        </a>
    </li>
    <li class="sidebar-item has-sub ">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-clipboard-plus"></i>
            <span>Input Nilai</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('nilai_IPK') }}">Input Nilai IPK</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_uji_program') }}">Input Nilai Uji Program</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_semhas') }}">Input Nilai Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('nilai_sidang') }}">Input Nilai Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-xl-8 col-md-6 order-md-1 order-last">
                    <h3>Mahasiswa Tugas Akhir</h3>
                    <br><br>
                </div>
                <div class="col-xl-4 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('mhs_ta') }}">Mahasiswa TA</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Aktif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- FORM UNTUK CARI DATA MAHASISWA -->
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
            <!-- END FORM CARI MAHASISWA -->
        </div>

        <br>
        <div class="row">
            <!-- FORM  FILTER -->
            <div class="col-xl-5">
                <form action="{{ route('filter_mhs') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-11">
                            <select class="form-control  @error('angkatan') is-invalid @enderror" id="angkatan"
                                name="angkatan" required placeholder="Filter berdasarkan angkatan ">
                                <option value="">Cari berdasarkan tahun angkatan</option>
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

            <div class="col-xl-1"></div>

            <!-- FORM  FILTER 2 -->
            <div class="col-xl-5">
                <form action="{{ route('filter_mhs2') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-11">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <select class="form-control" id="no_statusAkses" name="no_statusAkses" required>
                                <option value="">Cari berdasarkan status skripsi</option>
                                @foreach ($keterangan as $ket)
                                    <option value="{{ $ket->no_statusAkses }}">{{ $ket->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-1">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END FORM FILTER 2 -->
        </div>

        <br><br>

        <!-- DAFTAR MAHASISWA -->
        <p class="text-muted"><i> Menampilkan {{ $sum }} hasil yang sesuai untuk mahasiswa aktif angkatan
                {{ $tahun }}. </i> </p>
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
        <!-- END OF DAFTAR MAHASISWA -->

        <a href="{{ route('aktif') }}"> Kembali </a>
    </div>
@endsection
