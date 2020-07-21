<?php

include '../../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

$agentID = $_POST['agentId'];
$noresi = $_POST['no_resi'];
$no_id = $_POST['no_id'];
$nama_penerima = $_POST['nama_penerima'];
$telp = $_POST['no_telfon'];
$ext_image = array('jpg','jpeg','png');
$foto =  end(explode('.', $_FILES['image']['name']));
$tmp = $_FILES['image']['tmp_name'];

$fotobaru = $noresi . '.' . $foto;
$path = "file/id/".$fotobaru;

$hari = date('Y-m-d');
$waktu = date('H:i:s');
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak

	// Proses simpan ke Database
	$query = "INSERT INTO barang_keluar(`id`, `no_resi`, `no_identitas`, `nama_penerima`, `no_telfon_penerima`, `image_id`,`waktu`, `tanggal`,`agent`) VALUES (NULL,'$noresi','$no_id','$nama_penerima','$telp','$fotobaru','$waktu','$hari','$agentID')";
	$sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query

  	if($sql){
  		
  		// =================== untuk insert lokasi dan proses selesai================
  		$drop = mysqli_query($koneksi, "INSERT INTO lokasi(`id`, `no_resi`, `id_kurir`, `keterangan`, `waktu`, `tanggal`, `tujuan`, `status`) VALUES (NULL,'$noresi','','received','$waktu','$hari','','SELESAI')"); 
  		// =================== untuk insert lokasi dan proses selesai================ 

	    // Jika Sukses, Lakukan :
    	header("location: index.php"); // Redirect ke halaman index.php
	}else{
    	// Jika Gagal, Lakukan :
	    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
	    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
	}

}else{

  // Jika gambar gagal diupload, Lakukan :
  echo "Maaf, Gambar gagal untuk diupload.";
  echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";

}

?>