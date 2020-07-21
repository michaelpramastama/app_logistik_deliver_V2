<?php 

// mengaktifkan session php
session_start();
// menghubungkan dengan koneksi
include 'koneksi.php';
// menangkap data yang dikirim dari form
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
//md5 untuk menecrypt
$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from user where username='$username' and pswd='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
	if($cek > 0){

		$cek_login = mysqli_fetch_assoc($data);
		$cek_login['agent'] = $_SESSION['agent1'];

 			if($cek_login['level']=="admin"){
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "admin";
				// alihkan ke halaman dashboard admin
				header("location:administrator");
				// cek jika user login sebagai agent

			}else if($cek_login['level']=="agent"){
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "agent";
				// alihkan ke halaman dashboard pegawai
				header("location:agent");
				// cek jika user login sebagai pengurus
				
			}else if($cek_login['level']=="kurir"){
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "kurir";
				// alihkan ke halaman dashboard pegawai
				header("location: kurir");
				// cek jika user login sebagai pengurus
				}else{
				// alihkan ke halaman login kembali
				header("location:index.php?pesan=gagal");
			}	
	}else{
	header("location:index.php?pesan=gagal");
}

?>