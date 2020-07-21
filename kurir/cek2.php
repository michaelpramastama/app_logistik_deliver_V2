<?php 
session_start();
include "../koneksi.php";
date_default_timezone_get('Asia/Jakarta');

$userkur = $_SESSION['username']; 

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

    	$sql1 =mysqli_query($koneksi, "SELECT * FROM user WHERE username= '$userkur'");
    	$idview = mysqli_fetch_assoc($sql1);
    	$id = $idview['id'];

		$hari = date('Y-m-d');
		$waktu = date('H:i:s');
		$resi = $_POST[noresi];

    	$in = mysqli_query($koneksi, "INSERT INTO history_kurir(`id`, `no_resi`, `id_kurir`, `waktu`, `tanggal`) VALUES (NULL,'$resi','$id','$waktu','$hari')");
    	if($in){

    		$lih = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE no_resi  = '$resi' ORDER BY id DESC LIMIT 1");
    		$lihat = mysqli_fetch_assoc($lih);
    		$from = $lihat['tujuan'];

    		$in1 = mysqli_query($koneksi, "INSERT INTO lokasi(`id`, `no_resi`, `id_kurir`, `keterangan`, `waktu`, `tanggal`, `tujuan`, `status`) VALUES (NULL,'$resi','$id','DROPED AT','$waktu','$hari','$from','PROSES')");

    		$del = mysqli_query($koneksi, "DELETE FROM daskur WHERE  resi = '$resi'");
    		header('Location: barang.php');
    	}else{
    		echo "gagal";
    	}
	} 
?>
