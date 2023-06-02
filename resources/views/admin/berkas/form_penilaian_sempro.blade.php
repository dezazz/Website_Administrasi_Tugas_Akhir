<?php use Carbon\Carbon; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Penilaian Kelayakan Isi Proposal - Form 2B</title>
    <style type="text/css">
        body {
            width: 230mm;
            height: 100%;
            margin: 0 auto;
            padding: 0;
            font-size: 12pt;
            background: rgb(204, 204, 204);
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .main-page {
            width: 210mm;
            min-height: 297mm;
            margin: 10mm auto;
            background: white;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        .sub-page {
            padding: 1cm;
            height: 297mm;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .main-page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        table {
            border-style: solid;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr .padi {
            text-align: center;
            font-size: 13px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        table tr .ungu {
            text-align: center;
            font-size: 13px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        table tr .kiri {
            font-size: 13px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
        }

        table tr td {
            font-size: 13px;
        }

        .skrt {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .skrtt {
            border: 3px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        .pads {
            padding-left: 10px;

        }

        .kiris {
            padding-left: 47px;

        }

        tr .aku {
            padding-left: 10px;
            border-bottom-style: hidden;
        }

        .padsss {
            padding-bottom: 180px;
        }

        .ayo {
            padding-bottom: 50px;
            padding-left: 10px;
        }

        hr.line {
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <div class="main-page">
        <div class="sub-page">
            <div>
                <center>
                    <table width="625">
                        <tr>
                            <td style="padding-right: 15px;"><img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Logo_of_North_Sumatra_University.svg/400px-Logo_of_North_Sumatra_University.svg.png"
                                    width="110" height="110"></td>
                            <td>
                                <center>
                                    <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, <br> DAN TEKNOLOGI
                                    </font><br>
                                    <font size="3">UNIVERSITAS SUMATERA UTARA<br> FAKULTAS ILMU KOMPUTER DAN
                                        TEKNOLOGI INFORMASI</font><br>
                                    <font size="3"><b>PROGRAM STUDI S1 TEKNOLOGI INFORMASI</b></font><br>
                                    <font size="2">Jalan Alumni No. 3 Gedung C, Kampus USU Padang Bulan, Medan
                                        20155</font><br>
                                    <font size="2">Telepon/Fax: 061-8210077 | Email: tek.informasi@usu.ac.id |
                                        Laman: http://it.usu.ac.id</font>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr class="line">
                            </td>
                        </tr>
                        <table width="625">
                            <tr>
                                <td class="text">
                                    <font size="3"><b>FORM PENILAIAN KELAYAKAN ISI PROPOSAL</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <div>
                        <div>
                            <table width="625" border="1" class="skrt">
                                <tr>
                                    <td colspan="3" width="450" class="text"><b>Mahasiswa</b></td>
                                    <td colspan="3" width="550" class="pads">Hari / Tanggal :
                                        {{ Carbon::parse($query[0]->tanggal_sempro)->translatedFormat('l / d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="450" class="pads">Nama &nbsp {{ $query[0]->nama }}
                                    </td>
                                    <td colspan="3" width="550" class="pads">Waktu :
                                        {{ Carbon::createFromFormat('H:i:s', $query[0]->waktu)->format('H:i') }} WIB
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="450" class="pads">NIM {{ $query[0]->nim }}</td>
                                    <td colspan="3" width="550" class="pads">Bidang Tugas Akhir
                                        :{{ $query[0]->bidang_TA }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="450" class="text"><b>Pembimbing</b></td>
                                    <td colspan="3" width="550" class="aku">Judul Tugas Akhir :
                                        {{ $query[0]->judul_skripsi }}</td>
                                </tr>
                                @foreach ($query as $qr)
                                    <tr>
                                        <td colspan="1" width="50" class="pads">Nama</td>
                                        <td colspan="2" width="350" class="pads">{{ $qr->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" width="50" class="pads">NIP</td>
                                        <td colspan="2" width="350" class="pads">{{ $qr->nip }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="padi">
                                        <font size="2">HASIL SEMINAR PROPOSAL</font><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu"><b>No.</b></td>
                                    <td width="300" class="ungu"><b>Komponen Penilaian</b></td>
                                    <td width="100" class="ungu"><b>Terima*)</b></td>
                                    <td width="100" class="ungu"><b>Perbaiki*)</b></td>
                                    <td width="100" class="ungu"><b>Ganti*)</b></td>
                                    <td width="350" class="ungu"><b>Keterangan</b></td>
                                </tr>
                                {{--
								-- 1	Judul Skripsi 
								--  catatan_judul_skripsi text
								-- 2	Latar Belakang 
								--  catatan_latar_belakang text
								-- 3	Rumusan Masalah 
								-- catatan_rumusan_masalah text
								-- 4	Landasan Teori 
								-- catatan_landasan_teoris text
								-- 5	Penelitian Terdahulu 
								-- catatan_penelitian_terdahulu text
								-- 6	Data yang Digunakan 
								-- catatan_data_yang_digunakan text
								-- 7	Metodologi (Arsitektur Umum) 
								-- catatan_metodologi text
								-- 8	Daftar Pustaka ) 
								-- catatan_daftar_pustaka text --}}

                                @if ($nilai_kelayakan != null)
                                    @foreach ($nilai_kelayakan as $nk)
                                        <tr>
                                            <td width="50" class="ungu">1</td>
                                            <td width="300" class="kiri">Judul Skripsi</td>
                                            <td width="100" class="ungu">{{ $nk->judul_skripsi }}</td>
                                            <td width="100" class="ungu">{{ $nk->judul_skripsi }}</td>
                                            <td width="100" class="ungu">{{ $nk->judul_skripsi }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_judul_skripsi }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">2</td>
                                            <td width="300" class="kiri">Latar Belakang</td>
                                            <td width="100" class="ungu">{{ $nk->latar_belakang }}</td>
                                            <td width="100" class="ungu">{{ $nk->latar_belakang }}</td>
                                            <td width="100" class="ungu">{{ $nk->latar_belakang }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_latar_belakang }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">3</td>
                                            <td width="300" class="kiri">Rumusan Masalah</td>
                                            <td width="100" class="ungu">{{ $nk->rumusan_masalah }}</td>
                                            <td width="100" class="ungu">{{ $nk->rumusan_masalah }}</td>
                                            <td width="100" class="ungu">{{ $nk->rumusan_masalah }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_rumusan_masalah }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">4</td>
                                            <td width="300" class="kiri">Landasan Teori</td>
                                            <td width="100" class="ungu">{{ $nk->landasan_teori }}</td>
                                            <td width="100" class="ungu">{{ $nk->landasan_teori }}</td>
                                            <td width="100" class="ungu">{{ $nk->landasan_teori }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_landasan_teoris }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">5</td>
                                            <td width="300" class="kiri">Penelitian Terdahulu</td>
                                            <td width="100" class="ungu">{{ $nk->penelitian_terdahulu }}</td>
                                            <td width="100" class="ungu">{{ $nk->penelitian_terdahulu }}</td>
                                            <td width="100" class="ungu">{{ $nk->penelitian_terdahulu }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_penelitian_terdahulu }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">6</td>
                                            <td width="300" class="kiri">Metode Penelitian</td>
                                            <td width="100" class="ungu">{{ $nk->metodologi }}</td>
                                            <td width="100" class="ungu">{{ $nk->metodologi }}</td>
                                            <td width="100" class="ungu">{{ $nk->metodologi }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_metodologi }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50" class="ungu">7</td>
                                            <td width="300" class="kiri">Dafar Pustaka</td>
                                            <td width="100" class="ungu">{{ $nk->daftar_pustaka }}</td>
                                            <td width="100" class="ungu">{{ $nk->daftar_pustaka }}</td>
                                            <td width="100" class="ungu">{{ $nk->daftar_pustaka }}</td>
                                            <td width="350" class="kiri">{{ $nk->catatan_daftar_pustaka }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td width="50" class="ungu">1</td>
                                        <td width="300" class="kiri">Judul Skripsi</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">2</td>
                                        <td width="300" class="kiri">Latar Belakang</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">3</td>
                                        <td width="300" class="kiri">Rumusan Masalah</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">4</td>
                                        <td width="300" class="kiri">Landasan Teori</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">5</td>
                                        <td width="300" class="kiri">Penelitian Terdahulu</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">6</td>
                                        <td width="300" class="kiri">Data yang Digunakan</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">7</td>
                                        <td width="300" class="kiri">Metodologi (Arsitektur Umum)</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                    <tr>
                                        <td width="50" class="ungu">8</td>
                                        <td width="300" class="kiri">Daftar Pustaka</td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="100" class="ungu"></td>
                                        <td width="350" class="kiri"></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="padsss">
                            <br><br>
                            <table width="625">
                                <tr>
                                    <td width="50"></td>
                                    <td width="200" class="skrtt">Layak/Tidak Layak<br><i>(pilih salah satu)</i>
                                    </td>
                                    <td width="140"></td>
                                    <td width="180">Medan,
                                        {{ Carbon::parse($query[0]->tanggal_sempro)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td width="50"></td>
                                    <td width="200"></td>
                                    <td width="140"></td>
                                    <td width="180" class="kiris">Dosen Penilai,</td>
                                </tr>
                            </table>
                            <br><br><br>
                            <table width="625">
                                <tr>
                                    <td width="50"></td>
                                    <td width="200"></td>
                                    <td width="300"></td>
                                    <td width="200">(..................................................)</td>
                                </tr>
                                <tr>
                                    <td width="50"></td>
                                    <td width="200"></td>
                                    <td width="300"></td>
                                    <td width="200">NIP.</td>
                                </tr>
                            </table>
                        </div>
                </center>
            </div>
        </div>
    </div>

    <div class="main-page">
        <div class="sub-page">
            <div>
                <center>
                    <table width="625">
                        <tr>
                            <td style="padding-right: 15px;"><img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Logo_of_North_Sumatra_University.svg/400px-Logo_of_North_Sumatra_University.svg.png"
                                    width="110" height="110"></td>
                            <td>
                                <center>
                                    <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, <br> DAN TEKNOLOGI
                                    </font><br>
                                    <font size="3">UNIVERSITAS SUMATERA UTARA<br> FAKULTAS ILMU KOMPUTER DAN
                                        TEKNOLOGI INFORMASI</font><br>
                                    <font size="3"><b>PROGRAM STUDI S1 TEKNOLOGI INFORMASI</b></font><br>
                                    <font size="2">Jalan Alumni No. 3 Gedung C, Kampus USU Padang Bulan, Medan
                                        20155</font><br>
                                    <font size="2">Telepon/Fax: 061-8210077 | Email: tek.informasi@usu.ac.id |
                                        Laman: http://it.usu.ac.id</font>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr class="line">
                            </td>
                        </tr>
                        <table width="625">
                            <tr>
                                <td class="text">
                                    <font size="3"><b>FORM MASUKAN DAN SARAN - SEMINAR PROPOSAL</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <table width="625" border="1" class="skrt">
                        <tr>
                            <td class="ayo">Judul Tugas Akhir</td>
                        </tr>
                        <tr>
                            <td class="ayo">Latar Belakang</td>
                        </tr>
                        <tr>
                            <td class="ayo">Rumusan Masalah</td>
                        </tr>
                        <tr>
                            <td class="ayo">Landasan Teori</td>
                        </tr>
                        <tr>
                            <td class="ayo">Penelitian Terdahulu</td>
                        </tr>
                        <tr>
                            <td class="ayo">Data yang Digunakan</td>
                        </tr>
                        <tr>
                            <td class="ayo">Metodologi (Arsitektur Umum)</td>
                        </tr>
                        <tr>
                            <td class="ayo">Daftar Pustaka</td>
                        </tr>
                    </table>
                    <div>
                        <br><br>
                        <table width="625">
                            <tr>
                                <td width="50"></td>
                                <td width="200"></td>
                                <td width="140"></td>
                                <td width="180">Medan,
                                    {{ Carbon::parse($query[0]->tanggal_sempro)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td width="50"></td>
                                <td width="200"></td>
                                <td width="140"></td>
                                <td width="180" class="kiris">Dosen Penilai,</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <table width="625">
                            <tr>
                                <td width="50"></td>
                                <td width="200"></td>
                                <td width="300"></td>
                                <td width="200">(..................................................)</td>
                            </tr>
                            <tr>
                                <td width="50"></td>
                                <td width="200"></td>
                                <td width="300"></td>
                                <td width="200">NIP.</td>
                            </tr>
                        </table>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>
