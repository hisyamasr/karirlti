<?php
	function generatePengalaman($pid){
		$getPengalaman = "SELECT * from data_pengalamankerja where data_pelamar_id = '".$pid."'";
		$query = mysqli_query($getPengalaman);
		$no = 1;
		while($get = mysqli_fetch_array($query)){
			if($get[1] != null){
			$return .= $no.". ".$get[1]." \n\r Perusahaan : ".$get[2].",\n\r Jabatan : ".$get[3]."\n\r Awal Kerja : ".$get[4].",\n\r Akhir Kerja : ".$get[5].",\n\r Deskripsi : ".$get[7]."<br style='mso-data-placement:same-cell;'>";
			$no++;
			}
		}
		
		return $return;
	}
?>
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Pelamar</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Pelamar
                </div>
				<div class="panel-body">
					<?php if(isset($message['success'])): ?>
						   <div class="alert alert-success"><?php echo $message['success']; ?></div>
					<?php endif; ?>
					<?php if(isset($message['info'])): ?>
						<div class="alert alert-info"><?php echo $message['info']; ?></div>
					<?php endif; ?>
					<?php if(isset($message['error'])): ?>
						<div class="alert alert-danger"><?php echo $message['error']; ?></div>
					<?php endif; ?>
					<?php if(isset($message['errorr'])): ?>
						<div class="alert alert-danger"><?php print_r($message['errorr']); ?></div>
					<?php endif; ?>
					
					</br>
					<?php 
						//$url=;
						//echo $this->url->current_url();
					?>
					<div class="da-panel-content da-table-container">
						<table width="100%" class="table table-striped table-bordered table-hover" id="example">
							<thead>
								<tr>
									<th>No</th>
									<th>Foto</th>
									<th>Kode Posisi</th>
									<th>No. Registrasi</th>
									<th>No. KTP</th>
									<th>Nama</th>
									<th>Tempat Tanggal Lahir</th>
									<th>Umur</th>
									<th>Jenis Kelamin</th>
									<th>Agama</th>
									<th>No. Handphone</th>
									<th>Email</th>
									<th>Domisili</th>
									<th>Alamat Asli</th>
									<th>Status Perkawinan</th>
									<th>Pendidikan</th>
									<th>Pengalaman Kerja Terakhir</th>
									<th>Sertifikasi</th>
									<th>Pengalaman Lainnya</th>
									<th>Status Pengalaman</th>
									
									<th>Info Loker</th>
									<th>CV</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($pelamar as $each_pelamar): ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><img src="<?php echo base_url(); echo 'assets/documents/foto/'.$each_pelamar['foto_url']; ?>" height="120" width="100"></td>
										<td><?php echo $each_pelamar['kode_posisi']; ?></td>
										<td><?php echo $each_pelamar['no_registrasi']; ?></td>
										<td><?php echo $each_pelamar['no_ktp']; ?></td>
										<td><?php echo $each_pelamar['nama']; ?></td>
										<td><?php echo $each_pelamar['tempat_lahir']; ?>, <?php echo $each_pelamar['tanggal_lahir'];?></td>
										<td><?php echo $each_pelamar['umur']; ?></td>
										<td><?php echo $each_pelamar['jenis_kelamin']; ?></td>
										<td><?php echo $each_pelamar['agama']; ?></td>
										<td><?php echo $each_pelamar['no_handphone']; ?></td>
										<td><?php echo $each_pelamar['email']; ?></td>
										<td><?php echo $each_pelamar['domisili']; ?></td>
										<td><?php echo $each_pelamar['alamat_asli']; ?></td>
										<td><?php echo $each_pelamar['status_perkawinan']; ?></td>
										<td>
										<?php $i = 1;?>
										<?php foreach($pendidikan as $each_pendidikan): ?>
											<b>No.</b><?php echo $i; ?></br>
											<b>Universitas :</b><?php echo $each_pendidikan['universitas']; ?></br>
											<b>Jurusan :</b><?php echo $each_pendidikan['jurusan']; ?></br>
											<b>Jenjang :</b><?php echo $each_pendidikan['jenjang']; ?></br>
											<b>IPK :</b><?php echo $each_pendidikan['ipk']; ?></br>
											<b>Tahun Lulus :</b><?php echo $each_pendidikan['tahun_lulus']; ?></br>
											<b>No. Ijazah :</b><?php echo $each_pendidikan['no_ijazah']; ?></br></br>
										<?php $i++;?>	
										<?php endforeach?>
										</td>
										<td>
										<?php echo $each_pelamar['pengalaman_kerja']; ?>
										</td>
										<td>
										<?php $k = 1;?>
										<?php foreach($sertifikasi as $each_sertifikasi): ?>
											<b>No.</b><?php echo $k; ?></br>
											<b>No. Sertifikat :</b><?php echo $each_sertifikasi['no_sertifikat']; ?></br>
											<b>Tanggal Sertifikat :</b><?php echo $each_sertifikasi['tanggal_sertifikat']; ?></br>
											<b>Lokasi :</b><?php echo $each_sertifikasi['lokasi'];?></br>
											<b>Badan Penyelenggara :</b><?php echo $each_sertifikasi['badan_penyelenggara']; ?></br></br>
										<?php $k++;?>	
										<?php endforeach?>
										</td>
										<td><?php echo $each_pelamar['pengalaman_lainnya']; ?></td>
										<td><?php echo $each_pelamar['status_pengalaman']; ?></td>
										<td><?php echo $each_pelamar['info_loker']; ?></td>
										<td><a href="<?php echo base_url(); echo 'assets/documents/cv/'.$each_pelamar['cv_url']; ?>" target="_blank"><?php echo $each_pelamar['cv_url']; ?></a></td>
									</tr>
									<?php $no++;?>
								<?php endforeach?>
								
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>
</div>

