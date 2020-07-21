
  <?php  
  include 'header.php';
  include '../../koneksi.php';
     
  ?>


        <!-- page content utama -->
<div class="right_col" role="main">
    <div class="card">
        <div class="card-body">
          <h3>Komisi Paket</h3>
          <h4>
              <small>Data Komisi Paket</small>
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
                    <th width="200px"><center>Status</center></th>
                    <th width="250px"><center>Aksi</center></th>
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
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                            $disabled = '';
                             $active = '';
                                if($row['komisi'] == '0'){
                                    $disabled .='<button class="btn btn-danger" >Disabled</button>';
                                    echo $disabled;
                                }else{
                                    $active .='<button class="btn btn-success" >Active</button>';
                                    echo $active;
                                }                         
                            ?>
                        </center>
                    </td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalupdate"  data-id="<?php echo $row["id"]; ?>"><img src="asset/image/eye.png" /></button>
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
        <div class="modal-dialog modal-sm">
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
</script>
</body>


</html>
