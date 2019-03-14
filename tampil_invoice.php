<?php
include 'config/class.php';
$db = new database();

$id = $_SESSION['id_pelanggan'];
$hasil = $db->LihatInvoice($id);

if ($hasil) {
?>
<h1>Invoice</h1>
<table border="1" cellpadding="5" cellspacing="0">
	<tr align="center">
		<td>No</td>
		<td>INVOICE</td>
		<td>Tanggal</td>
		<td>Tampil</td>
	</tr>
<?php
	$no=1;
	while ($data = $hasil->fetch_array()) {
?>
	<tr align="center">
		<td><?php echo $no++; ?></td>
		<td><?php echo $data['invoice']; ?></td>
		<td><?php echo $data['tgl_pembelian']; ?></td>
		<td><a href="invoice.php?inv=<?php echo $data['invoice']; ?>" target="_blank">Lihat</a></td>
	</tr>
<?php } ?>
</table> 
<?php 
}else{
	echo "<p align='center' style='clear: left;font-family: roboto;'>Belum Ada Invoice</p>";
}