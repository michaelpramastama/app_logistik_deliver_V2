<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];


       $sql = "SELECT * FROM barang_masuk WHERE no_resi = '$id'";
       $result = mysqli_query($koneksi, $sql);
      
       while ($row = mysqli_fetch_array($result))
       {  $cek = $row['total'];
        $total = $cek * 20/100;

?>

        <form action="update.php" method="post" id="form">
            <!-- <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> -->
            <input type="hidden" class="form-control" name="total" id="total" value="<?php echo $total;  ?>" >
            <input type="hidden" class="form-control" name="total_tran" id="total_tran" value="<?php echo $cek;  ?>" >
            <div class="form-group">
                <label>No Resi:</label>
                <input type="text" class="form-control" name="no_resi" id="no_resi" value="<?php echo $row['no_resi'];  ?>">
            </div>
             <div class="form-group">
                <label>Nama Pengirim:</label>
                <input type="text" class="form-control" name="" id="" value="<?php echo $row['nama_pengirim'];  ?>">
            </div>
             <div class="form-group">
                <label>Jenis Barang:</label>
                <input type="text" class="form-control" name="" id="" value="<?php echo $row['keterangan_barang'];  ?>">
            </div>
             <div class="form-group">
                <label>Nama Penerima:</label>
                <input type="text" class="form-control" name="" id="" value="<?php echo $row['nama_penerima'];  ?>">
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" class="form-control" name="" id="" value="<?php echo $row['alamat_tujuan'];  ?>">
            </div>
            <br />
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Delete</button>
                <button class="btn btn-danger print" type="button">print</button>
            </div>
        </form>
        <script>
           $(document).ready(function(){
            $('.print').click(function() {
                    var printme = document.getElementById('form');
                    var mwe = window.open("","","width=300,height=200");
                    mwe.document.write(printme.outerHTML);
                    wme.document.close();
                    wme.focus();
                    wme.print();
                    wme.close();
                    window.print();
            });
           });
        </script>
<?php     
       } 
}
?>