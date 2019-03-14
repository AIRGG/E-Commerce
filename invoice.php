<?php
include 'config/class.php';
$db = new database();

if (isset($_POST['kirim'])) {
	$inv = $_GET['inv'];
	$img = $_FILES['bukti']['name'];
	$tmp = $_FILES['bukti']['tmp_name'];
	$db->bukti($inv, $img, $tmp);
}

if (isset($_GET['inv'])) {
	$inv = $_GET['inv'];
	$sql = "SELECT a.total_bayar, a.banyak, a.status, b.nama_pelanggan, a.id_pembelian, c.harga AS harga_produk, c.nama_produk, d.harga AS harga_kurir FROM tbl_pembelian a 
	INNER JOIN tbl_pelanggan b ON a.id_pelanggan=b.id_pelanggan 
	INNER JOIN tbl_produk c ON a.id_produk=c.id_produk 
	INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir WHERE invoice='$inv'";
	$sql1 = "SELECT * FROM tbl_pembelian a INNER JOIN tbl_pelanggan b ON a.id_pelanggan=b.id_pelanggan WHERE invoice='$inv' GROUP BY invoice ORDER BY id_pembelian ASC";
	$baca = $db->tampil($sql);
	$baca1 = $db->tampil($sql1);
//echo $db->invoice();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="shortcut icon" href="img/ci-icon.ico" type="image/x-icon" />
</head>
<body>
<div class="container-inv">
<?php
while ($data1 = $baca1->fetch_array()) {
?>
	<img src="img/logo.png" class="img-inv">
	<p class="invoice-inv" style="font-weight: bolder;">Invoice</p>
	<p style="clear: right; float: right; margin-right: 100px;"><?php echo $data1['tgl_pembelian']; ?> </p>
	<p style="clear: right; float: right; margin-right: 100px;"> </p>

	<p class="nama-inv" style="font-weight: bold;"><?php if($data1['status'] == 1){ echo "<font color='red'>Barang Belum Dikirim</font>"; }elseif($data1['status'] == 2){ echo "<font color='green'>Barang Sedang Dikirim</font>"; }else{ echo "<font color='green'>Barang Sudah Sampai</font>"; }; ?></p>
	<p class="nama-inv"><?php echo $data1['nama_pelanggan']; ?></p>
	<p style="margin-left: 50px; font: 18px roboto;"><?php echo $data1['alamat']; ?></p>
<?php } ?>
	<table cellspacing="0" cellpadding="10" class="table-inv">
		<tr align="center" style="background-color: #039be5; font-weight: bold; color: white;">
			<td>No</td>
			<td>Nama</td>
			<td>Banyak</td>
			<td>Harga</td>
			<td>Ongkir</td>
			<td>Total</td>
		</tr>
<?php
$no = 1;
$total=0;
while ($data = $baca->fetch_array()) {
?>
		<tr align="center">
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['nama_produk']; ?></td>
			<td><?php echo $data['banyak']; ?></td>
			<td><?php echo "Rp. ".number_format($data['harga_produk'])." ,-"; ?></td>
			<td><?php echo "Rp. ".number_format($data['harga_kurir'])." ,-"; ?></td>
			<td><?php echo $data['total_bayar']; ?></td>
		</tr>
<?php $total += $data['total_bayar']; } //style="color: white; font-weight: bold; background-color: #616161; ?>
		<tr align="center">
			<td colspan="5" style="border: none; background-color: white; ">Total Bayar</td>
			<td style="color: white; background-color: #ef5350;font-weight: bolder;"><?php echo "Rp. ".number_format($total)." ,-"; ?></td>
		</tr>
	</table>
	<hr>
	<div class="transfer-inv">
		<form action="" method="POST" enctype="multipart/form-data">
			<label>Kirim Bukti Transfer</label><br><br>
			<input type="file" name="bukti" required><br><br>
			<input class="btn" type="submit" name="kirim" value="Kirim">
		</form>

	</div>
</div>
</body>
</html>

<?php } ?>