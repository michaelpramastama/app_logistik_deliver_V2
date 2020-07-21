<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
    
       $sql = "SELECT * FROM user WHERE id = '$id'";
       $result = mysqli_query($koneksi, $sql);

       while ($row = mysqli_fetch_array($result))
       {
           
?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'];  ?>" placeholder="Username">
            </div>
            <br />
            <!-- email -->
            <div class="form-group">
                <label >Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email'];  ?>" placeholder="Email">
            </div>
            <br />
            <!-- telfon -->
            <div class="form-group">
                <label >Telfon:</label>
                <input type="text" class="form-control" name="telfon" id="telfon" value="<?php echo $row['telfon'];  ?>" placeholder="Telfon">
            </div>
            <br />
            <!-- password -->
            <div class="form-group">
                <label >Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <br />

              <button class="btn btn-primary" type="submit">Update</button>
        </form>

<?php
       }
}

?>