
  <?php  
  include 'header.php';
  include '../../koneksi.php';
     
  ?>


        <!-- page content utama -->
<div class="right_col" role="main">
    <div class="card">
        <div class="card-body">
          <h3>Transfer Bukti</h3>
          <h4>
              <small>Data Transfer Bukti</small>
          </h4>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="200px"><center>Country</center></th>
                    <th width="200px"><center>Agent</center></th>
                    <th width="200px"><center>Kode</center></th>
                    <th width="200px"><center>Telfon</center></th>
                    <th width="200px"><center>Pendapatan</center></th>
                    <th width="200px"><center>Rekening</center></th>
                    <th width="250px"><center>Upload</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                        <?php
                              $no = 1;
                                 $query = "SELECT * from agent order by nama_agent";
                                 $result = mysqli_query($koneksi, $query);
                              // =========================
                            while($row = mysqli_fetch_array($result))  
                            {  
                        ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                                $i = $row['country'];
                                $contri = mysqli_query($koneksi, "SELECT * FROM country where id = '$i'");
                                $r = mysqli_fetch_array($contri);
                                echo $r[1];                                   
                                ?>
                        </center>
                    </td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["nama_agent"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["kode_agent"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["no_telfon"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["pendapatan"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["rekening"]; ?></center></td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalupdate"  data-id="<?php echo $row["id"]; ?>"><img src="asset/image/upload.png" /></button>
                            <button type="button" class="btn btn-success"  id="view" data-toggle="modal" data-target="#history"  data-id="<?php echo $row["id"]; ?>"><img src="asset/image/eye.png" /></button>
                            <?php
                                if($row['komisi'] == 1){
                            ?>
                                <button type="button" class="btn btn-danger"  id="view" data-toggle="modal" data-target="#modalkom"  data-id="<?php echo $row["id"]; ?>"><img src="asset/image/eye.png" /></button>
                            <?php
                                }
                            ?>
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
    <div id="modalupdate" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
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
      <!-- modal view -->    
    <div id="modalkom" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blue;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Komisi</h4>
                </div>
                <div class="modal-body">
                      <div class="fetched-kom"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal view -->   
     <!-- modal view -->    
    <div id="history" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Riwayat</h4>
                </div>
                <div class="modal-body">
                      <div class="history-data"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal view -->   
<!-- end main -->
</div>
        
<?php
include 'footer.php';
?>
<script type="text/javascript">
  $(document).ready( function () {
      $('#datatables').DataTable();
  });
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
///          update ////////////////////////
 $(document).ready(function(){
        $('#modalkom').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail2.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-kom').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
///         end update ////////////////////////
///          history ////////////////////////
 $(document).ready(function(){
        $('#history').on('show.bs.modal', function (e) {
            var rid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'view.php',
                data :  'rid='+ rid,
                success : function(data){
                $('.history-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
///         end history ////////////////////////
</script>
</body>


</html>
