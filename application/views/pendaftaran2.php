<head>
	<title>Form Pendaftaran</title>
</head>
<?= $script_captcha ?>
<script>
	var dataPendidikan = [];
	function flushError(){
		$('#divListErr').hide();
		$('#listError').empty();
	}

	function deletePendidikan(obj) {
		$arr = $('.deleteDataPend'),
		index = $arr.index(obj);
		//console.log(dataPendidikan);
		dataPendidikan.splice(index,1);		
		$(obj).closest('tr').remove();
	}

	function  resetFormPendidikan(){
		$('#Universitas2').val("");
		$('#Universitas').val("");
		$('#Universitas').attr("type", "hidden");

		$('#Jurusan2').val("");
		$('#Jurusan').val("");
		$('#Jurusan').attr("type", "hidden");

		$('#Jenjang').val("");
		$('#IPK').val("");
		$('#TahunLulus').val("");
		$('#NoIjazah').val("");
	}

	function insertPendidikan(data){
		// var formData = new FormData();
		// formData.append("data", JSON.stringify(data));
		$.ajax({
			url: '<?= base_url(); ?>pendaftaran/insert_pendidikan',
			type: "POST",
			dataType: "json",
			data: { data :JSON.stringify(data)},
			success: function (result) {
				if (result.status == true) {
					// window.location = '<?= base_url(); ?>';
					console.log(result.errorList);
					//messageShow("success", "<li>" + result.errorList + "</li>");
				} else if (result.status == false) {
					messageShow("error", "<li>" + result.errorList + "</li>");
					//console.log(result.errorList);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				messageShow("error","<li>Error</li>");
				if (xhr.status == '401') {
					// window.location = '<?= base_url(); ?>';
				}
			}
		});
	}

	function createPengalaman(){
		
		var perusahaan = $('#Perusahaan').val();
		var jabatan = $('#PosisiJabatan').val();
		var awalKerja = $('#AwalPeriodeKerja').val();
		var akhirKerja = $('#AkhirPeriodeKerja').val();
		var pengalamanKerja = 'Perusahaan: ' + perusahaan + '\n<br>Posisi/Jabatan: ' + jabatan + '\n<br>' +
							'Periode Kerja: ' + awalKerja + ' s/d ' + akhirKerja;
		$('#PengalamanTerakhir').val(pengalamanKerja);
	}

	$(document).ready(function(){
		flushError();
		$('.datepicker').datepicker({
			format: "yyyy-mm-dd",
			language: "id",
			todayHighlight: true,
			autoclose: true
		});

		$('.datepicker_tahun').datepicker({
			format: "yyyy",
			language: "id",
			minViewMode: 2,
			autoclose: true
		});

		$('.datepicker_periode').datepicker({
			format: "mm/yyyy",
			language: "id",
			minViewMode: 1,
			autoclose: true
		});

		$('#NoKTP').change(function(){
			$.ajax({
				url: '<?= base_url(); ?>pendaftaran/check_ktp',
				type: "POST",
				dataType: "json",
				data: { noKTP: $(this).val() },
				success: function (data) {
					if (data.status == false) {
						messageShow("error", "<li>" + data.errorList + "</li>");
					}else{
						flushError();
					}
				}
			})
		});

		$('#TanggalLahir').change(function(){
			var today = new Date();
			var explode = $(this).val().split("-");			
			var tglLahir = new Date(explode[0], explode[1], explode[2]);
			var selisih = today.getFullYear() - tglLahir.getFullYear();
			$('#Usia').text("Usia Anda adalah : " + Math.floor(selisih) + " Tahun");
			$('#UsiaPelamar').val(Math.floor(selisih));
		});

		$('#Foto').change(function(){
			var getFile = $(this).get(0).files[0];
			$('#ErrorFoto').empty();
			if($('#NoKTP').val() != ""){					
				var formData = new FormData();
				formData.append("input_foto", getFile);
				formData.append("no_ktp", $('#NoKTP').val());
				$.ajax({
					url: '<?= base_url(); ?>pendaftaran/upload_foto',
					type: "POST",
					enctype: 'multipart/form-data',
					dataType: "json",
					data: formData,
					contentType: false,
					processData: false,
					success: function (result) {
						if (result.status == true) {
							//console.log(result.errorList);
							$('#ImageUploaded').attr("src","assets/documents/foto/"+result.errorList.file_name);
							$('#FotoUrl').val(result.errorList.file_name);
							$('#FotoFilename').text(result.errorList.client_name);
						} else if (result.status == false) {
							$('#ErrorFoto').text(result.errorList);
							$('#FotoFilename').text("Upload Foto");
							$(this).empty();
							$('#FotoUrl').val("");
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr);
						messageShow("error","<li>Error</li>");
						if (xhr.status == '401') {
							// window.location = '<?= base_url(); ?>';
						}
					}
				});
			}else{
				alert("No KTP belum diisi.!");
				$('#FotoFilename').text("Upload Foto");
				$(this).empty();
			}
		});

		$('#CV').change(function(){
			var getFile = $(this).get(0).files[0];
			var error = "";
			$('#ErrorCV').empty();
			if($('#NoKTP').val() != ""){					
				var formData = new FormData();
				formData.append("input_cv", getFile);
				formData.append("no_ktp", $('#NoKTP').val());
				$.ajax({
					url: '<?= base_url(); ?>pendaftaran/upload_cv',
					type: "POST",
					enctype: 'multipart/form-data',
					dataType: "json",
					data: formData,
					contentType: false,
					processData: false,
					success: function (result) {
						if (result.status == true) {
							//console.log(result.errorList);
							$('#CVUrl').val(result.errorList.file_name);
							$('#CVFilename').text(result.errorList.client_name);
						} else if (result.status == false) {
							console.log(result.errorList);
							$('#ErrorCV').text(result.errorList);
							$('#CVFilename').text("Upload CV");
							$(this).empty();
							$('#CVUrl').val("");
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						///console.log(xhr);
						messageShow("error","<li>Error</li>");
						if (xhr.status == '401') {
							window.location = '<?= base_url(); ?>';
						}
					}
				});
			}else{
				alert("No KTP belum diisi.!");
				$('#CVFilename').text("Upload CV");
				$(this).empty();
			}

			//$('#ErrorCV').text(error);
			//$('#CVFilename').text(fileName);			
		});

		$('#Universitas2').change(function(){
			if($(this).val() == "Lainnya"){
				$('#Universitas').attr("type", "text");
				$('#Universitas').val("");
			}else{
				$('#Universitas').attr("type", "hidden");
				$('#Universitas').val($(this).val());
			}
		});

		$('#Jurusan2').change(function(){
			if($(this).val() == "Lainnya"){
				$('#Jurusan').attr("type", "text");
				$('#Jurusan').val("");
			}else{
				$('#Jurusan').attr("type", "hidden");
				$('#Jurusan').val($(this).val());
			}
		});

		$('#submitForm').click(function(){
			flushError();
			var serializedForm = $('#formPendaftaran').serialize();
			//console.log(dataPendidikan);.
			serializedForm += "&data_pendidikan=" + JSON.stringify(dataPendidikan);
			$.ajax({
				url: '<?= base_url(); ?>pendaftaran/input_data_pelamar',
				type: "POST",
				dataType: "json",
				data: serializedForm,
				success: function (result) {
					if (result.status == true) {
						window.location = '<?= base_url(); ?>/pendaftaran/success';
						console.log(result.errorList);
						//messageShow("success", "<li>" + result.errorList + "</li>");
					} else if (result.status == false) {
						messageShow("error", "<li>" + result.errorList + "</li>");
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr);
					messageShow("error","<li>Error</li>");
					if (xhr.status == '401') {
						// window.location = '<?= base_url(); ?>';
					}
				}
			});
		});

		$('#btnTambahPendidikan').click(function(){
			var univ = $('#Universitas').val();
			var jurusan = $('#Jurusan').val();
			var jenjang = $('#Jenjang').val();
			var ipk = $('#IPK').val();
			var tahunLulus = $('#TahunLulus').val();
			var noIjazah = $('#NoIjazah').val();
			
			//if(univ != "" && jurusan != "" && jenjang != "" && ipk != "" && tahunLulus != "" && noIjazah != "")
			//{
				dataPendidikan.push({
					"universitas":univ,
					"jurusan":jurusan,
					"jenjang":jenjang,
					"ipk":ipk,
					"tahunLulus":tahunLulus,
					"noIjazah":noIjazah
				});

				var index = $('#isiPendidikan').length + 1;
				$('#isiPendidikan').append(
					'<tr class="rowDataPendidikan">'+
						'<td>'+ univ +'<input type="hidden" name="universitas" value="'+ univ +'"></td>' +
						'<td>'+ jurusan +'<input type="hidden" name="jurusan" value="'+ jurusan +'"></td>' +
						'<td>'+ jenjang +'<input type="hidden" name="jenjang" value="'+ jenjang +'"></td>' +
						'<td>'+ ipk +'<input type="hidden" name="ipk" value="'+ ipk +'"></td>' +
						'<td>'+ tahunLulus +'<input type="hidden" name="tahun_lulus" value="'+ tahunLulus +'"></td>' +
						'<td>'+ noIjazah +'<input type="hidden" name="no_ijazah" value="'+ noIjazah +'"></td>' +
						'<td class="text-center"><a type="button" class="fa fa-trash-alt fa-lg text-danger deleteDataPend" onClick="deletePendidikan(this)"></a></td>' +
					'</tr>'
				);
				
				resetFormPendidikan();
			// }else{
			// 	alert("Silahkan lengkapi data pendidikan Anda.!")
			// }
		});

		$('input[name=status_pengalaman]').change(function(){
			if($(this).val() == "Berpengalaman"){
				$('#IsiPengalaman').show();
			}else{
				$('#IsiPengalaman').hide();
				$('#PengalamanTerakhir').val("");
				$('#Perusahaan').val("");
				$('#PosisiJabatan').val("");
				$('#AwalPeriodeKerja').val("");
				$('#AkhirPeriodeKerja').val("");
				$('#PekerjaanLainnya').val("");
		
			}
		});
		
	});	
</script>
	<div id="container">
	<form method="post" id="formPendaftaran" class="needs-validation">
		<div class="card bg-light ">
			<h5 class="card-header">
				Form Rekrutmen PT. Len Telekomunikasi Indonesia
			</h5>
			<div class="card-body">
			<div class="alert alert-danger ml-3 mr-3" role="alert" id="divListErr">
				<uL class="list-unstyled" id="listError" style="margin-bottom:0;"></ul>
			</div>
				<div class="form-group col-md-2">
					<label for="KodePosisi">Kode Posisi Lamaran</label>
					<select class="custom-select" name="kode_posisi" id="KodePosisi" required>
						<option value="">Silahkan Pilih</option>
						<?php
							foreach($posisiList as $rows){
								echo '<option value="'.$rows->kode_posisi.'">'.$rows->kode_posisi.' - '.$rows->nama.'</option>';
							}
						?>
					</select>
				</div>
				
				<div class="card text-white bg-dark mb-3 ml-3 mr-3" >
					<div class="card-header">Personal</div>
					<div class="card-body row">
						<div class="col-md-6">
							<div class="form-group col-md-5">
								<label for="NoKTP">No KTP</label>
								<input class="form-control" type="text" name="no_ktp" id="NoKTP" required pattern=".{0}|.{16,16}" title="No KTP harus 16 angka">
								
							</div>

							<div class="form-group col-md-8">
								<label for="Nama">Nama</label>
								<input class="form-control" type="text" name="nama" id="Nama">
							</div>

							<div class="form-group col-md-6">
								<label for="TempatLahir">Tempat Lahir</label>
								<input class="form-control" type="text" name="tempat_lahir" id="TempatLahir">
							</div>

							<div class="form-group col-md-5">
								<label for="TanggalLahir">Tanggal Lahir</label>
								<input class="form-control datepicker" type="text" name="tanggal_lahir" id="TanggalLahir">
								<span id="Usia" class="text-muted"></span>
								<input type="hidden" name="usia" id="UsiaPelamar">
							</div>
						</div>

						<div class="col-md-6">
						<div class="form-group col-md-6">
							<label for="JenisKelamin">Jenis Kelamin</label><br>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="JenisKelamin1" name="jenis_kelamin" class="custom-control-input" value="Laki-Laki">
								<label class="custom-control-label" for="JenisKelamin1">Laki-Laki</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="JenisKelamin2" name="jenis_kelamin" class="custom-control-input" value="Perempuan">
								<label class="custom-control-label" for="JenisKelamin2">Perempuan</label>
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="Agama">Agama</label>
								<select class="custom-select" name="agama" id="Agama">
									<option value="">Silahkan Pilih</option>
									<option value="Islam">Islam</option>
									<option value="Islam">Kristen</option>
									<option value="Protestan">Protestan</option>
									<option value="Hindu">Hindu</option>
									<option value="Budha">Budha</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="StatusPerkawinan">Status Perkawinan</label>
								<select class="custom-select" name="status_perkawinan" id="StatusPerkawinan">
									<option value="">Silahkan Pilih</option>
									<option value="Belum Kawin">Belum Kawin</option>
									<option value="Kawin">Kawin</option>
									<option value="Cerai Hidup">Cerai Hidup</option>
									<option value="Cerai Mati">Cerai Mati</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="card text-white bg-dark mb-3 ml-3 mr-3">
					<div class="card-header">Informasi Kontak</div>
					<div class="card-body row">
						<div class="col-md-3">
							<div class="form-group col-md-12">
								<label for="NoHandphone">No Handphone</label>
								<input class="form-control" type="text" name="no_handphone" id="NoHandphone">
							</div>
							
							<div class="form-group col-md-12">
								<label for="Email">Alamat Email</label>
								<input class="form-control" type="email" name="email" id="Email">
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group col-md-12">
								<label for="Domisili">Domisili</label>
								<textarea class="form-control" name="domisili" id="Domisili" rows="3"></textarea>
							</div>

							<div class="form-group col-md-12">
								<label for="AlamatAsli">Alamat Asli</label>
								<textarea class="form-control" name="alamat_asli" id="AlamatAsli" rows="3"></textarea>
							</div>
						</div>						
					</div>
				</div>

				<div class="card text-white bg-dark mb-3 ml-3 mr-3">
					<div class="card-header">Informasi Pendidikan</div>
					<div class="card-body row">
						<div class="row col-md-11 ml-1">
							<div class="form-group col-md-4">
								<label for="Universitas2">Universitas</label>
								<select class="custom-select" id="Universitas2">
									<option value="">Silahkan Pilih</option>
									<?php
										foreach($universitasList as $rows){
											echo '<option value="'.$rows->nama.'">'.$rows->nama.'</option>';
										}
									?>
									<option value="Lainnya">Lainnya</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label for="Universitas"> &nbsp;</label>
								<input type="hidden" class="form-control" id="Universitas"/>
							</div> 
						</div>
						
						<div class="col-md-12 row ml-1">
							<div class="form-group col-md-2">
								<label for="Jurusan2">Jurusan</label>
								<select class="custom-select " id="Jurusan2">
									<option value="">Silahkan Pilih</option>
									<?php
										foreach($jurusanList as $rows){
											echo '<option value="'.$rows->nama.'">'.$rows->nama.'</option>';
										}
									?>
									<option value="Lainnya">Lainnya</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label for="Jurusan"> &nbsp;</label>
								<input type="hidden" class="form-control" id="Jurusan"/>
							</div> 
						</div>

						<div class="col-md-12 row ml-1">
							<div class="form-group col-md-2">
								<label for="Jenjang">Jenjang</label>
								<select class="custom-select " id="Jenjang">
									<option value="">Silahkan Pilih</option>
									<?php
										foreach($jenjangList as $rows){
											echo '<option value="'.$rows->jenjang.'">'.$rows->jenjang.'</option>';
										}
									?>
								</select>
							</div>

							<div class="form-group col-md-1">
								<label for="IPK">IPK</label>
								<input class="form-control" type="text" id="IPK">
								<span class="form-text text-muted">*ex: 4.00</span>
							</div>

							<div class="form-group col-md-2">
								<label for="TahunLulus">Tahun Lulus</label>
								<input class="form-control datepicker_tahun col-md-5" type="text" id="TahunLulus">
							</div>

							<div class="form-group col-md-3">
								<label for="NoIjazah">No Ijazah</label>
								<input class="form-control col-md-12" type="text" id="NoIjazah">
							</div>
							<div class="form-group col-md-2">
								<label for="btnTambahPendidikan"> &nbsp; </label>
								<button class="btn btn-success mt-4" type="button" id="btnTambahPendidikan"><i class="fa fa-plus-square"></i> Tambah</button>
							</div>
						</div>

						
					</div>
					<div class="card-footer">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="text-center" style="width:30%">Universitas</th>
									<th scope="col" class="text-center" style="width:25%">Jurusan</th>
									<th scope="col" class="text-center" style="width:10%">Jenjang</th>
									<th scope="col" class="text-center" style="width:8%">IPK</th>
									<th scope="col" class="text-center" style="width:10%">Tahun Lulus</th>
									<th scope="col" class="text-center" style="width:10%">No Ijazah</th>
									<th scope="col" class="text-center" style="width:5%">Action</th>
								</tr>						
							</thead>
							<tbody id="isiPendidikan"></tbody>
						</table>
					</div>
				</div>

				<div class="card text-white bg-dark mb-3 ml-3 mr-3">
					<div class="card-header">Riwayat Pekerjaan</div>
					<div class="form-group col-md-5 ml-3">
						<label for="StatusPengalaman">Pengalaman Kerja</label><br>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="StatusPengalaman1" name="status_pengalaman" class="custom-control-input" value="Fresh Graduate" required>
							<label class="custom-control-label" for="StatusPengalaman1">Fresh Graduate</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="StatusPengalaman2" name="status_pengalaman" class="custom-control-input" value="Berpengalaman" required>
							<label class="custom-control-label" for="StatusPengalaman2">Berpengalaman</label>
						</div>
					</div>
					<div class="card-body row" id="IsiPengalaman" style="display:none;">
						<div class="col-md-4">
							<h5 class="card-title ml-3">Pengalaman terakhir</h5>
							<div class="form-group col-md-12">
								<label for="Perusahaan">Perusahaan</label>
								<input class="form-control" type="text" id="Perusahaan" onChange="createPengalaman()">
							</div>

							<div class="form-group col-md-12">
								<label for="PosisiJabatan">Posisi atau Jabatan</label>
								<input class="form-control" type="text" id="PosisiJabatan" onChange="createPengalaman()">
							</div>

							<div class="form-group col-md-12">								
								<div class="row">
									<div class="col">
										<label for="Periode">Awal Periode Kerja</label>
										<input class="form-control datepicker_periode" type="text" id="AwalPeriodeKerja" onChange="createPengalaman()">
									</div>
									<div class="col">
										<label for="Periode">Akhir Periode Kerja</label>
										<input class="form-control datepicker_periode" type="text" id="AkhirPeriodeKerja" onChange="createPengalaman()">
									</div>
								
								</div>
							</div>
							<input type="hidden" name="pengalaman_terakhir" id="PengalamanTerakhir"> 
						</div>
						<div class="col-md-8">
							<h5 class="card-title ml-3">Pengalaman Lainnya</h5>
							
							<div class="form-group col-md-12">
								<textarea name="pekerjaan_lainnya" rows="8" class="form-control" id="PekerjaanLainnya"></textarea>
								<span class="form-text text-white">*Setiap pekerjaan di pisahkan dengan ";"</span>
							</div>
						</div>
					</div>
				</div>

				<div class="card text-white bg-dark mb-3 ml-3 mr-3">
					<div class="card-header">Upload Dokumen</div>
					<div class="card-body">
						<div class="form-group col-md-8">	
							<input class="custom-file-input" type="file" id="CV">
							<label class="custom-file-label" for="CV" id="CVFilename">Upload CV</label>							
							<span class="form-text text-danger font-weight-bold" id="ErrorCV"></span>							
							<span class="form-text text-white">
								*CV dalam format <b>.pdf</b> dengan ukuran <b><= 2 MB</b> serta dilengkapi dengan <b>Transkrip Nilai</b> dan <b>Ijazah</b>
							</span>	
							<input type="hidden" name="cv_url" id="CVUrl"/>
						</div>

						<div class="form-group col-md-5">
							<input class="custom-file-input" type="file" id="Foto">
							<label class="custom-file-label" for="Foto" id="FotoFilename">Upload Foto</label>
							<span id="ErrorFoto" class="text-danger font-weight-bold"></span>
							<span class="form-text text-white">
								*Foto dalam format <b>.jpg</b> atau <b>.png</b> dengan ukuran <b><= 1 MB</b>
							</span>	
						</div>
						<img id="ImageUploaded" height="130" width="90" src="" alt=""/>
						<input type="hidden" name="foto_url" id="FotoUrl"/>
					</div>
				</div>
				
				<div class="form-group col-md-12 ml-2">
					<label for="InfoLoker" >Info Loker</label> <br>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioInline1" name="info_loker" class="custom-control-input" value="Website LTI">
						<label class="custom-control-label" for="customRadioInline1">Website LTI</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioInline2" name="info_loker" class="custom-control-input" value="Media Sosial">
						<label class="custom-control-label" for="customRadioInline2">Media Sosial</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioInline3" name="info_loker" class="custom-control-input" value="Teman">
						<label class="custom-control-label" for="customRadioInline3">Teman</label>
					</div>
				</div>

				<div class="form-group col-md-12 ml-2" style="padding-left:40%;">
					<?= $captcha ?>
				</div>					
				
			</div>
			<div class="card-footer text-muted text-right">
				<button type="button" class="btn btn-primary" id="submitForm">Simpan</button>
				<button type="reset" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
	</div>	
