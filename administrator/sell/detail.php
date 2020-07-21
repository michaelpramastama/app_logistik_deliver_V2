<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
      
        $sql = "SELECT * FROM agent WHERE id = '$id'";     
       $result = mysqli_query($koneksi, $sql);
       while ($row = mysqli_fetch_array($result))
       {  
           
?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
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
                </h3>
                
            </div>
            <br />
            <!-- isi -->
            <div class="form-group">
                <label >Kode Agent:</label>
                <h2><b><?php echo $row['kode_agent']; ?></b></h2>
            </div>
            <div class="form-group">
                <label >Status Komisi:</label>
                <h2>
                    <b>
                        <?php 
                                $dis = '';
                                $dis1 = '';
                            if($row['komisi'] == "0"){
                                $dis.='<span class="label label-warning">Disabled</span>';
                                echo $dis;
                            }else{
                                $dis1.='<span class="label label-success">Active</span>';
                                echo $dis1;
                            }
                        ?>
                    </b>
                </h2>
            </div>
            <div class="form-group">
                <label >Penanggung Jawab:</label>
                <h1><b><?php echo $row['penanggung_jawab']; ?></b></h1>
            </div>
                <h2><b><?php echo $row['no_telfon']; ?></b></h2>
                <h2><b>Saldo : <?php echo $row['pend_paket']; ?></b></h2>
            <br>
            <div class="form-group">
                <select class="form-control" name="status" id="status" required>
                    <option value="">Pilih</option>
                    <option value="1">Active</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
            <br>

            <?php
                $cek = $row['pend_paket'];
                if($cek == '0'){
            ?>
            <button class="btn btn-primary" type="submit">Update</button>
            <?php
                }else{
            ?>
             <button class="btn btn-primary" type="submit" disabled>Update</button>
            <?php
                }
            ?>
        </form>
        <script>
        </script>

<?php
       }
}

?>