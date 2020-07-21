<?php

if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../koneksi.php");
 
    // get user id
    $id_rute = $_POST['id'];
 
    // delete User
    $query = "DELETE FROM harga WHERE id_rute = '$id_rute'";
    $result = mysqli_query($koneksi, $query);
    if($result){
      echo "<script>window.location = 'index.php';</script>";
    }else{
        echo "mohon maaf";
    }
}

?>