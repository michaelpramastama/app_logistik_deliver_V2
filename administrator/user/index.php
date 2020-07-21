<?php  
	  include 'header.php';
	  include '../../koneksi.php';
	  $agent= '';
	  $sql = "SELECT * from agent";
	  $result = mysqli_query($koneksi, $sql);
	  while($row = mysqli_fetch_array($result)){
	      $agent .='<option value="'.$row[0].'">'.$row[1].'</option>';
  		}
?>
        <!-- page content utama -->
<div class="right_col" role="main">
  	<!-- button add untuk menambahkan user -->
    <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal">
        ADD
    </button>

    <!-- Card -->   
    <div class="card">
        <div class="card-body">
            <h3>User</h3>
            <h4>
                <small>Data User</small>
            </h4>
        </div>
    </div>

    <!-- Table utama -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="250px"><center>Nama</center></th>
                    <th width="250px"><center>Email</center></th>
                    <th width="250px"><center>Country</center></th>
    	   	        <th width="150px"><center>Telfon</center></th>
                    <!-- <th width="200"><center>Agent</center></th> -->
                    <th><center>Level</center></th>
            	    <th width="150px"><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                <?php
                    $no = 1;
                    $query = "SELECT * FROM `user` order by username asc ";
                    $result = mysqli_query($koneksi, $query);
                    // =========================
                	//   $query1 = "SELECT * FROM agent INNER JOIN user ON agent.id = user.agent ";
                    //   $result1 = mysqli_query($koneksi, $query1);
                    while($row = mysqli_fetch_array($result)  )  
                        {  
                           // $row1 = mysqli_fetch_array($result1);
                ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row["username"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["email"]; ?></center></td>  
                	<td style="vertical-align: middle;"><center><?php echo $row["negara"]; ?></center></td>  
                    <!-- <td style="vertical-align: middle;"><center><?php echo $row["kode_agent"]; ?></center></td> -->  
                    <td style="vertical-align: middle;"><center><?php echo $row["telfon"]; ?></center></td>  
                    <!-- <td style="vertical-align: middle;"><center><?php echo $row["agent"]; ?></center></td>   -->
                    <td style="vertical-align: middle;"><center><?php echo $row["level"]; ?></center></td>
                    <td style="vertical-align: middle;">
                    	<center>

                    		<button type="button"  data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row["id"]; ?>" ><img src="asset/image/edit.png" />
                    		</button>

                            <button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row["id"]; ?>")' ><img src="asset/image/delete.png" />
                            </button>

                        </center>
                    </td>  
                </tr> 
                   	<?php 
                    	$no++; 
                        }  
                   	?>  
            </tbody>
        </table>
    </div>
    <!-- ENd Table utama -->

   	<!--  page modal input --> 
  	<div id="addmodal" class="modal fade" role="dialog">
       	<div class="modal-dialog">
       	    <div class="modal-content">

            	<div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal">&times;</button>
              		<h4 class="modal-title">MASUKAN USER</h4>
          		</div>

               	<div class="modal-body">
                  	<form action="insert.php" method="post">

                     	<!-- username -->
                     	<div class="form-group">
                        	<label>Name:</label>
                        	<input type="text" class="form-control" name="username" id="username" placeholder="Username" onkeyup="checkAvailability()" required><span id="user-availability-status"></span>
                     	</div>
                     	<br />

                      	<!-- email -->
                      	<div class="form-group">
                        	<label >Email:</label>
                        	<input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                     	</div>
                      	<br />

                      	<!-- telfon -->
                   		<div class="form-group">
                   			<label >Telfon:</label>
                   			<input type="text" class="form-control" name="telfon" id="telfon" placeholder="Telfon" required>              
                   		</div>
                       	<br />
                       	

                      	<!-- level -->
                      	<div class="form-group">
                        	<label>Level:</label>
                        	<select class="form-control" name="level" id="level" onchange="ganti()" placeholder="Level" required>
                        		<option></option>
			                    <option value="admin">admin</option>
			                    <option value="agent">agent</option>
			                    <option value="kurir">Kurir</option>
                        	</select>
                      	</div>

                      	<!-- agent -->
                      	<div class="form-group">
                        	<label id="lbl">Agent:</label>
                        	<select class="form-control" name="agent" id="agent"placeholder="Agent" >
                        		<option></option>
                        			<?php echo $agent ?>
                          	</select>
                      	</div>
                      	<br />

                    	<!-- password -->
                      	<div class="form-group">
                        	<label >Password:</label>
                          	<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                      	</div>
                      	<br />
                      	
                      	<!-- button submit -->
                      	<div class="text-right">
                        	<button ="right" type="submit" name="insert" id="insert" class="btn btn-primary submitBtn">SUBMIT</button>						
                      	</div>
                  	</form>
                </div>
            </div>
       	</div>
	</div>
	<!-- end modal input --> 

	<!-- modal update -->    
   	<div class="modal fade" id="modalupdate" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail User</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
   	</div>
    <!-- end modal update -->   

<!-- end main -->
</div>

<?php
	include 'footer.php';
?>

<script type="text/javascript">

	$(document).ready( function () {
	      $('#datatables').DataTable();
	});


	/// hapus ////////////////////////
    function hpus(id) {
		var conf = confirm("Yakin Ingin Menghapus Data User..?");
			if (conf == true) {
       			$.post("delete.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                $('#datatables').html(data); 
            }
          );
      }
    //  window.location = 'index.php';
	}

	/// update ////////////////////////
	$(document).ready(function(){
        $('#modalupdate').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  'rowid='+ rowid,
                success : function(data){
                	$('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
	/// end update ////////////////////////

	function checkAvailability() {

		$.ajax({
				url: "check.php",
				data:'username='+$("#username").val(),
				type: "POST",
				success:function(data){
					$("#user-availability-status").html(data);
				}
		});
	}
		
	/// level  ////////////////////////
	function ganti(){
        var x = document.getElementById("level").value;
        if(x == 'kurir' || x == 'admin'){
            $("#agent").hide(800);
            $("#lbl").hide(800);
        }else{
            $("#agent").show(800);
            $("#lbl").show(800);
        }
    }
</script>
</body>
</html>

