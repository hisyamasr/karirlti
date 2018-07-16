<script>
	function flushError(){
		$('#divListErr').hide();
		$('#listError').empty();
	}

	function deletePendidikan(obj) {
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
			// 	url: '<?php //echo base_url(); ?>pendaftaran/check_ktp',
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
			var serializedForm = $('#formPendaftaran').serializeArray();
			console.log(serializedForm);
			var formData = new FormData();
			$.each(serializedForm, function(key, input){
				formData.append(input.name, input.value);
			});
			$.ajax({
				url: '<?= base_url(); ?>pendaftaran/input_data_pelamar',
				type: "POST",
				dataType: "JSON",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
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
				$('#isiPendidikan').append(
					'<tr>'+
						'<td>'+ univ +'<input type="hidden" name="universitas" value="'+ univ +'"></td>' +
						'<td>'+ jurusan +'<input type="hidden" name="jurusan" value="'+ jurusan +'"></td>' +
						'<td>'+ jenjang +'<input type="hidden" name="jenjang" value="'+ jenjang +'"></td>' +
						'<td>'+ ipk +'<input type="hidden" name="ipk" value="'+ ipk +'"></td>' +
						'<td>'+ tahunLulus +'<input type="hidden" name="tahun_lulus" value="'+ tahunLulus +'"></td>' +
						'<td>'+ noIjazah +'<input type="hidden" name="no_ijazah" value="'+ noIjazah +'"></td>' +
						'<td class="text-center"><a type="button" class="fa fa-trash-alt fa-lg text-danger" onClick="deletePendidikan(this)"></a></td>' +
					'</tr>'
				);

				resetFormPendidikan();
			// }else{
			// 	alert("Silahkan lengkapi data pendidikan Anda.!")
			// }
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
				
				<!-- <div class="card text-white bg-dark mb-3 ml-3 mr-3" >
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
						</div>
					</div>
				</div> -->

				<!-- <div class="card text-white bg-dark mb-3 ml-3 mr-3">
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
				</div> -->

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
							<tbody id="isiPendidikan">
								<!-- <tr>
									<td>tes</td>
									<td>test1</td>
									<td>test</td>
									<td>test</td>
									<td>testes</td>
									<td>est</td>
									<td class="text-center">
										<a type="button" class="fa fa-trash-alt fa-lg text-danger"></a>
									</td>
								</tr>
								<tr>
									<td>tes</td>
									<td>test1</td>
									<td>test</td>
									<td>test</td>
									<td>testes</td>
									<td>est</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>

				<!-- <div class="card text-white bg-dark mb-3 ml-3 mr-3">
					<div class="card-header">Upload Dokumen</div>
					<div class="card-body">
						<div class="form-group col-md-8">	
							<input class="custom-file-input" type="file" id="CV">
							<label class="custom-file-label" for="CV" id="CVFilename">Upload CV</label>							
							<span class="form-text text-danger font-weight-bold" id="ErrorCV"></span>							
							<span class="form-text text-white">
								*CV dalam format .pdf dengan ukuran <= 2 MB serta dilengkapi dengan <b>Transkrip Nilai</b> dan <b>Ijazah</b>
							</span>	
							<input type="hidden" name="cv_url" id="CVUrl"/>
						</div>

						<div class="form-group col-md-5">
							<input class="custom-file-input" type="file" id="Foto">
							<label class="custom-file-label" for="Foto" id="FotoFilename">Upload Foto</label>
							<span id="ErrorFoto" class="text-danger font-weight-bold"></span>
						</div>
						<img id="ImageUploaded" height="130" width="90" src="" alt=""/>
						<input type="hidden" name="foto_url" id="FotoUrl"/>
					</div>
				</div> -->
				
				<!-- <div class="form-group col-md-12 ml-2">
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
				</div> -->
				<input type="hidden" name="test" value="test1">
				<input type="hidden" name="test" value="test2">
			</div>
			<div class="card-footer text-muted text-right">
				<button type="button" class="btn btn-primary" id="submitForm">Simpan</button>
				<button type="reset" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
	</div>	
