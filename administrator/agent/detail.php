<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
        $provinsi= '';
        $kabupaten= '';
        $kecamatan= '';
        // echo $id;
       $sql = "SELECT * FROM agent WHERE id = '$id'";
       $sql1="SELECT name from kabupaten INNER JOIN agent on agent.kabupaten = kabupaten.id";
       $sql2="SELECT name from provinsi INNER JOIN agent on agent.provisinsi = provinsi.id";
       $sql3="SELECT name from kecamatan INNER JOIN agent on agent.kecamatan = kecamatan.id";
       
       $sql4="SELECT * from provinsi order by name asc";
       $result4 = mysqli_query($koneksi, $sql4);

       while($row4 = mysqli_fetch_array($result4)){
           $provinsi .='<option value="'.$row4[0].'">'.$row4[1].'</option>';
       }
   
    //    $sql5="SELECT * from kabupaten where province_id = '$we' order by name asc";
    //    $result5 = mysqli_query($koneksi, $sql5);

    //    while($row5 = mysqli_fetch_array($result5)){
    //        $kabupaten .='<option value="'.$row5[0].'">'.$row5[2].'</option>';
    //    }

    //    $sql6="SELECT * from kecamatan order by name asc";
    //    $result6 = mysqli_query($koneksi, $sql6);

    //    while($row6 = mysqli_fetch_array($result6)){
    //        $kecamatan .='<option value="'.$row6[0].'">'.$row6[2].'</option>';
    //    }

       $result1 = mysqli_query($koneksi, $sql1);
       $result2 = mysqli_query($koneksi, $sql2);
       $result3 = mysqli_query($koneksi, $sql3);
       $result = mysqli_query($koneksi, $sql);

       $result7 = mysqli_query($koneksi, $sql);
       $data = mysqli_fetch_assoc($result7);
       
       if($data["country"] == '2'){
            while ($row = mysqli_fetch_array($result))
            {
            $row1 = mysqli_fetch_array($result1);
            $row2 = mysqli_fetch_array($result2);
            $row3 = mysqli_fetch_array($result3);
            
           
?>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
             <div class="form-group">
                <label>Name Penanggun jawab:</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $row['penanggung_jawab'];  ?>">
            </div>
            <br />
            <div class="form-group">
                <label>Name Agent:</label>
                <input type="text" class="form-control" name="nama_agent" id="nama_agent" value="<?php echo $row['nama_agent'];  ?>">
            </div>
            <br />
            <!-- email -->
            <div class="form-group">
                <label >Telfon:</label>
                <input type="text" class="form-control" name="telfon" id="telfon" value="<?php echo $row['no_telfon'];?>" >
            </div>
            <br />
            <!-- rekening -->
            <div class="form-group">
                <label >Rekening:</label>
                <input type="text" class="form-control" name="rekening" id="rekening" value="<?php echo $row['rekening'];?>" >
            </div>
            <br />
            <!-- provinsi -->
            <div class="form-group">
                <label>Provinsi:</label>
                <select class="form-control action" name="provinsi" id="provinsi">
                    <option  value="<?php echo $row['provisinsi'];?>"><?php echo $row2['name'];  ?></option>
                    <?php echo $provinsi; ?>
                </select>
            </div>
            <br />
            <!-- kabupaten -->
            <div class="form-group">
                <label>Kabupaten:</label>
                <select class="form-control action" name="kabupaten" id="kabupaten">
                    <option value="<?php echo $row['kabupaten'];?>"><?php echo $row1['name'];  ?></option>
                   
                </select>
            </div>
            <br />
            <!-- kecamatan -->
            <div class="form-group">
                <label>Kecamatan:</label>
                <select class="form-control" name="kecamatan" id="kecamatan">
                    <option value="<?php echo $row['kecamatan'];?>"><?php echo $row3['name'];  ?></option>
                   
                </select>
            </div>
            <br />
            <!-- alamat -->
            <div class="form-group">
                <label >Alamat:</label>
                <textarea type="text" class="form-control" name="alamat" id="alamat"  style="resize:none;width:565px;height:100px;"><?php echo $row['alamat'] ?></textarea>
            </div>
            <br />
            <!-- kodepos -->
            <div class="form-group">
                <label >Kode Agent:</label>
                <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $row['kode_agent'];?>" >
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>
    <script>
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
    </script>

<?php
            }
        }else{
            $result8 = mysqli_query($koneksi, $sql);
            while ($row8 = mysqli_fetch_array($result8))
            {
?>
                <form action="update1.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row8['id']; ?>">
                     <!-- nama -->
                    <div class="form-group">
                        <label>Name Penanggung Jawab:</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $row8['penanggung_jawab'];  ?>">
                    </div>
                    <br />
                     <!-- agent -->
                    <div class="form-group">
                        <label>Name Agent:</label>
                        <input type="text" class="form-control" name="nama_agent" id="nama_agent" value="<?php echo $row8['nama_agent'];  ?>">
                    </div>
                    <br />
                    <!-- telfon -->
                    <div class="form-group">
                        <label >Telfon:</label>
                        <input type="text" class="form-control" name="telfon" id="telfon" value="<?php echo $row8['no_telfon'];?>" >
                    </div>
                    <br />
                    <!-- alamat -->
                    <div class="form-group">
                        <label >Alamat:</label>
                        <textarea type="text" class="form-control" name="alamat" id="alamat"  style="resize:none;width:565px;height:100px;"><?php echo $row8['alamat'] ?></textarea>
                    </div>
                    <br />
                    <!-- kodepos -->
                    <div class="form-group">
                        <label >Kode Agent:</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $row8['kode_agent'];?>" >
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>          
<?php
            }
        }
}

?>