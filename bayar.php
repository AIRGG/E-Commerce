<?php
include 'config/class.php';
$db = new database();

if (!isset($_SESSION['status'])) {
	header("location:?page=login&pesan=belum_daftar");

}elseif ($_SESSION['status'] != "login" || $_SESSION['level'] != "user") {
		header("location:admin?aksi=logout");
}

if (isset($_SESSION['cart']) && $_SESSION['cart'] !== []) {
	//echo serialize(($_SESSION['cart'])).'<br><br><br>';
	//print_r($_SESSION['cart']).'<br><br><br>';

	foreach ($_SESSION['cart'] as $key => $value) {
		$produk = $db->TampilProdukId($key);
		$cart[] = array(
			'produk' => $produk,
			'banyak' => $value
		);
	}
	if (isset($_POST['kurir'])) {
		$id = $_SESSION['id_pelanggan'];
		$id_kurir = $_POST['kurir'];
		$sqlk = "SELECT * FROM tbl_kurir WHERE id_kurir='$id_kurir'";
		$bc = $db->tampil($sqlk);
		while ($datak = $bc->fetch_array()) {
			$ongkir = $datak['harga'];
		}
		$db->bayar($id, $cart, $id_kurir, $ongkir);
	}

}else{
	header("location:index.php");
}

?>
<?php
if(isset($_SESSION['cart']) && $_SESSION['cart'] != []){
?>
<h1 style="font-family: roboto">Checkout</h1>
<table border="1" cellpadding="10" cellspacing="0" style="font-family: roboto">
	<tr align="center">
		<td>No</td>
		<td>Nama</td>
		<td>Harga</td>
		<td>Banyak</td>
		<td>Total</td>
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
</tr>
<?php } ?>
<tr align="center">
	<td colspan="4">Total Bayar</td>
	<td><b><?php echo "Rp. ".number_format($total)." ,-"; ?></b></td>
</tr>
</table>
<br>
<form method="POST" action="">
	<label style="font: 18px roboto; ">Pilih Kurir: </label><br>
	<select name="kurir" style="float: left;padding: 7px 5px;">
<?php
$baca = $db->kurir();
while ($dataK = $baca->fetch_array()) {
?>
		<option value="<?php echo $dataK['id_kurir']; ?>"><?php echo $dataK['nama_kurir'].' - Rp. '.number_format($dataK['harga']); ?></option>
<?php } ?>
	</select>
	<input type="submit" name="pembayaran" value="Bayar" class="btn-bayar" style="clear: right; float: left; padding: 7px 10px; font-family: roboto; border-top-right-radius: 5px; border-bottom-right-radius: 5px; cursor:pointer;">
</form>
<br><br><br>
<a href="?page=cart" style="color: #303f9f; text-decoration: none; font-family: roboto;">Kembali</a>
<?php } ?>