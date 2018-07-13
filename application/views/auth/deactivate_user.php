<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Deactivate User</h1>
        </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Deactivate User
                </div>
				<div class="panel-body">
				
					<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

					<?php echo form_open("auth/deactivate/".$user->id);?>

					  <p>
						<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
						<input type="radio" name="confirm" value="yes" checked="checked" />
						<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
						<input type="radio" name="confirm" value="no" />
					  </p>

					  <?php echo form_hidden($csrf); ?>
					  <?php echo form_hidden(array('id'=>$user->id)); ?>

					  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>