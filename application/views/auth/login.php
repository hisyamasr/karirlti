<link href="<?php echo base_url(); ?>assets_login/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url(); ?>assets_login/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets_login/js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets_login/css/login.css">
<!------ Include the above in your HEAD tag ---------->

<link href="<?php echo base_url(); ?>assets_login/css/font-awesome.min.css" rel="stylesheet">


<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
  			<div id="iosBlurBg">
  				<div id="whiteBg"></div>
  			</div>
  			<div id="bottomEnter"></div>
  			<div id="bottomBlurBg"></div>
  			<!-- Login Form -->
  			<div class="loginForm">
  				<div class="title">
  					<p>LOG INTO<br><span>SYSTEM</span></p>
					<!-- <h1><?php echo lang('login_heading');?></h1> -->
					<!--<p><?php echo lang('login_subheading');?></p>-->
  					<hr>
  					<hr class="short">
  				</div>
				<div id="infoMessage"><?php echo $message;?></div>
				<div class="col-3">
					<?php echo form_open("auth/login");?>
						  <p>
							<?php echo form_input($identity);?>
						  </p>

						  <p>
							<?php echo form_input($password);?>
						  </p>

						  <p>
							<?php echo form_checkbox('remember', '1', FALSE, 'id="remember" style="margin:4px -59px 0;"' );?>Remember Me <br>
						  </p>
							<p></p>
<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
					
				</div>
				
  			</div>
  				<div class="enterButton" style="width:100px">
	  				<i class="fa fa-lock fa-2x text-white"></i><br>
	  				<?php echo form_submit('submit', 'Enter');?>
	  			</div>
  				<?php echo form_close();?>
		</div>
	</div>
</div>