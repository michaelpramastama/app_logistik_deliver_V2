<?php
include '../../koneksi.php';

    $id = $_POST['id'];
    $username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];
	$agent = $_POST['agent'];
	$email = $_POST['email'];
    $telfon = $_POST['telfon'];
    
    $input = "UPDATE `user` SET `username`='$username',`pswd`='$password',`email`='$email',`telfon`='$telfon' WHERE id = '$id'";

    $result = mysqli_query($koneksi, $input);


    if($result){
        
        header('Location: index.php');
    }else{
        echo "mohon maaf";
    }

    


?>