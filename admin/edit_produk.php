<?php

if (isset($_POST['tambah'])) {
	$id_produk = $_GET['id_produk'];
	$kode = $_POST['kode_produk'];
	$nama = $_POST['nama_produk'];	
	$desc = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$img0 = $_POST['gbr'];
	$img1 = $_FILES['gambar']['name'];
	$tmp = $_FILES['gambar']['tmp_name'];

	$db->UpdateProduk($id_produk, $kode, $nama, $desc, $harga, $img0, $img1, $tmp);
	echo "<script>alert('Data Berhasil Diedit');document.location.href='index.php?page=produk'</script>";
}


$id = $_GET['id_produk'];
$sql = "SELECT * FROM tbl_produk WHERE id_produk='$id'";

$baca = $db->tampil($sql);
while ($data = $baca->fetch_array()) {
?>
<h1>Edit Produk</h1>
<a href="?page=produk">Kembali</a>
<div class="main-content">
	<form class="input-form" method="POST" enctype="multipart/form-data">
		<label class="form-label">Kode Produk</label>
		<input type="text" name="kode_produk" required class="form-control" value="<?php echo $data['kode_produk']; ?>">
		<label class="form-label">Nama Produk</label>
		<input type="text" name="nama_produk" required class="form-control" value="<?php echo $data['nama_produk']; ?>">
		<label class="form-label">Deskripsi</label>
		<textarea class="form-control" name="deskripsi"><?php echo $data['deskripsi']; ?></textarea>
		<label class="form-label">Harga Satuan</label>
		<input type="number" name="harga" required class="form-control" value="<?php echo $data['harga']; ?>">
		<input type="hidden" name="gbr" value="<?php echo $data['img']; ?>">
		<label for="input-files" class="files">Pilih Gambar</label>
		<input id="input-files" type="file" name="gambar"><br><br>
		<input class="btn" type="submit" name="tambah" value="Edit">&nbsp;&nbsp;
		<a href="?page=produk">Kembali</a>
	</form>
</div>
<?php } ?>