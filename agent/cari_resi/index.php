<?php  
  include 'header.php';
  include '../../koneksi.php';
?>
<style>
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }

    .tabb{
        -moz-transition: all .7s ease-in;
        -o-transition: all .7s ease-in;
        -webkit-transition: all .7s ease-in;
        transition: all .7s ease-in;
        padding: 20px;
    }

    .tabb a{
        text-decoration: none;
         color: black;
    }

    .tabb:hover{
        background-color: #dee0e3;
    }

</style>

<!-- page content utama -->
<div class="right_col" role="main">
    <div class="card">
        <div class="card-body">
            <ul class="nav" >
                <li class="tabb"><a data-toggle="tab" href="#home">Cek Resi</a></li>
                <li class="tabb" style="border-left: 1px solid grey;"><a data-toggle="tab" href="#menu1">Drop Resi</a></li>
            </ul>
         </div>
    </div>
<br>
<div class="tab-content">
	<!-- tab 1 -->
    <div id="home" class="tab-pane active">

        <nav class="navbar navbar-light bg-light">
            <form action="index.php" method="get" class="form-inline col-md-6">
                <input class="form-control col-sm-6" id="noresi" name="noresi" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

        <br>
        <br>
        <br>


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
                        <th width="200px"><center>Action</center></th>
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
                                    <button type="button"  data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row['no_resi']; ?>" ><img src="asset/image/tracking.png" />
                                    </button>
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
    </div>
    <!-- end  tab 1 -->
   	<!--  tab 2 -->
    <div id="menu1" class="tab-pane fade">
    	 <nav class="navbar navbar-light bg-light col-md-6">
                <input class="form-control"  type="text" name="search" id="search" placeholder="Search No Resi" onkeyup="search()" aria-label="Search">
        </nav>
        <br>
        <div class="table-responsive">
        	<table class="table table-striped" id="datatables">
        		<thead>
        			<tr>
                        <th><center>No</center></th>
        				<th><center>No Resi</center></th>
        				<th><center>Tanggal</center></th>
        				<th><center>Waktu</center></th>
        				<th><center>Action</center></th>
        			</tr>
        		</thead>
        		<!-- ================================================================================= -->
        		<?php
        			// untuk melihat id agent di user
        			$user = $_SESSION['username'];
        			$view = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user'");
        			$data1 = mysqli_fetch_assoc($view);
        		?>
        		<!-- ================================================================================= -->
        		
        		<tbody>
                    <?php
                        // untuk melihat data di cargo sesuai agent tujuan
                        $agentid = $data1['agent'];
                        $view1 = mysqli_query($koneksi, "SELECT * FROM cargo WHERE tujuan = '$agentid'");
                        $no = 1;
                        while ($row = mysqli_fetch_array($view1)) {
                    ?>
        			<tr>
                        <td><center><?php echo $no; ?></center></td>
        				<td><center><?php echo $row['no_resi']; ?></center></td>
        				<td>
        					<center>
        						<?php 
        							echo date("d-m-Y",strtotime($row['tanggal']));
        						?>
        					</center>
        				</td>
        				<td><center><?php echo $row['waktu']; ?></center></td>
        				<td>
        					<center>
        						<button type="button"  class="btn btn-primary"  onclick='hpus("<?php echo $row['no_resi']; ?>")' >DROP
                  				</button>
        					</center>
        				</td>
        			</tr>
                    <!-- ================================================================================= -->
                    <?php
                        $no++;
                        }
                    ?>
                    <!-- ================================================================================= -->
        		</tbody>
        	</table>
        </div>
    </div>
    <!-- end  tab 2 -->
</div>

<!-- modal update -->    
<div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            		<h5 class="modal-title" id="exampleModalLabel">Tracking</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">	
            			<span aria-hidden="true">&times;</span>
            		</button>
       		</div>

        	<div class="modal-body">
        		<div class="fetched-data"></div>
        	</div>

        	<div class="modal-footer">
            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
////          Search ////////////////////////

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

///hapus ////////////////////////

function hpus(id) {
	var conf = confirm("Apakah Barang dengan No Resi "+id+" Sudah tiba ..?");
		if (conf == true) {
	    	$.post("drop.php", {
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

</script>
</body>
</html>

