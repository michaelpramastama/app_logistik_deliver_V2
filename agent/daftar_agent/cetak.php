<?php
require_once('file/TCPDF/tcpdf.php');
  include '../../koneksi.php';
//konfigurasi TCPDF
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('By System Logistik');
	$pdf->SetTitle('Invoice Logistik');
	$pdf->SetSubject('Invoice');
// remove default header/footer
	$pdf->setPrintHeader(false);
// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//menambahkan halaman
	$pdf->SetMargins(5,5,5, true);
	$pdf->AddPage();
    $id = $_GET['no_resi'];
    if($id){
         $query = "SELECT * FROM barang_masuk WHERE no_resi='$id'";
         $result = mysqli_query($koneksi, $query);
         $row = mysqli_fetch_array($result);
        $teks ='
	<p style="font-size: 12px;">INVOICE '.$row['tanggal'].' '.$row['waktu'].'</p>
	<table style="border: 1px solid black; font-size: 10px;">
		<tr>
			<th align="center" style="border: 1px solid black;"><p>pengirim</p></th>
			<th align="center" style="border: 1px solid black;"><p>penerima</p></th>
			<th align="center" style="border: 1px solid black;"><p>jenis barang</p></th>
		</tr>
		<tr>
			<td align="center" style="border: 1px solid black;">
				'.$row['nama_pengirim'].'<br>
				'.$row['no_telfon_pengirim'].'
			</td>
			<td align="center" style="border: 1px solid black;">
				'.$row['nama_penerima'].'<br>
				'.$row['no_telfon_penerima'].'<br>
				'.$row['alamat_tujuan'].'<br>
			</td>
			<td align="center" style="border: 1px solid black;">
				'.$row['keterangan_barang'].'<br>
				Berat : '.$row['berat'].' KG
			</td>
		</tr>
	</table>

	<span style="font-size: 10px;"><i>*Untuk Mengecek No Resi Silahkan Kunjungi www.logistik.com/resi</i></span>
	';
    
// isi pdf
	

// set style for barcode
	$style = array(
		 'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

	$style1 = array(
		'border' => false,
		'padding' => 0,
		'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
	
//print teks
	// $pdf->Cell(90,10,'this kalkd',1,1,'L',1,1,1);

// QRCODE,H : QR-CODE Best error correction
$pdf->Cell(0, 0,$id, 0, 1);
$pdf->write1DBarcode($id, 'C39', '', '', '', 18, 0.4, $style, 'N');
$pdf->writeHTML($teks, true, false, true, false, '');
$pdf->write2DBarcode($id, 'QRCODE,H', 122, 64, 20, 20, $style1, 'N');

//hasil print
	$pdf->Output('invoice.pdf','I');
}else{
        echo "tidak ada";
    }

?>