<?php
	include "../koneksi.php";
?>	
<!DOCTYPE html>
<html>
<head>
	<title>Logistik</title>
	<link rel="shortcut icon" href="../image/truck.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php 
			session_start();
			// cek apakah yang mengakses halaman ini sudah login
			if($_SESSION['level']==""){
				header("location:../index.php?pesan=gagal");
			}
			$user = $_SESSION['username'];
			$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user'");
			$data = mysqli_fetch_assoc($query);
			$vw = $data['id'];
		?>
	<!-- ============= navbar ======================================================================== -->
	<nav class="navbar navbar-default">
  		<div class="container-fluid">
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		     	</button>
		      	<a class="navbar-brand" href="#"><?php echo $_SESSION['username']; ?></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    	<ul class="nav navbar-nav">
		    		<li><a href="barang.php">Barang Keluar</a></li>
		    	</ul>
		      	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li><a href="javascript:;" data-toggle="modal" data-target="#addmodalchange"> Setting</a></li>
				            <li><a href="../logout.php">LogOut</a></li>
			          	</ul>
			        </li>
			    </ul>
		    </div>
  		</div>
	</nav>
	<!-- ============= end navbar ==================================================================== -->
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
	<!-- ============= main ==================================================================== -->
	<div class="container">
		<!-- ====== button =============================== -->
		<div class="row">
			<div class="col-md-6">
				<button type="button" onclick="myFunction()" class="btn btn-primary btn-md" data-toggle="modal" data-target="#scan">
 				+ TAMBAH
				</button>
			
				<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#update">
 				UPDATE
				</button>

				<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#cargo">
 				CARGO
				</button>

				<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#container1">
 				CONTAINER
				</button>

				<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#agent1">
 				AGENT
				</button>
			</div>
			<br>
			<div class="col-md-6">
				<div class="well">
					<?php
						$query3 = mysqli_query($koneksi, "SELECT SUM(berat) as total FROM `daskur` JOIN barang_masuk on barang_masuk.no_resi = daskur.resi WHERE id_kurir = '$vw'");
						$jml1 = mysqli_fetch_assoc($query3);
					?>
					BERAT : <?php  echo $jml1[total]; ?> KG
					<br>
					<?php
						$query2 = mysqli_query($koneksi, "SELECT COUNT(*) AS JUMLAH FROM daskur WHERE id_kurir = '$vw'");
						$jml = mysqli_fetch_assoc($query2);

					?>
					JUMLAH : <?php echo $jml[JUMLAH]; ?> PKT
				</div>
			</div>
		</div>
		<!-- ====== button ================================= -->

		<!-- ====== modal scan ADD========================== -->
		<div class="modal fade" id="scan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog modal-sm" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" onclick="myFunction1()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Scanner Qr Code</h4>
			      	</div>

			      	<div class="modal-body">
				        <div class="panel-body text-center" >
					        <canvas style="width: 250px; height: 250px;"></canvas>
					        <hr>
					        <select id="select"></select>
				      	</div>
			      	</div>

			     	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" onclick="myFunction1()" data-dismiss="modal">Close</button>
			      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- ====== modal scan ========================== -->

		<!-- ====== modal UPDATE ========================== -->
		<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog modal-md" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Update Perjalanan</h4>
			      	</div>
			      	<!-- ============================= php ================== -->
			      		<?php
			      			$agent= '';
        					$query4 = "SELECT * from agent";
        					$result4 = mysqli_query($koneksi,$query4);
					        while($row = mysqli_fetch_array($result4))
					        {
					            $agent .= '<option value="'.$row[0].'">'.$row[2].' '.$row[12].'</option>';
					        }
			      		?>
			      	<!-- ==================================================== -->
				      	<div class="modal-body">
				      		<form action="update.php" method="post">
					        	<div class="form-group">
					        		<input type="hidden" class="active" name="kurir" id="kurir" value="<?php echo $vw; ?>">
								    <label for="email">Menuju Ke :</label>
								    <select class="form-control" id="agent" name="agent" required>
								    	<option><?php echo $agent; ?></option>
								    </select>
								</div>

								<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        	<button type="submit" name="btnup" id="btnup" class="btn btn-default">Update</button>
						      	</div>
						    </form>
				      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- ====== modal        ========================== -->
		<!-- ====== modal UPDATE ========================== -->
		<div class="modal fade" id="cargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog modal-md" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Perjalanan Cargo</h4>
			      	</div>
			      	<!-- ============================= php ================== -->
			      		<?php
			      			$agent= '';
        					$query4 = "SELECT * from agent";
        					$result4 = mysqli_query($koneksi,$query4);
					        while($row = mysqli_fetch_array($result4))
					        {
					            $agent .= '<option value="'.$row[0].'">'.$row[2].' '.$row[12].'</option>';
					        }
			      		?>
			      	<!-- ==================================================== -->
				      	<div class="modal-body">
				      		<form action="cargo.php" method="post">
					        	<div class="form-group">
					        		<input type="hidden" class="active" name="kurir" id="kurir" value="<?php echo $vw; ?>">
								    <label for="email">Menuju Ke :</label>
								    <select class="form-control" id="agent" name="agent" required>
								    	<option><?php echo $agent; ?></option>
								    </select>
								</div>

								<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        	<button type="submit" name="btnup" id="btnup" class="btn btn-default">Update</button>
						      	</div>
						    </form>
				      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- ====== modal        ========================== -->
		<!-- ====== modal UPDATE ========================== -->
		<div class="modal fade" id="container1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog modal-md" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Perjalanan Container</h4>
			      	</div>
			      	<!-- ============================= php ================== -->
			      		<?php
			      			$agent= '';
        					$query4 = "SELECT * from agent";
        					$result4 = mysqli_query($koneksi,$query4);
					        while($row = mysqli_fetch_array($result4))
					        {
					            $agent .= '<option value="'.$row[0].'">'.$row[2].' '.$row[12].'</option>';
					        }
			      		?>
			      	<!-- ==================================================== -->
				      	<div class="modal-body">
				      		<form action="container.php" method="post">
					        	<div class="form-group">
					        		<input type="hidden" class="active" name="kurir" id="kurir" value="<?php echo $vw; ?>">
								    <label for="email">Menuju Ke :</label>
								    <select class="form-control" id="agent" name="agent" required>
								    	<option><?php echo $agent; ?></option>
								    </select>
								</div>

								<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        	<button type="submit" name="btnup" id="btnup" class="btn btn-default">Update</button>
						      	</div>
						    </form>
				      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- ====== modal        ========================== -->
		<!-- ====== modal Agent ========================== -->
		<div class="modal fade" id="agent1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Daftar Agent</h4>
			      	</div>
			      	<!-- ============================= php ================== -->
			      		<?php
        					$query5 = "SELECT * from agent";
        					$result5 = mysqli_query($koneksi,$query5);
			      		?>
			      	<!-- ==================================================== -->
				    <div class="modal-body">
				    	<div class="table-responsive">
				    		<table class="table table-striped">
				    			<thead>
				    				<tr>
				    					<th><center>NO</center></th>
				    					<th><center>NAMA AGENT</center></th>
				    					<th><center>KODE AGENT</center></th>
				    					<th><center>ALAMAT</center></th>
				    				</tr>
				    			</thead>

				    			<tbody>
				    				<?php
				    					$no = 1;
				    					while($row5 = mysqli_fetch_array($result5)){
				    				?>
				    				<tr>
										<td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
	    								<td style="vertical-align: middle;">
     										<center>
					    						<?php echo $row5['nama_agent'];?> 
				      						</center>
				      					</td>
					    				<td style="vertical-align: middle;"><center><?php echo $row5['kode_agent'];?></center></td>
					    				<td style="vertical-align: middle;">
					    					<center>
												<?php echo $row5['alamat'];?> 
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
			      	</div>
		    	</div>
		  	</div>
		</div>
		<!-- ====== modal        ========================== -->
	
		<!-- ====== table ========================== -->

		<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> php <<<<<<<<<<<<<<<<<<<<<<< -->
			 <?php		
			 	$query1 = mysqli_query($koneksi, "SELECT * FROM daskur WHERE id_kurir = '$vw'");
			 	// $data1 = mysqli_fetch_array($query1);
			 ?>
		<!-- >>>>>>>>>>>>>>>>>>>>>>>>>> php <<<<<<<<<<<<<<<<<<<<<<< -->
		<div class="table-responsive">
			<table class="table table-striped" id="datatables">
			    <thead>
				    <tr>
				    	<th><center>NO</center></th>
				        <th><center>RESI</center></th>
				        <th><center>Date</center></th>
				        <th><center>Action</center></th>
				    </tr>
			    </thead>
			    <tbody>
			   		<?php 
			   			$no = 1; 
			   			while ($row = mysqli_fetch_array($query1)) {
			   		?>
					<tr>
						<td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
	    				<td style="vertical-align: middle;">
     						<center>
					    		<?php echo $row['resi'];?> 
				      		</center></td>
					    <td style="vertical-align: middle;"><center><?php echo $row['waktu'];?></center></td>
					    <td style="vertical-align: middle;">
					    	<center>
								<button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row['resi']; ?>")' ><img src="delete.png" />
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
		<!-- ====== end table ========================== -->		

	</div>
	<!-- ============= end main ==================================================================== -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scan/js/jquery.js"></script>
<script type="text/javascript" src="scan/js/qrcodelib.js"></script>
<script type="text/javascript" src="scan/js/webcodecamjquery.js"></script>
<script type="text/javascript">

    var arg = {
        resultFunction: function(result) {
            var redirect = 'cek.php';
            $.redirectPost(redirect, {noresi: result.code});
        }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("#select");


   	function myFunction() {
  			 decoder.play();
	};

	function myFunction1() {
  			 decoder.stop();
	};
   
    $('#select').on('change', function(){
        decoder.stop().play();
    });

     $.extend(
    {
        redirectPost: function(location, args)
        {
            var form = '';
            $.each( args, function( key, value ) {
                form += '<input type="hidden" name="'+key+'" value="'+value+'">';
            });
            $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
        }
    });

    ///hapus ////////////////////////

	function hpus(id) {
	var conf = confirm("Yakin Ingin Menghapus Data Paket..?");
		if (conf == true) {
	    	$.post("delete.php", {
	            id: id
	       	},
		    function (data, status) {
	        // reload Users by using readRecords();
	            $('#datatables').html(data); 
	            }
	        );
	    }
	    //  window.location = 'index.php';
	}

///update ////////////////////////

</script>
</body>
</html>