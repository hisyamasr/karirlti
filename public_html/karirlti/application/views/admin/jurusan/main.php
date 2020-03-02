<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Master Jurusan</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Jurusan
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
							<button id="da-jurusan-create-dialog" class="btn btn-success btn-create">[+] Tambah</button>
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
									<th>Nama Jurusan</th>
									<th>Kode Jurusan</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($jurusan as $each_jurusan): ?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $each_jurusan['nama']; ?></td>
										<td><?php echo $each_jurusan['kode_jurusan']; ?></td>
										<td><?php
												if ($each_jurusan['isActive'] == 1){ ?>
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
											<a class="da-jurusan-edit-dialog" href="#" data-value="<?php echo $each_jurusan['id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
											<?php
												$id = $each_jurusan['id'];
												$delete_url = "/SetupJurusan/delete_jurusan/" . $id;
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
	
	<!-- modal create jurusan-->
	<div id="da-jurusan-create-form-div" class="form-container">
		<form id="da-jurusan-create-form-val" class="da-form" action="<?php echo base_url(); ?>SetupJurusan/create_jurusan" method="post" enctype="multipart/form-data">
			<div id="da-jurusan-create-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Jurusan</label>
					<div class="da-form-item large">
						<input class="form-control" id="nama" name="nama">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Kode Jurusan</label>
					<div class="da-form-item large">
						<input class="form-control" id="kode_jurusan" name="kode_jurusan">
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
	
	<!-- modal edit jurusan-->
	<div id="da-jurusan-edit-form-div" class="form-container">
		<form id="da-jurusan-edit-form-val" class="da-form" action="<?php echo base_url(); ?>SetupJurusan/update_jurusan" method="post">
			<div id="da-jurusan-edit-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Jurusan</label>
					<div class="da-form-item large">
						<input class="form-control" id="jurusan-edit-nama" name="nama">
					</div>					
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Kode Jurusan</label>
					<div class="da-form-item large">
						<input class="form-control" id="jurusan-edit-kodejurusan" name="kode_jurusan">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Status</label>
					<div class="da-form-item large">
						<select class="form-control" name="status" id="jurusan-edit-status">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
				</div>
				
				<input id="jurusan-edit-id" type="hidden" name="id">
			</div>
		</form>
	</div>
	
	<?php
		foreach($jurusan as $i):
			$id=$i['id'];
			$nama=$i['nama'];
			$kodejurusan=$i['kode_jurusan'];
	?>
	 <!-- ============ MODAL HAPUS jurusan =============== -->
		<div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Jurusan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'SetupJurusan/delete_jurusan/'?>">
				<div class="modal-body">
					<p>Anda yakin mau menghapus jurusan <b><?php echo $nama;?></b></p>
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

