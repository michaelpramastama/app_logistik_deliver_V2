<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
      
        $sql = "SELECT * FROM harga  WHERE id_rute = '$id' GROUP BY id_rute";     
       $result = mysqli_query($koneksi, $sql);
       while ($row = mysqli_fetch_array($result))
       {  
           
?>
        <center>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id_rute']; ?>">
            <div class="form-group">
                <h3>
                    <span class="label label-default">
                        <?php 
                            $i = $row['country'];
                            $contri = mysqli_query($koneksi, "SELECT * FROM country where id = '$i'");
                            $r = mysqli_fetch_array($contri);
                            echo $r[1]; 
                        ?>
                    </span>
                    <h2><b>
                    <?php 
                    
                     $i = $row['id_agent'];
                            $contri = mysqli_query($koneksi, "SELECT * FROM agent where id = '$i'");
                            $r = mysqli_fetch_array($contri);
                            echo $r[2]; 
                    ?>
                    </b>
                </h2>
                </h3>
                
            </div>
           
            <!-- isi -->
            <div class="form-group">
            <img src="asset/image/arrow.png" style="transform:rotate(90deg);" />
            </div>
            <div class="form-group">
                <h3>
                    <span class="label label-default">
                        <?php 
                            $i = $row['country1'];
                            $contri = mysqli_query($koneksi, "SELECT * FROM country where id = '$i'");
                            $r = mysqli_fetch_array($contri);
                            echo $r[1]; 
                        ?>
                    </span>
                    <h2><b>
                    <?php 
                    
                     $i = $row['id_agent1'];
                            $contri = mysqli_query($koneksi, "SELECT * FROM agent where id = '$i'");
                            $r = mysqli_fetch_array($contri);
                            echo $r[2]; 
                    ?>
                    </b>
                </h2>
                </h3>
                
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $row['harga']; ?>">
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
        </center>
        <script>
        </script>

<?php
       }
}

?>
