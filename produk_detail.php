<?php
include 'config/class.php';
$db = new database();

if (isset($_POST['add'])) {
	$id = $_GET['id_produk'];
	$byk = $_POST['byk'];
	
	$db->AddCart($id, $byk);
	header("location:?page=cart");
}

$id = $_GET['id_produk'];
$sql = "SELECT * FROM tbl_produk WHERE id_produk='$id'";
$baca = $db->tampil($sql);

while ($data = $baca->fetch_array()) {
?>
<div class="produk-detail">
	<h1 style=" font-family: roboto; text-align: center; color: #e63d2e;"><?php echo $data['nama_produk']; ?></h1>
	<div class="produk-image" style="background-image: url('upload/<?php echo($data['img'] != '' && file_exists('upload/'.$data['img']))? $data['img'] : 'no_image.png' ?>');"></div>
	<table border="0" cellpadding="5" cellspacing="0" style="margin-top: 15px;">
		<tr>
			<td style="border-bottom: 0px; background-color: white;">Nama Produk</td>
			<td style="width: 20px; border-bottom: 0px; background-color: white;">:</td>
			<td style="border-bottom: 0px; background-color: white;"><?php echo $data['nama_produk']; ?></td>
		</tr>
		<tr>
			<td style="border-bottom: 0px; background-color: white;">Deskripsi</td>
			<td style="width: 20px; border-bottom: 0px; background-color: white;">:</td>
			<td style="border-bottom: 0px; background-color: white;"><?php echo $data['deskripsi']; ?></td>
		</tr>
		<tr>
			<td style="border-bottom: 0px; background-color: white;">Harga</td>
			<td style="width: 20px; border-bottom: 0px; background-color: white;">:</td>
			<td style="border-bottom: 0px; background-color: white;"><?php echo "Rp. ".number_format($data['harga'])." ,-"; ?></td>
		</tr>
	</table>
	<form action="" method="POST"><input type="number" min="1" style="width: 80px; float: right;" value="1" name="byk"><input class="btn-add" type="submit" name="add" value="Add" style="padding: 10px 10px; border-bottom-left-radius: 5px; border-top-left-radius: 5px;"></form>
</div>
<?php } ?>