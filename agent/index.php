<!DOCTYPE html>
<?php
  include '../koneksi.php';
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="asset/image/truck.png" type="image/ico" />
  <title>AGENT</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
        	<a class="nav-link" href="index.php">
        	<i class="fas fa-fw fa-tachometer-alt"></i>
        	<span>Dashboard</span></a>
      	</li>

      	<!-- Divider -->
      	<hr class="sidebar-divider">

	    <!-- Nav Item - Pages Collapse Menu -->
    	<li class="nav-item">
        	<a class="nav-link collapsed" href="index.php">
        		<img src="asset/image/home.png"><i class="fas"></i>
          		<span>HOME</span>
        	</a>
      	</li>

      	<!-- Nav Item - Utilities Collapse Menu -->
      	<li class="nav-item">
        	<a class="nav-link collapsed" href="barang_masuk">
           		<img src="asset/image/box.png"><i class="fas"></i>
          		<span>BARANG MASUK</span>
        	</a>
      	</li>
      
       	<!-- Nav Item - Utilities Collapse Menu -->
      	<li class="nav-item">
        	<a class="nav-link collapsed" href="list_transaksi">
          		<img src="asset/image/list.png"><i class="fas"></i>
         	 	<span>LIST TRANSAKSI</span>
        	</a>
      	</li>

      	<!-- Nav Item - Utilities Collapse Menu -->
      	<li class="nav-item">
        	<a class="nav-link collapsed" href="barang_keluar">
         		<img src="asset/image/boxx.png"><i class="fas"></i>
         	 	<span>BARANG KELUAR</span>
        	</a>
      	</li>

     	<!-- Nav Item - Charts -->
      	<li class="nav-item">
        	<a class="nav-link" href="uang_masuk">
          		<img src="asset/image/coin.png"><i class="fas"></i>
          		<span>UANG MASUK</span>
          	</a>
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
		        <a class="nav-link" href="kom_agent">
		          <img src="asset/image/coin.png"><i class="fas"></i>
		          <span>KOMISI AGENT</span>
		      	</a>
		    </li>

	    <?php
	        }
	   	?>
      
      	<!-- Nav Item - Tables -->
      	<li class="nav-item">
        	<a class="nav-link" href="daftar_agent">
         		<img src="asset/image/reseller.png"><i class="fas"></i>
          		<span>DAFTAR AGENT</span>
          	</a>
      	</li>


       <!-- Nav Item - Tables -->
      	<li class="nav-item">
        	<a class="nav-link" href="cari_resi">
          		<img src="asset/image/notification.png"><i class="fas"></i>
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
                			<a class="dropdown-item" href="../logout.php" >
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

		        <!-- Page Heading -->
		        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		        </div>

		        <!-- Content Row -->
		        <div class="row">

            	<!-- Total Semua Transaksi -->
            	<div class="col-xl-3 col-md-6 mb-4">
              		<div class="card border-left-primary shadow h-100 py-2">
                		<div class="card-body">
                  			<div class="row no-gutters align-items-center">
                    			<div class="col mr-2">

                      				<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Semua Transaksi
                      				</div>

                          			<div class="h5 mb-0 font-weight-bold text-gray-800">
	                              		<?php
			                                  $query2 = "SELECT * FROM user WHERE username = '$_SESSION[username]'";
			                                  $result2 = mysqli_query($koneksi, $query2);
			                                  $data = mysqli_fetch_assoc($result2);


			                                  $query3 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where agent = $data[agent]";
			                                  $result3 = mysqli_query($koneksi, $query3);
			                                  $data1 = mysqli_fetch_assoc($result3);

			                                  echo $data1['jumlah'];
	                              		?>
                          			</div>
                    			</div>

                    			<div class="col-auto">
                      				<i class="fas fa-calendar fa-2x text-gray-300"></i>
                    			</div>
                  			</div>
                		</div>
              		</div>
            	</div>

            	<!-- Total Transaksi /Tahun -->
            	<div class="col-xl-3 col-md-6 mb-4">
              		<div class="card border-left-primary shadow h-100 py-2">
                		<div class="card-body">
                  			<div class="row no-gutters align-items-center">
                    			<div class="col mr-2">

                      				<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Transaksi /Tahun
                      				</div>

                          			<div class="h5 mb-0 font-weight-bold text-gray-800">
			                            <?php
			                                  $Y = date('Y');
			                                  $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where year(tanggal) = '$Y' AND agent ='$data[agent]'";
			                                    $result4 = mysqli_query($koneksi, $query4);
			                                    $data2 = mysqli_fetch_assoc($result4);

			                                    echo "$data2[jumlah]";
			                            ?>
                          			</div>
                    			</div>
                    
                    			<div class="col-auto">
                      				<i class="fas fa-calendar fa-2x text-gray-300"></i>
                    			</div>
                  			</div>
                		</div>
              		</div>
            	</div>

            	<!-- Pendapatan Agent (KG) -->
            	<div class="col-xl-3 col-md-6 mb-4">
              		<div class="card border-left-success shadow h-100 py-2">
                		<div class="card-body">
                  			<div class="row no-gutters align-items-center">
                    			<div class="col mr-2">
                      				<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Agent (KG)
                      				</div>

                        			<div class="h5 mb-0 font-weight-bold text-gray-800">
			                            <?php
			                                $query3 = "SELECT * FROM agent where id = $data[agent]";
			                                $result3 = mysqli_query($koneksi, $query3);
			                                $data1 = mysqli_fetch_assoc($result3);

			                                echo "Rp. $data1[pendapatan]";
			                            ?>
                        			</div>
                    			</div>

			                    <div class="col-auto">
			                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
			                    </div>
                  			</div>
                		</div>
              		</div>
            	</div>

	            <!-- History Saldo Terakhir (KG) -->
	            <div class="col-xl-3 col-md-6 mb-4">
	              	<div class="card border-left-success shadow h-100 py-2">
	                	<div class="card-body">
	                  		<div class="row no-gutters align-items-center">
	                   			<div class="col mr-2">
	                      			<div class="text-xs font-weight-bold text-success text-uppercase mb-1">History Saldo 		Terakhir (KG)
	                      			</div>
	                        
	                        		<div class="h5 mb-0 font-weight-bold text-gray-800">
			                            <?php
			                                $query3 = "SELECT * FROM history_saldo where agent = $data[agent] ORDER BY id DESC LIMIT 1";
			                                $result3 = mysqli_query($koneksi, $query3);
			                                $data1 = mysqli_fetch_assoc($result3);

			                                echo "Rp. $data1[saldo]";
			                            ?>
	                        		</div>
	                    		</div>

			                    <div class="col-auto">
			                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
			                    </div>
	                  		</div>
	                	</div>
	              	</div>
	            </div>

	            <!-- Total Transaksi /Bulan -->
	            <div class="col-xl-3 col-md-6 mb-4">
	              	<div class="card border-left-warning shadow h-100 py-2">
	                	<div class="card-body">
	                  		<div class="row no-gutters align-items-center">
	                    		<div class="col mr-2">
	                      			<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi /	Bulan
	                      			</div>
	                      			
	                      			<div class="h5 mb-0 font-weight-bold text-gray-800">  
			                          	<?php
			                              $m = date('m');
			                              $y = date('Y');
			                              $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where month(tanggal) = '$m' AND year(tanggal) = '$y' AND agent ='$data[agent]'";
			                                $result4 = mysqli_query($koneksi, $query4);
			                                $data2 = mysqli_fetch_assoc($result4);

			                                echo "$data2[jumlah]";
			                          	?>
	                      			</div>
	                    		</div>
	                    		
	                    		<div class="col-auto">
	                      			<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    		</div>
	                  		</div>
	                	</div>
	              	</div>
	            </div>

	            <!-- Total Transaksi /Hari  -->
	            <div class="col-xl-3 col-md-6 mb-4">
	              	<div class="card border-left-warning shadow h-100 py-2">
	                	<div class="card-body">
	                  		<div class="row no-gutters align-items-center">
	                    		<div class="col mr-2">
	                     			<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi /	Hari  
	                     			</div>
	                      
	                      			<div class="h5 mb-0 font-weight-bold text-gray-800">  
				                          <?php
				                              $m = date('m');
				                              $y = date('Y');
				                              $d = date('d');
				                              $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where day(tanggal) = '$d' AND month(tanggal) = '$m' AND year(tanggal) = '$y' AND agent ='$data[agent]'";
				                                $result4 = mysqli_query($koneksi, $query4);
				                                $data2 = mysqli_fetch_assoc($result4);

				                                echo "$data2[jumlah]";
				                          ?>
	                      			</div>
	                    		</div>

			                    <div class="col-auto">
			                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
			                    </div>
	                  		</div>
	                	</div>
	              	</div>
	            </div>

            	<!-- Status Komisi -->
             	<?php
                	$query5 = mysqli_query($koneksi, "SELECT * FROM agent where id = $data[agent]");
                 	$dataa2 = mysqli_fetch_assoc($query5);

                 	if($dataa2['komisi'] == '1'){
              	?>

	            <!-- Pendapatan Agent (PKT) -->
	            <div class="col-xl-3 col-md-6 mb-4">
	              	<div class="card border-left-success shadow h-100 py-2">
	                	<div class="card-body">
	                  		<div class="row no-gutters align-items-center">
	                    		<div class="col mr-2">
	                      			<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Agent (PKT)
	                      			</div>
	                        
			                        <div class="h5 mb-0 font-weight-bold text-gray-800">
			                            <?php
			                                $query3 = "SELECT * FROM agent where id = $data[agent]";
			                                $result3 = mysqli_query($koneksi, $query3);
			                                $data1 = mysqli_fetch_assoc($result3);

			                                echo "Rp. $data1[pend_paket]";
			                            ?>
			                        </div>
	                    		</div>

			                    <div class="col-auto">
			                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
			                    </div>
	                  		</div>
	                	</div>
	              	</div>
	            </div>

	            <!-- History Saldo Terakhir (PKT) -->
	            <div class="col-xl-3 col-md-6 mb-4">
	              	<div class="card border-left-success shadow h-100 py-2">
	                	<div class="card-body">
	                  		<div class="row no-gutters align-items-center">
	                    		<div class="col mr-2">
	                      			<div class="text-xs font-weight-bold text-success text-uppercase mb-1">History Saldo Terakhir (PKT)
	                      			</div>
	                        
	                        		<div class="h5 mb-0 font-weight-bold text-gray-800">
			                            <?php
			                             	$query3 = "SELECT * FROM history_saldo_pkt where agent = $data[agent] ORDER BY id DESC LIMIT 1";
			                                $result3 = mysqli_query($koneksi, $query3);
			                                $data1 = mysqli_fetch_assoc($result3);

			                                echo "Rp. $data1[saldo]";
			                            ?>
	                        		</div>
	                    		</div>
	                    		
	                    		<div class="col-auto">
	                      			<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
	                    		</div>
	                  		</div>
	                	</div>
	              	</div>
	            </div>

	            <?php
	            	}
	            ?>

          	</div>

          	<div class="row">
            	
	            <?php
	                $query1 = "SELECT * FROM notice where id_agent = $data[agent]";
	                $result1 = mysqli_query($koneksi, $query1);
	                while($row1 = mysqli_fetch_array($result1)){
	            ?>
            	<div class="col-xl-4 col-md-12 mb-8">
              		<div class="card border-left-danger shadow h-100 py-2">
                		<div class="card-body">
                  			<div class="row no-gutters align-items-center">
                    			<div class="col mr-2">
                      				<div class="text-lg font-weight-bold text-warning text-uppercase mb-1">Pengumuman</div>
                      					<div class="h8 mb-0 font-weight-bold text-gray-800 text-justify"><?php echo substr($row1['isi_notice'],0,40);echo" ...." ?>
                      					</div>
                      					<br>
                      					<buttontype="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalview"  data-id="<?php echo $row1["id"]; ?>" class="btn btn-info btn-sm">show</button>
                    				</div>

				                    <div class="col-auto">
				                      	<i class="fas fa-bullhorn fa-2x text-gray-300" style="padding-left: 30px;"></i>
				                    </div>
                  				</div>
                			</div>
              			</div>
            		</div>
            		<?php
            			}
            		?>
          		</div>

		       	<div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-hidden="true">
		          	<div class="modal-dialog" role="document">
		            	<div class="modal-content">
		              		<div class="modal-header">
		                		<h5 class="modal-title" id="exampleModalLabel">Pengumuman</h5>
		                		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  			<span aria-hidden="true">&times;</span>
		                		</button>
		              		</div>

				            <div class="modal-body">
				                <div class="view"></div>
				            </div>
		              		
		              		<div class="modal-footer">
		                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                		<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		              		</div>
		            	</div>
		          	</div>
		        </div>
		    </div>
	    </div>
 	</div>
  	<!-- End of Page Wrapper -->

  
<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  	<!-- Core plugin JavaScript-->
  	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  	<!-- Custom scripts for all pages-->
  	<script src="js/sb-admin-2.min.js"></script>

  	<!-- Page level plugins -->
  	<script src="vendor/chart.js/Chart.min.js"></script>

  	<!-- Page level custom scripts -->
  	<script src="js/demo/chart-area-demo.js"></script>
  	<script src="js/demo/chart-pie-demo.js"></script>
  	
  	<script>
	    $(document).ready(function(){
	        $('#modalview').on('show.bs.modal', function (e) {
	            var rowid = $(e.relatedTarget).data('id');
	            //menggunakan fungsi ajax untuk pengambilan data
	            $.ajax({
	                type : 'post',
	                url : 'view.php',
	                data :  'rowid='+ rowid,
	                success : function(data){
	                $('.view').html(data);//menampilkan data ke dalam modal
	                }
	            });
	         });
	    });
  	</script>
</body>
</html>
