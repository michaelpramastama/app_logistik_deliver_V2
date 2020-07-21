<?php
	include '../koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logistik</title>
	<link rel="shortcut icon" href="../image/truck.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
	<!-- ======================================================================================== -->
	<div class="container" >
		<div class="row">
			<div class="col-lg-12" style="background-color: red; margin-top: 20px; margin-bottom: 20px; border-radius: 10px; padding: 10px;">
				<center>
					<h1 style="color: white;">Cek Resi Anda</h1>
					<form action="index.php" method="get">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="input-group">
		      					<input type="text" class="form-control" id="cari" name="cari" placeholder="Search for Resi">
		      					<span class="input-group-btn">
		        					<button class="btn btn-default" type="submit" id="btn" name="btn">Lacak</button>
		      					</span>
		    				</div>
						</div>
						<div class="col-md-2"></div>
					</form>
					<?php 
						if(isset($_GET['cari'])){
							$cari = $_GET['cari'];
						}
					?>
					<br>
					<h3 style="color: white;"><?php echo $cari; ?></h3>
				</center>
			</div>
		</div>
	</div>
	<!-- ======================================================================================== -->

	<!-- ======================================================================================== -->
	<div style=" height: 400px; overflow-y: scroll; ">
	<?php 
		if(isset($_GET['cari'])){
			$cari = $_GET['cari'];
			$data = mysqli_query($koneksi,"SELECT * FROM lokasi WHERE no_resi = '$cari'");	
		
		}else{
			
		}

		$no = 1;
		$output = '';
		while($d = mysqli_fetch_array($data)){
			$tanggall = $d['tanggal'];

			$idagent = $d['tujuan'];
			$lihat = mysqli_query($koneksi, "SELECT * FROM agent WHERE id = '$idagent'");
			$view  = mysqli_fetch_assoc($lihat);

			$idcountry = $view['country'];
			$lihat1 = mysqli_query($koneksi, "SELECT * FROM country WHERE id = '$idcountry'");
			$view1  = mysqli_fetch_assoc($lihat1);

			$output = '
				<div class="container">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div>
								<div style="width: 20px; height: 70px;display: inline-block; ">
									<div style="width: 20px; height: 20px; border-radius: 20px; background-color: red;"></div>
									<div style="width: 5px; height: 70px; margin-bottom: 4px; margin-left: 7px;border-radius: 10px; background-color: yellow;"></div>
								</div>

								<div style="width: 380px; height: 90px; display: inline-block; position: relative;">
									<label>'.$d['waktu'].'    '.date("d-m-Y",strtotime($tanggall)).'</label><br>
									<label>'.$d['keterangan'].'    '.$view['nama_agent'].' '.$view['kode_agent'].' '.$view1['negara'].'</label><br>
									<label>'.$d['status'].'</label>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>		
					';
	?>

	<?php echo $output; ?>
			
	<?php } ?>
	</div>
	<!-- ======================================================================================== -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>