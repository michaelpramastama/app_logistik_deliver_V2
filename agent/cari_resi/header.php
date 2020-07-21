<!DOCTYPE html>
<html lang="en">
<?php
	include '../../koneksi.php';
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../asset/image/truck.png" type="image/ico" />
  <title>AGENT</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
	<?php 
		session_start();
		// cek apakah yang mengakses halaman ini sudah login
		if($_SESSION['level']==""){
			header("location:../index.php?pesan=gagal");
		}
	?>

	<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	    <!-- Sidebar - Brand -->
	    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
	        <div class="sidebar-brand-text mx-3">AGENT</div>
	    </a>

	    <!-- Divider -->
	    <hr class="sidebar-divider my-0">

	    <!-- Nav Item - Dashboard -->
	    <li class="nav-item active">
	        <a class="nav-link" href="../index.php">
	        <i class="fas fa-fw fa-tachometer-alt"></i>
	        <span>Dashboard</span></a>
	    </li>

	    <!-- Divider -->
	    <hr class="sidebar-divider">

	    <!-- Nav Item - Pages Collapse Menu -->
	    <li class="nav-item">
	        <a class="nav-link collapsed" href="../index.php">
			    <img src="../asset/image/home.png"><i class="fas"></i>
		        <span>HOME</span>
        	</a>
	    </li>

	    <!-- Nav Item - Utilities Collapse Menu -->
	    <li class="nav-item">
	        <a class="nav-link collapsed" href="index.php">
	    	    <img src="../asset/image/box.png"><i class="fas"></i>
		        <span>BARANG MASUK</span>
	        </a>
	    </li>

	    <li class="nav-item">
	        <a class="nav-link collapsed" href="../list_transaksi/index.php">
		        <img src="../asset/image/list.png"><i class="fas"></i>
	    	    <span>LIST TRANSAKSI</span>
	        </a>
	    </li>

      	<!-- Nav Item - Utilities Collapse Menu -->
	    <li class="nav-item">
	        <a class="nav-link collapsed" href="../barang_keluar">
		        <img src="../asset/image/boxx.png"><i class="fas"></i>
		        <span>BARANG KELUAR</span>
	        </a>
	    </li>

	    <!-- Nav Item - Charts -->
	    <li class="nav-item">
	        <a class="nav-link" href="../uang_masuk">
	        <img src="../asset/image/coin.png"><i class="fas"></i>
	        <span>UANG MASUK</span></a>
	    </li>

    	<?php
	        $user = $_SESSION['username'];
	        $view = mysqli_query($koneksi, "SELECT * FROM user where username = '$user'");
	        $viewuser = mysqli_fetch_assoc($view);
	        $agent = $viewuser['agent'];
	        $viewagent = mysqli_query($koneksi, "SELECT * FROM agent where id = '$agent'");
	        $vieagent = mysqli_fetch_assoc($viewagent);
	        $komagen = $vieagent['komisi'];
	        if($komagen == '1'){
	    ?>

	      	<!-- Nav Item - Charts -->
		    <li class="nav-item">
		        <a class="nav-link" href="../kom_agent">
		        <img src="../asset/image/coin.png"><i class="fas"></i>
		        <span>KOMISI AGENT</span></a>
		    </li>

	    <?php
    	    }
      	?>

      	<!-- Nav Item - Tables -->
	    <li class="nav-item">
	        <a class="nav-link" href="../daftar_agent">
		        <img src="../asset/image/reseller.png"><i class="fas"></i>
		        <span>DAFTAR AGENT</span>
		    </a>
      	</li>

    	<!-- Nav Item - Tables -->
	    <li class="nav-item">
	        <a class="nav-link" href="../cari_resi">
		        <img src="../asset/image/notification.png"><i class="fas"></i>
		        <span>SEARCH by RESI</span>
		    </a>
	    </li>

	    <!-- Divider -->
	    <hr class="sidebar-divider d-none d-md-block">

	    <!-- Sidebar Toggler (Sidebar) -->
	    <div class="text-center d-none d-md-inline">
	        <button class="rounded-circle border-0" id="sidebarToggle"></button>
	    </div>

    </ul>
    <!-- End of Sidebar -->

	<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
	    <!-- Main Content -->
	    <div id="content">
	        <!-- Topbar -->
    	    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		        <!-- Sidebar Toggle (Topbar) -->
		        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		            <i class="fa fa-bars"></i>
		        </button>

		        <!-- Topbar Navbar -->
		        <ul class="navbar-nav ml-auto">
		            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
		            <div class="topbar-divider d-none d-sm-block"></div>
		            <!-- Nav Item - User Information -->
		            <li class="nav-item dropdown no-arrow">
			            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                	<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
		                	<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
			            </a>
			            <!-- Dropdown - User Information -->
			            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                			<a class="dropdown-item" href="#addmodalchange" data-toggle="modal">
                  				<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  				Settings
                			</a>
            			    <div class="dropdown-divider"></div>
				            <a class="dropdown-item" href="../../logout.php" >
				                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					                Logout
			                </a>
			            </div>
		            </li>
		        </ul>
	        </nav>
	        <!-- End of Topbar -->
	        
	        <!-- modal CHANGE --> 
	    	<div id="addmodalchange" class="modal fade" role="dialog">
		        <div class="modal-dialog">
		            
			            <div class="modal-content">
			            	<div class="modal-header">
		                    	<h5 class="modal-title" id="exampleModalLabel">Setting Password</h5>
			                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
		                    </button>
	                	</div>

		                <div class="modal-body">
		                    <form action="changepas.php" method="post">
	                          	<!-- Nama Penanggung jawab -->
	                          	<input type="hidden" name="username1" id="username1" value="<?php echo $_SESSION['username']; ?>">
	                          	<div class="form-group">
	                              <label>Password Lama:</label>
	                              <input type="password" class="form-control" name="passlam1" id="passlam1" placeholder="Password Lama" required>
	                          	</div>

		                        <!-- username -->
		                        <div class="form-group">
	                              <label>Password Baru:</label>
	                              <input type="password" class="form-control" name="passbar1" id="passbar1" placeholder="Password Baru" required>
		                        </div>

	                         	<div class="text-right">
	                              <button ="right" type="submit" name="insert1" id="insert1" class="btn btn-primary submitBtn">CHANGE</button>						
	                          	</div>
		                    </form>
		                </div>
		            </div>
		        </div>
			</div>
		    <!-- end modal change --> 
        <!-- Begin Page Content -->
        <div class="container-fluid">


         



            

        

