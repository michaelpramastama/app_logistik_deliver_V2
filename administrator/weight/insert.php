<?php
include '../../koneksi.php';

if(isset($_POST['s_agent'])){

  $id = $_POST['id'];
  $agent = $_POST['t_agent'];

  $up1 = mysqli_query($koneksi, "UPDATE `setting` SET `k_agent`='$agent' WHERE id = '$id'");
  if($up1){
     header('Location: index.php');
  }else{
    echo "gagal update database";
  }


}else if(isset($_POST['s_pkt'])){
  
  $id = $_POST['id'];
  $paket = $_POST['t_paket'];

  $up2 = mysqli_query($koneksi, "UPDATE `setting` SET `k_pkt`='$paket' WHERE id = '$id'");
  if($up2){
     header('Location: index.php');
  }else{
    echo "gagal update database";
  }


}else if(isset($_POST['s_kargo'])){
    
    $id = $_POST['id'];
    $kargo = $_POST['t_cargo'];

  $up3 = mysqli_query($koneksi, "UPDATE `setting` SET `cargo`='$kargo' WHERE id = '$id'");
  if($up3){
     header('Location: index.php');
  }else{
    echo "gagal update database";
  }


}



?>