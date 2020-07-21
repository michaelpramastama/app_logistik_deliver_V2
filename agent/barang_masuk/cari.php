<?php
if(isset($_POST["cari"])){
        include '../../koneksi.php';
        $output = '';
        $query = "SELECT * FROM harga WHERE id_agent = '".$_POST["agent1"]."' AND id_agent1 = '".$_POST["agent2"]."' ";
           $result = mysqli_query($koneksi, $query);

           $row = mysqli_num_rows($result); 

           if($row >= 1){

               $hasil = mysqli_fetch_assoc($result);
               $output .=''.$hasil['harga'].'';
    
               echo $output;
           }else{
                $output .='<label>Rute Belum Ada</label>';
    
               echo $output;
           }

}