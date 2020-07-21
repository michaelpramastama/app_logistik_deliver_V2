<?php
include '../../koneksi.php';

if ($_POST['rid']) {
     $id = $_POST['rid'];
                 
?>

    <table class="table">
        <thead>
            <tr>
                <th><center>#</center></th>
                <th><center>Tanggal</center></th>
                <th><center>Time</center></th>
                <th><center>Nominal</center></th>
                <th><center>Keterangan</center></th>
            </tr>
        </thead>
        <tbody>
        <?php
                     $no = 1;
                  $sql = "SELECT * FROM uang_masuk WHERE agent = '$id' order by id desc";     
                    $result = mysqli_query($koneksi, $sql);
                    while ($row = mysqli_fetch_array($result))
                    { 
        ?>
            <tr>
                <td><center><?php echo $no;?></center></td>
                <td><center><?php echo $row['date'];?></center></td>
                <td><center><?php echo $row['time'];?></center></td>
                <td><center><?php echo $row['nominal'];?></center></td>
                <td><center><?php echo $row['keterangan'];?></center></td>
            </tr>
        <?php
             $no++; 
                    }
        ?>
        </tbody>
    </table>
   
<?php
    //    }
}

?>
