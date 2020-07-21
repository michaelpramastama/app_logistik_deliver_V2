<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
        $agent= '';

        $sql = "SELECT * from agent order by id desc";
        $result1 = mysqli_query($koneksi, $sql);

        while($row = mysqli_fetch_array($result1)){
        $agent .='<option value="'.$row[0].'">'.$row[1].'</option>';
        }

        $sql = "SELECT * FROM notice WHERE id = '$id'";     
       $result = mysqli_query($koneksi, $sql);
       while ($row = mysqli_fetch_array($result))
       {  
           
?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Subject :</label>
                <input type="text" class="form-control" name="subject" id="subject" value="<?php echo $row['subject'];  ?>">
            </div>
            <br />
            <!-- isi -->
            <div class="form-group">
                <label >Isi Pengumuman:</label>
                <textarea type="text" class="form-control" name="isi_subject" id="isi_subject"  style="resize:none;width:565px;height:100px;"><?php echo $row['isi_notice'] ?></textarea>
            </div>
            <br />
            <div class="form-group">
                <label>Agent:</label>
                <select class="form-control" name="agent" id="agent">
                    <option><?php echo $row['id_agent'];  ?></option>
                    <?php echo $agent ?>
                </select>
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