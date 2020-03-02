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
									<th>Pengalaman Lainnya</th>
									<th>Status Pengalaman</th>
									
									<th>Info Loker</th>
									<th>CV</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; $index = 0;?>
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
										<?php //var_dump($pendidikan[$no]); ?>
										<?php

										?>
										<?php foreach($pendidikan[$index][1] as $each_pendidikan): ?>
										<?php //var_dump($each_pendidikan); ?>
											<b>No.</b><?php echo $i; ?></br>
											<b>Universitas :</b><?= $each_pendidikan->universitas; ?></br>
											<b>Jurusan :</b><?= $each_pendidikan->jurusan; ?></br>
											<b>Jenjang :</b><?= $each_pendidikan->jenjang; ?></br>
											<b>IPK :</b><?= $each_pendidikan->ipk; ?></br>
											<b>Tahun Lulus :</b><?= $each_pendidikan->tahun_lulus; ?></br>
											<b>No. Ijazah :</b><?= $each_pendidikan->no_ijazah; ?></br></br>
										
										<?php $i++;?>	
										
										<?php endforeach?>
										</td>
										<td>
										<?php echo $each_pelamar['pengalaman_kerja']; ?>
										</td>
										<td><?php echo $each_pelamar['pengalaman_lainnya']; ?></td>
										<td><?php echo $each_pelamar['status_pengalaman']; ?></td>
										<td><?php echo $each_pelamar['info_loker']; ?></td>
										<td><a href="<?php echo base_url(); echo 'assets/documents/cv/'.$each_pelamar['cv_url']; ?>" target="_blank"><?php echo $each_pelamar['cv_url']; ?></a></td>
									</tr>
									<?php $no++; $index++;?>
								<?php endforeach?>
								
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>
</div>

