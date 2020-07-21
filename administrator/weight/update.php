<?php
include '../../koneksi.php';

  	$id_rute = $_POST['id'];
	$harga = $_POST['harga'];
	
    
    $input = "UPDATE `harga` SET `harga`='$harga' WHERE id_rute = '$id_rute'";

    $result = mysqli_query($koneksi, $input);

    if($result){
        
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }

    


?>