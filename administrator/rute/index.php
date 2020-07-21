
  <?php  
  include 'header.php';
  include '../../koneksi.php';
     $negara = '';
     $negara1 = '';
     $query = "SELECT * from country ";
        $result = mysqli_query($koneksi,$query);
        while($row = mysqli_fetch_array($result))
        {
            $negara .= '<option value="'.$row[0].'">'.$row[1].'</option>';
        }

     $query1 = "SELECT * from country ";
        $result1 = mysqli_query($koneksi,$query1);
        while($row1 = mysqli_fetch_array($result1))
        {
            $negara1 .= '<option value="'.$row1[0].'">'.$row1[1].'</option>';
        }
  ?>


        <!-- page content utama -->
<div class="right_col" role="main">
 <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal">
              ADD
    </button>
    <div class="card">
        <div class="card-body">
          <h3>Rute & Harga</h3>
          <h4>
              <small>Rute & Harga</small>
          </h4>
        </div>
    </div>
    
    <div class="table-responsive">
    
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="200px"><center>Country Asal</center></th>
                    <th width="200px"><center>Agent Asal</center></th>
                    <th width="200px"><center></center></th>
                    <th width="200px"><center>Country Tujuan</center></th>
                    <th width="200px"><center>Agent Tujuan</center></th>
                    <th width="200px"><center>Harga</center></th>
                    <th width="250px"><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                        <?php
                              $no = 1;
                                 $query = "SELECT * from harga WHERE id %2 <>0";
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
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                            
                            $w = $row["id_agent"];
                            $agenttt = mysqli_query($koneksi, "SELECT * FROM agent WHERE id = '$w'");
                            $t = mysqli_fetch_array($agenttt);
                            echo $t[2];

                            ?>
                        </center>
                    </td>   
                    <td style="vertical-align: middle;"><center><img src="asset/image/arrow.png" /></center></td> 
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                                $i1 = $row["country1"];
                                $contri1 = mysqli_query($koneksi, "SELECT * FROM country where id = '$i1'");
                                $r1 = mysqli_fetch_array($contri1);
                                echo $r1[1];   
                            ?>
                        </center>
                    </td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                                $w1 = $row["id_agent1"];
                                $agenttt1 = mysqli_query($koneksi, "SELECT * FROM agent WHERE id = '$w1'");
                                $t1 = mysqli_fetch_array($agenttt1);
                                echo $t1[2]; 
                            ?>
                        </center>
                    </td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["harga"]; ?></center></td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <button type="button" class="btn btn-primary"  id="view" data-toggle="modal" data-target="#modalupdate"  data-id="<?php echo $row[1]; ?>"><img src="asset/image/edit.png" /></button>
                            <button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row[1]; ?>")' ><img src="asset/image/delete.png" /></button>
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
     <!-- modal view -->    
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">TAMBAH RUTE</h4>
                </div>
                <div class="modal-body">
                    <form action="insert.php" method="post">
                        <h2><span class="label label-danger">From :</span></h2>
                      <!-- username -->
                          <div class="form-group">
                              <label>Pilih Negara :</label>
                              <select name="negara" id="negara" class="form-control action" >
                                    <option value="0">negara</option>
                                    <?php echo $negara; ?>
                              </select>
                          </div>
                    <!-- username -->
                          <div class="form-group">
                              <label>Pilih Agent :</label>
                              <select name="agent" id="agent" class="form-control action">
                                    <option value="0">Agent</option>
                              </select>
                          </div>
                          <br>
                          <div class="form-group">
                             <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" required>
                          </div>
                          <br>
                           <h2><span class="label label-success">To :</span></h2>
                      <!-- username -->
                          <div class="form-group">
                              <label>Pilih Negara :</label>
                              <select name="negara1" id="negara1" class="form-control action1" >
                                    <option value="0">negara</option>
                                    <?php echo $negara1; ?>
                              </select>
                          </div>
                          <br />
                    <!-- username -->
                          <div class="form-group">
                              <label>Pilih Agent :</label>
                              <select name="agent1" id="agent1" class="form-control action1">
                                    <option value="0">Agent</option>
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

  function hpus(id) {
			 var conf = confirm("Yakin Ingin Menghapus Data Rute..?");
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
$(document).ready(function(){
    $('.action').change(function(){
    if($(this).val() != '')
    {
      var action = $(this).attr("id");
      var query = $(this).val();
      var result = '';
      if(action == 'negara')
      {
        result = 'agent';
      }
      else
      {
       
      }
      $.ajax({
           url:"fetch.php",
           method:"POST",
           data:{action:action, query:query},
           success:function(data){
            $('#'+result).html(data);
           }

      })
    }
    });
  });

  $(document).ready(function(){
    $('.action1').change(function(){
    if($(this).val() != '')
    {
      var action1 = $(this).attr("id");
      var query1 = $(this).val();
      var result1 = '';
      if(action1 == 'negara1')
      {
        result1 = 'agent1';
      }
      else
      {
       
      }
      $.ajax({
           url:"fetch1.php",
           method:"POST",
           data:{action1:action1, query1:query1},
           success:function(data){
            $('#'+result1).html(data);
           }

      })
    }
    });
  });
</script>
</body>


</html>
