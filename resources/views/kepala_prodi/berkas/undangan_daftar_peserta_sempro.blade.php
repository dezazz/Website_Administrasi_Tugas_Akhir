<!DOCTYPE html>
<html>
<head>
	<title>Undangan & Daftar Peserta Seminar Proposal</title>
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
			text-align: left;
			font-size: 13px;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
		}
		table tr .text6 {
			padding-left: 8px;
			font-size: 13px;
			padding-top: 7px;
			padding-bottom: 7px;
		}
		table tr .text7 {
			text-align: center;
			padding-left: 8px;
			font-size: 13px;
			padding-top: 7px;
			padding-bottom: 7px;
		}
		table tr .text8 {
			text-align: center;
			font-size: 13px;
			padding-top: 7px;
			padding-bottom: 7px;
		}
		table tr .text9 {
			text-align: left;
			font-size: 13px;
			padding-right: 15px;
		}
		table tr .text10 {
			text-align: center;
			font-size: 13px;
			padding-top: 10px;
			padding-bottom: 10px;
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
		.padi{
			padding-left: 65px;
		}
		hr.line {
		border: 2px solid black;
		}
		.kiris {
			padding-left: 63px;
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
			padding-bottom: 197px;;
		}
		.ttd {
			padding-top: 55px;
		}
		.center {
			text-align: center;
		}

	</style>
</head>
<body>
	<center>
		<!-- Surat Undangan -->
		<div class="batas">
			<table width="625">
				<tr>
					<td style="padding-right: 15px;"><img src="{{asset('storage/Logo.png')}}" width="110" height="110"></td>
					<td>
					<center>
						<font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, <br> DAN TEKNOLOGI</font><br>
						<font size="3">UNIVERSITAS SUMATERA UTARA<br> FAKULTAS ILMU KOMPUTER DAN TEKNOLOGI INFORMASI</font><br>
						<font size="3"><b>PROGRAM STUDI S1 TEKNOLOGI INFORMASI</b></font><br>
						<font size="2">Jalan Alumni No. 3 Gedung C, Kampus USU Padang Bulan, Medan 20155</font><br>
						<font size="2">Telepon/Fax: 061-8210077 | Email: tek.informasi@usu.ac.id | Laman: http://it.usu.ac.id</font>
					</center>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr class="line"></td>
				</tr>
			</table><br>

			<div>
				<?php use Carbon\Carbon; 
					$now = Carbon::now();
				?>
				<table width="625">
					<tr>
						<td width="10">Nomor</td>
						<td width="250">: 988 /UN5.2.1.14.2.2/SPB/2022</td>
						<td width="100" class="text2">Medan, {{$date_now}}</td>
					</tr>	
					<tr>
						<td width="10">Lampiran</td>
						<td width="250">: 1 (satu lembar)</td>
					</tr>	
					<tr>
						<td width="20">Perihal</td>
						<td width="250">: Undangan Seminar Proposal Mahasiswa</td>
					</tr>			
				</table>
			</div>
			<br>
			<div>
				<table width="625">
					<tr>
						<td width="100">Yth, Sdr</td>
						<td width="100"></td>
					</tr>
					<tr>
						<td width="100">Staff Pengajar Program Studi S-1 Teknologi Informasi</td>
						<td width="100"></td>
					</tr>
					<tr>
						<td width="100">Fakultas Ilmu Komputer dan Teknologi Informasi</td>
						<td width="100"></td>
					</tr>
					<tr>
						<td width="100">Universitas Sumatera Utara</td>
						<td width="100"></td>
					</tr>
					<tr>
						<td width="100">Medan</td>
						<td width="100"></td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td>Dengan Hormat, kami mengundang Saudara untuk dapat hadir :</td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td class="text"><b>SEMINAR PROPOSAL MAHASISWA</b></td>
					</tr>
					<tr>
						<td class="text">Nama Mahasiswa : Daftar Terlampir</td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td>Yang akan dilaksanakan pada :</td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td width="50">Hari/Tanggal</td>
						<td width="280">: {{$date}}</td>
					</tr>	
					<tr>
						<td width="50">Pukul</td>
						<td width="280">: {{Carbon::createFromFormat('H:i:s', $query[0]->waktu)->format('H:i')}} WIB</td>
					</tr>	
					<tr>
						<td width="50">Tempat</td>
						<td width="280">: {{$query[0]->tempat}}</td>
					</tr>			
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td class="text4">Demi kelancaran kegiatan Seminar Proposal tersebut, kami harapkan kehadirannya agar tepat waktu.
							Untuk Daftar Penyaji Seminar dan Bahan Seminar terlampir.</td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td class="text4">Demikian undangan ini kami sampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</td>
					</tr>
				</table><br>
			</div>
			<div>
				<table width="625">
					<tr>
						<td width="300"></td>
						<td width="200">Ketua,</td>
					</tr>
					<tr>
						<td width="300"></td>
						<td width="200" class="ttd">Sarah Purnamawati, S.T., M.Sc</td>
					</tr>
					<tr>
						<td width="300"></td>
						<td width="200">NIP 198302262010122003</td>
					</tr>
					<tr>
						<td width="300" class="ttd"><font size="1">Tembusan :</font></td>
						<td width="200"></td>
					</tr>
					<tr>
						<td width="300" class="pads"><font size="1">1. Wakil Dekan I</font></td>
						<td width="200"></td>
					</tr>
					<tr>
						<td width="300" class="pads"><font size="1">2. Arsip</font></td>
						<td width="200"></td>
					</tr>
				</table>
			</div>
		</div>

		<!-- Daftar Peserta -->
		<div>
			<table width="700">
				<tr>
					<td class="text"><b><u>DAFTAR PENYAJI SEMINAR PROPOSAL MAHASISWA</u></b></td>
				</tr>
			</table>
			<table width="700">
				<tr>
					<td width="275"></td>
					<td style="padding-right: 25px;">HARI/TANGGAL</td>
					<td width="445">:  {{$date}}</td>
				</tr>
				<tr>
					<td></td>
					<td>PUKUL</td>
					<td width="445">:  {{Carbon::createFromFormat('H:i:s', $query[0]->waktu)->format('H:i')}} WIB</td>
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
					<td width="200" class="text4"><font size="2"><b>JUDUL SKRIPSI</b></font></td>
					<td width="100" class="text4"><font size="2"><b>PEMBIMBING I/II</b></font></td>
					<td width="30" class="text4"><font size="2"><b>MODERATOR / NOTULEN</b></font></td>
				</tr>
                <?php $i ?> 
				<?php $j = 1 ?>
                @for($i = 0; $i <= (count($query)-1); $i+=2)
				<tr>
					<td width="20" class="text5"><font size="2">{{$j}}</font></td>
					<td width="50" class="text5"><font size="2">{{$query[$i]->nama}}</font></td>
					<td width="200" class="text5"><font size="2">
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
					<td width="30" class="text5"><font size="2"></font></td>
				</tr>
				<?php ++$j ?>
                @endfor
			</table>
		</div>
	</center>
</body>
<script>
	window.print();
</script>
</html>