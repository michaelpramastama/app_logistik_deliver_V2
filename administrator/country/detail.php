<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
   

        $sql = "SELECT * from country";
        $result = mysqli_query($koneksi, $sql);

      
       $sql = "SELECT * FROM country WHERE id = '$id'";
       $result = mysqli_query($koneksi, $sql);

       while ($row = mysqli_fetch_array($result))
       {
           
?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Name Country:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['negara'];  ?>" placeholder="Name Country">
            </div>
            <br />
            <button class="btn btn-primary" type="submit">Update</button>
        </form>

<?php
       }
}

?>