<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Master Posisi</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Posisi
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
					<div class="row-fluid">
						<div class="span12" >
							<button id="da-posisi-create-dialog" class="btn btn-success btn-create">[+] Tambah</button>
						</div>
					</div>
					</br>
					<?php 
						//$url=;
						//echo $this->url->current_url();
					?>
					<div class="da-panel-content da-table-container">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Posisi</th>
									<th>Kode Posisi</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($posisi as $each_posisi): ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $each_posisi['nama']; ?></td>
										<td><?php echo $each_posisi['kode_posisi']; ?></td>
										<td><?php
												if ($each_posisi['isActive'] == 1){ ?>
												<b style="color: green"> Aktif</b>
											<?php
												}else{ 
											?>
												<b style="color: red">Non Aktif</b>
											<?php 
												}
											?>
										</td>
										<td>
											<a class="da-posisi-edit-dialog" href="#" data-value="<?php echo $each_posisi['id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
											<?php
												$id = $each_posisi['id'];
												$delete_url = "/SetupPosisi/delete_posisi/" . $id;
											?>
											<a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $id;?>">Hapus</i></a>
											
										</td>
										
									</tr>
									<?php $no++;?>
								<?php endforeach?>
								
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- modal create posisi-->
	<div id="da-posisi-create-form-div" class="form-container">
		<form id="da-posisi-create-form-val" class="da-form" action="<?php echo base_url(); ?>SetupPosisi/create_posisi" method="post" enctype="multipart/form-data">
			<div id="da-posisi-create-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Posisi</label>
					<div class="da-form-item large">
						<input class="form-control" id="nama" name="nama">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Kode Posisi</label>
					<div class="da-form-item large">
						<input class="form-control" id="kode_posisi" name="kode_posisi">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Status</label>
					<div class="da-form-item large">
						<select class="form-control" name="status" id="status">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
					
				</div>
			</div>
		</form>
	</div>
	
	<!-- modal edit posisi-->
	<div id="da-posisi-edit-form-div" class="form-container">
		<form id="da-posisi-edit-form-val" class="da-form" action="<?php echo base_url(); ?>SetupPosisi/update_posisi" method="post">
			<div id="da-posisi-edit-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Posisi</label>
					<div class="da-form-item large">
						<input class="form-control" id="posisi-edit-nama" name="nama">
					</div>					
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Kode Posisi</label>
					<div class="da-form-item large">
						<input class="form-control" id="posisi-edit-kodeposisi" name="kode_posisi">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Status</label>
					<div class="da-form-item large">
						<select class="form-control" name="status" id="posisi-edit-status">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
				</div>
				
				<input id="posisi-edit-id" type="hidden" name="id">
			</div>
		</form>
	</div>
	
	<?php
		foreach($posisi as $i):
			$id=$i['id'];
			$nama=$i['nama'];
			$kodeposisi=$i['kode_posisi'];
	?>
	 <!-- ============ MODAL HAPUS Posisi =============== -->
		<div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Posisi</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'SetupPosisi/delete_posisi/'?>">
				<div class="modal-body">
					<p>Anda yakin mau menghapus posisi <b><?php echo $nama;?></b></p>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
					<button class="btn btn-danger">Hapus</button>
				</div>
			</form>
			</div>
			</div>
		</div>
	<?php endforeach;?>

</div>

