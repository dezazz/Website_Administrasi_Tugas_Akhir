@extends('admin/layout')

@section('title')
    <title>Prodi - Edit Nilai Seminar Hasil</title>
@endsection

@section('sidebar')
    <li class="sidebar-item ">
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
    <li class="sidebar-item has-sub active">
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
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Nilai Seminar Hasil</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adm_store_upd_nilai_semhas') }}">Input Nilai
                                    Seminar Hasil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Nilai Seminar Hasil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="card card-outline-secondary">
                    <div class="row align-items-center m-5">
                        <div class="col-md mb-5">
                            <!-- FORM PENGEDITAN NILAI -->
                            <form class="form form-horizontal" action="{{ route('store_upd_nilai_semhas') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="nim" value="{{ $data[0]->nim }}">
                                <div class="form-body">
                                    <div class="row">
                                        <h3>Masukkan Nilai Seminar Hasil</h3> <br>
                                        <div class="col-md-4">
                                            <label>Nama Mahasiswa</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data[0]->nama }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>NIM</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" required value="{{ $data[0]->nim }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal">Tanggal Penilaian</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date"
                                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                                name="tanggal" required value="{{ $data[0]->tanggal }}">
                                            @error('tanggal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="waktu">Waktu</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="time" class="form-control @error('waktu') is-invalid @enderror"
                                                id="waktu" name="waktu" required value="{{ $data[0]->waktu }}">
                                            @error('waktu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br><br><br><br>
                                        <h6>Silakan input nilai sesuai dengan urutan komponen berikut:</h6>
                                        <p class="text-muted">
                                            1. Nilai 1: Abstrak (0-3)<br>
                                            2. Nilai 2: Bab I: Pendahuluan (0-10) <br>
                                            3. Nilai 3: Bab II: Landasan Teori (0-15) <br>
                                            4. Nilai 4: Bab III: Metodologi (0-25) <br>
                                            5. Nilai 5: Bab IV: Implementasi (0-35)<br>
                                            6. Nilai 6: Bab V: Kesimpulan (0-2)<br>
                                            7. Nilai 7: Kemampuan mengemukakan substansi dan pendapat dan sikap
                                            (0-10)<br><br>
                                        </p>
                                        <!-- NILAI DOSEN 1 -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nip">Dosen 1</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control  @error('nip') is-invalid @enderror"
                                                    id="nip" name="nip" required value="{{ old('nip') }}"
                                                    autocomplete="nip">
                                                    <option value="{{ $data[0]->nip }}">{{ $data[0]->nama_dosen }}
                                                    </option>
                                                    <option value="{{ $data[0]->nip_dosbing1 }}">Doping I -
                                                        {{ $data[0]->nama_dosbing1 }}</option>
                                                    <option value="{{ $data[0]->nip_dosbing2 }}">Doping II -
                                                        {{ $data[0]->nama_dosbing2 }}</option>
                                                    <option value="{{ $data[0]->nip_dosen_penguji1 }}">Pembanding I -
                                                        {{ $data[0]->nama_dosen_penguji1 }}</option>
                                                    <option value="{{ $data[0]->nip_dosen_penguji2 }}">Pembanding II -
                                                        {{ $data[0]->nama_dosen_penguji2 }}</option>
                                                </select>
                                                @error('nip')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <br><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n1">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n1"
                                                    class="form-control  @error('n1') is-invalid @enderror"
                                                    value="{{ $data[0]->n1 }}" name="n1"autocomplete="n1">
                                                @error('n1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n2">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n2"
                                                    class="form-control  @error('n2') is-invalid @enderror"
                                                    value="{{ $data[0]->n2 }}" name="n2" autocomplete="n2">
                                                @error('n2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n3">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n3"
                                                    class="form-control  @error('n3') is-invalid @enderror"
                                                    value="{{ $data[0]->n3 }}" name="n3" autocomplete="n3">
                                                @error('n3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n4">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n4"
                                                    class="form-control  @error('n4') is-invalid @enderror"
                                                    value="{{ $data[0]->n4 }}" name="n4" autocomplete="n4">
                                                @error('n4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n5">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n5"
                                                    class="form-control  @error('n5') is-invalid @enderror"
                                                    value="{{ $data[0]->n5 }}" name="n5" autocomplete="n5">
                                                @error('n5')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n6">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n6"
                                                    class="form-control  @error('n6') is-invalid @enderror"
                                                    value="{{ $data[0]->n6 }}" name="n6" autocomplete="n6">
                                                @error('n6')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n7">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n7"
                                                    class="form-control  @error('n7') is-invalid @enderror"
                                                    value="{{ $data[0]->n7 }}" name="n7" autocomplete="n7">
                                                @error('n7')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="total1">Total</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="total1"
                                                    class="form-control  @error('total1') is-invalid @enderror"
                                                    value="{{ $data[0]->total }}" name="total1" required
                                                    autocomplete="total1">
                                                @error('total1')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- END NILAI DOSEN 1 -->
                                        <hr><br>

                                        <!-- NILAI DOSEN 2 -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nip2">Dosen 2</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control  @error('nip2') is-invalid @enderror"
                                                    id="nip2" name="nip2" required value="{{ old('nip2') }}"
                                                    autocomplete="nip2">
                                                    <option value="{{ $data[1]->nip }}">{{ $data[1]->nama_dosen }}
                                                    </option>
                                                    <option value="{{ $data[1]->nip_dosbing1 }}">Doping I -
                                                        {{ $data[1]->nama_dosbing1 }}</option>
                                                    <option value="{{ $data[1]->nip_dosbing2 }}">Doping II -
                                                        {{ $data[1]->nama_dosbing2 }}</option>
                                                    <option value="{{ $data[1]->nip_dosen_penguji1 }}">Pembanding I -
                                                        {{ $data[1]->nama_dosen_penguji1 }}</option>
                                                    <option value="{{ $data[1]->nip_dosen_penguji2 }}">Pembanding II -
                                                        {{ $data[1]->nama_dosen_penguji2 }}</option>
                                                </select>
                                                @error('nip2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <br><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n8">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n8"
                                                    class="form-control  @error('n8') is-invalid @enderror"
                                                    value="{{ $data[1]->n1 }}" name="n8" autocomplete="n8">
                                                @error('n8')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n9">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n9"
                                                    class="form-control  @error('n9') is-invalid @enderror"
                                                    value="{{ $data[1]->n2 }}" name="n9" autocomplete="n9">
                                                @error('n9')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n10">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n10"
                                                    class="form-control  @error('n10') is-invalid @enderror"
                                                    value="{{ $data[1]->n3 }}" name="n10" autocomplete="n10">
                                                @error('n10')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n11">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n11"
                                                    class="form-control  @error('n11') is-invalid @enderror"
                                                    value="{{ $data[1]->n4 }}" name="n11" autocomplete="n11">
                                                @error('n11')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n12">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n12"
                                                    class="form-control  @error('n12') is-invalid @enderror"
                                                    value="{{ $data[1]->n5 }}" name="n12" autocomplete="n12">
                                                @error('n12')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n13">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n13"
                                                    class="form-control  @error('n13') is-invalid @enderror"
                                                    value="{{ $data[1]->n6 }}" name="n13" autocomplete="n13">
                                                @error('n13')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n14">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n14"
                                                    class="form-control  @error('n14') is-invalid @enderror"
                                                    value="{{ $data[1]->n7 }}" name="n14" autocomplete="n14">
                                                @error('n14')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="total2">Total</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="total2"
                                                    class="form-control  @error('total2') is-invalid @enderror"
                                                    value="{{ $data[1]->total }}" name="total2" required
                                                    autocomplete="total2">
                                                @error('total2')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- END NILAI DOSEN 2 -->
                                        <hr><br>

                                        <!-- NILAI DOSEN 3 -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nip3">Dosen 3</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control  @error('nip3') is-invalid @enderror"
                                                    id="nip3" name="nip3" required value="{{ old('nip3') }}"
                                                    autocomplete="nip3">
                                                    <option value="{{ $data[2]->nip }}">{{ $data[2]->nama_dosen }}
                                                    </option>
                                                    <option value="{{ $data[2]->nip_dosbing1 }}">Doping I -
                                                        {{ $data[2]->nama_dosbing1 }}</option>
                                                    <option value="{{ $data[2]->nip_dosbing2 }}">Doping II -
                                                        {{ $data[2]->nama_dosbing2 }}</option>
                                                    <option value="{{ $data[2]->nip_dosen_penguji1 }}">Pembanding I -
                                                        {{ $data[2]->nama_dosen_penguji1 }}</option>
                                                    <option value="{{ $data[2]->nip_dosen_penguji2 }}">Pembanding II -
                                                        {{ $data[2]->nama_dosen_penguji2 }}</option>
                                                </select>
                                                @error('nip3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <br><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n15">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n15"
                                                    class="form-control  @error('n15') is-invalid @enderror"
                                                    value="{{ $data[2]->n1 }}" name="n15" autocomplete="n15">
                                                @error('n15')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n16">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n16"
                                                    class="form-control  @error('n16') is-invalid @enderror"
                                                    value="{{ $data[2]->n2 }}" name="n16" autocomplete="n16">
                                                @error('n16')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n17">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n17"
                                                    class="form-control  @error('n17') is-invalid @enderror"
                                                    value="{{ $data[2]->n3 }}" name="n17" autocomplete="n17">
                                                @error('n17')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n18">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n18"
                                                    class="form-control  @error('n18') is-invalid @enderror"
                                                    value="{{ $data[2]->n4 }}" name="n18" autocomplete="n18">
                                                @error('n18')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n19">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n19"
                                                    class="form-control  @error('n19') is-invalid @enderror"
                                                    value="{{ $data[2]->n5 }}" name="n19" autocomplete="n19">
                                                @error('n19')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n20">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n20"
                                                    class="form-control  @error('n20') is-invalid @enderror"
                                                    value="{{ $data[2]->n6 }}" name="n20" autocomplete="n20">
                                                @error('n20')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n21">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n21"
                                                    class="form-control  @error('n21') is-invalid @enderror"
                                                    value="{{ $data[2]->n7 }}" name="n21" autocomplete="n21">
                                                @error('n21')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="total3">Total</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="total3"
                                                    class="form-control  @error('total3') is-invalid @enderror"
                                                    value="{{ $data[2]->total }}" name="total3" required
                                                    autocomplete="total3">
                                                @error('total3')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- END NILAI DOSEN 3 -->
                                        <hr><br>

                                        <!-- NILAI DOSEN 4 -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nip4">Dosen 4</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control  @error('nip4') is-invalid @enderror"
                                                    id="nip4" name="nip4" required value="{{ old('nip4') }}"
                                                    autocomplete="nip4">
                                                    <option value="{{ $data[3]->nip }}">{{ $data[3]->nama_dosen }}
                                                    </option>
                                                    <option value="{{ $data[3]->nip_dosbing1 }}">Doping I -
                                                        {{ $data[3]->nama_dosbing1 }}</option>
                                                    <option value="{{ $data[3]->nip_dosbing2 }}">Doping II -
                                                        {{ $data[3]->nama_dosbing2 }}</option>
                                                    <option value="{{ $data[3]->nip_dosen_penguji1 }}">Pembanding I -
                                                        {{ $data[3]->nama_dosen_penguji1 }}</option>
                                                    <option value="{{ $data[3]->nip_dosen_penguji2 }}">Pembanding II -
                                                        {{ $data[3]->nama_dosen_penguji2 }}</option>
                                                </select>
                                                @error('nip4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <br><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n22">Nilai 1</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n22"
                                                    class="form-control  @error('n22') is-invalid @enderror"
                                                    value="{{ $data[3]->n1 }}" name="n22" autocomplete="n22">
                                                @error('n22')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n23">Nilai 2</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n23"
                                                    class="form-control  @error('n23') is-invalid @enderror"
                                                    value="{{ $data[3]->n2 }}" name="n23" autocomplete="n23">
                                                @error('n23')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n24">Nilai 3</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n24"
                                                    class="form-control  @error('n24') is-invalid @enderror"
                                                    value="{{ $data[3]->n3 }}" name="n24" autocomplete="n24">
                                                @error('n24')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n25">Nilai 4</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n25"
                                                    class="form-control  @error('n25') is-invalid @enderror"
                                                    value="{{ $data[3]->n4 }}" name="n25" autocomplete="n25">
                                                @error('n25')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="n26">Nilai 5</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n26"
                                                    class="form-control  @error('n26') is-invalid @enderror"
                                                    value="{{ $data[3]->n5 }}" name="n26" autocomplete="n26">
                                                @error('n26')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n27">Nilai 6</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n27"
                                                    class="form-control  @error('n27') is-invalid @enderror"
                                                    value="{{ $data[3]->n6 }}" name="n27" autocomplete="n27">
                                                @error('n27')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <label for="n28">Nilai 7</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="n28"
                                                    class="form-control  @error('n28') is-invalid @enderror"
                                                    value="{{ $data[3]->n7 }}" name="n28" autocomplete="n28">
                                                @error('n28')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="total4">Total</label>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <input type="text" id="total4"
                                                    class="form-control  @error('total4') is-invalid @enderror"
                                                    value="{{ $data[3]->total }}" name="total4" required
                                                    autocomplete="total4">
                                                @error('total4')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- END NILAI DOSEN 4 -->
                                        <br><br>

                                        <center>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM EDIT NILAI -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
