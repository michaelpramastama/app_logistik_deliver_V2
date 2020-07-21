<?php
include '../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
       $sql = "SELECT * FROM notice WHERE id = '$id'";
       $result = mysqli_query($koneksi, $sql);

       while ($row = mysqli_fetch_array($result))
       
       {
?>

      <div class="table-responsive">
          <table class="table table-striped table-hover">
               <tbody align="left">
                    <tr>
                         <td width="150px">Subject</td><td><?php  echo $row['subject'] ?></td>
                    </tr>
                    <tr>
                         <td>Pengumuman</td><td><?php  echo $row['isi_notice'] ?></td>
                    </tr>
                    <!-- <tr>
                         <td>Agent</td><td><?php  echo $row['id_agent'] ?></td>
                    </tr> -->
               </tbody>
          </table>
      </div>

<?php
       }
}

?>