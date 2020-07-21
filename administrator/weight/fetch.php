<?php
if(isset($_POST["action"]))
       {
       	include '../../koneksi.php';
       	$output = '';
       	if($_POST["action"] == "negara")
       	{
       		$query = "SELECT * FROM agent WHERE country = '".$_POST["query"]."'";

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