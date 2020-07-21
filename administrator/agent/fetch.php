<?php
if(isset($_POST["action"]))
       {
       	include '../../koneksi.php';
       	$output = '';
       	if($_POST["action"] == "provinsi")
       	{
       		$query = "SELECT * FROM kabupaten WHERE 	province_id = '".$_POST["query"]."'ORDER BY name ASC";

       		$result = mysqli_query($koneksi, $query);
       		$output .= '<option value = "">Pilih Kabupaten</option>';
       		while($row = mysqli_fetch_array($result))
       		{
       			$output .= '<option value = "'.$row['id'].'">'.$row["name"].'</option>'; 
       		} 
       	}
       	  if($_POST["action"] == "kabupaten")
       	  {
       	  	$query = "SELECT * FROM kecamatan WHERE regency_id = '".$_POST["query"]."'";

       	  	$result = mysqli_query($koneksi,$query);
       	  	$output .= '<option value= "">select kota</option>';
       	  	while($row = mysqli_fetch_array($result))
       	  	{
       	  		$output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>'; 
       	  	} 
       	  }
       	  echo $output;
       }



?>