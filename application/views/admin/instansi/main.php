<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Master Instansi Pendidikan</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Instansi Pendidikan
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
							<button id="da-instansi-create-dialog" class="btn btn-success btn-create">[+] Tambah</button>
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
									<th>Nama Instansi</th>
									<th>Singkatan</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;?>
								<?php foreach($instansi as $each_instansi): ?>
									<tr>
										<td class="no-row"><?php echo $no; ?></td>
										<td class="unit-name-row"><?php echo $each_instansi['nama']; ?></td>
										<td class="document-name-row"><?php echo $each_instansi['singkatan']; ?></td>
										<td>
											<a class="da-instansi-edit-dialog" href="#" data-value="<?php echo $each_instansi['id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
											<?php
												$id = $each_instansi['id'];
												$delete_url = "/SetupInstansi/delete_instansi/" . $id;
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
	
	<!-- modal create instansi-->
	<div id="da-instansi-create-form-div" class="form-container">
		<form id="da-instansi-create-form-val" class="da-form" action="<?php echo base_url(); ?>SetupInstansi/create_instansi" method="post" enctype="multipart/form-data">
			<div id="da-instansi-create-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Instansi</label>
					<div class="da-form-item large">
						<input class="form-control" id="nama" name="nama">
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Singkatan</label>
					<div class="da-form-item large">
						<input class="form-control" id="singkatan" name="singkatan">
					</div>
				</div>
				
			</div>
		</form>
	</div>
	
	<!-- modal edit instansi-->
	<div id="da-instansi-edit-form-div" class="form-container">
		<form id="da-instansi-edit-form-val" class="da-form" action="<?php echo base_url(); ?>SetupInstansi/update_instansi" method="post">
			<div id="da-instansi-edit-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Nama Instansi</label>
					<div class="da-form-item large">
						<input class="form-control" id="instansi-edit-nama" name="nama">
					</div>
					
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Singkatan</label>
					<div class="da-form-item large">
						<input class="form-control" id="instansi-edit-singkatan" name="singkatan">
					</div>
				</div>
				<input id="instansi-edit-id" type="hidden" name="id">
			</div>
		</form>
	</div>
	
	<?php
		foreach($instansi as $i):
			$id=$i['id'];
			$nama=$i['nama'];
			$singkatan=$i['singkatan'];
	?>
	 <!-- ============ MODAL HAPUS INSTANSI =============== -->
		<div class="modal fade" id="modal_hapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 class="modal-title" id="myModalLabel">Hapus Instansi Pendidikan</h3>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo base_url().'SetupInstansi/delete_instansi/'?>">
				<div class="modal-body">
					<p>Anda yakin mau menghapus Instansi <b><?php echo $nama;?></b></p>
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

