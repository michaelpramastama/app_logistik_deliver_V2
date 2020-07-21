<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../asset/images/truck.png" type="image/ico" />
    <title>Logistik</title>
    <!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="asset/datatable/datatables.min.css" rel="stylesheet">  
  </head>

  <body class="nav-md">
	<?php 
		session_start();
		// cek apakah yang mengakses halaman ini sudah login
		if($_SESSION['level']==""){
			header("location:../../index.php?pesan=gagal");
		}
	?>

    <div class="container body">
	    <div class="main_container">
	        <div class="col-md-3 left_col">
		        <div class="left_col scroll-view">
		
		            <div class="navbar nav_title" style="border: 0;">
			            <a href="index.php" class="site_title"> <span>Dashboard</span></a>
		            </div>

		            <!-- menu profile quick info -->
		            <div class="profile clearfix">
			            <div class="profile_pic">
			                <img src="../asset/images/user.png" alt="..." class="img-circle profile_img">
			            </div>

              			<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $_SESSION['level']; echo"," ;echo "<br>"; ?></h2>
			                <h2><?php echo $_SESSION['username']; ?></h2>
			            </div>
		            </div>

		            <!-- /menu profile quick info -->
	            <br />

	            <!-- sidebar menu -->
	            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		            <div class="menu_section">
		                <h3>General</h3>
		                <ul class="nav side-menu">
			                <li><a href="../index.php"><img src="../asset/images/home.png"><i class="fa"></i> Home </a>
						    <li><a href="../user"><img src="../asset/images/seller.png"><i class="fa"></i> User </a>
			                <li><a href="../country"><img src="../asset/images/world.png"><i class="fa"></i> Country </a>
			                <li><a href="../agent"><img src="../asset/images/warehouse.png"><i class="fa"></i> Agent </a></li>
			                <li><a href="../notice"><img src="../asset/images/announcement.png"><i class="fa"></i> Pengumuman </a></li>
			                <li><a href="../transfer"><img src="../asset/images/transfer.png"><i class="fa"></i> Bukti Transfer </a></li>
			                <li  class="active"><a><img src="../asset/images/way.png"><i class="fa"></i>Rute</a></li>
			                <li ><a href="../sell"><img src="../asset/images/sell.png"><i class="fa"></i>Komisi</a></li>
			                <li><a href="../weight"><img src="../asset/images/weight.png"><i class="fa"></i>Berat</a></li>
		                </ul>
		            </div>
	            </div>
    	        <!-- /sidebar menu -->
	        </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
	        <div class="nav_menu">
	            <nav>
		            <div class="nav toggle">
		                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
		            </div>
		
		            <ul class="nav navbar-nav navbar-right">
		                <li class="">
			                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			                    <img src="../asset/images/user.png" alt=""><?php echo $_SESSION['username']; ?>
			                    <span class=" fa fa-angle-down"></span>
			                </a>
			                <ul class="dropdown-menu dropdown-usermenu pull-right">
			                    <li><a href="javascript:;" data-toggle="modal" data-target="#addmodalchange"> Setting</a></li>
			                    <li><a href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
			                </ul>
		                </li>
		            </ul>
	            </nav>
	        </div>
        </div>

        <!-- modal CHANGE --> 
    	<div id="addmodalchange" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">

	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal">&times;</button>
	                    <h4 class="modal-title">Setting Password</h4>
	                </div>
	                
	                <div class="modal-body">
	                    <form action="changepas.php" method="post">
                          	<!-- Nama Penanggung jawab -->
                          	<input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>">
                          	<div class="form-group">
                              <label>Password Lama:</label>
                              <input type="password" class="form-control" name="passlam" id="passlam" placeholder="Password Lama" required>
                          	</div>
	                        <br />

	                        <!-- username -->
	                        <div class="form-group">
                              <label>Password Baru:</label>
                              <input type="password" class="form-control" name="passbar" id="passbar" placeholder="Password Baru" required>
	                        </div>
	                        <br />

                         	<div class="text-right">
                              <button ="right" type="submit" name="insert" id="insert" class="btn btn-primary submitBtn">CHANGE</button>						
                          	</div>
	                    </form>
	                </div>
	            </div>
	        </div>
		</div>
	    <!-- end modal change --> 