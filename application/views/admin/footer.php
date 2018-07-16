

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom/instansi.modal.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom/jurusan.modal.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom/posisi.modal.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom/pendidikan.modal.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
		
		$('#dataTables-pelamar').DataTable({
			scrollX: true
		});
		
		$('#example').DataTable( {  
			 dom: 'Bfrtip',  
			 buttons: [  
			 {"extends":'excel', "text":'<i class="glyphicon glyphicon-export"> Export</i>',"className": 'btn btn-primary'}
			 ]  ,
			 scrollX: true
		});  
    });
    </script>

</body>

</html>