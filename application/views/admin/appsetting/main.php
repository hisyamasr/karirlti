<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">App Setting</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    App Setting
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
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Tanggal Pembukaan</th>
									<th>Tanggal Penutupan</th>
									<th>Pengumuman</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($appsetting as $each_appsetting): ?>
									<tr>
										<td><?php echo $each_appsetting['tanggal_pembukaan']; ?></td>
										<td><?php echo $each_appsetting['tanggal_penutupan']; ?></td>
										<td><?php echo $each_appsetting['text_pengumuman']; ?></td>
										<td><?php
												if ($each_appsetting['status_rekrutmen'] == 1){ ?>
												<b style="color: green">Dibuka</b>
											<?php
												}else{ 
											?>
												<b style="color: red">Ditutup</b>
											<?php 
												}
											?>
										</td>
										<td>
											<a class="da-appsetting-edit-dialog" href="#" data-value="<?php echo $each_appsetting['id']; ?>" title="Edit"><i class="btn btn-xs btn-warning">Edit </i></a>
											
										</td>
										
									</tr>
								<?php endforeach?>
								
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- modal edit appsetting-->
	<div id="da-appsetting-edit-form-div" class="form-container">
		<form id="da-appsetting-edit-form-val" class="da-form" action="<?php echo base_url(); ?>AppSetting/update_appsetting" method="post">
			<div id="da-appsetting-edit-validate-error" class="da-message error" style="display:none;"></div>
			<div class="da-form-inline">
				<div class="da-form-row">
					<label class="da-form-label">Tanggal Pembukaan</label>
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
					  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="appsetting-edit-pembukaan" name="tanggal_pembukaan"/>
					  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
						<div class="input-group-text" style="width:120%"><i class="fa fa-calendar" style="font-size:30px;"></i></div>
					  </div>
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Tanggal Penutupan</label>
					<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
					  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="appsetting-edit-penutupan" name="tanggal_penutupan"/>
					  <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
						<div class="input-group-text" style="width:120%"><i class="fa fa-calendar" style="font-size:30px;"></i></div>
					  </div>
					
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Text Pengumuman</label>
					<div class="da-form-item large">
						<textarea class="form-control" rows="5" id="appsetting-edit-pengumuman" name="text_pengumuman"></textarea>
					</div>
				</div>
				<div class="da-form-row">
					<label class="da-form-label">Status</label>
					<div class="da-form-item large">
						<select class="form-control" name="status_rekrutmen" id="appsetting-edit-status">
							<option value="1">Dibuka</option>
							<option value="0">Ditutup</option>
						</select>
					</div>
				</div>
				
				<input id="appsetting-edit-id" type="hidden" name="id">
			</div>
		</form>
	</div>
	
</div>

