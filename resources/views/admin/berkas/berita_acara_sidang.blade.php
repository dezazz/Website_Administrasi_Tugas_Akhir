<!DOCTYPE html>
<html>

<head>
    <title>Form Berita Acara Sidang Meja Hijau - Form 2I</title>
    <style type="text/css">
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
    <?php use Carbon\Carbon; ?>
    <center>
        <div class="batas">
            <table width="600">
                <tr>
                    <td style="padding-right: 15px;"><img src="{{ asset('storage/Logo.png') }}" width="110"
                            height="110"></td>
                    <td>
                        <center>
                            <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, <br> DAN TEKNOLOGI</font><br>
                            <font size="3">UNIVERSITAS SUMATERA UTARA<br> FAKULTAS ILMU KOMPUTER DAN TEKNOLOGI
                                INFORMASI</font><br>
                            <font size="3"><b>PROGRAM STUDI S1 TEKNOLOGI INFORMASI</b></font><br>
                            <font size="2">Jalan Alumni No. 3 Gedung C, Kampus USU Padang Bulan, Medan 20155
                            </font><br>
                            <font size="2">Telepon/Fax: 061-8210077 | Email: tek.informasi@usu.ac.id | Laman:
                                http://it.usu.ac.id</font>
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
                <?php $i = 1; ?>
                @foreach ($semhas as $sh)
                    <tr>
                        <td width="20" class="text">{{ $i }}</td>
                        @foreach ($sidang as $sd)
                            @if ($sh->nip == $sd->nip)
                                <td width="200" class="text6">{{ $sh->nama_dsn }}</td>
                                <td width="100" class="text6">
                                    <center>{{ $sh->total_semhas }}</center>
                                </td>
                                <td width="100" class="text6">
                                    <center>{{ $sd->total_sidang }}</center>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <?php $i++; ?>
                @endforeach
                @if ($semhas->count() == 4)
                    <?php
                    
                    $a = ($semhas[0]->total_semhas + $semhas[1]->total_semhas + $semhas[2]->total_semhas + $semhas[3]->total_semhas) / 4;
                    $b = ($sidang[0]->total_sidang + $sidang[1]->total_sidang + $sidang[2]->total_sidang + $sidang[3]->total_sidang) / 4;
                    $c = $uji[0]->total_uji;
                    $total_akhir = ($a * 4 + $b * 4 + $c * 2) / 10;
                    ?>
                @elseif ($semhas->count() == 3)
                    <?php
                    
                    $a = ($semhas[0]->total_semhas + $semhas[1]->total_semhas + $semhas[2]->total_semhas) / 3;
                    $b = ($sidang[0]->total_sidang + $sidang[1]->total_sidang + $sidang[2]->total_sidang) / 3;
                    $c = $uji[0]->total_uji;
                    $total_akhir = ($a * 4 + $b * 4 + $c * 2) / 10;
                    ?>
                @elseif ($semhas->count() == 2)
                    <?php
                    
                    $a = ($semhas[0]->total_semhas + $semhas[1]->total_semhas) / 2;
                    $b = ($sidang[0]->total_sidang + $sidang[1]->total_sidang) / 2;
                    $c = $uji[0]->total_uji;
                    $total_akhir = ($a * 4 + $b * 4 + $c * 2) / 10;
                    ?>
                @elseif ($semhas->count() == 1)
                    <?php
                    
                    $a = $semhas[0]->total_semhas;
                    $b = $sidang[0]->total_sidang;
                    $c = $uji[0]->total_uji;
                    $total_akhir = ($a * 4 + $b * 4 + $c * 2) / 10;
                    ?>
                @else
                    <?php
                    
                    $a = 0;
                    $b = 0;
                    $c = $uji[0]->total_uji;
                    $total_akhir = ($a * 4 + $b * 4 + $c * 2) / 10;
                    ?>
                @endif
                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6">TOTAL</td>
                    <td width="100" class="text6">(a) <center>{{ $a }}</center>
                    </td>
                    <td width="100" class="text6">(b) <center>{{ $b }}</center>
                    </td>
                </tr>
                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6" colspan="2">NILAI UJI PROGRAM:</td>
                    <td width="100" class="text6">(c) <center>{{ $uji[0]->total_uji }}</center>
                    </td>
                </tr>
                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6" colspan="2">NILAI AKHIR:</td>
                    <td width="100" class="text6">
                        <center>{{ $total_akhir }}</center>
                    </td>
                </tr>
            </table>
            <br>
            <table width="600">
                <tr>
                    <td width="300" class="text">
                        <font size="2">Mengetahui,</font>
                    </td>
                    <td width="300" class="text">
                        <font size="2">Palu,..............................</font>
                    </td>
                </tr>
                <tr>
                    <td width="300" class="text">
                        <font size="2">Ketua Program Studi</font>
                    </td>
                    <td width="300" class="text">
                        <font size="2">Ketua Program Studi</font>
                    </td>
                </tr>
                <tr>
                    <td width="300" class="text">
                        <font size="2">Teknik Informatika</font>
                    </td>
                    <td width="300" class="text">

                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6">TOTAL</td>
                    <td width="100" class="text6">(a) <center>{{ $a }}</center>
                    </td>
                    <td width="100" class="text6">(b) <center>{{ $b }}</center>
                    </td>
                </tr>
                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6" colspan="2">NILAI UJI PROGRAM:</td>
                    <td width="100" class="text6">(c) <center>{{ $uji[0]->total_uji }}</center>
                    </td>
                </tr>
                <tr>
                    <td width="20" class="text"></td>
                    <td width="200" class="text6" colspan="2">NILAI KESELURUHAN ((a x 4) + (b x 4) + (c x 2))/10
                    </td>
                    <td width="100" class="text6">
                        <center>{{ $total_akhir }}</center>
                    </td>
                </tr>
                <tr>
                    @if ($total_akhir < 50)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>E</center>
                        </td>
                    @elseif($total_akhir >= 50 && $total_akhir < 60)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>D</center>
                        </td>
                    @elseif($total_akhir >= 60 && $total_akhir < 65)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>C</center>
                        </td>
                    @elseif($total_akhir >= 65 && $total_akhir < 70)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>C+</center>
                        </td>
                    @elseif($total_akhir >= 70 && $total_akhir < 75)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>B</center>
                        </td>
                    @elseif($total_akhir >= 75 && $total_akhir < 80)
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>B+</center>
                        </td>
                    @else
                        <td width="20" class="text"></td>
                        <td width="200" class="text6" colspan="2">NILAI HURUF</td>
                        <td width="100" class="text6">
                            <center>A</center>
                        </td>
                    @endif
                </tr>
            </table><br><br>
            <table width="600">
                <tr>
                    <td width="410" class="pads"><b>Kategori Nilai</b></td>
                    <td width="180"></td>
                    <td width="180"></td>
                    <td width="260">Medan,
                        {{ Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('d F Y') }}
                    </td>
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
                    <td width="260">({{ $dosen_penguji[0]->nama_dosen_penguji1 }})</td>
                </tr>
                <tr>
                    <td width="410" class="ket"><b>0 - 49 = E</b></td>
                    <td width="180"></td>
                    <td width="180"></td>
                    <td width="260" class="kets">NIP. {{ $dosen_penguji[0]->nip_dosen_penguji1 }}</td>
                </tr>
            </table>
        </div>

        <div>
            <table width="600">
                <tr>
                    <td style="padding-right: 15px;"><img src="{{ asset('storage/Logo.png') }}" width="110"
                            height="110"></td>
                    <td>
                        <center>
                            <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, <br> DAN TEKNOLOGI</font>
                            <br>
                            <font size="3">UNIVERSITAS SUMATERA UTARA<br> FAKULTAS ILMU KOMPUTER DAN TEKNOLOGI
                                INFORMASI</font><br>
                            <font size="3"><b>PROGRAM STUDI S1 TEKNOLOGI INFORMASI</b></font><br>
                            <font size="2">Jalan Alumni No. 3 Gedung C, Kampus USU Padang Bulan, Medan 20155
                            </font><br>
                            <font size="2">Telepon/Fax: 061-8210077 | Email: tek.informasi@usu.ac.id | Laman:
                                http://it.usu.ac.id</font>
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
                    <td class="text4">Pada hari ini
                        :{{ Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('l') }} Tanggal :
                        {{ Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('d') }} Bulan :
                        {{ Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('F') }} Tahun
                        {{ Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('Y') }} bertempat di ruang
                        rapat/Seminar Program Studi S-1 Teknologi Informasi Fasilkom-TI USU telah dilangsungkan Ujian
                        Sarjana/ Skripsi mahasiswa :</td>
                </tr>
            </table>
            <table width="600">
                <tr>
                    <td style="padding-right: 90px;">Nama</td>
                    <td width="572">: {{ $query[0]->nama }}</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td width="572">: {{ $query[0]->nim }}</td>
                </tr>
                <tr>
                    <td>Judul Skripsi</td>
                    <td width="572">: {{ $query[0]->judul_skripsi }}</td>
                </tr>
                <tr>
                    <td>Judul Bahasa Inggris</td>
                    <td width="572">: {{ $query[0]->eng_judul_skripsi }}</td>
                </tr>
                <?php $i = 1; ?>
                @foreach ($query as $mhs)
                    <tr>
                        <td>Pembimbing {{ $i }}</td>
                        <td width="572">: {{ $mhs->nama_dosen }}</td>
                    </tr>
                    <?php ++$i; ?>
                @endforeach
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
                    <td width="572">: {{ $dosen_penguji[0]->nama_dosen_penguji1 }}</td>
                </tr>
                <tr>
                    <td>Sekretaris</td>
                    <td width="572">: {{ $dosen_penguji[0]->nama_dosen_penguji2 }}</td>
                </tr>
                <tr>
                    <td>Anggota 1</td>
                    <td width="572">: {{ $query[0]->nama_dosen }}</td>
                </tr>
                <tr>
                    <td>Anggota 2</td>
                    <td width="572">: {{ $query[1]->nama_dosen }}</td>
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
                    <td width="500"><b>{{ $total_akhir }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td width="180" class="pads"><b>2. IPK</b></td>
                    <td width="80"><b>:</b></td>
                    <td width="500"><b>-</b></td>
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
                    <td width="500" class="text">(Dedy Arisandi, ST., M.Kom. )</td>
                    <td width="500" class="text">({{ $dosen_penguji[0]->nama_dosen_penguji1 }})</td>
                </tr>
                <tr>
                    <td width="500" class="padi"> NIP. 198302262010122003</td>
                    <td width="500" class="padi"> NIP. {{ $dosen_penguji[0]->nip_dosen_penguji1 }}</td>
                </tr>
            </table>
        </div>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>
