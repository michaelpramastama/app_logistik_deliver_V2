<?php  
  include 'header.php';
  include '../../koneksi.php';
?>

<div class="right_col" role="main">
	<?php
        $nm = $_SESSION['username'];
        $ver = mysqli_query($koneksi, "SELECT * FROM user where username ='$nm'");
        $sh = mysqli_fetch_assoc($ver);
        $cb = $sh['pswd'];
    ?>
    <input type="hidden" nama="asal" id="asal" value="<?php echo $cb; ?>">
		<div class="row">
	       <?php
	           $view = mysqli_query($koneksi,"SELECT * FROM setting");
		       $lihat = mysqli_fetch_assoc($view);
	        ?>

        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats" style="padding: 20px;">
                <div class="count">% Agent (kg)</div>
	                <form action="insert.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $lihat['id']; ?>">
                        <input type="text" class="form-control" name="t_agent" id="t_agent" value="<?php echo $lihat['k_agent']; ?>"><br>
                        <center>
	                        <button class="btn btn-info btn-md" name="s_agent" id="s_agent" >Save</button>
	                        <button class="btn btn-info btn-md" type="button" name="c_agent" id="c_agent" data-toggle="modal" data-target="#modal">Change</button>
	                    </center>

    		        </form>
	            </div>
	        </div>
	
	        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
	            <div class="tile-stats" style="padding: 20px;">
	                <div class="count">% Agent (PKT)</div>
		                <form action="insert.php" method="post">
	                        <input type="hidden" name="id" value="<?php echo $lihat['id']; ?>">
	                        <input type="text" class="form-control" name="t_paket" id="t_paket" value="<?php echo $lihat['k_pkt']; ?>"><br>
	                        <center>
		                        <button class="btn btn-info btn-md" name="s_pkt" id="s_pkt">Save</button>
		                        <button class="btn btn-info btn-md" type="button" name="c_pkt" id="c_pkt" data-toggle="modal" data-target="#modal1">Change</button>
	                        </center>
		                </form>
		            </div>
		        </div>
		
		        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
			        <div class="tile-stats" style="padding: 20px;">
		                <div class="count">Cargo (RP)</div>
				            <form action="insert.php" method="post">
			                    <input type="hidden" name="id" value="<?php echo $lihat['id']; ?>">
		                        <input type="text" class="form-control" name="t_cargo" id="t_cargo" value="<?php echo $lihat['cargo']; ?>"><br>
		                        <center>
			                        <button class="btn btn-info btn-md" name="s_kargo" id="s_kargo">Save</button>
			                        <button class="btn btn-info btn-md" type="button" name="c_kargo" id="c_kargo"  data-toggle="modal" data-target="#modal2">Change</button>
			                    </center>
		                	</form>
			            </div>
			        </div>
			    </div>

    			<div id="modal" class="modal fade" role="dialog">
			        <div class="modal-dialog modal-sm">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal">&times;</button>
				                <h4 class="modal-title">Verifikasi</h4>
			                </div>
			                <div class="modal-body">
				                <div class="form-group">
			                        <input type="password" class="form-control" name="cek" id="cek">
			                    </div>
			                    <button class="btn btn-info" onclick="myFunction()">CEK</button>
			                </div>
			            </div>
			        </div>
			    </div>

    			<div id="modal1" class="modal fade" role="dialog">
			        <div class="modal-dialog modal-sm">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal">&times;</button>
			                    <h4 class="modal-title">Verifikasi</h4>
			                </div>
			                <div class="modal-body">
			                    <div class="form-group">
                        			<input type="password" class="form-control" name="cek1" id="cek1">
                      			</div>
			                    <button class="btn btn-info" onclick="myFunction1()">CEK</button>
			                </div>
			            </div>
			        </div>
			    </div>

			    <div id="modal2" class="modal fade" role="dialog">
				    <div class="modal-dialog modal-sm">
			            <div class="modal-content">
			                <div class="modal-header">
			                    <button type="button" class="close" data-dismiss="modal">&times;</button>
			                    <h4 class="modal-title">Verifikasi</h4>
			                </div>
			                <div class="modal-body">
			                    <div class="form-group">
				                    <input type="password" class="form-control" name="cek2" id="cek2">
			                    </div>
			                    <button class="btn btn-info" onclick="myFunction2()">CEK</button>
			                </div>
			            </div>
			        </div>
			    </div>

    <!-- end modal view  -->

</div>

        

<?php

include 'footer.php';

?>

<script src="asset/js/md5.min.js"></script>
<script>
	$(document).ready(function() {
	    document.getElementById("s_agent").disabled = true;
	    document.getElementById("s_pkt").disabled = true;
	    document.getElementById("s_kargo").disabled = true;
	    document.getElementById("t_agent").disabled = true;
    	document.getElementById("t_paket").disabled = true;
	    document.getElementById("t_cargo").disabled = true;
	})


function myFunction() {
    var cek = $('#cek').val();
    var hash = md5(cek);
    var asal = $('#asal').val();

    if(asal ==  hash){
        $('#modal').modal('hide');
         document.getElementById("s_agent").disabled = false;
         document.getElementById("t_agent").disabled = false;
         document.getElementById("c_agent").disabled = true;
    }else{
        alert("gagal");
    }
}


function myFunction1() {
    var cek = $('#cek1').val();
    var hash = md5(cek);
    var asal = $('#asal').val();

    if(asal ==  hash){
        $('#modal1').modal('hide');
         document.getElementById("s_pkt").disabled = false;
         document.getElementById("t_paket").disabled = false;
         document.getElementById("c_pkt").disabled = true;
    }else{
        alert("gagal");
    }
}


function myFunction2() {
    var cek = $('#cek2').val();
    var hash = md5(cek);
    var asal = $('#asal').val();
   
    if(asal ==  hash){
        $('#modal2').modal('hide');
         document.getElementById("s_kargo").disabled = false;
         document.getElementById("t_cargo").disabled = false;
         document.getElementById("c_kargo").disabled = true;
    }else{
        alert("gagal");
    }
}

</script>
</body>
</html>

