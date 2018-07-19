<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
	<title>Rekrutment PT LTI</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	#body {
		margin: 0 15px 0 15px;
	}
	</style>
</head>
	<div class="card text-center ml-5 mr-5">
		<div class="card-header">
			<h3>Konfirmasi Rekrutmen PT. Len Telekomunikasi Indonesia</h3>
		</div>
		<div class="card-body">
			<i class="card-title fa fa-check-circle text-success" style="font-size:80px;"></i>
			<h5 class="card-title">Terima Kasih</h5>
			<p class="card-text">Konfirmasi data lamaran berhasil. Tahap selanjutnya akan diumumkan melalui e-mail pendaftar.</p>
			<table class="table table-solid" style="width:45%; margin-left:30%;">
				<tbody>
					<tr>
						<th scope="row" class="text-left" style="width:35%;">No Registrasi</th>
						<td style="width:3%;">:</td>
						<td class="text-left" style="width:65%;"><?= $data->no_registrasi ?></td>
					</tr>
					<tr>
						<th scope="row" class="text-left" >No KTP</th>
						<td>:</td>
						<td class="text-left" ><?= $data->no_ktp ?></td>
					</tr>
					<tr>
						<th scope="row" class="text-left">Nama</th>
						<td>:</td>
						<td class="text-left" ><?= $data->nama ?></td>
					</tr>
					<tr>
					<?php
						$explode = explode("-", $data->tanggal_lahir);
					?>
						<th scope="row" class="text-left">Tempat, Tanggal lahir</th>
						<td>:</td>
						<td class="text-left" ><?= $data->tempat_lahir ?>, <?= $explode[2]."/".$explode[1]."/".$explode[0] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="card-footer text-muted">
			<!-- <a href="<?php echo base_url(); ?>" class="btn btn-primary">Kembali</a> -->
		</div>
	</div>

	<?php
		// print_r($data);
	
	?>