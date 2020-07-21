<?php
    include '../../koneksi.php';
if(isset($_POST['insert'])){
	
	$nama = $_POST['nama'];
	$nama_agent = $_POST['nama_agent'];
	$country = $_POST['country'];
	$telfon = $_POST['telfon'];
	$kode = $_POST['kode'];
	$rekening = $_POST['rekening'];
	$provinsi = $_POST['provinsi'];
	$kabupaten = $_POST['kabupaten'];
	$kecamatan = $_POST['kecamatan'];
	$alamat = $_POST['alamat'];


$input = "INSERT INTO agent(`id`, `penanggung_jawab`, `nama_agent`, `no_telfon`, `alamat`, `rekening`, `country`, `provisinsi`, `kabupaten`, `kecamatan`, `kode_agent`) VALUES 
(NULL,'$nama','$nama_agent','$telfon','$alamat','$rekening','$country','$provinsi','$kabupaten','$kecamatan','$kode')";

$result = mysqli_query($koneksi, $input);


if($result){
	header('Location: index.php');
}else{
	echo "mohon maaf";
}

}

?>