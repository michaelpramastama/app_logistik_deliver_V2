
  <?php  
  include 'header.php';
  include '../../koneksi.php';
  $agent= '';

  $sql = "SELECT * from country";
  $result = mysqli_query($koneksi, $sql);
  while($row = mysqli_fetch_array($result)){
      $agent .='<option value="'.$row[0].'">'.$row[1].'</option>';
  }
  ?>


        <!-- page content utama -->
        <div class="right_col" role="main">
            <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal">
              ADD
            </button>
            <div class="card">
                <div class="card-body">
                    <h3>Country</h3>
                    <h4>
                        <small>Data Contry</small>
                    </h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover " id="datatables"> 
                    <thead>
                        <tr>
                            <th width="30px"><center>No</center></th>
                            <th width="250px"><center>Name Country</center></th>
                            <th width="150px"><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody id="barisData">
                        <?php
                              $no = 1;
                              $query = "SELECT * FROM country order by negara asc ";
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
                            <td style="vertical-align: middle;"><center><?php echo $row["negara"]; ?></center></td>  
                            <td style="vertical-align: middle;"><center><button type="button"  data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row["id"]; ?>" ><img src="asset/image/edit.png" /></button>
                            <button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row["id"]; ?>")' ><img src="asset/image/delete.png" /></button>
                            </center></td>  
                        </tr> 
                      <?php 
                          $no++; 
                              }  
                      ?>  
                    </tbody>
                </table>
            </div>
          <!-- page modal -->
          <!--  modal input --> 
          <div id="addmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">INPUT COUNTRY</h4>
                </div>
                <div class="modal-body">
                  <form action="insert.php" method="post">
                      <!-- username -->
                      <div class="form-group">
                          <label>Name Country:</label>
                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Name Negara">
                      </div>
                      <br />
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
///          hapus ////////////////////////
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

///          update ////////////////////////
 
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
///         end update ////////////////////////

</script>
</body>


</html>
