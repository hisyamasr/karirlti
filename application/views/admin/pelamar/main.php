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
									<th>Universitas</th>
									<th>Jurusan</th>
									<th>Jenjang</th>
									<th>Pengalaman Kerja Terakhir</th>
									<th>Pengalaman Lainnya</th>
									<th>Status Pengalaman</th>
									<th>Status Perkawinan</th>
									<th>Info Loker</th>
									<th>CV</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($pelamar as $each_pendidikan): ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><img src="<?php echo base_url(); echo 'assets/documents/foto/'.$each_pendidikan['foto_url']; ?>"</td>
										<td><?php echo $each_pendidikan['kode_posisi']; ?></td>
										<td><?php echo $each_pendidikan['no_registrasi']; ?></td>
										<td><?php echo $each_pendidikan['no_ktp']; ?></td>
										<td><?php echo $each_pendidikan['nama']; ?></td>
										<td><?php echo $each_pendidikan['tempat_lahir']; ?>, <?php echo $each_pendidikan['tanggal_lahir'];?></td>
										<td><?php echo $each_pendidikan['umur']; ?></td>
										<td><?php echo $each_pendidikan['jenis_kelamin']; ?></td>
										<td><?php echo $each_pendidikan['agama']; ?></td>
										<td><?php echo $each_pendidikan['no_handphone']; ?></td>
										<td><?php echo $each_pendidikan['email']; ?></td>
										<td><?php echo $each_pendidikan['domisili']; ?></td>
										<td><?php echo $each_pendidikan['alamat_asli']; ?></td>
										<td><?php echo $each_pendidikan['universitas']; ?></td>
										<td><?php echo $each_pendidikan['jurusan']; ?></td>
										<td><?php echo $each_pendidikan['jenjang']; ?></td>
										<td><?php echo $each_pendidikan['pengalaman_kerja']; ?></td>
										<td><?php echo $each_pendidikan['pengalaman_lainnya']; ?></td>
										<td><?php echo $each_pendidikan['status_pengalaman']; ?></td>
										<td><?php echo $each_pendidikan['status_perkawinan']; ?></td>
										<td><?php echo $each_pendidikan['info_loker']; ?></td>
										<td><a href="<?php echo base_url(); echo 'assets/documents/cv/'.$each_pendidikan['cv_url']; ?>" target="_blank"><?php echo $each_pendidikan['cv_url']; ?></a></td>
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

