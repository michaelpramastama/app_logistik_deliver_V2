<?php
include 'header.php';
include '../../koneksi.php';
$agent= '';
  $sql = "SELECT * from agent";
  $result = mysqli_query($koneksi, $sql);
  while($row = mysqli_fetch_array($result)){
      $agent .='<option value="'.$row[0].'">'.$row[1].' ||  '.$row[4].'</option>';
  }
?>
<!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                             <?php
                                $date = '';
                                $time = '';
                                $date = '<h3>'.date('d-m-Y').'</h3>'; 
                                $time = '<div id="time" style="font-size: 30px;"></div>'; 
                                echo $date; echo " " ; echo $time;                               
                            ?>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="../">Home</a></li>
                                <li><span>Keuangan Keluar</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="../logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <br>
            <div class="main-content-inner">
                <button type="button" class="btn btn-primary" id="add" data-toggle="modal" data-target="#addmodal" style="margin-button: 20px;">
                 ADD
                </button>
                
               <div class="table-responsive">
                   <br>
                <table class="table table-striped table-bordered table-hover " id="datatables"> 
                    <thead>
                        <tr>
                            <th width="30px"><center>No</center></th>
                            <th width="250px"><center>Agent</center></th>
                            <th width="250px"><center>Tanggal</center></th>
                            <th width="150px"><center>Waktu</center></th>
                            <th width="150px"><center>Nominal</center></th>
                            <th width="150px"><center>Keterangan</center></th>
                            <th width="150px"><center>Picture</center></th>
                        </tr>
                    </thead>
                    <tbody id="barisData">
                        <?php
                              $no = 1;
                              $query = "SELECT * FROM histori_transfer order by id desc ";
                              $result = mysqli_query($koneksi, $query);
                            $query1 = "SELECT * FROM histori_transfer inner join agent on histori_transfer.agent = agent.id";
                            $result1 = mysqli_query($koneksi, $query1);
                            //   =========================
                              while($row = mysqli_fetch_array($result)  )  
                              {  
                                  $row1 = mysqli_fetch_array($result1)
                        ?>
                        <tr>  
                            <td style="vertical-align: middle;"><center><?php echo $no ?></center></td>
                            <td style="vertical-align: middle;"><center><?php echo $row1['nama_agent'] ?></center></td>  
                            <td style="vertical-align: middle;"><center><?php echo $row['date'] ?></center></td>  
                            <td style="vertical-align: middle;"><center><?php echo $row['time'] ?></center></td>  
                            <td style="vertical-align: middle;"><center><?php echo $row['nominal'] ?></center></td>
                            <td style="vertical-align: middle;"><center><?php echo $row['keterangan'] ?></center></td>
                            <td style="vertical-align: middle;">
                                <center>
                                    <button type="button" class="btn btn-info"  id="view" data-toggle="modal" data-target="#modalview"  data-id="<?php echo $row["id"]; ?>"><img src="../assets/images/eye.png" /></button>
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
            <!-- modal  -->
                    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bukti Transferan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form action="insert.php" method="post" enctype="multipart/form-data">
                                <!-- agent -->
                                <div class="form-group">
                                    <label>Agent:</label>
                                    <select class="form-control" name="agent" id="agent">
                                        <option></option>
                                        <?php echo $agent ?>
                                    </select>
                                </div>
                                 <!-- nominal -->
                                <div class="form-group">
                                    <label >Nominal :</label>
                                    <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal">
                                </div>
                                <!-- keterangan -->
                                <div class="form-group">
                                    <label >Keterangan:</label>
                                    <input type="text" class="form-control" name="ket" id="ket" placeholder="Keterangan">
                                </div>
                                <!-- gambar -->
                                 <div class="form-group">
                                    <label>Gambar:</label>
                                    <input type="file" name="image" id="image" onchange="readURL(this);"/>
                                    <img id="blah" src="#" alt="your image" />
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     <button type="submit" name="insert" id="insert" class="btn btn-primary submitBtn">Save</button>						
                                 </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

            <!-- modal -->
            </div>
        </div>
        <!-- main content area end -->
        <?php
            include 'footer.php';
        ?>
        <script>
        ///         image ////////////////////////
        function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(400)
                            .height(200);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        ///         image ////////////////////////
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