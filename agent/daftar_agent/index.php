
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
            <h3><b>Daftar Semua Agent</b></h3>
        </div>
    </div>
<br>
    <div class="md-form mt-0" >
         <input class="form-control"  type="text" name="search" id="search" placeholder="Search Agent By Country" onkeyup="search()" aria-label="Search">
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
                    <th width="30px"><center>Country</center></th>
                    <th width="30px"><center>Nama Agent</center></th>
                    <th width="30px"><center>No Telfon</center></th>
                    <th width="200px"><center>Alamat</center></th>
                    <th width="200px"><center>Penanggung Jawab</center></th>
                </tr>
            </thead>
            <tbody id="barisData">
                        <?php
                              $query = "SELECT * FROM agent ORDER BY country ASC";
                              $result = mysqli_query($koneksi, $query);
                              $no = 1;
                              $limit = 5; // Jumlah data per halamannya
                                // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                                $limit_start = ($page - 1) * $limit;
                              // =========================
                              while($row = mysqli_fetch_array($result)  )  
                              {  
                     
                        ?>
                <tr>  
                    <td style="vertical-align: middle;"><center><?php echo $no;?></center></td>
                    <td style="vertical-align: middle;">
                        <center>
                            <?php 
                                $id =  $row["country"];
                                $query1 = mysqli_query($koneksi, "SELECT * FROM country where id = '$id'");
                                $view = mysqli_fetch_assoc($query1);
                                echo $view['negara'];
                            ?>
                        </center>
                    </td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["nama_agent"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["no_telfon"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["alamat"]; ?></center></td>  
                    <td style="vertical-align: middle;"><center><?php echo $row["penanggung_jawab"]; ?></center></td>  
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
                    $pag = mysqli_query($koneksi,"SELECT COUNT(*) AS jumlah FROM agent");
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
</script>
</body>


</html>
