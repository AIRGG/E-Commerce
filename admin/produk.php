<div style="font-family: roboto; margin-bottom: 50px;">
<h1>Produk</h1>
<h3><a href="?page=tambah_produk">+ Tambah Produk</a>&nbsp; | &nbsp;<a href="print.php?ket=produk" target="_blank">Print</a></h3>
	<?php
	if (isset($_GET['aksi'])) {
		if ($_GET['aksi'] == "tambah_stok") {

			if (isset($_POST['tambah_S'])) {
				$tmbh = $_POST['tmbh_stok'];
				$id_produk = $_POST['id_produk'];
				$db->TambahStok($id_produk, $tmbh);
			}
		?>
		Tambah Stok
		<form method="POST" action=""><input type="hidden" name="id_produk" value="<?php echo $_GET['id_produk']; ?>"><input class="form-control" type="text" name="tmbh_stok" style="width: 15%;"><input class="btn" type="submit" name="tambah_S" value="Tambah" style="width: auto; padding: 6px 10px; margin-left: 0px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; "></form>
		<br>

		<?php
		}
	}
	?>
	<table cellpadding="10" cellspacing="0">
		<thead align="center">
			<th>No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Stok</th>
			<th>Harga</th>
			<th>Deskripsi</th>
			<th>Gambar</th>
			<th style="background-color: #ff9800;">Action</th>
		</thead>
		<?php
			$no=1;
			$sql = "SELECT * FROM tbl_produk ORDER BY id_produk DESC";
			$baca = $db->tampil($sql);
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
			<td>
				<a href="?page=produk&aksi=tambah_stok&id_produk=<?php echo $data['id_produk']; ?>">+ Stok</a>
				&nbsp;|&nbsp;
				<a href="?page=edit_produk&id_produk=<?php echo $data['id_produk']; ?>">Edit</a>
				&nbsp;|&nbsp;
				<a onclick="return konfirmasi()" href="?aksi=hapus&id_produk=<?php echo $data['id_produk']; ?>">Hapus</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<script type="text/javascript">
	function konfirmasi() {
		var tanya = confirm("Yakin ingin menghapus data ini?");
		if (tanya == true) return true;
		else return false;
	}
</script>