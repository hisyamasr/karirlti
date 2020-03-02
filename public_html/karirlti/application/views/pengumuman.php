	<head>
		<title>Rekrutment PT LTI</title>
	</head>
	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }
		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footerbox {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
	</style>
	<script>
		$(document).ready(function(){
			$('#submitForm').click(function(){
				$.ajax({
					url: '<?= base_url(); ?>pendaftaran/test_email',
					type: "POST",
					dataType: "json",
					success: function (result) {
						if (result.status == true) {
							//window.location = '<?= base_url(); ?>/pendaftaran/success';
							//$.redirect('<?= base_url(); ?>pendaftaran/success', {'data': result.dataPelamar});
							console.log(result.errorList);
							//messageShow("success", "<li>" + result.errorList + "</li>");
						} else if (result.status == false) {
							messageShow("error", "<li>" + result.errorList + "</li>");
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr);
						messageShow("error","<li>Error</li>");
						if (xhr.status == '401') {
							// window.location = '<?= base_url(); ?>';
						}
					}
				});
			});
		});
	</script>
	<div id="container">
		<h1>Selamat Datang di halaman Rekrutmen PT. Len Telekomunikasi Indonesia</h1>
		<div id="body" align="center" >
			<!-- jika pdf -->
			<!-- <embed class="embed-responsive embed-responsive-16by9" type="application/pdf" src="<?php echo base_url('assets/hisyambsa-karir_periode_2.pdf') ?>" height="1500" > -->
				<img class="img-fluid" src="<?php echo base_url('assets/daftar_rekrutmen.jpg') ?>" alt="daftar_rekrutmen">
			</div>
			<p class="footerbox">
				<a class="btn btn-primary" style="margin-top:10px; margin-bottom:10px;" href="pendaftaran">Apply Now</a>
			</p>

		</div>