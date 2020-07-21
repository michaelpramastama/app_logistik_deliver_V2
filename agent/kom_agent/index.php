
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
            <h3><b>Uang Komisi Masuk</b></h3>
        </div>
    </div>
<br>
    
   
    <div class="table-responsive">
    <br>
        <table class="table table-striped table-bordered table-hover " id="datatables"> 
            <thead>
                <tr>
                    <th width="30px"><center>No</center></th>
                    <th width="100px"><center>Tanggal</center></th>
                    <th width="100px"><center>Waktu</center></th>
                    <th width="150px"><center>Nominal</center></th>
                    <th width="200px"><center>Keterangan</center></th>
                    <th width="100px"><center>Pitcure</center></th>
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
                              $query = "SELECT * FROM uang_masuk_pkt  WHERE agent='$agent' order by id desc LIMIT $limit_start,$limit";
                              $result = mysqli_query($koneksi, $query);
                              // =========================
                              while($row = mysqli_fetch_array($result)  )  
                              {  
                                
                        ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row["date"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["time"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo"Rp. "; echo $row["nominal"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["keterangan"]; ?></center></td>  
                    <td style="vertical-align: middle;">
                        <center>
                            <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalview"  data-id="<?php echo $row["id"]; ?>"><img src="../asset/image/eye.png" /></button>
                        </center>
                    </td>  
                </tr> 
                        <?php 
                            $no++; 
                              }  
                        ?>  
              </tbody>
        </table>
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
    </div>
      <!-- modal view -->    
        <div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">GAMBAR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="view">
                        </div>
                    </div>
                </div>
            </div>
        </div>

          <!-- end modal view -->                     
    <!-- page modal -->
<!-- end main -->
</div>
        
<?php
include 'footer.php';
?>
<script type="text/javascript">

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
