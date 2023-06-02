<?php use Carbon\Carbon ?>
<!DOCTYPE html>
<html>
<head>
	<title>Contoh Sidang Meja Hijau - Daftar Peserta</title>
	<style type="text/css">
		body {
       width: 230mm;
       height: 100%;
       margin: 0 auto;
       padding: 0;
       font-size: 12pt;
       background: rgb(204,204,204); 
    }
    *	{
       box-sizing: border-box;
       -moz-box-sizing: border-box;
    	}
    .main-page {
       width: 297mm;
       min-height: 210mm;
       margin: 10mm auto;
       background: white;
       box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    .sub-page {
       padding: 1cm;
       height: 210mm;
    }
    @page {
       size: A4;
       margin: 0;
    }
     @media print {
       html, body {
     	width: 297mm;
     	height: 210mm;        
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
			text-align: left;
			font-size: 13px;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 5px;
		}
		table tr .text4 {
			text-align: center;
			font-size: 13px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		table tr .text5 {
			text-align: left;
			font-size: 13px;
			padding-left: 10px;
			padding-right: 10px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		table tr .text6 {
			text-align: left;
			font-size: 13px;
			padding-right: 15px;
		}
		table tr td {
			font-size: 13px;
		}
		.skrt {
			border: 1px solid black;
  			border-collapse: collapse;
		}
		.pads {
			padding-bottom: 741px;
		}
		.padss {
			padding-bottom: 704px;
		}
		.padsss {
			padding-bottom: 593px;
		}
		.center {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="main-page">
		<div class="sub-page">
			<div>
				<center>
					<table width="700">
						<tr>
							<td class="text"><b><u>DAFTAR PENYAJI SIDANG MAHASISWA</u></b></td>
						</tr>
					</table>
					<table width="700">
						<tr>
							<td width="275"></td>
							<td style="padding-right: 25px;">HARI/TANGGAL</td>
							<td width="445">:   {{$date}}</td>
						</tr>
						<tr>
							<td></td>
							<td>PUKUL</td>
							<td width="445">:  {{Carbon::createFromFormat('H:i:s', $query[0]->waktu)->format('H:i')}} WIB S/D SELESAI</td>
						</tr>
						<tr>
							<td></td>
							<td>SISTEM SEMINAR</td>
							<td width="445">:  {{$query[0]->tempat}}</td>
						</tr>
					</table><br>
					<table width="1000" border="1" class="skrt">
						<tr>
							<td width="20" class="text4"><font size="2"><b>NO</b></font></td>
							<td width="50" class="text4"><font size="2"><b>NAMA / NIM</b></font></td>
							<td width="250" class="text4"><font size="2"><b>JUDUL SKRIPSI</b></font></td>
							<td width="100" class="text4"><font size="2"><b>PEMBIMBING I/II</b></font></td>
							<td width="100" class="text4"><font size="2"><b>PEMBANDING</b></font></td>
							<td width="30" class="text4"><font size="2"><b>STATUS</b></font></td>
						</tr>
						<?php $i ?> 
                        <?php $j = 1 ?>
                        @for($i = 0; $i <= (count($query)-1); $i+=2)
                        <tr>
                            <td width="20" class="text5"><font size="2">{{$j}}</font></td>
                            <td width="50" class="text5"><font size="2">{{$query[$i]->nama}} - {{$query[$i]->nim}}</font></td>
                            <td width="250" class="text5"><font size="2">
                                {{$query[$i]->judul_skripsi}}
                            </font></td>
                            <td width="100" class="text6"><font size="2">
                                <ol>
                                    <li>
                                        {{$query[$i]->nama_dosen}}
                                    </li>
                                    <li>
                                        {{$query[$i+1]->nama_dosen}}
                                    </li>
                                </ol>
                            </font></td>
                            <td width="100" class="text6"><font size="2">
                                <ol>
                                    <li>
                                        {{$query[$i]->nama_dosen_penguji1}}
                                    </li>
                                    <li>
                                        {{$query[$i]->nama_dosen_penguji2}}
                                    </li>
                                </ol>
                            </font></td>
                            <td width="30" class="text5"><font size="2"></font></td>
                        </tr>
                        <?php ++$j ?>
                        @endfor
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