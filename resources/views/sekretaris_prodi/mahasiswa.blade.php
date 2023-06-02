@extends('prodi/layout')

@section('title')
    <title>Prodi - Mahasiswa TA</title>
@endsection

@section('sidebar')
    <li class="sidebar-item active">
        <a href="/sekretaris_prodi/dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item has-sub">
        <a href="/sekretaris_prodi/menu_mahasiswa" class='sidebar-link'>
            <i class="bi bi-people-fill"></i>
            <span>Mahasiswa TA</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_aktif">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="/sekretaris_prodi/menu_mahasiswa/mahasiswa_alumni">Lulus / Alumni</a>
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
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Mahasiswa TA</h3>
                        <p class="text-subtitle text-muted">Daftar mahasiswa-mahasiswa tingkat akhir.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/sekretaris_prodi/mahasiswa">Mahasiswa TA</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-6">
                            <h5>Daftar Mahasiswa</h5><br>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th width="150">Nama</th>
                                            <th width="100">NIM</th>
                                            <th width="200">Tahap Skripsi</th>
                                            <th width="150">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i; ?>
                                        @for ($i = 0; $i <= count($query) - 1; $i += 2)
                                            <tr>
                                                <td>{{ $query[$i]->nama }}</td>
                                                <td>{{ $query[$i]->nim }}</td>
                                                <td>{{ $query[$i]->keterangan }}</td>
                                                <td>
                                                    <a href="/sekretaris_prodi/mahasiswa/{{ $query[$i]->nim }}"><button
                                                            class="btn btn-primary btn-sm"><i
                                                                class="bi bi-eye"></i>&nbsp;&nbsp;Selengkapnya</button></a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table><br><br><br>
                            </div>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-primary  justify-content-center">
                                    <li class="page-item">
                                        {!! $query->links() !!}
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection
