<?php

include '../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

if(isset($_POST['btnup'])){

	$kurir = $_POST['kurir'];
	$agent = $_POST['agent'];
	$hari = date('Y-m-d');
	$waktu = date('H:i:s');

$input = "INSERT INTO lokasi(id,no_resi, id_kurir, keterangan, waktu, tanggal, tujuan, status) 
	SELECT 
		NULL,
		resi,
		id_kurir,
		'CONTAINER',
		'$waktu',
		'$hari',
		'$agent',
		'PROSES'
		FROM daskur WHERE id_kurir = '$kurir'";
$result = mysqli_query($koneksi, $input);

if($result){
	$input1 = mysqli_query($koneksi, "INSERT INTO cargo(id,no_resi, id_kurir, waktu, tanggal, tujuan, type) 
	SELECT 
		NULL,
		resi,
		id_kurir,
		'$waktu',
		'$hari',
		'$agent',
		'CONTAINER'
		FROM daskur WHERE id_kurir = '$kurir'");

	$delete = mysqli_query($koneksi, "DELETE FROM daskur WHERE id_kurir = '$kurir'");
	header('Location: index.php');
}else{
	echo "Connect TO Database Error";
}



}



?>