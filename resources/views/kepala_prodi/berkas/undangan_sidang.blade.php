<?php 
    use Carbon\Carbon;
    $now = Carbon::now();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contoh Sidang Meja Hijau - Undangan</title>
	<style type="text/css">
		body {
			width: 230mm;
			height: 100%;
			margin: 0 auto;
			padding: 0;
			font-size: 12pt;
			background: rgb(204,204,204); 
		}
     * 	{
			box-sizing: border-box;
			-moz-box-sizing: border-box;
     	}
		.main-page {
			width: 210mm;
			min-height: 297mm;
			margin: 10mm auto;
			background: white;
			box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
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
		html, body {
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
			padding-bottom: 360px;
		}
		.ttd {
			padding-top: 55px;
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
							<td style="padding-right: 15px;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Logo_of_North_Sumatra_University.svg/400px-Logo_of_North_Sumatra_University.svg.png" width="110" height="110"></td>
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
						<table width="625">
							<tr>
								<td width="10">Nomor</td>
								<td width="250">: 988 /UN5.2.1.14.2.2/SPB/2022</td>
								<td width="100" class="text2">Medan, {{Carbon::parse($now)->translatedFormat('d F Y')}}</td>
							</tr>	
							<tr>
								<td width="10">Lampiran</td>
								<td width="250">: 1 (satu lembar)</td>
							</tr>	
							<tr>
								<td width="20">Perihal</td>
								<td width="250">: Undangan Sidang Meja Hijau</td>
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
								<td class="text"><b>SIDANG MEJA HIJAU</b></td>
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
								<td width="280">: {{Carbon::parse($query[0]->tanggal_sidang)->translatedFormat('l / d F Y')}}</td>
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
								<td class="text4">Demi kelancaran kegiatan Sidang Meja Hijau, kami harapkan kehadirannya agar tepat waktu. Untuk Daftar Peserta Sidang Meja Hijau dan Bahan Sidang terlampir.</td>
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
				</center>
			</div>
		</div>
	</div>
</body>
<script>
	window.print();
</script>
</html>