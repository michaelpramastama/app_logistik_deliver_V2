<?php
include '../../koneksi.php';

    $id = $_POST['id'];
    $country = $_POST['name'];
  
    
    $input = "UPDATE `country` SET `negara`='$country' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $input);


    if($result){
        
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }

    


?>