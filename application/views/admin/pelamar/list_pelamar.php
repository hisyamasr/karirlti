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
									<th>Universitas</th>
									<th>Jurusan</th>
									<th>Jenjang</th>
									<th>IPK</th>
									<th>Tahun Lulus</th>
									<th>No. Ijazah</th>
									
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
										<td><?php echo $each_pelamar['universitas']; ?></td>
										<td><?php echo $each_pelamar['jurusan']; ?></td>
										<td><?php echo $each_pelamar['jenjang']; ?></td>
										<td><?php echo $each_pelamar['ipk']; ?></td>
										<td><?php echo $each_pelamar['tahun_lulus']; ?></td>
										<td><?php echo $each_pelamar['no_ijazah']; ?></td>
										
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

