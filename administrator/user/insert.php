<?php
    include '../../koneksi.php';
if(isset($_POST['insert'])){
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];
	$agent = $_POST['agent'];
	$email = $_POST['email'];
	$telfon = $_POST['telfon'];


$input = "INSERT INTO user(`id`, `username`, `pswd`, `level`,`agent`, `email`, `telfon`) VALUES (NULL,'$username','$password','$level','$agent','$email','$telfon')";

$result = mysqli_query($koneksi, $input);


if($result){
	
	header('Location: index.php');
}else{
	echo "mohon maaf";
}

}

?>