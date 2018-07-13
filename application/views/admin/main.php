<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Users</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Data User
                </div>
				<div class="panel-body">
					<?php if(isset($message['success'])): ?>
							   <div class="da-message success"><?php echo $message['success']; ?></div>
							<?php endif; ?>
							<?php if(isset($message['info'])): ?>
								<div class="da-message info"><?php echo $message['info']; ?></div>
							<?php endif; ?>
							<?php if(isset($message['error'])): ?>
								<div class="da-message error"><?php echo $message['error']; ?></div>
							<?php endif; ?>
							<?php if(isset($message['errorr'])): ?>
								<div class="da-message error"><?php print_r($message['errorr']); ?></div>
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
								<table id="da-instansi-datatable-numberpaging" class="da-table">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Instansi</th>
											<th>Singkatan</th>
											<th style="width: 70px;"></th>
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
                                                    <a class="da-instansi-edit-dialog" href="#" data-value="<?php echo $each_instansi['instansi_penjualan_id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
                                                    <?php
                                                        $instansi_id = $each_instansi['id'];
                                                        $delete_url = "/setupinstansi/delete_instansi/" . $instansi_id;
                                                    ?>
                                                    <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_hapus<?php echo $instansi_id;?>">Hapus</i></a>
                                                    
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
</div>