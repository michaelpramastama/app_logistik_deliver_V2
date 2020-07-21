<?php  
  include 'header.php';
  include '../../koneksi.php';
?>

<style>
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>

<!-- page content utama -->
<div class="right_col" role="main">
	
	<div class="card">
        <div class="card-body">
	        <h3><b>Barang Keluar</b></h3>
        </div>
    </div>

    <br>

    <nav class="navbar navbar-light bg-light">
        <form action="index.php" method="get" class="form-inline col-md-6">
            <input class="form-control col-sm-6" id="noresi" name="noresi" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <br>
    <br>
    <br>

    <!-- page modal -->
    <?php 
        if(!empty($_GET['noresi'])){
            $noresi = $_GET['noresi'];
    ?>

    <div class="table-responsive">
	    <table class="table table-striped table-bordered table-hover " id="datatables">
            <thead>
                <tr>
                    <th width="30px"><center>No Resi</center></th>
                    <th width="200px"><center>Nama Pengirim</center></th>
                    <th width="200px"><center>Nama Penerima</center></th>
                    <th width="350px"><center>Telfon Pengirim</center></th>
                    <th width="350px"><center>Jenis Barang</center></th>
                    <th width="350px"><center>Berat(Kg)</center></th>
                    <th width="200px"><center>Konfirmasi</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
	            <?php 
		            $query = "SELECT * FROM barang_masuk WHERE no_resi='$noresi'";
		            $result = mysqli_query($koneksi, $query);
	
	                while($row = mysqli_fetch_array($result)  )  
	                	{  
	            ?>
	                <tr>  
	                    <td style="vertical-align: middle;"><center><?php echo $row["no_resi"]; ?></center></td>  
	                    <td style="vertical-align: middle;"><center><?php echo $row["nama_pengirim"]; ?></center></td>  
	                    <td style="vertical-align: middle;"><center><?php echo $row["nama_penerima"]; ?></center></td>  
		                <td style="vertical-align: middle;"><center><?php echo $row["no_telfon_pengirim"]; ?></center></td>  
	                    <td style="vertical-align: middle;"><center><?php echo $row["keterangan_barang"]; ?></center></td>  
	                    <td style="vertical-align: middle;"><center><?php echo $row["berat"]; ?></center></td>  
	                    <td style="vertical-align: middle;">
		                    <center>
		                    	<?php
		                    		$no = $row['no_resi'];
		                    		$cek = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE no_resi = '$no'");
		                    		$cek1 = mysqli_num_rows($cek);
		                    		if($cek1 == 1){
		                    	?>
		                    		<button class="btn btn-primary" id="add" data-toggle="modal" data-id="<?php echo $row['no_resi']; ?>" data-target="#view"><img src="asset/image/image.png" /></button>
		                    	<?php
		                    		}else{
		                    	?>
		                    		<button class="btn btn-info" id="add" data-toggle="modal" data-target="#modalview"><img src="asset/image/printer.png" /></button>
		                    	<?php
		                    		}
		                    	?>
	                        </center>
	                    </td>  
	                </tr>
	            <?php 
	            	    }  
	            ?>   
            </tbody>
        </table>
    </div>

    <?php
        }else{
    ?>
    <div class="col-md-12">
        <div class="error-template">
            <h1>
                Oops!
            </h1>
            <h2>
                404 Not Found
            </h2>

            <div class="error-details">
                Sorry, no resi tidak ditemukan, pastikan no resi benar!
            </div>
        </div>
    </div>

    <?php
        }
    ?>

    <!-- modal verifikasi -->    
    <div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
		        <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Barang</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <div class="modal-body">
		            <form action="insert.php" method="post" enctype="multipart/form-data">
		            	<!-- untuk melihat agent by pass username  -->
		            	<input type="hidden" class="form-control active" name="agentId" id="agentId" 
		            		value="
		            			<?php 
		            				$user = $_SESSION['username'];
		            				$agent = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user'");
		            				$agent1 = mysqli_fetch_assoc($agent);
		            				echo $agent1['agent'];
		            			?>">
		            	<!-- untuk melihat agent by pass username  -->
	                    <div class="form-group">
	                        <label>No Resi:</label>
	                        <input type="text" class="form-control" name="no_resi" id="no_resi" value="<?php echo $noresi ?>" >
	                    </div>

	                    <br />
    	                <div class="form-group">
	                        <label>No Identitas:</label>
	                        <input type="text" class="form-control" name="no_id" id="no_id"  placeholder="No Identitas" >
	                    </div>

    	                <br />
	                    <div class="form-group">
	                        <label>Nama Penerima:</label>
	                        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"  placeholder="Nama Penerima" >
	                    </div>

    	                <br />
	                    <div class="form-group">
	                        <label>No Telfon:</label>
	                        <input type="text" class="form-control" name="no_telfon" id="no_telfon"  placeholder="No Telfon" >
	                    </div>

    	                <br />
	                    <div class="form-group">
	                        <label>Gambar:</label>
	                        <input type="file" name="image" id="image" onchange="readURL(this);"/>
	                        <img id="blah" src="#" alt="your image" />
	                    </div>

    	                <br />
			    </div>

	        			<div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
				        </div>
			        </form>
	        </div>
	    </div>
    </div>
    <!-- end modal verifikasi --> 

    <!-- modal view --> 
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
		        <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel">Detail Barang Keluar</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <div class="modal-body">
		            <div class="viescontent"></div>
			    </div>
	        </div>
	    </div>
    </div> 
    <!-- modal view -->   
<!-- end main -->
</div>

        

<?php
include 'footer.php';
?>

<script type="text/javascript">

///          Search ////////////////////////
function search(){
	
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	table = document.getElementById("datatables");
	tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[1];
		    if (td) {
			    txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
		    	    tr[i].style.display = "";
		   		} else {
			        tr[i].style.display = "none";
			    }
			}
		}
}
///          Search ////////////////////////

///          view ////////////////////////
$(document).ready(function(){
    $('#modalview').on('show.bs.modal', function (e) {
	    var rowid = $(e.relatedTarget).data('id');
	    //menggunakan fungsi ajax untuk pengambilan data
	    $.ajax({
	        type : 'post',
	        url : 'view.php',
	        data :  'rowid='+ rowid,
	        success : function(data){
		        $('.view').html(data);//menampilkan data ke dalam modal
	        }
	    });
	});
});
///         end view ////////////////////////

///          view ////////////////////////
$(document).ready(function(){
    $('#view').on('show.bs.modal', function (e) {
	    var rowid = $(e.relatedTarget).data('id');
	    //menggunakan fungsi ajax untuk pengambilan data
	    $.ajax({
	        type : 'post',
	        url : 'detail.php',
	        data :  'rowid='+ rowid,
	        success : function(data){
		        $('.viescontent').html(data);//menampilkan data ke dalam modal
	        }
	    });
	});
});
///         end view ////////////////////////

///         image ////////////////////////
// function readURL(input) {
// 	if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//         $('#blah')
//             .attr('src', e.target.result)
//             .width(400)
//             .height(200);
//         };
// 	    reader.readAsDataURL(input.files[0]);
//     }
// }
///         image ////////////////////////

</script>
</body>
</html>

