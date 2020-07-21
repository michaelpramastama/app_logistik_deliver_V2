<?php
include '../../koneksi.php';

if ($_POST['rid']) {
     $id = $_POST['rid'];

         
           
?>

        <form action="insert1.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
             <!-- username -->
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <br />
            <!-- email -->
            <div class="form-group">
                <label >Email:</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <br />
            <!-- telfon -->
            <div class="form-group">
                <label >Telfon:</label>
                <input type="text" class="form-control" name="telfon" id="telfon" placeholder="Telfon">
            </div>
                <br />
            <!-- agent -->
                <input type="hidden" name="agent" id="agent" value="<?php echo $id; ?>">
            <!-- password -->
            <div class="form-group">
                <label >Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <br />
            <!-- level -->
            <div class="form-group">
                <input type="hidden" class="form-control" value="agent" name="level" id="level" >
            </div>
            <div class="text-right">
                <button ="right" type="submit" name="insert" id="insert" class="btn btn-primary submitBtn">SUBMIT</button>						
            </div>
            
        </form>
    
                   
<?php
            }

?>