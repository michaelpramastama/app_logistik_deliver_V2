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
		'MENUJU',
		'$waktu',
		'$hari',
		'$agent',
		'PROSES'
		FROM daskur WHERE id_kurir = '$kurir'";
$result = mysqli_query($koneksi, $input);

if($result){
	header('Location: index.php');
}else{
	echo "Connect TO Database Error";
}



}



?>