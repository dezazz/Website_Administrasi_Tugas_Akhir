<?php use Carbon\Carbon; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Berita Acara Seminar Proposal - Form 2B-1</title>
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

        .pads {
            padding-left: 10px;

        }

        .kiris {
            padding-left: 28px;

        }

        tr .aku {
            padding-left: 10px;
            border-bottom-style: hidden;
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
                                    <font size="3"><b>BERITA ACARA SEMINAR PROPOSAL</b></font>
                                </td>
                            </tr>
                        </table>
                    </table><br>

                    <div>
                        <table width="625" border="1" class="skrt">
                            <tr>
                                <td colspan="2" width="450" class="text"><b>Mahasiswa</b></td>
                                <td colspan="3" width="550" class="pads">Hari / Tanggal :
                                    {{ Carbon::parse($mahasiswa[0]->tanggal_sempro)->translatedFormat('l / d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" width="450" class="pads">Nama : {{ $mahasiswa[0]->nama }}</td>
                                <td colspan="3" width="550" class="pads">Waktu :
                                    {{ Carbon::createFromFormat('H:i:s', $mahasiswa[0]->waktu)->format('H:i') }} WIB
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" width="450" class="pads">NIM {{ $mahasiswa[0]->nim }}</td>
                                <td colspan="3" width="550" class="pads">Bidang Tugas Akhir :
                                    {{ $mahasiswa[0]->bidang_TA }} </td>
                            </tr>
                            <tr>
                                <td colspan="2" width="450" class="text"><b>Pembimbing</b></td>
                                <td colspan="3" width="550" class="aku">Judul Tugas Akhir :
                                    {{ $mahasiswa[0]->judul_skripsi }}</td>
                            </tr>
                            @foreach ($mahasiswa as $mh)
                                <tr>
                                    <td colspan="1" width="40" class="pads">Nama</td>
                                    <td colspan="1" width="410" class="pads">{{ $mh->nama_dosen }}</td>
                                </tr>
                                <tr>
                                    <td colspan="1" width="40" class="pads">NIP</td>
                                    <td colspan="1" width="410" class="pads">{{ $mh->nip }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="padi">
                                    <font size="2">HASIL SEMINAR PROPOSAL</font><br>
                                </td>
                            </tr>
                            <tr>
                                <td width="40" class="ungu"><b>No.</b></td>
                                <td width="410" class="ungu"><b>Nama Dosen</b></td>
                                <td width="180" class="ungu"><b>Layak</b></td>
                                <td width="180" class="ungu"><b>Tidak Layak</b></td>
                                <td width="180" class="ungu"><b>Tanda Tangan</b></td>
                            </tr>
                            @if ($nilai_kelayakan->count() > 0)
                                @foreach ($nilai_kelayakan as $nilai)
                                    <tr>
                                        <td width="40" class="ungu">{{ $loop->iteration }}</td>
                                        <td width="410" class="kiri">{{ $nilai->nama_dosen }}</td>
                                        <td width="180" class="ungu">
                                            {{ $nilai->hasil == 'Layak' ? 'V' : '' }}</td>
                                        <td width="180" class="ungu">
                                            {{ $nilai->hasil == 'Tidak Layak' ? 'V' : '' }}</td>
                                        <td width="180" class="ungu"></td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($nilai_kelayakan->count() < 5)
                                @for ($i = 0; $i < 5 - $nilai_kelayakan->count(); $i++)
                                    <tr>
                                        <td width="50" class="ungu">
                                            {{ $nilai_kelayakan->count() + $i + 1 }}
                                        </td>
                                        <td width="80" class="pac"></td>
                                        <td width="80" class="pac"></td>
                                        <td width="80" class="pac"></td>
                                        <td width="350" class="pac"></td>
                                    </tr>
                                @endfor
                            @else
                                <tr>
                                    <td width="40" class="ungu">1</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>

                                <tr>
                                    <td width="40" class="ungu">2</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">3</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">4</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">5</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">6</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">7</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                                <tr>
                                    <td width="40" class="ungu">8</td>
                                    <td width="410" class="kiri"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                    <td width="180" class="ungu"></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div>
                        <br><br>
                        <table width="625">
                            <tr>
                                <td width="40"></td>
                                <td width="410"></td>
                                <td width="180"></td>
                                <td width="260">Medan,
                                    {{ Carbon::parse($mahasiswa[0]->tanggal_sempro)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td width="40"></td>
                                <td width="410"></td>
                                <td width="180"></td>
                                <td width="260" class="kiris">Ketua Program Studi,</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <table width="625">
                            <tr>
                                <td width="40"></td>
                                <td width="410"></td>
                                <td width="200"></td>
                                <td width="240">(Dedy Arisandi ST., M.Kom.)</td>
                            </tr>
                            <tr>
                                <td width="40"></td>
                                <td width="410"></td>
                                <td width="200"></td>
                                <td width="240">NIP. 197908312009121002</td>
                            </tr>
                        </table>
                    </div>
                </center>
            </div>
        </div>
</body>
<script>
    window.print();
</script>

</html>
