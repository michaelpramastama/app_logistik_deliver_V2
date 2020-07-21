<?php 
session_start();
include "../koneksi.php";
date_default_timezone_get('Asia/Jakarta');

$userkur = $_SESSION['username']; 

// mengecek apakah resi sudah di terbitkan

$sql=mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE no_resi='$_POST[noresi]'");
$d=mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) < 1){
?>
	<div class="alert alert-danger">
    	<center>
    		<strong>Maaf, Data tidak ditemukan..!</strong><br>
  	    </center>
    </div>
<?php
    }else{
    	//mencari id user kurir

    	$sql1 =mysqli_query($koneksi, "SELECT * FROM user WHERE username= '$userkur'");
    	$idview = mysqli_fetch_assoc($sql1);
    	$id = $idview['id'];
		$hari = date('Y-m-d');
		$waktu = date('H:i:s');
		$resi = $_POST[noresi];

		// cek apakah resi sudah ada atau belum

		$cek = mysqli_query($koneksi, "SELECT * FROM daskur WHERE resi='$_POST[noresi]'");

		// jika belum ada, system akan meng input kan ke db daskur

		if(mysqli_num_rows($cek) < 1){

		//meng input kan ke db daskur

    	$in = mysqli_query($koneksi, "INSERT INTO daskur(`id`,`resi`, `id_kurir`, `waktu`, `tanggal`) VALUES (NULL,'$resi','$id','$waktu','$hari')");
    		
    		//meng input kan ke db lokasi

    		$in1 = mysqli_query($koneksi, "INSERT INTO lokasi(`id`,`no_resi`, `id_kurir`, `keterangan`, `waktu`, `tanggal`, `tujuan`, `status`) VALUES (NULL,'$resi','$id','PICK UP KURIR','$waktu','$hari','','PROSES')");

    		header('Location: index.php');
    	}else{

    		$output = '';
    		$output = '
    				   	<script language="javascript">
  							var r = confirm("Barang Paket Sudah Ada");
  							if (r == true) {
    						window.location = "index.php";
  							} else {
    						
  							}
						</script>

    					';
    		echo $output;
    	}
	} 
?>
