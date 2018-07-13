<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Group</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Edit User
                </div>
				<div class="panel-body">
					<p><?php echo lang('edit_group_subheading');?></p>

					<div id="infoMessage"><?php echo $message;?></div>

					<?php echo form_open(current_url());?>

						  <p>
								<?php echo lang('edit_group_name_label', 'group_name');?> <br />
								<?php echo form_input($group_name);?>
						  </p>

						  <p>
								<?php echo lang('edit_group_desc_label', 'description');?> <br />
								<?php echo form_input($group_description);?>
						  </p>

						  <p><?php echo form_submit('submit', lang('edit_group_submit_btn'));?></p>

					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>