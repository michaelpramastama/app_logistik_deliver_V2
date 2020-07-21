<?php

 include '../../koneksi.php';

 if(!empty($_POST["username"])) {
 	$user = $_POST["username"];
  $query = "SELECT * FROM user WHERE username= '$user' ";
  $result= mysqli_query($koneksi,$query);
  $count = mysqli_num_rows($result);

  if($count>=1) {
      echo "<span class='status-not-available'> Username Not Available.</span>";
  }else{
      echo "<span class='status-available'> Username Available.</span>";

  }

}
?>