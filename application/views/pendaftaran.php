<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/datepicker/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.min.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/datepicker-gijgo.min.css"/> -->
	<script type="text/javascript" src='assets/js/jquery-3.3.1.js'/></script>
	<script type="text/javascript" src='assets/js/jquery-ui.min.js'/></script>
	<script type="text/javascript" src='assets/js/popper.1.14.js'/></script>
	<script type="text/javascript" src='assets/js/bootstrap.min.js'/></script>
	<script type="text/javascript" src='assets/js/bootstrap-datepicker.min.js'/></script>
	<!-- <script type="text/javascript" src='assets/js/bootstrap-datepicker.id.min.js'/></script> -->
	<!-- <script type="text/javascript" src='assets/js/datepicker-gijgo.min.js'/></script> -->
	<meta charset="utf-8">
	<title>Pendaftaran</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 0px 40px 40px 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}
	</style>
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker({
				format: "dd/mm/yyyy",
				language: "id",
				todayHighlight: true
			});

			$('#NoKTP').keyup(function(){
				console.log($(this).val());
			});
		});
	</script>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="https://www.len-telko.co.id">
			<!-- <img src="assets/images/cropped-LTI-2.png" width="150" height="56" class="d-inline-block align-top" alt=""> -->
		</a>
	</nav>
	<div class="jumbotron">
	<form method="post" action="pendaftaran/simpan_data" id="formPendaftaran">
		<div class="card">
			<h3 class="card-header">
				Selamat Datang 
				<!-- di halaman Rekrutmen PT. Len Telekomunikasi Indonesia -->
			</h3>
			<div class="card-body">
				<div class="form-group col-md-5">
					<label for="NoKTP">No KTP</label>
					<input class="form-control form-control-sm" type="text" name="noktp" id="NoKTP">
				</div>

				<div class="form-group col-md-5">
					<label for="Nama">Nama</label>
					<input class="form-control form-control-sm" type="text" name="nama" id="Nama">
				</div>

				<div class="form-group col-md-4">
					<label for="TempatLahir">Tempat Lahir</label>
					<input class="form-control form-control-sm" type="text" name="tempat_lahir" id="TempatLahir">
				</div>

				<div class="form-group col-md-2">
					<label for="TanggalLahir">Tanggal Lahir</label>
					<input class="form-control form-control-sm datepicker" type="text" name="tanggal_lahir" id="TanggalLahir">
				</div>

				<div class="form-group row">
					<label for="NoKTP" class="col-sm-2 col-form-label">No KTP</label>
					<div class="col-sm-5">
						<input class="form-control form-control-sm" type="text" name="noktp" id="NoKTP">
					</div>
				</div>

				

				<div class="form-group row">
					<label for="NoKTP" class="col-sm-1 col-form-label">No KTP</label>
					<div class="col-sm-5">
						<input class="form-control form-control-sm" type="text" name="noktp" id="NoKTP">
					</div>
				</div>

				<div class="form-group row">
					<label for="NoKTP" class="col-sm-1 col-form-label">No KTP</label>
					<div class="col-sm-5">
						<input class="form-control form-control-sm" type="text" name="noktp" id="NoKTP">
					</div>
				</div>

				<div class="form-group">
					<input class="form-control" type="text" placeholder="Nama" name="nama">
					<input class="form-control" type="text" placeholder="Tempat Lahir" name="tempat_lahir">
					<input class="form-control" type="text" placeholder="Tanggal Lahir" name="tanggal_lahir">
					<input class="form-control" type="text" placeholder="No KTP" name="noktp">
					<input class="form-control" type="text" placeholder="No KTP" name="noktp">
					<input class="form-control" type="text" placeholder="No KTP" name="noktp">
				</div>
				
			</div>
			<div class="card-footer text-muted text-right">
				<a href="#" class="btn btn-primary">Simpan</a>
				<a href="#" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
	</div>
	
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> -->
	
	
</body>
</html>