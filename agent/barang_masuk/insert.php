<?php

include '../../koneksi.php';
date_default_timezone_get('Asia/Jakarta');

if(isset($_POST['insert'])){

	$no_resi = $_POST['no_resi'];
	$alamat_penerima = $_POST['alamat_penerima'];
	$nama_penerima = $_POST['nama_penerima'];
	$telfon_penerima = $_POST['telfon_penerima'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$telfon_pengirim = $_POST['telfon_pengirim'];
	$jenis_barang = $_POST['jenis_barang'];
    $berat = $_POST['berat'];
	$total = $_POST['totall'];
	$totalmur = $_POST['totalmur'];
	$agent = $_POST['agent'];
	$agent2 = $_POST['agent2'];
	$agent1 = $_POST['agent1'];
	$panjang = $_POST['panjang'];
	$lebar = $_POST['lebar'];
	$tinggi = $_POST['tinggi'];
	$putndpt = $_POST['putndpt'];
	$putpket = $_POST['putpket'];
	$transport = $_POST['sel1'];
	$i_hitung = $_POST['i_hitung'];

	$p_kg = $_POST['pndpt'];
	$p_pkt = $_POST['p_pkt'];

	$hari = date('Y-m-d');
 	$waktu = date('H:i:s');


	// =========== input ke database barang masuk ================
	$input = "INSERT INTO barang_masuk(`id`, `no_resi`, `alamat_tujuan`, `nama_penerima`, `no_telfon_penerima`, `nama_pengirim`, `no_telfon_pengirim`, `keterangan_barang`, `berat`, `P`, `L`, `T`, `total`,  `totalmur`, `i_hitung`, `transport`, `status`, `tanggal`, `waktu`, `agent`, `agent1`, `agent2`) VALUES 

	(NULL,'$no_resi','$alamat_penerima','$nama_penerima','$telfon_penerima','$nama_pengirim','$telfon_pengirim','$jenis_barang',' $berat','$panjang','$lebar','$tinggi','$total','$totalmur','$i_hitung','$transport','Waiting Payment','$hari','$waktu','$agent','$agent1','$agent2')";

	$result = mysqli_query($koneksi, $input);
	// =========== input ke database barang masuk ================

	if($result){

		// =========== update pendapata sesuai komisi ================
		$update = "UPDATE agent SET pendapatan = pendapatan + '$putndpt' where id = '$agent'";
		$result1 = mysqli_query($koneksi, $update);
		// =========== update pendapata sesuai komisi  ================

		// =========== update pendapata sesuai paket ================
		$updatee = "UPDATE agent SET pend_paket = pend_paket + '$putpket' where id = '$agent'";
		$resultt1 = mysqli_query($koneksi, $updatee);
		// =========== update pendapata sesuai paket  ================


		// =========== untuk operator pendapatan agent  ================
		$cek = mysqli_query($koneksi, "SELECT * FROM pendapatan_agent WHERE id_agent = '$agent'");
		$cek1 = mysqli_num_rows($cek);

		if($cek1 <= 0){
			$masuk = mysqli_query($koneksi, "INSERT INTO `pendapatan_agent`(`id`, `id_agent`, `saldo`) VALUES (NULL,'$agent','$totalmur')");
		}else{

			$update1 = "UPDATE pendapatan_agent SET saldo = saldo + '$totalmur' where id_agent = '$agent'";
			$result2 = mysqli_query($koneksi, $update1);
		}
		// =========== untuk operator pendapatan agent ================


		// =========== update pendapatan (histoy) ================
		$input1 = "INSERT INTO lap_pend_agent(`id`, `no_resi`, `tanggal`, `waktu`, `p_kg`, `p_pkt`, `pnd_kg`, `pnd_paket`, `nominal`, `agent`) VALUES(NULL,'$no_resi','$hari','$waktu','$p_kg','$p_pkt','$putndpt','$putpket','$totalmur','$agent')";
		$result2 = mysqli_query($koneksi,$input1);
		// =========== update pendapatan (histoy) ================


		// =========== update ke lokasi ================	
		 $drop = mysqli_query($koneksi, "INSERT INTO lokasi(`id`, `no_resi`, `id_kurir`, `keterangan`, `waktu`, `tanggal`, `tujuan`, `status`) VALUES (NULL,'$no_resi','','SORTING AND WAITING FOR PICK UP','$waktu','$hari','','PROSES')");
		// ===========  update ke lokasi ================	


		header('Location: ../list_transaksi');

	}else{
		echo "mohon maaf";
	}

}



?>