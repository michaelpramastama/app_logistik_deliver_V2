<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
      
        $sql = "SELECT * FROM agent WHERE id = '$id'";     
       $result = mysqli_query($koneksi, $sql);
       while ($row = mysqli_fetch_array($result))
       {  
           
?>

        <form action="insert.php" method="post" enctype="multipart/form-data">
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
                <label >Penanggung Jawab:</label>
                <h1><b><?php echo $row['penanggung_jawab']; ?></b></h1>
            </div>
                <h2><b><?php echo $row['no_telfon']; ?></b></h2>
            <div class="form-group">
                <label >Keterangan:</label>
                <input type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan" required>
            </div>
            <!-- gambar -->
            <div class="form-group">
                <label>Gambar:</label>
                <input type="file" name="image" id="image" onchange="readURL(this);" required/>
                <img id="blah" src="#" alt="your image" />
            </div>
            <div class="form-group">
                <label >Nominal :</label>
                <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" required> 
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
        <script>
        </script>

<?php
       }
}

?>
<script type="text/javascript">
function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(400)
                            .height(200);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
</script>