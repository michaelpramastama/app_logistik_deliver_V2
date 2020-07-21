<?php
    include '../../koneksi.php';
    date_default_timezone_get('Asia/Jakarta');
		if(isset($_POST['insert'])){

			$subject = $_POST['subject'];
			$isi_subject = $_POST['isi_subject'];
			$agent = $_POST['agent'];
			$date = date("Y-m-d");
			$time = date("H:i:s");
			
			$input = "INSERT INTO notice(`id`, `subject`, `isi_notice`, `tanggal`, `time`, `id_agent`) VALUES(NULL,'$subject','$isi_subject','$date','$time','$agent')";

			$result = mysqli_query($koneksi, $input);

			if($result){
				header('Location: index.php');
			}else{
				echo "mohon maaf";
			}
		}
?>