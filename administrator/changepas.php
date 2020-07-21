<?php
    include '../koneksi.php';
	if(isset($_POST['insert1'])){
		$username = $_POST['username1'];
		$passlam = md5($_POST['passlam1']);
		$passbar = md5($_POST['passbar1']);

		$data = mysqli_query($koneksi, "SELECT * FROM user where username = '$username'");
		$lihat = mysqli_fetch_assoc($data);

		$paslam = $lihat['pswd'];

		if($passlam == $paslam){
				$update = mysqli_query($koneksi, "UPDATE user set pswd = '$passbar' WHERE username = '$username'");
				header('Location: ../logout.php');
		}else{
			   $Confirmation = "
			   	<script> 
				   var r = confirm('Password Anda Salah');
				   if (r == true) {
				   window.history.back();
				   } 
			  	</script>";
				echo $Confirmation;
		}
}
?>