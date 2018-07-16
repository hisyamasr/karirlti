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
			$.ajax({
				url: '<?= base_url(); ?>pendaftaran/check_ktp',
				type: "POST",
				dataType: "json",
				data: { noKTP: $(this).val() },
				success: function (data) {
					// console.log(data.errorList);
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

		$('#btnTambahPendidikan').click(function(){
			var univ = $('#Universitas').val();
			var jurusan = $('#Jurusan').val();
			var jenjang = $('#Jenjang').val();
			var ipk = $('#IPK').val();
			var tahunLulus = $('#TahunLulus').val();
			var noIjazah = $('#NoIjazah').val();

			$('#isiPendidikan').append(
				'<tr>'+
					'<td>'+univ+'</td>' +
					'<td>'+jurusan+'</td>' +
					'<td>'+jenjang+'</td>' +
					'<td>'+ipk+'</td>' +
					'<td>'+tahunLulus+'</td>' +
					'<td>'+noIjazah+'</td>' +
					'<td class="text-center"><a type="button" class="fa fa-trash-alt fa-lg text-danger" onClick="deletePendidikan(this)"></a></td>' +
				'</tr>'
			);

			resetFormPendidikan();
		});
	});
</script>
	<div id="container">
	<form method="post" id="formPendaftaran" class="needs-validation" >
		<div class="card bg-light ">
			<h5 class="card-header">
				Form Rekrutmen PT. Len Telekomunikasi Indonesia
			</h5>
			<div class="card-body">
			<div class="alert alert-danger" role="alert" id="divListErr">
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
								<input class="form-control" type="text" name="noktp" id="NoKTP" required 
								pattern=".{0}|.{16,16}" title="No KTP harus 16 angka">
							</div>

							<div class="form-group col-md-8">
								<label for="Nama">Nama</label>
								<input class="form-control" type="text" name="nama" id="Nama" required>
							</div>

							<div class="form-group col-md-6">
								<label for="TempatLahir">Tempat Lahir</label>
								<input class="form-control" type="text" name="tempat_lahir" id="TempatLahir" required>
							</div>

							<div class="form-group col-md-5">
								<label for="TanggalLahir">Tanggal Lahir</label>
								<input class="form-control" type="date" name="tanggal_lahir" id="TanggalLahir" required date-date-format="DD/MM/YYYY">
								<span id="Usia" class="text-muted"></span>
							</div>
						</div>

						<div class="col-md-6">
						<div class="form-group col-md-6">
							<label for="JenisKelamin">Jenis Kelamin</label><br>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="JenisKelamin1" name="jenis_kelamin" class="custom-control-input" value="Laki-Laki" required>
								<label class="custom-control-label" for="JenisKelamin1">Laki-Laki</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="JenisKelamin2" name="jenis_kelamin" class="custom-control-input" value="Perempuan" required>
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
								<input class="form-control" type="text" name="no_handphone" id="NoHandphone" required>
							</div>
							
							<div class="form-group col-md-12">
								<label for="Email">Alamat Email</label>
								<input class="form-control" type="email" name="email" id="Email" required>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group col-md-12">
								<label for="Domisili">Domisili</label>
								<textarea class="form-control" name="tanggal_lahir" id="Domisili" rows="3" required></textarea>
							</div>

							<div class="form-group col-md-12">
								<label for="AlamatAsli">Alamat Asli</label>
								<textarea class="form-control" name="alamat_asli" id="AlamatAsli" rows="3" required></textarea>
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
								<input type="hidden" class="form-control" name="universitas" id="Universitas"/>
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
								<input type="hidden" class="form-control" name="jurusan" id="Jurusan"/>
							</div> 
						</div>

						<div class="col-md-12 row ml-1">
							<div class="form-group col-md-2">
								<label for="Jenjang">Jenjang</label>
								<select class="custom-select " name="jenjang" id="Jenjang">
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
								<input class="form-control" type="text" name="ipk" id="IPK">
							</div>

							<div class="form-group col-md-2">
								<label for="TahunLulus">Tahun Lulus</label>
								<input class="form-control datepicker_tahun col-md-5" type="text" name="tahun_lulus" id="TahunLulus">
							</div>

							<div class="form-group col-md-3">
								<label for="NoIjazah">No Ijazah</label>
								<input class="form-control col-md-12" type="text" name="tahun_lulus" id="NoIjazah">
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
					<div class="card-body row">
						<div class="col-md-4">
							<h5 class="card-title ml-3">Pengalaman terakhir</h5>
							<div class="form-group col-md-12">
								<label for="Perusahaan">Perusahaan</label>
								<input class="form-control" type="text" id="Perusahaan">
							</div>

							<div class="form-group col-md-12">
								<label for="PosisiJabatan">Posisi atau Jabatan</label>
								<input class="form-control" type="text" id="PosisiJabatan">
							</div>

							<div class="form-group col-md-12">								
								<div class="row">
									<div class="col">
										<label for="Periode">Awal Periode Kerja</label>
										<input class="form-control" type="date" id="AwalPeriodeKerja">
									</div>
									<div class="col">
										<label for="Periode">Akhir Periode Kerja</label>
										<input class="form-control" type="date" id="AkhirPeriodeKerja">
									</div>
								
								</div>
							</div>
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
							<input class="custom-file-input" type="file" name="cv_url" id="CV" required>
							<label class="custom-file-label" for="CV" id="CVFilename">Upload CV</label>
							<small class="form-text text-danger" id="ErrorCV"></small>	
							<span class="form-text text-white">
								*CV dalam format .pdf dengan ukuran <= 2 MB serta dilengkapi dengan <b>Transkrip Nilai</b> dan <b>Ijazah</b>
							</span>	
						</div>

						<div class="form-group col-md-5">
							<input class="custom-file-input" type="file" name="foto" id="Foto" required>
							<label class="custom-file-label" for="Foto" id="FotoFilename">Upload Foto</label>
							<span id="ErrorFoto" class="text-danger font-weight-bold"></span>
						</div>

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
			</div>
			<div class="card-footer text-muted text-right">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="reset" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
	</div>	
