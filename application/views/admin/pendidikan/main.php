<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Master Pendidikan</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Pendidikan
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
							<button id="da-pendidikan-create-dialog" class="btn btn-success btn-create">[+] Tambah</button>
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
									<th>Nama Pendidikan</th>
									<th>Kode Pendidikan</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($pendidikan as $each_pendidikan): ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $each_pendidikan['nama']; ?></td>
										<td><?php echo $each_pendidikan['jenjang']; ?></td>
										<td><?php
												if ($each_pendidikan['isActive'] == 1){ ?>
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
											<a class="da-pendidikan-edit-dialog" href="#" data-value="<?php echo $each_pendidikan['id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
											<?php
												$id = $each_pendidikan['id'];
												$delete_url = "/SetupPendidikan/delete_pendidikan/" . $id;
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
	
	<!-- modal create pendidikan-->
	<div id="da-pendidikan-create-form-div" class="form-container">
		<form id="da-pendidikan-create-form-val" class="da-form" action="<?php echo base_url(); ?>SetupPendidikan/create_pendidikan" method="post" enctype="multipart/form-data">
			<div id="da-pendidikan-create-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Pendidikan</label>
					<div class="da-form-item large">
						<input class="form-control" id="nama" name="nama">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Jenjang</label>
					<div class="da-form-item large">
						<input class="form-control" id="jenjang" name="jenjang">
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
	
	<!-- modal edit pendidikan-->
	<div id="da-pendidikan-edit-form-div" class="form-container">
		<form id="da-pendidikan-edit-form-val" class="da-form" action="<?php echo base_url(); ?>SetupPendidikan/update_pendidikan" method="post">
			<div id="da-pendidikan-edit-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama pendidikan</label>
					<div class="da-form-item large">
						<input class="form-control" id="pendidikan-edit-nama" name="nama">
					</div>					
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Kode pendidikan</label>
					<div class="da-form-item large">
						<input class="form-control" id="pendidikan-edit-jenjang" name="jenjang">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Status</label>
					<div class="da-form-item large">
						<select class="form-control" name="status" id="pendidikan-edit-status">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
				</div>
				
				<input id="pendidikan-edit-id" type="hidden" name="id">
			</div>
		</form>
	</div>
	
	<?php
		foreach($pendidikan as $i):
			$id=$i['id'];
			$nama=$i['nama'];
			$jenjang=$i['jenjang'];
	?>
	 <!-- ============ MODAL HAPUS pendidikan =============== -->
		<div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Pendidikan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'SetupPendidikan/delete_pendidikan/'?>">
				<div class="modal-body">
					<p>Anda yakin mau menghapus pendidikan <b><?php echo $nama;?></b></p>
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

