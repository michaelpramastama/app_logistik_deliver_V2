<?php
include '../../koneksi.php';

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nama_agent = $_POST['nama_agent'];
	$telfon = $_POST['telfon'];
	$rek = $_POST['rekening'];
	$provinsi = $_POST['provinsi'];
	$kabupaten = $_POST['kabupaten'];
	$kecamatan = $_POST['kecamatan'];
	$alamat = $_POST['alamat'];
	$kode = $_POST['kode'];
    
    $input = "UPDATE `agent` SET `penanggung_jawab`='$nama',`nama_agent`='$nama_agent',`no_telfon`='$telfon',`alamat`='$alamat',`rekening`='$rek',`provisinsi`='$provinsi',`kabupaten`='$kabupaten',`kecamatan`='$kecamatan',`kode_agent`='$kode' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $input);


    if($result){
        
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }

    


?>