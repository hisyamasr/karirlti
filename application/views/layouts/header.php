<!DOCTYPE html>
<html lang="en">
<head>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datepicker/bootstrap-datepicker3.css"/>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/global.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fontawesome-5.1/css/all.css">
	<script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-3.3.1.js'/></script>
	<script type="text/javascript" src='<?php echo base_url();?>assets/js/jquery-ui.js'/></script>
	<!-- <script type="text/javascript" src='assets/js/popper.1.14.js'/></script> -->
	<script type="text/javascript" src='<?php echo base_url();?>assets/js/bootstrap.min.js'/></script>
	<script type="text/javascript" src='<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js'/></script>
	<script type="text/javascript" src='<?php echo base_url();?>assets/js/bootstrap-datepicker.id.min.js'/></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<meta charset="utf-8">

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }
		html {
			height: 100%;
			box-sizing: border-box;
		}

		*,
		*:before,
		*:after {
			box-sizing: inherit;
		}

		body {
			position: relative;
			background-color: #f8f9fa !important;
			/* margin: 0px 20px 20px 20px; */
			/* font: 13px/20px normal Helvetica, Arial, sans-serif; */
			/* color: #4F5155; */
			font-size: 13px;
			margin: 0;
			padding-bottom: 4rem;
			min-height: 100%;
		}
		
		a{
			outline: none;
		}

		#container {
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
			margin: 10px 40px;
		}

		#listError > li > p {
			margin-bottom: 0px;
		}
	</style>
	<script>
		function messageShow(stat, msg) {
			$("#divListErr").hide();
			$("#listError").empty();
			$("#listError").append(msg);
			if (stat == "success") {
				$("#divListErr").removeClass().toggleClass("alert alert-success ml-3 mr-3");
			} else if (stat == "error"){
				$("#divListErr").removeClass().toggleClass("alert alert-danger ml-3 mr-3");
			} else {
				$("#divListErr").removeClass().toggleClass("alert alert-danger ml-3 mr-3");
			}
			$("div").animate({ scrollTop: 0 }, 0);
			// $("div").scrollTop(0);
			$("#divListErr").show();
         }

		 function warningShow(msg) {
			$("#isiWarning").text(msg);
			$("#warning").dialog({
				modal: true,
				buttons: {
					Ok: function () {
						$(this).dialog("close");
					}
				}
			});
        }
	</script>
</head>
<body>
	<nav class="navbar navbar-light bg-light mb-3">
		<a class="navbar-brand" href="https://www.len-telko.co.id" style="margin-left:30px;">
			<img src="assets/images/cropped-LTI-2.png" width="150" height="56" class="d-inline-block align-top" alt="">
		</a>
	</nav>
	<div id="warning" title="Peringatan !" style="display:none;">
		<br />
		<div class="col-md-2">
			<img src="assets/images/alert.png" height="42" width="42">
		</div>
		<div class="col-md-10" style="padding-left:3em"><span id="isiWarning"></span></div>
	</div>