<?php
include '../../koneksi.php';

if(isset($_POST['insert'])){

  $negara = $_POST['negara'];
  $agent = $_POST['agent'];
  $harga = $_POST['harga'];
  $negara1 = $_POST['negara1'];
  $agent1 = $_POST['agent1'];
    
    $verif = mysqli_query($koneksi, "SELECT * FROM harga WHERE country ='$negara' OR id_agent = '$agent' AND country1 ='$negara' OR id_agent1 = '$agent' ");
    
    $count  = mysqli_num_rows($verif);

    if($count >= 1){
     echo '<script type="text/javascript">'; 
     echo 'alert("Rute Sudah Ada");'; 
     echo 'window.location.href = "index.php";';
     echo '</script>';
    }else{

      $lihat = mysqli_query($koneksi, "SELECT * FROM harga ORDER BY id_rute DESC LIMIT 1");
      $view =mysqli_fetch_assoc($lihat);
      $tambh = $view['id_rute'] + 1;
      $query = "INSERT INTO `harga`(`id`,`id_rute`, `country`, `id_agent`, `harga`, `country1`, `id_agent1`) VALUES (NULL,'$tambh','$negara','$agent','$harga','$negara1','$agent1')";
      $sql = mysqli_query($koneksi, $query); 
      if($sql){ 
          $query1 = "INSERT INTO `harga`(`id`,`id_rute`, `country`, `id_agent`, `harga`, `country1`, `id_agent1`) VALUES (NULL,'$tambh','$negara1','$agent1','$harga','$negara','$agent')";
          $sql1 = mysqli_query($koneksi, $query1);
          header('location: index.php'); 
      }else{
          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";

      }

    }
}



?>