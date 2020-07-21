<?php
if(isset($_POST["action1"]))
       {
       	include '../../koneksi.php';
       	$output = '';
       	if($_POST["action1"] == "negara1")
       	{
       		$query = "SELECT * FROM agent WHERE country = '".$_POST["query1"]."'";

       		$result = mysqli_query($koneksi, $query);
       		$output .= '<option value = "">Pilih Agent</option>';
       		while($row = mysqli_fetch_array($result))
       		{
       			$output .= '<option value = "'.$row['id'].'">'.$row["nama_agent"].'</option>'; 
       		} 
       	}
       	  echo $output;
       }



?>