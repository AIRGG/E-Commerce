<?php
include 'config/class.php';
$db = new database();

if (isset($_SESSION['cart']) && $_SESSION['cart'] != []) {
	//echo serialize(($_SESSION['cart'])).'<br><br><br>';
	//print_r($_SESSION['cart']).'<br><br><br>';

	foreach ($_SESSION['cart'] as $key => $value) {
		$produk = $db->TampilProdukId($key);
		$cart[] = array(
			'produk' => $produk,
			'banyak' => $value
		);
	}
}else{
	echo "<p align='center' style='clear: left;font-family: roboto;'>Keranjang Belanja Kosong</p>";
}

if (isset($_GET['id_dex'])) {
	$id = $_GET['id_dex'];

	if ($_SESSION['cart'] === []) {
		unset($_SESSION['cart']);
	}
	unset($_SESSION['cart'][$id]);
	header("location:index.php?page=cart");
}

if(isset($_SESSION['cart']) && $_SESSION['cart'] != []){
	//print_r($cart);
?>
<h1 style="font-family: roboto">Keranjang Belanja</h1>
<table border="1" cellpadding="10" cellspacing="0" style="font-family: roboto;">
	<tr align="center">
		<td>No</td>
		<td>Nama</td>
		<td>Harga</td>
		<td>Banyak</td>
		<td>Total</td>
		<td>Action</td>
	</tr>
<?php
	$no=1;
	$total = 0;
	foreach ($cart as $key => $data) {
		$total += $data['produk']['harga'] * $data['banyak'];
?>
<tr align="center">
	<td><?php echo $no++; ?></td>
	<td><?php echo $data['produk']['nama_produk']; ?></td>
	<td><?php echo "Rp. ".number_format($data['produk']['harga'])." ,-"; ?></td>
	<td><?php echo $data['banyak']; ?></td>
	<td><?php echo "Rp. ".number_format($data['produk']['harga'] * $data['banyak'])." ,-"; ?></td>
	<td><a href="?page=cart&id_dex=<?php echo $data['produk']['id_produk']; ?>&byk=<?php echo $data['banyak']; ?>">Hapus</a></td>
</tr>
<?php } ?>
<tr align="center">
	<td colspan="4">Total Bayar</td>
	<td><b><?php echo "Rp. ".number_format($total)." ,-"; ?></b></td>
	<td></td>
</tr>
</table>
<br>
<a class="btn-add" href="?page=bayar" style="float: left; padding: 10px 10px; font-family: roboto;">Checkout</a>&nbsp;
<a href="?page=produk" style="color: #303f9f; text-decoration: none; font-family: roboto;">Belanja Lagi ?</a>

<?php } ?>