
  <?php  
  include 'header.php';
  include '../../koneksi.php';
     
  ?>


        <!-- page content utama -->
<div class="right_col" role="main">
    <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal">
              ADD
    </button>
    <div class="card">
        <div class="card-body">
          <h3>Pengumuman</h3>
          <h4>
              <small>Data Pengumuman</small>
          </h4>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="200px"><center>Subject</center></th>
                    <th width="200px"><center>Isi Notice</center></th>
                    <th width="200px"><center>Date</center></th>
                    <th width="200px"><center>Time</center></th>
                    <th width="250px"><center>Agent</center></th>
                    <th width="250px"><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                        <?php
                              $no = 1;
                                 $query = "SELECT * from notice order by tanggal desc";
                                 $result = mysqli_query($koneksi, $query);
                              // =========================
                            while($row = mysqli_fetch_array($result))  
                            {  
                        ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row["subject"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo substr($row['isi_notice'],0,30); ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["tanggal"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["time"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["id_agent"]; ?></center></td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalview"  data-id="<?php echo $row["id"]; ?>"><img src="asset/image/eye.png" /></button>
                            <button type="button" id="add" data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row["id"]; ?>" ><img src="asset/image/edit.png" /></button>
                            <button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row["id"]; ?>")' ><img src="asset/image/delete.png" /></button>
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
    <!-- page modal -->
      <!-- modal view -->    
    <div id="modalview" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">DETAIL AGENT</h4>
                </div>
                <div class="modal-body">
                      <div class="view"></div>
                </div>
            </div>
        </div>
    </div>

          <!-- end modal view -->   
      <!-- modal view -->    
    <div id="modalupdate" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blue;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">UPDATE</h4>
                </div>
                <div class="modal-body">
                      <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>

          <!-- end modal view -->   
        <!--  modal input --> 
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">MASUKAN PENGUMUMAN</h4>
                </div>
                <div class="modal-body">
                    <form action="insert.php" method="post">
                      <!-- username -->
                          <div class="form-group">
                              <label>Subject Pengumuman:</label>
                              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject Pengumuman">
                          </div>
                          <br />
                          <!-- telfon -->
                            <div class="form-group">
                              <label >Isi Pengumuman:</label>
                              <textarea type="text" class="form-control" name="isi_subject" id="isi_subject" placeholder="Isi Pengumuman" style="resize:none;width:565px;height:100px;"></textarea>
                          </div>
                          <br />
                          <!-- provisnis -->
                          <div class="form-group">
                                
                                      <?php
                                         $query1 = "SELECT * from agent order by id desc";
                                         $result1 = mysqli_query($koneksi, $query1);
                                    ?>
                                 <label >Agent :</label>
                                <select name="agent" id="agent" class="form-control action">
                                    <option value="">--Agent--</option>  
                                        <?php while($row = mysqli_fetch_array($result1) ) : ?>
                                            <option value="<?php echo($row[0]);?>" ><?php echo($row[1]);?></option>
                                        <?php endwhile; ?> 
                                </select>
                          </div>
                          <br>
                          <div class="text-right">
                              <button ="right" type="submit" name="insert" id="insert" class="btn btn-primary submitBtn">SUBMIT</button>						
                          </div>
                    </form>
                </div>
            </div>
        </div>
		</div>
    <!-- end modal input --> 
                

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
			 var conf = confirm("Yakin Ingin Menghapus Data jadwal..?");
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


</script>
</body>


</html>
