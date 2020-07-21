<?php

include '../../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

$agent = $_POST['id'];
$nominal = $_POST['nominal'];
$keterangan = $_POST['ket'];
$ext_image = array('jpg','jpeg','png');
$file_name =  $_FILES['image']['name'];
$tmpp = explode('.', $file_name);
$foto = end($tmpp);
$tmp = $_FILES['image']['tmp_name'];

$date1 = date("YmdHis");
$date = date("Y-m-d");
$time = date("H:i:s");

$fotobaru = $date1 . '_' . $agent . '.' . $foto;
$path = "bukti/komisi/".$fotobaru;

if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
	// Proses simpan ke Database

  	$query = "INSERT INTO uang_masuk_pkt(`id`, `agent`, `date`, `time`, `nominal`, `keterangan`, `bukti`) VALUES (NULL,'$agent','$date','$time','$nominal','$keterangan','$fotobaru')";
	$sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query

  	if($sql){ // Cek jika proses simpan ke database sukses atau tidak

	    // Jika Sukses, Lakukan :
	    $query1 = "SELECT * FROM agent where id = '$agent'";
	    $result1 = mysqli_query($koneksi, $query1);
	    $data = mysqli_fetch_assoc($result1);

	    $query2 = "INSERT INTO history_saldo_pkt (`id`, `date`, `time`, `agent`, `saldo`) VALUES (NULL, '$date', '$time', '$agent', '$data[pend_paket]')";
	    $result2 = mysqli_query($koneksi, $query2);

		// $update = "UPDATE pendapatan_agent SET saldo = saldo - '$nominal' where id_agent = '$agent'";
		// $result = mysqli_query($koneksi, $update);

		$update1 = "UPDATE agent SET pend_paket = pend_paket - '$nominal' where id = '$agent'";
		$result1 = mysqli_query($koneksi, $update1);
	
	    header("location: index.php"); // Redirect ke halaman index.php
	}else{

    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";

	}

}else{

    // Jika gambar gagal diupload, Lakukan :
	echo "Maaf, Gambar gagal untuk diupload.";
}

?>