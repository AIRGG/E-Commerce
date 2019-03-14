<?php
if (isset($_POST['tambah'])) {
	$kode = $_POST['kode_produk'];
	$nama = $_POST['nama_produk'];
	$stok = $_POST['stok'];
	$desc = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$img = $_FILES['gambar']['name'];
	$tmp = $_FILES['gambar']['tmp_name'];

	$db->TambahProduk($kode, $nama, $stok, $desc, $harga, $img, $tmp);
	echo "<script>alert('Data Berhasil Ditambahkan');document.location.href='index.php?page=tambah_produk'</script>";
}
?>
<div style="font-family: roboto;">
<h1>Tambah Produk</h1>
<a href="?page=produk">Kembali</a>
<div class="main-content">
	<form class="input-form" method="POST" enctype="multipart/form-data">
		<label class="form-label">Kode Produk</label>
		<input type="text" name="kode_produk" required class="form-control">
		<label class="form-label">Nama Produk</label>
		<input type="text" name="nama_produk" required class="form-control">
		<label class="form-label">Deskripsi</label>
		<textarea class="form-control" name="deskripsi"></textarea>
		<label class="form-label">Stok</label>
		<input type="number" name="stok" required class="form-control">
		<label class="form-label">Harga Satuan</label>
		<input type="number" name="harga" required class="form-control">
		<label for="input-files" class="files">Pilih Gambar</label>
		<input id="input-files" type="file" name="gambar"><br><br>
		<input class="btn" type="submit" name="tambah" value="Tambah" style="width: auto; padding: 10px 10px;">&nbsp;&nbsp;
		<a href="?page=produk">Kembali</a>
	</form>
</div>
</div>