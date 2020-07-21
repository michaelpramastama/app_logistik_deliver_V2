<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
     $view = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE no_resi = '$id'");
     $view1 = mysqli_fetch_array($view);
?>

<label>No Resi</label>&emsp;&emsp;&emsp;&emsp;&emsp;<label>: <?php echo $view1['no_resi']; ?></label><br>
<label>Nama Penerima</label>&emsp; <label>: <?php echo $view1['nama_penerima']; ?></label><br>
<label>No Telfon</label>&emsp;&emsp;&emsp;&emsp;<label>: <?php echo $view1['no_telfon_penerima']; ?></label><br>
<label>No Identitas</label>&emsp;&emsp;&emsp;<label>: <?php echo $view1['no_identitas']; ?></label><br>
<label>Tanggal</label>&emsp;&emsp;&emsp;&emsp;&emsp;<label>: 
	<?php 
		$tanggall = $view1['tanggal'];
       	echo date('d-m-Y',strtotime($tanggall)); 
       	echo "  "; 
       	$waktu = $view1['waktu'];
       	echo date('H:i',strtotime($waktu)); 
    ?>
</label><br>
<label>Image</label>&emsp;&emsp;&emsp;
<label>
	<img src="file/id/<?php echo $view1['image_id']?>" style="width: 350px; height: 200px;">
</label><br>
<?php
       }
?>