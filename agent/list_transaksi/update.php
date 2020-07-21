<?php
include '../../koneksi.php';

    $no_resi = $_POST['no_resi'];
    $total = $_POST['total'];
    $total_tran = $_POST['total_tran'];

    $data = mysqli_query($koneksi,"select * from barang_masuk where no_resi = '$no_resi'");
    $cek_login = mysqli_fetch_assoc($data);
    $agent =  $cek_login['agent'];

    
    $update = "UPDATE agent SET pendapatan = pendapatan - '$total' where id = '$agent'";
	$result = mysqli_query($koneksi, $update);
    
    
    if($result){
        $update1 = "UPDATE pendapatan_agent SET saldo = saldo - '$total_tran' where id_agent = '$agent'";
        $result1 = mysqli_query($koneksi, $update1);

        $query1 = "DELETE FROM lap_pend_agent where no_resi = '$no_resi'";
        $result2 = mysqli_query($koneksi, $query1);

        $query = "DELETE FROM barang_masuk where no_resi = '$no_resi'";
        $result1 = mysqli_query($koneksi, $query);
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }

    


?>