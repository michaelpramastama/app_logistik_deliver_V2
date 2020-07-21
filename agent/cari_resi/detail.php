<?php
include '../../koneksi.php';
if ($_POST['rowid']) {
     $id = $_POST['rowid'];
       // $sql = "SELECT * FROM user WHERE id = '$id'";
       // $result = mysqli_query($koneksi, $sql);
       // while ($row = mysqli_fetch_array($result))
       // {
?>
    <div class="container" style=" height: 400px; overflow-y: scroll;">
       	<table class="table table-responsive">
       		<thead>
       			<tr>
       				<th><center>NO</center></th>
       				<th><center>No Resi</center></th>
       				<th><center>Time</center></th>
       				<th><center>Date</center></th>
       				<th><center>Keterangan</center></th>
       				<th><center>Tujuan</center></th>
       				<th><center>Status</center></th>
       			</tr>
       		</thead>
       		<tbody>
       			<!-- ================================================================ -->
       			<?php
       				$no = 1;
       				$view = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE no_resi = '$id' ORDER BY id");
       				while ($row = mysqli_fetch_array($view)) {
       			?>
       		<!-- 	================================================================ -->
       			<tr>
       				<td><center><?php echo $no; ?></center></td>
       				<td><center><?php echo $row['no_resi']; ?></center></td>
       				<td><center><?php echo $row['waktu']; ?></center></td>
       				<td>
       					<center>
       						<?php 
       							$tanggall = $row['tanggal'];
       							echo date('d-m-Y',strtotime($tanggall)); 
       						?>
       					</center>
       				</td>
       				<td><center><?php echo $row['keterangan']; ?></center></td>
       				<td>
       					<center>
       						<?php 
       							$to = $row['tujuan']; 
       							$lihat1 = mysqli_query($koneksi,"SELECT * FROM agent WHERE id = '$to'");
       							$assoc1 = mysqli_fetch_assoc($lihat1);
       							echo $assoc1['nama_agent'];
       						?>
       					</center>
       				</td>
       				<td><center><?php echo $row['status']; ?></center></td>
       			</tr>
       			<?php
       				$no++;
       				}
       			?>
       		</tbody>
       	</table>
    </div>

 

<?php
       }
?>