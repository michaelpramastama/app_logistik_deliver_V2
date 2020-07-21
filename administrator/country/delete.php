<?php

if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../koneksi.php");
 
    // get user id
    $country_id = $_POST['id'];
 
    // delete User
    $query = "DELETE FROM country WHERE id = '$country_id'";
    $result = mysqli_query($koneksi, $query);
    if($result){
      echo "<script>window.location = 'index.php';</script>";
    }else{
        echo "mohon maaf";
    }
}

?>