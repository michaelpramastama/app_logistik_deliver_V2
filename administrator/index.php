<?php
	include'../koneksi.php';
  date_default_timezone_get('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="asset/images/truck.png" type="image/ico" />
    <title>Logistik</title>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="nav-md">
	    <?php 
			session_start();
			// cek apakah yang mengakses halaman ini sudah login
			if($_SESSION['level']==""){
				header("location:../index.php?pesan=gagal");
			}
		?>
    <div class="container body">
      <div class="main_container">
      	<!-- ===================================================================================== -->
        <div class="col-md-3 left_col">
          	<div class="left_col scroll-view">
	            <div class="navbar nav_title" style="border: 0;">
	              <a href="index.php" class="site_title"> <span>Dashboard</span></a>
	            </div>
            		<div class="profile clearfix">
	              		<div class="profile_pic">
	                		<img src="asset/images/user.png" alt="..." class="img-circle profile_img">
	              		</div>
	              		<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $_SESSION['level']; echo"," ;echo "<br>"; ?></h2>
		                	<h2><?php echo $_SESSION['username']; ?></h2>
	             		</div>
            		</div>
            		<br />
            		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              			<div class="menu_section">
			                <h3>General</h3>
			                <ul class="nav side-menu">
				                  <li class="active"><a href="index.php"><img src="asset/images/home.png"><i class="fa"></i> Home </a>
				                  <li><a href="user"><img src="asset/images/seller.png"><i class="fa"></i> User </a>
				                  <li><a href="country"><img src="asset/images/world.png"><i class="fa"></i> Country </a>
				                  <li><a href="agent"><img src="asset/images/warehouse.png"><i class="fa"></i> Agent </a></li>
				                  <li><a href="notice"><img src="asset/images/announcement.png"><i class="fa"></i> Pengumuman </a></li>
				                  <li><a href="transfer"><img src="asset/images/transfer.png"><i class="fa"></i> Bukti Transfer </a></li>
				                  <li><a href="rute"><img src="asset/images/way.png"><i class="fa"></i>Rute</a></li>
				                  <li><a href="sell"><img src="asset/images/sell.png"><i class="fa"></i>Komisi</a></li>
				                  <li><a href="weight"><img src="asset/images/weight.png"><i class="fa"></i>Berat</a></li>
                			</ul>
              			</div>
           			</div>
          	</div>
	    </div>
	    <!-- ===================================================================================== -->
	    <div class="top_nav">
		    <div class="nav_menu">
            	<nav>
		            <div class="nav toggle">
                		<a id="menu_toggle"><i class="fa fa-bars"></i></a>
              		</div>
              		<ul class="nav navbar-nav navbar-right">
                		<li class="">
	                 			<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                    			<img src="asset/images/user.png" alt=""><?php echo $_SESSION['username']; ?>
	                    			<span class=" fa fa-angle-down"></span>
                  				</a>
		                  	  	<ul class="dropdown-menu dropdown-usermenu pull-right">
				                    <li><a href="javascript:;" data-toggle="modal" data-target="#addmodalchange"> Setting</a></li>
				                    <li><a href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
			                 	</ul>
               			</li>
              		</ul>
            	</nav>
          	</div>
        </div>
        <!-- ===================================================================================== -->
        <div class="right_col" role="main">
            <!-- total semua transaksi -->
          	<div class="row tile_count">
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
             		<span class="count_top"><i class="fa fa-user"></i> Total Semua Transaksi</span>
              	<div class="count">
                  <center>
                    <?php
                         $query3 = "SELECT COUNT(*) AS jumlah FROM barang_masuk";
                         $result3 = mysqli_query($koneksi, $query3);
                         $data1 = mysqli_fetch_assoc($result3);
                         echo $data1['jumlah'];
                    ?>
                  </center>
                </div>
                <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
		        </div>
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		        	<span class="count_top"><i class="fa fa-clock-o"></i> Total Transaksi /Tahun</span>
			        <div class="count">
                <center>
                  <?php
                       $Y = date('Y');
                       $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where year(tanggal) = '$Y'";
                       $result4 = mysqli_query($koneksi, $query4);
                       $data2 = mysqli_fetch_assoc($result4);
                       $y1 = $data2[jumlah];
                       echo "$data2[jumlah]";
                  ?>
                </center>
              </div>
		          <span class="count_bottom">
                <?php
                       
                       $tambah_tanggal = mktime(0,0,0,date('m')+0,date('d')+0,date('Y')-1);
                       $hasil = date('Y',$tambah_tanggal);

                       $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where year(tanggal) = '$hasil'";
                       $result4 = mysqli_query($koneksi, $query4);
                       $data2 = mysqli_fetch_assoc($result4);

                       $y2 = $data2[jumlah];
                       echo "$data2[jumlah]";

                       if ($y1 > $y2) {
                ?>
                      <i class="green"><i class="fa fa-sort-asc">
                      </i></i> From last Year</span>
                <?php
                      }else{
                ?>
                      <i class="red"><i class="fa fa-sort-desc">
                      </i></i> From last Year</span>
                <?php
                      }
                ?>
	            </div>
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		            <span class="count_top"><i class="fa fa-user"></i> Total Transaksi /Bulans</span>
				        <div class="count green">
                  <center>
                    <?php
                         $m = date('m');
                         $y = date('Y');
                         $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where month(tanggal) = '$m' AND year(tanggal) = '$y'";
                         $result4 = mysqli_query($koneksi, $query4);
                         $data2 = mysqli_fetch_assoc($result4);
                         $y1 = $data2[jumlah];
                         echo "$data2[jumlah]";
                    ?>
                  </center>
                </div>
		            <span class="count_bottom">
                  <?php
                       $tambahy = mktime(0,0,0,date('m')+0,date('d')+0,date('Y')-1);
                       $y = date('Y',$tambahy);
                       $tambahm = mktime(0,0,0,date('m')-1,date('d')+0,date('Y')+0);
                       $m = date('m',$tambahm);

                       $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where month(tanggal) = '$m' AND year(tanggal) = '$y'";
                       $result4 = mysqli_query($koneksi, $query4);
                       $data2 = mysqli_fetch_assoc($result4);

                       $y2 = $data2[jumlah];
                       echo "$data2[jumlah]";
                       if ($y1 > $y2) {
                ?>
                      <i class="green"><i class="fa fa-sort-asc">
                      </i></i> From last Month</span>
                <?php
                      }else{
                ?>
                      <i class="red"><i class="fa fa-sort-desc">
                      </i></i> From last Month</span>
                <?php
                      }
                ?>
	            </div>
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		            <span class="count_top"><i class="fa fa-user"></i> Total Transaksi /Hari</span>
		            <div class="count">
                  <center>
                    <?php
                         $m = date('m');
                         $y = date('Y');
                         $d = date('d');
                         $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where day(tanggal) = '$d' AND month(tanggal) = '$m' AND year(tanggal) = '$y'";
                         $result4 = mysqli_query($koneksi, $query4);
                         $data2 = mysqli_fetch_assoc($result4);
                         echo "$data2[jumlah]";
                    ?>
                  </center>
                </div>
		            <span class="count_bottom">
                <?php
                       $tambahy = mktime(0,0,0,date('m')+0,date('d')+0,date('Y')-1);
                       $y = date('Y',$tambahy);
                       $tambahm = mktime(0,0,0,date('m')-1,date('d')+0,date('Y')+0);
                       $m = date('m',$tambahm);
                       $tambahd = mktime(0,0,0,date('m')+0,date('d')-1,date('Y')+0);
                       $d = date('d',$tambahd);

                       $query4 = "SELECT COUNT(*) AS jumlah FROM barang_masuk where day(tanggal) = '$d' AND month(tanggal) = '$m' AND year(tanggal) = '$y'";
                       $result4 = mysqli_query($koneksi, $query4);
                       $data2 = mysqli_fetch_assoc($result4);

                       $y2 = $data2[jumlah];
                       echo "$data2[jumlah]";
                       if ($y1 > $y2) {
                ?>
                      <i class="green"><i class="fa fa-sort-asc">
                      </i></i> From last Day</span>
                <?php
                      }else{
                ?>
                      <i class="red"><i class="fa fa-sort-desc">
                      </i></i> From last Day</span>
                <?php
                      }
                ?>  
                </span>
	            </div>
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		            <span class="count_top"><i class="fa fa-user"></i> Total Agent</span>
  			        <div class="count">
                  <center>
                    <?php
                         $query4 = "SELECT COUNT(*) AS jumlah FROM agent";
                         $result4 = mysqli_query($koneksi, $query4);
                         $data2 = mysqli_fetch_assoc($result4);
                         echo "$data2[jumlah]";
                    ?>
                  </center>
                </div>
		            <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            	</div>
	            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> Total User</span>
		              <div class="count">
		              	<center>
		                    <?php
		                         $query4 = "SELECT COUNT(*) AS jumlah FROM user";
		                         $result4 = mysqli_query($koneksi, $query4);
		                         $data2 = mysqli_fetch_assoc($result4);
		                         echo "$data2[jumlah]";
		                    ?>
		                </center>
		              </div>
		             <!--  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            	</div>
        </div>
        <!-- ===================================================================================== -->
        <!-- ==================================  MAIN  ========================================== -->
        <div class="form-group form-inline" style="float: right;">
        	<input class="form-control"  type="text" name="search" id="search" placeholder="Search No Resi" onkeyup="search()" aria-label="Search">
        </div>
        <div class="container" style=" height: 400px; overflow-y: scroll;">
        	<table class="table table-responsive" id="datatables">
        		<thead>
        			<tr>
        				<th><center>NO</center></th>
        				<th><center>No Resi</center></th>
        				<th><center>Time</center></th>
        				<th><center>Date</center></th>
        				<th><center>Action</center></th>
        			</tr>
        		</thead>
        		<tbody>
        			<!-- ================================================================ -->
        			<?php
        				$no = 1;
        				$view = mysqli_query($koneksi, "SELECT * FROM lokasi GROUP by no_resi");
        				while ($row = mysqli_fetch_array($view)) {
        			?>
        			<!-- ================================================================ -->
        			<tr>
        				<td><center><?php echo $no; ?></center></td>
        				<td><center><?php echo $row['no_resi']; ?></center></td>
        				<td><center><?php echo $row['waktu']; ?></center></td>
        				<td>
        					<center>
        						<?php 
        							$tanggall = $row['tanggal']; 
        							echo date('d-m-Y', strtotime($tanggall));
        						?>
        					</center>
        				</td>
        				<td>
        					<center>
        						<button type="button"  data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row['no_resi']; ?>" ><img src="asset/images/search.png" />
                    		</button>
        					</center>
        				</td>
        			</tr>
        			<?php
        				$no++;
        				}
        			?>
        		</tbody>
        	</table>
        </div>
        <!-- ===================================================================================== -->
        <!-- modal update -->    
	   	<div class="modal fade" id="modalupdate" role="dialog">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">

	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal">&times;</button>
	                    <h4 class="modal-title">Tracking Resi</h4>
	                </div>
	                <div class="modal-body">
	                    <div class="fetched-data"></div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
	                </div>
	            </div>
	        </div>
	   	</div>
	    <!-- end modal update -->
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
                          	<input type="hidden" name="username1" id="username1" value="<?php echo $_SESSION['username']; ?>">
                          	<div class="form-group">
                              <label>Password Lama:</label>
                              <input type="password" class="form-control" name="passlam1" id="passlam1" placeholder="Password Lama" required>
                          	</div>
	                        <br />

	                        <!-- username -->
	                        <div class="form-group">
                              <label>Password Baru:</label>
                              <input type="password" class="form-control" name="passbar1" id="passbar1" placeholder="Password Baru" required>
	                        </div>
	                        <br />

                         	<div class="text-right">
                              <button ="right" type="submit" name="insert1" id="insert1" class="btn btn-primary submitBtn">CHANGE</button>						
                          	</div>
	                    </form>
	                </div>
	            </div>
	        </div>
		</div>
	    <!-- end modal change --> 
	    <!-- ===================================================================================== -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="build/js/custom.min.js"></script>
    <script type="text/javascript">
    /// update ////////////////////////
	$(document).ready(function(){
        $('#modalupdate').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  'rowid='+ rowid,
                success : function(data){
                	$('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
	/// end update ////////////////////////
  function search(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("datatables");
  tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
              txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
    }
  }
    </script>
  </body>
</html>

