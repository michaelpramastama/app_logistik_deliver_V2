<?php  
  include 'header.php';
  include '../../koneksi.php';
        $provinsi= '';
        $negara= '';
        $query1 = "SELECT * from country order by negara asc";
        $result1 = mysqli_query($koneksi,$query1);
        while($row = mysqli_fetch_array($result1))
        {
            $negara .= '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
        $query = "SELECT * from provinsi order by name asc";
        $result = mysqli_query($koneksi,$query);
        while($row = mysqli_fetch_array($result))
        {
            $provinsi .= '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
?>

<div class="right_col" role="main">

  <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal">
  ADD
  </button>

  <div class="card">
    <div class="card-body">
        <h3>Agent</h3>
        <h4>
          <small>Data Agent</small>
        </h4>
    </div>
  </div>
  <!-- ======================================================================================================== -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover " id="datatables"> 
      <thead>
        <tr>
          <th width="30px"><center>No</center></th>
          <th width="200px"><center>Nama Agent</center></th>
          <th width="200px"><center>Kode Agent</center></th>
          <th width="200px"><center>Telfon</center></th>
          <th width="200px"><center>Country</center></th>
          <th width="350px"><center>Alamat</center></th>
          <th width="200px"><center>Aksi</center></th>
        </tr>
      </thead>
      <tbody id="barisData">
          <?php
              $no = 1;
              $query = "SELECT * FROM agent join country on agent.country = country.id order by nama_agent asc";
              $result = mysqli_query($koneksi, $query);
              while($row = mysqli_fetch_array($result)  )  
                   { 
          ?>
          <tr>  
            <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
            <td style="vertical-align: middle;"><center><?php echo $row["nama_agent"]; ?></center></td>  
            <td style="vertical-align: middle;"><center><?php echo $row["kode_agent"]; ?></center></td>  
            <td style="vertical-align: middle;"><center><?php echo $row["no_telfon"]; ?></center></td>  
            <td style="vertical-align: middle;"><center><?php echo $row["negara"]; ?></center></td>  
            <td style="vertical-align: middle;"><center><?php echo $row["alamat"]; ?></center></td>  
            <td style="vertical-align: middle;">
              <center>
                  <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalview"  data-id="<?php echo $row[0]; ?>"><img src="asset/image/eye.png" />
                  </button>

                  <button type="button" data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete"  data-id="<?php echo $row[0]; ?>" ><img src="asset/image/edit.png" />
                  </button>

                  <button type="button"  class="btn btn-danger btn_delete"  onclick='hpus("<?php echo $row[0]; ?>")' ><img src="asset/image/delete.png" />
                  </button>

                  <button type="button"  class="btn btn-danger btn_delete info-number badge bg-green" id="user" data-toggle="modal" data-target="#modaluser" data-id="<?php echo $row[0]; ?>"><img src="asset/image/user.png" />
                        <span>
                            <?php 
                                $lihat = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM user WHERE agent = '$row[0]'");
                                $view = mysqli_fetch_assoc($lihat);
                                          echo $view['jumlah'];
                            ?>
                        </span>
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

  <!-- ======================================================================================================== -->

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
  
  <!-- ======================================================================================================== -->

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

  <!-- ======================================================================================================== -->

  <div id="modaluser" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah User</h4>
          </div>

          <div class="modal-body">
              <div class="user-data"></div>
          </div>

      </div>
    </div>
  </div>

  <!-- ======================================================================================================== -->

  <div id="addmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
	            <h4 class="modal-title">MASUKAN AGENT</h4>
	        </div>

          	<div class="modal-body">
            	<form action="insert.php" method="post">

                    <!-- Nama Penanggung jawab -->
                    <div class="form-group">
                        <label>Name Penanggung Jawab:</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Penanggung Jawab" required>
                    </div>
                    <br />

                    <!-- username -->
                    <div class="form-group">
                        <label>Name Agent:</label>
                        <input type="text" class="form-control" name="nama_agent" id="nama_agent" placeholder="Nama Agent" required>
                    </div>
                    <br />

                    <!-- negara -->
                    <div class="form-group">
                        <label>Country :</label>
                        <select name="country" id="country" class="form-control" onchange="ganti()" required>
                            <option value="">Country</option> 
                                <?php echo $negara; ?>   
                        </select>
                    </div>
                    <br>

                    <!-- telfon -->
                    <div class="form-group">
                        <label >Telfon:</label>
                        <input type="text" class="form-control" name="telfon" id="telfon" placeholder="Telfon" required>
                    </div>
                    <br />

                    <!-- kodepos -->
                    <div class="form-group" >
                        <label >Kode Agent:</label>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="kode" id="kode" placeholder="Kode Agent" required>
                    </div>
                    <br>

                    <!-- kodepos -->
                    <div class="form-group" id="hk">
                        <label >No Rekening:</label>
                        <input type="text" value="0" class="form-control" name="rekening" id="rekening" placeholder="No Rekening" required>
                    </div>
                    <br>

                    <div id="list">
                          <!-- provisnis -->
                          <div class="form-group" id="list">
                              <label id="1">Provinsi :</label>
                              <select name="provinsi" id="provinsi" class="form-control action" >
                                    <option value="0">Provinsi</option>
                                    <?php echo $provinsi; ?>
                              </select>
                          </div>
                          <br />

                          <!-- kabupaten -->
                          <div class="form-group" id="list">
                              <label id="2">Kabupaten :</label>
                              <select name="kabupaten" id="kabupaten" class="form-control action" >
                                    <option value="0">Kabupaten</option>    
                              </select>
                          </div>
                          <br>

                          <!-- kecamatan -->
                          <div class="form-group" id="list">
                              <label id="3" >Kecamatan:</label>
                              <select name="kecamatan" id="kecamatan" class="form-control " >
                                  <option value="0">Kabupaten</option>
                              </select>
                          </div>
                          </div>
                          <br />

                          <!-- alamat -->
                          <div class="form-group">
                              <label >Alamat:</label>
                              <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" style="resize:none;width:565px;height:100px;" required></textarea>
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
 
</div>

<?php
include 'footer.php';
?>
<script type="text/javascript">

  $(document).ready( function () {
        $('#datatables').DataTable();
  });

///hapus ////////////////////////

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

///update ////////////////////////
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
///end update ////////////////////////

///user ////////////////////////

$(document).ready(function(){
    $('#modaluser').on('show.bs.modal', function (e) {
        var rid = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url : 'detail1.php',
            data :  'rid='+ rid,
	            success : function(data){
    		        $('.user-data').html(data);//menampilkan data ke dalam modal
                }
        });
    });
});
///end update ////////////////////////
///view ////////////////////////

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
///end view ////////////////////////
$(document).ready(function(){
    $('.action').change(function(){
    if($(this).val() != '')
    {
      var action = $(this).attr("id");
      var query = $(this).val();
      var result = '';
      if(action == 'provinsi')
      {
        result = 'kabupaten';
      }
      else
      {
        result = 'kecamatan';
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

// ======================================================================

  function ganti(){
        var x = document.getElementById("country").value;
        if(x == '2'){
            $("#list").show(1500);
        }else{
            $("#list").hide(1500);
        }
        if(x == '3'){
            $("#hk").hide(1500);
        }else{
            $("#hk").show(1500);
        }
    }

</script>
</body>
</html>

