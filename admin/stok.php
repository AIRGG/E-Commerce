<div style="font-family: roboto;">
<h1>Stok</h1>
<?php
if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == "edit_stok") {

		if (isset($_POST['edit_s'])) {
			$id_p = $_POST['id_produk'];
			$id_s = $_POST['id_stok'];
			$tmbh_stok = $_POST['tmbh_stok'];

			$db->EditStok($id_s, $id_p, $tmbh_stok);
		}
	?>
	Edit Stok
	<form method="POST" action=""><input type="hidden" name="id_stok" value="<?php echo $_GET['id_stok']; ?>"><input type="hidden" name="id_produk" value="<?php echo $_GET['id_produk']; ?>"><input class="form-control" type="text" name="tmbh_stok" value="<?php echo $_GET['stok']; ?>" style="width: 15%;"><input type="submit" name="edit_s" value="Edit" class="btn" style="width: auto; padding: 6px 10px; margin-left: 0px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;"></form>
	<br>
	<?php
	}
}
?>
<table cellpadding="10" cellspacing="0">
	<thead align="center">
		<th>No</th>
		<th>Nama Produk</th>
		<th>Stok</th>
		<th>Tgl Ditambahkan</th>
		<th style="background-color: #ff9800;">Action</th>
	</thead>
<?php
$no=1;
$sql = "SELECT * FROM tbl_stok a INNER JOIN tbl_produk b ON a.id_produk = b.id_produk";
$baca = $db->tampil($sql);
while ($data = $baca->fetch_array()) {
?>
	<tr align="center">
		<td><?php echo $no++; ?></td>
		<td><?php echo $data['nama_produk'] ?></td>
		<td><?php echo $data['jml_stok']; ?></td>
		<td><?php echo $data['tgl_msk']; ?></td>
		<td>
			<a href="?page=stok&aksi=edit_stok&id_produk=<?php echo $data['id_produk']; ?>&id_stok=<?php echo $data['id_stok']; ?>&stok=<?php echo $data['jml_stok']; ?>">Edit</a>
			&nbsp;|&nbsp;
			<a onclick="return konfirmasi()" href="?aksi=hapus_stok&id_produk=<?php echo $data['id_produk']; ?>&id_stok=<?php echo $data['id_stok']; ?>">Hapus</a><a href=""></a>
		</td>
	</tr>
<?php } ?>
</table>
<script type="text/javascript">
	function konfirmasi() {
		var tanya = confirm("Yakin ingin menghapus data ini?");
		if (tanya == true) return true;
		else return false;
	}
</script>