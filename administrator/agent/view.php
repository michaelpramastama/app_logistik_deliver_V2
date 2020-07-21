<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
       $sql = "SELECT * FROM agent join country on agent.country = country.id  WHERE agent.id = '$id'";
       $sql1="SELECT name from kabupaten INNER JOIN agent on agent.kabupaten = kabupaten.id";
       $sql2="SELECT name from provinsi INNER JOIN agent on agent.provisinsi = provinsi.id";
       $sql3="SELECT name from kecamatan INNER JOIN agent on agent.kecamatan = kecamatan.id";

       $result1 = mysqli_query($koneksi, $sql1);
       $result2 = mysqli_query($koneksi, $sql2);
       $result3 = mysqli_query($koneksi, $sql3);
       $result = mysqli_query($koneksi, $sql);

          while ($row = mysqli_fetch_array($result))
          {
               $row1 = mysqli_fetch_array($result1);
               $row2 = mysqli_fetch_array($result2);
               $row3 = mysqli_fetch_array($result3);
?>
      <div class="table-responsive">
          <table class="table table-striped table-hover">
               <tbody align="left">
                <input type="hidden" id="idcon" value="<?php echo $row['country']; ?>">
                    <tr>
                         <td width="150px">PENANGGUNG JAWAB</td><td><?php  echo $row['penanggung_jawab'] ?></td>
                    </tr>
                    <tr>
                         <td width="150px">NAMA AGENT</td><td><?php  echo $row['nama_agent'] ?></td>
                    </tr>
                    <tr>
                         <td>Kode Agent</td><td><?php  echo $row['kode_agent'] ?></td>
                    </tr>
                    <tr>
                         <td>NO TELFON</td><td><?php  echo $row['no_telfon'] ?></td>
                    </tr>
                    <tr id="rek">
                         <td>REKENING AGENT</td><td><?php  echo $row['rekening'] ?></td>
                    </tr>
                    <tr>
                         <td>COUNTRY</td><td><?php  echo $row['negara'] ?></td>
                    </tr>
                    <tr id="prov">
                         <td>PROVINSI</td><td><?php  echo $row2['name'] ?></td>
                    </tr>
                    <tr id="kab">
                         <td>KABUPATEN</td><td><?php  echo $row1['name'] ?></td>
                    </tr>
                    <tr id="kec">
                         <td>KECAMATAN</td><td><?php  echo $row3['name'] ?></td>
                    </tr>
                    <tr>
                         <td>ALAMAT</td><td><?php  echo $row['alamat'] ?></td>
                    </tr>
               </tbody>
          </table>
      </div>
     <script>
           $(document).ready(function(){
                $("#idcon").val(function(){
                    if($(this).val() == '2'){
                         $("#prov").show();
                         $("#kab").show();
                         $("#kec").show();
                    }else{
                         $("#prov").hide();
                         $("#kab").hide();
                         $("#kec").hide();
                    }

                    if($(this).val() == '3'){
                         $("#rek").hide();
                         
                    }else{
                         $("#rek").show();
                    }
                 });
           });
     </script>
<?php
          }
     }
?>
