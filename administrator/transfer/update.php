<?php

include '../../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

$id = $_POST['id'];
$status = $_POST['status'];

$date = date("d-F-Y");
$time = date("H:i:s");

$input = "UPDATE `agent` SET `komisi`='$status' WHERE id = '$id'";
$result = mysqli_query($koneksi, $input);

if($result){
    header('Location: index.php');
}else{
    echo "mohon maaf";
}

?>