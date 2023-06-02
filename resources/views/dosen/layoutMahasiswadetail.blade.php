@extends('dosen.layout')

@section('title')
    <title>Dosen - Detail Mahasiswa</title>
@endsection

@section('sidebar')
    <li class="sidebar-item  ">
        <a href="dashboard" class='sidebar-link'>

            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item active  ">
        <a href="{{ route('mhs_bimbingan') }}" class='sidebar-link'>
            {{-- <i class="bi bi-people-fill"></i> --}}
            <span>Mahasiswa Bimbingan</span>
        </a>
        {{-- <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('mhs_aktif') }}">Mahasiswa Aktif</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('lulus') }}">Lulus / Alumni</a>
            </li>
        </ul> --}}
    </li>
    <li class="sidebar-item has-sub ">
        <a href="{{ route('mahasiswa_ta') }}" class='sidebar-link'>
            {{-- <i class="bi bi-people-fill"></i> --}}
            <span>Bimbingan</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="{{ route('bimbingan_sempro') }}">Pra Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('bimbingan_semhas') }}">Pra Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('bimbingan_sidang') }}">Pra Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-item has-sub ">
        <a href="/jadwalSeminarSidang" class='sidebar-link'>
            {{-- <i class="bi bi-people-fill"></i> --}}
            <span>Jadwal</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item ">
                <a href="/dosen/sempro">Seminar Proposal</a>
            </li>
            <li class="submenu-item ">
                <a href="/dosen/semhas">Seminar Hasil</a>
            </li>
            <li class="submenu-item ">
                <a href="/dosen/sidang">Sidang Meja Hijau</a>
            </li>
        </ul>
    </li>

    {{-- <li class="sidebar-item  ">
        <a href="jadwalSeminarSidang" class='sidebar-link'>
            <span>Jadwal Seminar/Sidang</span>
        </a>
    </li> --}}
    <li class="sidebar-item  ">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="sidebar-link">
            @csrf
            <button class="btn btn-primary" type="submit"> Logout
                {{-- <span>Logout</span> --}}
            </button>
        </form>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Mahasiswa Bimbingan</h3>
                    <p class="text-subtitle text-muted">Berikut Data Detail Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="table1">
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($query as $item)
                            @if ($i == 0)
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{ $item->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Skripsi</td>
                                    <td>{{ $item->judul_skripsi }}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>{{ $item->angkatan }}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing <?= $i + 1 ?></td>
                                    <td>{{ $item->dosen_pembimbing }}</td>
                                </tr>
                            @endif
                            <?php $i++; ?>
                            @if ($i == 2)
                                <tr>
                                    <td>Dosen Pembimbing <?= $i ?></td>
                                    <td>{{ $item->dosen_pembimbing }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
