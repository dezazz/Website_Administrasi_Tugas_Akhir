<!DOCTYPE html>
<html>

<head>
    <title>Form Pengajuan Judul - Form 2A</title>
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
            padding-right: 80px;
            text-align: right;
            font-size: 13px;
        }

        table tr .text5 {
            text-align: center;
            font-size: 13px;
            vertical-align: top;
            padding-top: 10px;
            padding-bottom: 10px;
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
            vertical-align: bottom;
        }

        .dudu {
            border: 3px solid black;
            border-collapse: collapse;
            text-align: center;
            vertical-align: top;
            padding-top: 3px;
        }

        .skrrt {
            border: 3px solid black;
            border-collapse: collapse;
            text-align: center;
            padding-right: 10px;
            padding-left: 10px;
        }

        .guci {
            border: 3px solid black;
            border-collapse: collapse;
            padding-right: 10px;
            padding-left: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .mane {
            border: 3px solid black;
            border-collapse: collapse;
            padding-right: 10px;
            padding-left: 10px;
            padding-top: 90px;
            padding-bottom: 90px;
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
            padding-left: 10px;
            padding-bottom: 60px;
        }

        .kirs {
            padding-left: 12px;
            padding-bottom: 60px;
        }

        tr .aku {
            padding-left: 10px;
            border-bottom-style: hidden;
        }

        .padsss {
            padding-bottom: 51px;
        }

        .mun {
            padding-bottom: 20px;
        }

        .ayo {
            padding-bottom: 50px;
            padding-left: 10px;
        }

        hr.line {
            border: 2px solid black;
        }

        .damn {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .check {
            -webkit-appearance: none;
            width: 10px;
            height: 10px;
            outline: none;
            box-shadow: 0 0 0 3px black;
        }

        .check2 {
            -webkit-appearance: none;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            outline: none;
            box-shadow: 0 0 0 3px black;
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
                    </table><br>
                    <div>
                        <table width="625">
                            <tr>
                                <td class="text3" colspan="2">
                                    <font size="3"><b>FORM PENGAJUAN JUDUL</b></font>
                                </td>
                                <td width="100" class="skrtt" rowspan="6"><img
                                        src="../../main/photos/{{ $data_mhs->foto }}" alt="Foto Terbaru"
                                        style="height: 200px; width:150px" /></td>
                            </tr>
                            <tr>
                                <td width="150" class="damn"></td>
                                <td width="280" class="damn"></td>
                            </tr>
                            <tr>
                                <td width="150">Nama</td>
                                <td width="280" style="padding-left: 7px;">: {{ $data_mhs->nama }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td width="280" style="padding-left: 7px;">: {{ $data_mhs->nim }}</td>
                            </tr>
                            <tr>
                                <td>Judul diajukan oleh*</td>
                                @if ($pengajuan_judul->pengaju != 'dosen')
                                    {{-- ceklis box dosen --}}
                                    <td width="280" style="padding-left: 7px; padding-bottom: 10px;">:
                                        <input type="checkbox" class="check"checked> Dosen
                                    </td>
                                @else
                                    <td width="280" style="padding-left: 7px;">:
                                        <input type="checkbox" class="check"> Dosen
                                    </td>
                                @endif

                            </tr>
                            <tr>
                                <td></td>
                                @if ($pengajuan_judul->pengaju = 'mahasiswa')
                                    {{-- ceklis box mahasiswa --}}
                                    <td width="280" style="padding-left: 7px; padding-bottom: 10px;">:
                                        <input type="checkbox" class="check" checked> Mahasiswa
                                    </td>
                                @else
                                    <td width="280" style="padding-left: 7px; padding-bottom: 10px;">:
                                        <input type="checkbox" class="check"> Mahasiswa
                                    </td>
                                @endif
                            </tr>
                        </table><br>
                    </div>

                    <div>
                        <table width="625">
                            <tr>
                                <td width="76">Bidang Ilmu (tulis dua bidang)</td>
                                <td width="7" class="text">:</td>
                                <td width="170" class="guci"></td>
                            </tr>
                        </table><br>
                    </div>

                    <div>
                        <table width="625">
                            <tr>
                                <td width="96">Uji Kelayakan Judul**</td>
                                <td width="10" style="padding-left: 8px;">:
                                    <input type="radio" class="check2"> Diterima
                                </td>
                                <td width="200">
                                    <input type="radio" class="check2"> Ditolak
                                </td>
                            </tr>
                        </table><br>
                    </div>

                    <div>
                        <table width="625">
                            <tr>
                                <td>Hasil Uji Kelayakan Judul :</td>
                            </tr>
                            <tr>
                                <td class="mane"></td>
                            </tr>
                        </table><br>
                    </div>

                    <div>
                        <table width="625">
                            <tr>
                                <td width="170">Calon Dosen Pembimbing I:</td>
                                <td width="50"></td>
                                <td class="dudu" rowspan="2" width="100">Paraf Calon Dosen Pembimbing I</td>
                            </tr>
                            <tr>
                                <td width="170" class="mun">
                                    <font size="1"><i>(Jika judul dari dosen maka dosen tersebut berhak menjadi
                                            pembimbing I)</i></font>
                                </td>
                                <td width="50"></td>
                            </tr>
                        </table><br>
                        <table width="625">
                            <tr>
                                <td width="170">Calon Dosen Pembimbing II:</td>
                                <td width="50"></td>
                                <td width="100"></td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        <table width="625">
                            <tr>
                                <td width="360"></td>
                                <td width="100">Medan, .......................</td>
                            </tr>
                            <tr>
                                <td width="360"></td>
                                <td width="100" class="kirs">Ka. Laboratorium Penelitian,</td>
                            </tr>
                            <tr>
                                <td width="360"><i>* Centang salah satu atau keduanya</i></td>
                                <td width="100">(Ivan Jaya, S.Si., M.Kom)</td>
                            </tr>
                            <tr>
                                <td width="360"><i>** Pilih salah satu</i></td>
                                <td width="100">NIP. 198407072015041001</td>
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
                                    <font size="3"><b>RINGKASAN JUDUL YANG DIAJUKAN</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>
                    <table width="625">
                        <tr>
                            <td>*Semua kolom di bawah ini diisi oleh mahasiswa yang sudah mendapat judul</td>
                        </tr>
                    </table>

                    <div>
                        <table width="625" border="1" class="skrt">
                            <tr>
                                <td width="50" class="text5"><b>Judul / Topik Skripsi</b< /td>
                                <td width="200" class="pac"><b></b></td>
                            </tr>
                            <tr>
                                <td width="50" class="text5"><b>Latar Belakang dan Penelitian Terdahulu</b< /td>
                                <td width="200" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="text5"><b>Rumusan Masalah</b< /td>
                                <td width="200" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="text5"><b>Metodologi</b< /td>
                                <td width="200" class="pac"></td>
                            </tr>
                            <tr>
                                <td width="50" class="text5"><b>Referensi</b< /td>
                                <td width="200" class="pac"></td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        <br><br>
                        <table width="625">
                            <tr>
                                <td width="360"></td>
                                <td width="100">Medan, ..........................</td>
                            </tr>
                            <tr>
                                <td width="360"></td>
                                <td width="100" class="kiris">Mahasiswa yang mengajukan,</td>
                            </tr>
                            <tr>
                                <td width="360"></td>
                                <td width="100">({{ $data_mhs->nama }})</td>
                            </tr>
                            <tr>
                                <td width="360"></td>
                                <td width="100">NIM. {{ $data_mhs->nim }}</td>
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
