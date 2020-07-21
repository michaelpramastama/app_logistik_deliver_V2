<?php
include '../../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

  	$id = $_POST['id'];
	$subject = $_POST['subject'];
	$isi_subject = $_POST['isi_subject'];
	$agent = $_POST['agent'];
	$date = date("Y-m-d");
	$time = date("H:i:s");

    $input = "UPDATE `notice` SET `subject`='$subject',`isi_notice`='$isi_subject',`tanggal`='$date',`time`='$time',`id_agent`='$agent' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $input);

    if($result){
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }
?>