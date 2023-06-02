<!DOCTYPE html>
<html>

<head>
    <title>Lembar Kendali Seminar Hasil - Form 1B</title>
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

        .skrrt {
            border: 3px solid black;
            border-collapse: collapse;
            text-align: center;
            padding-right: 10px;
            padding-left: 10px;
        }

        .pads {
            padding-left: 10px;
        }

        .pac {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .kiris {
            padding-left: 40px;
        }

        tr .aku {
            padding-left: 10px;
            border-bottom-style: hidden;
        }

        .padsss {
            padding-bottom: 279px;
        }

        .ayo {
            padding-bottom: 50px;
            padding-left: 10px;
        }

        .ayyo {
            padding-bottom: 15px;
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
                                    <font size="3"><b>LEMBAR KENDALI BIMBINGAN SKRIPSI</b></font>
                                </td>
                            </tr>
                            <tr>
                                <td class="text">
                                    <font size="3"><b>PRA SEMINAR HASIL</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <table width="625">
                        <tr>
                            <td style="padding-right: 10px;" width="80">Pembimbing I</td>
                            <td width="270">: {{ $dosbing1->nama }}</td>
                            <td width="100" class="skrtt"><b>FORM 1-B</b></td>
                        </tr>
                        <tr>
                            <td style="padding-right: 10px;" class="ayyo">Pembimbing II</td>
                            <td width="270" class="ayyo">: {{ $dosbing2->nama }}</td>
                        </tr>
                        <tr>
                            <td style="padding-right: 10px;">NIM</td>
                            <td width="270">: {{ $data->nim }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td width="270">: {{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td width="270">: S1 Teknologi Informasi</td>
                        </tr>
                        <tr>
                            <td>No. SK</td>
                            <td width="270">:
                                ............................................................................................................
                            </td>
                        </tr>
                    </table><br>
                    <table width="625">
                        <tr>
                            <td class="text"><b>Judul Skripsi</b></td>
                        </tr>
                    </table>
                    <table width="625" border="1" class="skrt">
                        <tr>
                            <td class="pac">{{ $data->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <td class="pac"></td>
                        </tr>
                        <tr>
                            <td class="pac"></td>
                        </tr>
                    </table><br>

                    <div class="padsss">
                        <table width="625" border="1" class="skrt">
                            <tr>
                                <td width="50" rowspan="2" class="ungu"><b>No.</b></td>
                                <td width="300" colspan="3" class="ungu"><b>Tanggal Bimbingan</b></td>
                                <td width="350" rowspan="2" class="ungu"><b>Catatan</b></td>
                            </tr>
                            <tr>
                                <td width="80" class="ungu"><b>Penyerahan</b></td>
                                <td width="80" class="ungu"><b>Selesai Diperiksa</b></td>
                                <td width="80" class="ungu"><b>Terima Kembali</b></td>
                            </tr>
                            @if ($bimbingan->count() > 0)
                                @foreach ($bimbingan as $bimbingan)
                                    <tr>
                                        <td width="50" class="ungu">{{ $loop->iteration }}</td>
                                        <td width="80" class="pac">{{ $bimbingan->tgl_penyerahan }}</td>
                                        <td width="80" class="pac">{{ $bimbingan->tgl_selesai_periksa }}</td>
                                        <td width="80" class="pac">{{ $bimbingan->tgl_kembali }}</td>
                                        <td width="150" class="pac">{{ $bimbingan->catatan }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td width="50" class="ungu">1</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">2</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">3</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">4</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">5</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">6</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                                <tr>
                                    <td width="50" class="ungu">7</td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="80" class="pac"></td>
                                    <td width="150" class="pac"></td>
                                </tr>
                            @endif
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
                    </table><br>

                    <div>
                        <table width="625" border="1" class="skrt">
                            <tr>
                                <td width="50" rowspan="2" class="ungu"><b>No.</b></td>
                                <td width="300" colspan="3" class="ungu"><b>Tanggal Bimbingan</b></td>
                                <td width="350" rowspan="2" class="ungu"><b>Catatan</b></td>
                            </tr>
                            <tr>
                                <td width="80" class="ungu"><b>Penyerahan</b></td>
                                <td width="80" class="ungu"><b>Selesai Diperiksa</b></td>
                                <td width="80" class="ungu"><b>Terima Kembali</b></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">8</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">9</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">10</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">11</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">12</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">13</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">14</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">15</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">16</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">17</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="ungu">18</td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="80" class="pac"></td>
                                <td width="150" class="pac"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="padsss">
                        <br>
                        <table width="625">
                            <tr>
                                <td width="30"></td>
                                <td width="70" class="skrrt" rowspan>Rencana Tanggal Seminar Hasill</td>
                                <td width="120"></td>
                                <td width="130">Medan, ...................................</td>
                            </tr>
                            <tr>
                                <td width="30"></td>
                                <td width="70" class="skrrt">{{ $tanggal }}</td>
                                <td width="120"></td>
                                <td width="130" class="kiris">Pembimbing I/II,</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <table width="625">
                            <tr>
                                <td width="30"></td>
                                <td width="70"></td>
                                <td width="200"></td>
                                <td width="100">(..................................................)</td>
                            </tr>
                            <tr>
                                <td width="30"></td>
                                <td width="70"></td>
                                <td width="200"></td>
                                <td width="100">NIP.</td>
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
