<script>
	function flushError(){
		$('#divListErr').hide();
		$('#listError').empty();
	}
	$(document).ready(function(){
		flushError();
		$('.datepicker').datepicker({
			format: "dd/mm/yyyy",
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

		$('#NoKTP').change(function(){
			// $.ajax({
			// 	url: '<?= base_url(); ?>pendaftaran/check_ktp',
			// 	type: "POST",
			// 	dataType: "json",
			// 	data: { noKTP: $(this).val() },
			// 	success: function (data) {
			// 		// console.log(data.errorList);
			// 		if (data.status == false) {
			// 			messageShow("error", "<li>" + data.errorList + "</li>");
			// 		}else{
			// 			flushError();
			// 		}
			// 	}
			// })
		});

		$('#TanggalLahir').change(function(){
			var today = new Date();
			var explode = $(this).val().split("-");			
			var tglLahir = new Date(explode[0], explode[1], explode[2]);
			var selisih = today.getFullYear() - tglLahir.getFullYear();
			$('#Usia').text("Usia Anda adalah : " + Math.floor(selisih) + " Tahun");
		});

		$('#Foto').change(function(){
			var getFile = $(this).get(0).files[0];
			// console.log($(this).get(0).files[0]);
			var error = "";
			var fileName = getFile.name;
			if(getFile.type != "image/jpeg" && getFile.type != "image/png" ){
				error = "Format foto harus JPG atau PNG";
				fileName = "Cari Foto";
				$('#Foto').empty();
			}else if(getFile.size > 1000000){
				error = "Ukuran File harus >= 1 MB";
				fileName = "Cari Foto";
				$('#Foto').empty();
			}else{
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
								console.log(result.errorList);
								messageShow("success", "<li>" + result.errorList + "</li>");
							} else if (result.status == false) {
								messageShow("error", "");
								console.log(result.errorList);
								for (var i = 0; i < result.errorList.length; i++) {
									$("#listError").append("<li>" + result.errorList[i] + "</li>");
								}
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
				}
			}

			$('#ErrorFoto').text(error);
			$('#FotoFilename').text(fileName);
		});

		$('#CV').change(function(){
			var getFile = $(this).get(0).files[0];
			// console.log($(this).get(0).files[0]);
			var error = "";
			var fileName = getFile.name;
			if(getFile.type != "application/pdf"){
				error = "Format CV harus .pdf";
				fileName = "Upload CV";
				$(this).empty();
			}else if(getFile.size > 2000000){
				error = "Ukuran File harus >= 2 MB";
				fileName = "Upload CV";
				$(this).empty();
			}

			$('#ErrorCV').text(error);
			$('#CVFilename').text(fileName);			
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
			//e.preventDefault();
			var serializedForm = $('#formPendaftaran').serialize();
			var formData = new FormData();
			formData.append("input_foto", $('#Foto').get(0).files[0]);
			formData.append("formPendaftaran", serializedForm)
                $.ajax({
                    url: '<?= base_url(); ?>pendaftaran/input_data_pelamar',
                    type: "POST",
					enctype: 'multipart/form-data',
					dataType: "json",
                    data: formData,
					contentType: false,
        			processData: false,
                    success: function (result) {
                        if (result.status == true) {
                            // window.location = '<?= base_url(); ?>';
							messageShow("success", "<li>" + result.errorList + "</li>");
                        } else if (result.status == false) {
							messageShow("error", "");
							console.log(result.errorList);
                            for (var i = 0; i < result.errorList.length; i++) {
                                $("#listError").append("<li>" + result.errorList[i] + "</li>");
                            }
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
	});
</script>
	<div id="container">
	<form method="post" id="formPendaftaran" class="needs-validation" enctype="multipart/form-data">
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
								<input class="form-control" type="date" name="tanggal_lahir" id="TanggalLahir">
								<span id="Usia" class="text-muted"></span>
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

							<div class="form-group col-md-11 ml-3 mt-4">
								<input class="custom-file-input" type="file" name="foto" id="Foto">
								<input type="hidden" name="input_foto" id="InputFoto"/>
								<label class="custom-file-label" for="Foto" id="FotoFilename">Cari Foto</label>
								<span id="ErrorFoto" class="text-danger font-weight-bold"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted text-right">
				<button type="button" class="btn btn-primary" id="submitForm">Simpan</button>
				<button type="reset" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
	</div>	
