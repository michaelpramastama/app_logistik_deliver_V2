<?php
  if(isset($_POST['id']) && isset($_POST['id']) != "")
	{
    // include Database connection file
    include("../../koneksi.php");

    // get user id
    $resi = $_POST['id'];

    $lih = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE no_resi  = '$resi' ORDER BY id DESC LIMIT 1");
    $lihat = mysqli_fetch_assoc($lih);
    $from = $lihat['tujuan'];
    $id =$lihat['id_kurir'];
    // verifikasi drop
    $hari = date('Y-m-d');
	$waktu = date('H:i:s');
    $drop = mysqli_query($koneksi, "INSERT INTO lokasi(`id`, `no_resi`, `id_kurir`, `keterangan`, `waktu`, `tanggal`, `tujuan`, `status`) VALUES (NULL,'$resi','$id','DROPED AT','$waktu','$hari','$from','PROSES')");
    
    if($drop){

    	// delete User
	    $query = "DELETE FROM cargo WHERE no_resi = '$resi'";
	    $result = mysqli_query($koneksi, $query);

      	echo "<script>window.location = 'index.php';</script>";

    }else{

        echo "mohon maaf";

    }
}
?>