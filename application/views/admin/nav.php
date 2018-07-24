<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="assets/images/cropped-LTI-2.png" width="150" height="56" class="d-inline-block align-top" alt="">
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="<?php echo base_url();?>auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" style="margin-top:57px;">
                <div class="sidebar-nav navbar-collapse" >
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>DataPelamar"><i class="fa fa-dashboard fa-fw"></i> Data Rekrutmenr<span class="fa arrow"></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>DataPelamar">Data Pelamar</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>DataPelamar/list_by_pendidikan">Pelamar By Pendidikan</a>
                                </li>
								
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Data Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>AppSetting">AppSetting</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>SetupInstansi">Instansi</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>SetupJurusan">Jurusan</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>SetupPendidikan">Pendidikan</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>SetupPosisi">Posisi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    </div>
    <!-- /#wrapper -->