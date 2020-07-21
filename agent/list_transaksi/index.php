
  <?php  
  include 'header.php';
  include '../../koneksi.php';
   // Cek apakah terdapat data page pada URL
$page = (isset($_GET['page']))? $_GET['page'] : 1;
  ?>


        <!-- page content utama -->
<div class="right_col" role="main">
    <div class="card">
        <div class="card-body">
            <h3><b>List Transaksi</b></h3>
        </div>
    </div>
<br>
    <div class="md-form mt-0" >
         <input class="form-control"  type="text" name="search" id="search" placeholder="Search No Resi" onkeyup="search()" aria-label="Search">
         <br>
    </div>
    <div class="card">
        <!-- <div class="card-body">
          <h3>Agent</h3>
          <h4>
              <small>List Transaksi</small>
          </h4>
        </div>
    </div> -->
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="30px"><center>No Resi</center></th>
                    <th width="30px"><center>Tanggal</center></th>
                    <th width="30px"><center>Waktu</center></th>
                    <th width="200px"><center>Nama Pengirim</center></th>
                    <th width="200px"><center>Nama Penerima</center></th>
                    <th width="350px"><center>Telfon Pengirim</center></th>
                    <th width="150px"><center>Jenis Barang</center></th>
                    <th width="150px"><center>Berat(Kg)</center></th>
                    <th width="350px"><center>Cetak</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                        <?php
                            $user =  $_SESSION['username'];  
                            $data = mysqli_query($koneksi,"select * from user where username = '$user'");
                            $cek_login = mysqli_fetch_assoc($data);
                            $agent =  $cek_login['agent'];
                              $no = 1;                         
                            $limit = 5; // Jumlah data per halamannya
                            // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                            $limit_start = ($page - 1) * $limit;

                              $query = "SELECT * FROM barang_masuk WHERE agent='$agent' ORDER BY id DESC LIMIT $limit_start,$limit";
                              $result = mysqli_query($koneksi, $query);
                              // =========================
                              while($row = mysqli_fetch_array($result)  )  
                              {  
                     
                        ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row["no_resi"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["tanggal"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["waktu"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["nama_pengirim"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["nama_penerima"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["no_telfon_pengirim"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["keterangan_barang"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["berat"]; ?></center></td>  
                    <td style="vertical-align: middle;">
                        <center>
                                <button type="button" id="add" data-toggle="modal" data-target="#modalupdate" class="btn btn-warning btn_delete btn-sm"  data-id="<?php echo $row["no_resi"];  ?>" ><img src="asset/image/dollar.png" /></button>
                               <br>
                                <a href="cetak.php?no_resi=<?=$row["no_resi"];?>" target="blank"><button class="btn btn-info btn-sm"><img src="asset/image/printer.png" /></button></a>
                        </center>
                    </td>  
                </tr> 
                        <?php 
                            $no++; 
                              }  
                        ?>  
              </tbody>
        </table>
        <nav aria-label="...">
            <ul class="pagination">
                <?php
                  if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                ?>
                <li class="page-item disabled">
                    <a href="#"><span class="page-link">First</span></a>
                </li>
                 <li class="page-item disabled">
                    <a href="#"><span class="page-link">&laquo;</span></a>
                </li>
               
                <?php
                    }else{ // Jika page bukan page ke 1
                    $link_prev = ($page > 1)? $page - 1 : 1;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=1">First</a></li>
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                <?php
                }
                ?>
                <?php
                    $pag = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM barang_masuk");
                    $get_jml = mysqli_fetch_array($pag);

                    $jml_page = ceil($get_jml['jumlah']/$limit);
                    $jmlh_nmbr = 4;
                    $str_nmbr = ($page > $jml_page - $jmlh_nmbr)? $page - 0 : 1;
                    $end_nmbr = ($page < ($jml_page - $jmlh_nmbr))? $page + $jmlh_nmbr : $jml_page;
                    for($i = $str_nmbr; $i <=$end_nmbr; $i++){
                        // $link_active = '';
                        // if($page == $i){
                        //     $link_active.'active';
                        // }
                        $link_active = ($page == $i)? 'active' : '';
                    
                ?>
                <li class="page-item <?php echo $link_active; ?>"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                }
                ?>

                <?php
                    if($page == $jml_page){
                ?>
                    <li class="page-item disabled">
                        <a href="#"><span class="page-link">&laquo;</span></a>
                    </li>
                    <li class="page-item disabled">
                        <a href="#"><span class="page-link">Last</span></a>
                    </li>
                 <?php
                }else{ // Jika Bukan page terakhir
                $link_next = ($page < $jml_page)? $page + 1 : $jml_page;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $jml_page; ?>">Last</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <form action="update.php" method="post">
            <input type="hidden" class="form-control" name="agent" id="agent" value="<?php echo $agent;  ?>" >
        </form>
    </div>
    <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmasion Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>                         
    <!-- page modal -->
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
