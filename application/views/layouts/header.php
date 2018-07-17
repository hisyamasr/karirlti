<!DOCTYPE html>
<html lang="en">
<head>	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/datepicker/bootstrap-datepicker3.css"/>	
	<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css"/>
	<script type="text/javascript" src='assets/js/jquery-3.3.1.js'/></script>
	<script type="text/javascript" src='assets/js/jquery-ui.min.js'/></script>
	<script type="text/javascript" src='assets/js/popper.1.14.js'/></script>
	<script type="text/javascript" src='assets/js/bootstrap.min.js'/></script>
	<script type="text/javascript" src='assets/js/bootstrap-datepicker.min.js'/></script>
	<script type="text/javascript" src='assets/js/bootstrap-datepicker.id.min.js'/></script>
	<meta charset="utf-8">

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #f8f9fa !important;
		/* margin: 0px 20px 20px 20px; */
		/* font: 13px/20px normal Helvetica, Arial, sans-serif; */
		/* color: #4F5155; */
		font-size: 13px;
	}
	
	a{
		outline: none;
	}

	#container {
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		margin: 10px 40px;
	}
	</style>
	<script>
		function messageShow(stat, msg) {
                $("#divListErr").hide();
                $("#listError").empty();
                $("#listError").append(msg);
                if (stat == "success") {
                    $("#divListErr").removeClass().toggleClass("alert alert-success");
                } else if (stat == "error"){
                    $("#divListErr").removeClass().toggleClass("alert alert-danger");
                } else {
                    $("#divListErr").removeClass().toggleClass("alert alert-danger");
                }
                $('div').animate({ scrollTop: 0 }, 0);
                $("#divListErr").show();
            }
	</script>
</head>
<body>
	<nav class="navbar navbar-light bg-light mb-3">
		<a class="navbar-brand" href="https://www.len-telko.co.id" style="margin-left:30px;">
			<img src="assets/images/cropped-LTI-2.png" width="150" height="56" class="d-inline-block align-top" alt="">
		</a>
	</nav>