<?php

if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("../../koneksi.php");
    // get user id
    $user_id = $_POST['id'];
    // delete User
    $query = "DELETE FROM agent WHERE id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    if($result){

      echo "<script>window.location = 'index.php';</script>";

    }else{

        echo "mohon maaf";

    }
}

?>