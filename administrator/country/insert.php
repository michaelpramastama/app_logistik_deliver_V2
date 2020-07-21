<?php
    include '../../koneksi.php';
if(isset($_POST['insert'])){
	
	$country = $_POST['nama'];


$input = "INSERT INTO country(`id`, `negara`) VALUES (NULL,'$country')";

$result = mysqli_query($koneksi, $input);


if($result){
	
	header('Location: index.php');
}else{
	echo "Sorry";
}

}

?>