<!DOCTYPE html>
<html>

<head>
    <title>Form Berita Acara Sidang Meja Hijau - Form 2I</title>
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

        table tr .text3 {
            text-align: center;
            font-size: 13px;
            padding-bottom: 50px;
        }

        table tr .text4 {
            text-align: justify;
            font-size: 13px;
        }

        table tr .text5 {
            text-align: center;
            font-size: 13px;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        table tr .text6 {
            padding-left: 8px;
            font-size: 13px;
            padding-top: 7px;
            padding-bottom: 7px;
        }

        table tr td {
            font-size: 13px;
        }

        .skrt {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pads {
            padding-left: 8px;
        }

        .padi {
            padding-left: 65px;
        }

        hr.line {
            border: 2px solid black;
        }

        .kiris {
            padding-left: 50px;
            line-height: 0.8;
        }

        .ket {
            line-height: 0.8;
            padding-left: 8px;
        }

        .kets {
            line-height: 0.8;
        }

        .batas {
            padding-bottom: 399px;
        }
    </style>
</head>

<body>
    <div class="main-page">
        <div class="sub-page">
            <div>
                <center>
                    <table width="600">
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
                        <table width="600">
                            <tr>
                                <td class="text">
                                    <font size="3"><b>REKAPITULASI NILAI UJI PROGRAM, SEMINAR HASIL</b></font>
                                </td>
                            </tr>
                            <tr>
                                <td class="text">
                                    <font size="3"><b>DAN SIDANG MEJA HIJAU</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <table width="600" border="1" class="skrt">
                        <tr>
                            <td width="20" class="text5"><b>No.</b< /td>
                            <td width="200" class="text5"><b>Nama Dosen</b></td>
                            <td width="100" class="text5"><b>Nilai Seminar Hasil</b></td>
                            <td width="100" class="text5"><b>Nilai Sidang</b></td>
                        </tr>
                        @if ($nilai_sidang->count() > 0 && $nilai_sidang->count() < 4)
                            @foreach ($nilai_sidang as $nilai_sidang)
                                <tr>
                                    <td width="20" class="text6">{{ $loop->iteration }}</td>
                                    <td width="200" class="text6">{{ $nilai_sidang->nama_dosen }}</td>
                                    <td width="100" class="text6">{{ $nilai_sidang->total }}</td>
                                    <td width="100" class="text6">{{ $nilai_sidang->total }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td width="20" class="text">1</td>
                                <td width="200" class="text6"></td>
                                <td width="100" class="text6"></td>
                                <td width="100" class="text6"></td>
                            </tr>
                            <tr>
                                <td width="20" class="text">2</td>
                                <td width="200" class="text6"></td>
                                <td width="100" class="text6"></td>
                                <td width="100" class="text6"></td>
                            </tr>
                            <tr>
                                <td width="20" class="text">3</td>
                                <td width="200" class="text6"></td>
                                <td width="100" class="text6"></td>
                                <td width="100" class="text6"></td>
                            </tr>
                            <tr>
                                <td width="20" class="text">4</td>
                                <td width="200" class="text6"></td>
                                <td width="100" class="text6"></td>
                                <td width="100" class="text6"></td>
                            </tr>
                        @endif
                        {{-- @if ($nilai_sidang->count() < 4)
                            @for ($i = 0; $i < 4 - $nilai_sidang->count(); $i++)
                                <tr>
                                    <td width="20" class="text6">{{ $nilai_sidang->count() + $i + 1 }}</td>
                                    <td width="200" class="text6"></td>
                                    <td width="100" class="text6"></td>
                                    <td width="100" class="text6"></td>
                                </tr>
                            @endfor
                        @endif --}}
                        <tr>
                            <td width="20" class="text"></td>
                            <td width="200" class="text6">TOTAL</td>
                            {{--  jumlah nilai semhas --}}
                            <td width="100" class="text6">(a) </td>
                            <td width="100" class="text6">(b) </td>
                        </tr>
                        <tr>
                            <td width="20" class="text"></td>
                            <td width="200" class="text6" colspan="2">NILAI UJI PROGRAM:</td>
                            <td width="100" class="text6">(c)</td>
                        </tr>
                        <tr>
                            <td width="20" class="text"></td>
                            <td width="200" class="text6" colspan="2">NILAI KESELURUHAN ((a x 4) + (b x 4) + (c x
                                2))/10</td>
                            <td width="100" class="text6"></td>
                        </tr>
                        <tr>
                            <td width="20" class="text"></td>
                            <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                            <td width="100" class="text6"></td>
                        </tr>
                    </table><br><br>
                    <table width="600">
                        <tr>
                            <td width="410" class="pads"><b>Kategori Nilai</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260">Medan, ......................................</td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>80 - 100 = A</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260" class="kiris">Ketua Penguji</td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>75 - 79 = B+</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260"></td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>70 - 74 = B</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260"></td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>65 - 69 = C+</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260"></td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>60 - 64 = C</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260"></td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>50 - 59 = D</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260">(..................................................)</td>
                        </tr>
                        <tr>
                            <td width="410" class="ket"><b>0 - 49 = E</b></td>
                            <td width="180"></td>
                            <td width="180"></td>
                            <td width="260" class="kets">NIP.</td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
    </div>

    <div class="main-page">
        <div class="sub-page">
            <div>
                <center>
                    <table width="600">
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
                        <table width="600">
                            <tr>
                                <td class="text">
                                    <font size="3"><b>BERITA ACARA SIDANG MEJA HIJAU</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <table width="600">
                        <tr>
                            <td class="text4">Pada hari ini :...................... Tanggal : ......... Bulan :
                                .................. Tahun Dua Ribu ............ bertempat di ruang rapat/Seminar Program
                                Studi S-1 Teknologi Informasi Fasilkom-TI USU telah dilangsungkan Ujian Sarjana/ Skripsi
                                mahasiswa :</td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td style="padding-right: 90px;">Nama</td>
                            <td width="572">: {{ $mahasiswa[0]->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td width="572">: {{ $mahasiswa[0]->nim }}</td>
                        </tr>
                        <tr>
                            <td>Judul Skripsi</td>
                            <td width="572">: {{ $mahasiswa[0]->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <td>Judul Bahasa Inggris</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                        <tr>
                            <td>Pembimbing</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                        <tr>
                            <td>Co. Pembimbing</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td class="text4">Yang diuji oleh Panitia Pelaksana Ujian Sarjana Komputer :
                            </td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td style="padding-right: 90px;">Ketua</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                        <tr>
                            <td>Sekretaris</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                        <tr>
                            <td>Anggota 1</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                        <tr>
                            <td>Anggota 2</td>
                            <td width="572">: ..............................................................</td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td style="padding-right: 15px;">Dinyatakan</td>
                            <td width="572" colspan="2"><b>: LULUS / TIDAK LULUS</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="200" class="pads"><b>Dengan Kriteria :</b></td>
                            <td width="800"><b>[ ____ ] Memuaskan</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="200"></td>
                            <td width="800"><b>[ ____ ] Sangat Memuaskan</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="200"></td>
                            <td width="800"><b>[ ____ ] Cum Laude</b></td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td style="padding-right: 35px;">Catatan</td>
                            <td width="572" colspan="3"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="180" class="pads"><b>1. Nilai Ujian Sarjana</b></td>
                            <td width="80"><b>:</b></td>
                            <td width="500"><b>( _____ )</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td width="180" class="pads"><b>2. IPK</b></td>
                            <td width="80"><b>:</b></td>
                            <td width="500"></td>
                        </tr>
                    </table>
                    <table width="600">
                        <tr>
                            <td class="text4">Demikian berita acara ujian ini diperbuat dengan sebenarnya.</td>
                        </tr>
                    </table><br>
                    <table width="600">
                        <tr>
                            <td class="text">
                                <font size="2"><b>PANITIA PELAKSANA UJIAN</b></font>
                            </td>
                        </tr>
                    </table><br>
                    <table width="600">
                        <tr>
                            <td width="500" class="text3">Ketua Program Studi</td>
                            <td width="500" class="text3">Ketua Penguji</td>
                        </tr>
                        <tr>
                            <td width="500" class="text">(Sarah Purnamawati, S.T., M.Sc)</td>
                            <td width="500" class="text">(................................................)</td>
                        </tr>
                        <tr>
                            <td width="500" class="padi"> NIP. 198302262010122003</td>
                            <td width="500" class="padi"> NIP. </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>
