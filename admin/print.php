<script> window.print(); </script>
<?php
include '../config/class.php';
$db = new database();

if (isset($_GET['ket'])) {
	if ($_GET['ket'] == "produk") {
$sql = "SELECT * FROM tbl_produk";
$baca = $db->tampil($sql);
?>
<script type="text/javascript">window.print();</script>
<h1>Laporan Berbagai Produk</h1>
<table border="1" cellpadding="5" cellspacing="0">
	<thead align="center">
		<th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Stok</th>
		<th>Harga</th>
		<th>Deskripsi</th>
		<th>Gambar</th>
	</thead>
<?php
$no=1;
$tb = 0;
while ($data = $baca->fetch_array()) {
?>
<tr align="center">
	<td><?php echo $no++; ?></td>
	<td><?php echo $data['kode_produk']; ?></td>
	<td><?php echo $data['nama_produk']; ?></td>
	<td><?php echo $data['stok']; ?></td>
	<td><?php echo "Rp. ".number_format($data['harga'])." ,-"; ?></td>
	<td><?php echo $data['deskripsi']; ?></td>
	<td><?php echo $data['img']; ?></td>
	<?php
	$tb += $data['harga'];
	?>
</tr>
<?php } ?>
<tr align="center">
	<td colspan="4">Total</td>
	<td><?php echo "Rp. ".number_format($tb)." ,-"; ?></td>
	<td colspan="2"></td>
</tr>
</table>
<?php
	}elseif ($_GET['ket'] == "pembelian") {
if (isset($_GET['urut'])) {
	if ($_GET['urut'] == "belum_transfer") {
		$sql = "SELECT a.invoice, a.id_pembelian, a.banyak, a.total_bayar, a.status, a.img, b.nama_produk, b.harga AS harga_produk, c.nama_pelanggan, d.harga AS harga_kurir FROM tbl_pembelian a
		INNER JOIN tbl_produk b ON a.id_produk=b.id_produk
		INNER JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
		INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir WHERE a.status='1' AND a.img=''";
	}elseif ($_GET['urut'] == "sudah_transfer") {
		$sql = "SELECT a.invoice, a.id_pembelian, a.banyak, a.total_bayar, a.status, a.img, b.nama_produk, b.harga AS harga_produk, c.nama_pelanggan, d.harga AS harga_kurir FROM tbl_pembelian a
		INNER JOIN tbl_produk b ON a.id_produk=b.id_produk
		INNER JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
		INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir WHERE a.status='1' AND a.img != ''";
	}elseif ($_GET['urut'] == "dikirim") {
		$sql = "SELECT a.invoice, a.id_pembelian, a.banyak, a.total_bayar, a.status, a.img, b.nama_produk, b.harga AS harga_produk, c.nama_pelanggan, d.harga AS harga_kurir FROM tbl_pembelian a
		INNER JOIN tbl_produk b ON a.id_produk=b.id_produk
		INNER JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
		INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir WHERE a.status='2'";
	}elseif ($_GET['urut'] == "sampai") {
		$sql = "SELECT a.invoice, a.id_pembelian, a.banyak, a.total_bayar, a.status, a.img, b.nama_produk, b.harga AS harga_produk, c.nama_pelanggan, d.harga AS harga_kurir FROM tbl_pembelian a
		INNER JOIN tbl_produk b ON a.id_produk=b.id_produk
		INNER JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
		INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir WHERE a.status='3'";
	}
}else{
	$sql = "SELECT a.invoice, a.id_pembelian, a.banyak, a.total_bayar, a.status, a.img, b.nama_produk, b.harga AS harga_produk, c.nama_pelanggan, d.harga AS harga_kurir FROM tbl_pembelian a
		INNER JOIN tbl_produk b ON a.id_produk=b.id_produk
		INNER JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
		INNER JOIN tbl_kurir d ON a.id_kurir=d.id_kurir";
}

$baca = $db->tampil($sql);
	?>
<h1>Laporan Pembelian
<?php 
if(isset($_GET['urut'])){
	if ($_GET['urut'] == "belum_transfer") {
		echo " Barang yang Belum Transfer";
	}elseif ($_GET['urut'] == "sudah_transfer") {
		echo " Barang yang Sudah Transfer";
	}elseif ($_GET['urut'] == "dikirim") {
		echo " Barang yang Sedang Dikirim";
	}elseif ($_GET['urut'] == "sampai") {
		echo " Barang yang Sudah Sampai";
	}
}
?>
</h1>
	<table border="1" cellpadding="5" cellspacing="0">
		<thead align="center">
			<th>No</th>
			<th>Invoice</th>
			<th>Nama Pembeli</th>
			<th>Barang</th>
			<th>Banyaknya</th>
			<th>Harga</th>
			<th>Ongkir</th>
			<th>Total Bayar</th>
		</thead>
<?php		
$no = 1;
$total = 0;
while ($data = $baca->fetch_array()) {
?>
		<tr align="center">
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['invoice']; ?></td>
			<td><?php echo $data['nama_pelanggan']; ?></td>
			<td><?php echo $data['nama_produk']; ?></td>
			<td><?php echo $data['banyak']; ?></td>
			<td><?php echo "Rp. ".number_format($data['harga_produk'])." ,-"; ?></td>
			<td><?php echo "Rp. ".number_format($data['harga_kurir'])." ,-"; ?></td>
			<td><?php echo "Rp. ".number_format($data['total_bayar'])." ,-"; ?></td>
		</tr>
<?php $total += $data['total_bayar']; } ?>
		<tr align="center">
			<td colspan="7">Total Pendapatan</td>
			<td><?php echo "Rp. ".number_format($total)." ,-"; ?></td>
		</tr>
	<?php
	}
}		
?>