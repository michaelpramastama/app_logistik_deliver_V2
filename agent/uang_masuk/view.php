<?php
include '../../koneksi.php';

if ($_POST['rowid']) {
     $id = $_POST['rowid'];
       $sql = "SELECT * FROM uang_masuk WHERE id = '$id'";

       $result = mysqli_query($koneksi, $sql);
     $data = mysqli_fetch_assoc($result);
     $foto = $data['bukti'];

?>

      <img src="../../administrator/transfer/bukti/<?php echo $foto; ?>" class="rounded mx-auto d-block" style="width: 400px; height: 380px;" alt="foto">

<?php
       }


?>