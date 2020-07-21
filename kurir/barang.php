<?php
	include '../koneksi.php';
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
		    		<li><a href="index.php">Kembali</a></li>
		    	</ul>
		      	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li><a href="#">Setting</a></li>
				            <li><a href="../logout.php">LogOut</a></li>
			          	</ul>
			        </li>
			    </ul>
		    </div>
  		</div>
	</nav>
	<!-- ============= end navbar ==================================================================== -->
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center>
					<button type="button" onclick="myFunction()" style="margin-bottom: 10px;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#scan">
	 				SCAN
					</button><br>
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#history">
	 				HISTORY
					</button>
				</center>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
	<!-- ================================================================================================================== -->
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
				        <select id="selectcam"></select>
			      	</div>
		      	</div>

		     	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" onclick="myFunction1()" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>
	<!-- ====== modal scan ========================== -->
	<!-- ====== modal Agent ========================== -->
	<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header form-inline">
			        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">History Pick UP</h4>
		      		<div class="form-group" style="float: right;" >
		      			<input class="form-control"  type="text" name="search" id="search" placeholder="Search No Resi" onkeyup="search()" aria-label="Search">
	                </div>
		      	</div>
		      	<!-- ============================= php ================== -->
		      		<?php
       					$query5 = "SELECT * from history_kurir";
       					$result5 = mysqli_query($koneksi,$query5);
		      		?>
		      	<!-- ==================================================== -->
			    <div class="modal-body">
			    	<div class="table-responsive">
			    		<table class="table table-striped" id="datatables">
			    			<thead>
			    				<tr>
			    					<th><center>NO</center></th>
			    					<th><center>NO RESI</center></th>
			    					<th><center>WAKTU</center></th>
			    					<th><center>TANGGAL</center></th>
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
				    						<?php echo $row5['no_resi'];?> 
			      						</center>
			      					</td>
				    				<td style="vertical-align: middle;"><center><?php echo $row5['waktu'];?></center></td>
				    				<td style="vertical-align: middle;">
				    					<center>
											<?php 
												$hari = $row5['tanggal'];
												echo date("d-m-Y",strtotime($hari));
											?> 
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

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scan/js/jquery.js"></script>
<script type="text/javascript" src="scan/js/qrcodelib.js"></script>
<script type="text/javascript" src="scan/js/webcodecamjquery.js"></script>
<script type="text/javascript">
	var arg = {
        resultFunction: function(result) {
            var redirect = 'cek2.php';
            $.redirectPost(redirect, {noresi: result.code});
        }
    };

    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");


   	function myFunction() {
  			 decoder.play();
	};

	function myFunction1() {
  			 decoder.stop();
	};
   
    $('select').on('change', function(){
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