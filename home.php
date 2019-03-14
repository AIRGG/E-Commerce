<?php
include 'config/class.php';
$db = new database();

if (isset($_GET['search'])) {
	$nama = $_GET['cari'];

	$sql = "SELECT * FROM tbl_produk WHERE nama_produk LIKE '%$nama%'";
	$hit = $db->hitung($sql);
}else{
	$sql = "SELECT * FROM tbl_produk ORDER BY id_produk DESC";
}
$baca = $db->tampil($sql);
if (isset($_GET['search'])) {
	if ($hit > 0) {
		echo(isset($_GET['search'])? "<p align='center' style='clear: left;font-family: roboto;'>Ditemukan <b>".$hit."</b> data</p>" : '');		
	}else{
		echo "<p align='center' style='clear: left;font-family: roboto;'>Data <b>". $_GET['cari'] ."</b> Tidak Ditemukan</p>";
		echo "<p align='center' style='clear: left;font-family: roboto;'>Silahkan Cek Kata Kunci Pencarian</p>";
	}
}
while ($data = $baca->fetch_array()) {
	//for ($i=0; $i <= 5; $i++) { 

?>
<div class="box">
	<div onclick="pindah(<?php echo $data['id_produk']; ?>)" class="produk-image" style="background-image: url('upload/<?php echo($data['img'] != '' && file_exists('upload/'.$data['img']))? $data['img'] : 'no_image.png' ?>'); cursor:pointer;"></div>
	<div class="produk-desc">
		<h2 class="produk-name"><a href="?page=detail_produk&id_produk=<?php echo $data['id_produk']; ?>"><?php echo(strlen($data['nama_produk']) >= 15)? substr($data['nama_produk'], 0, 13)."..." : $data['nama_produk']; ?></a></h2>
		<p class="produk-harga" style="font-size: 25px; "><?php echo "Rp. ".number_format($data['harga'])." ,-"; ?></p>
	</div>
	<div class="produk-nav">
		<a class="btn-detail" href="?page=detail_produk&id_produk=<?php echo $data['id_produk']; ?>" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px; width: 49%;">Detail</a>
		<a class="btn" href="?page=produk&add_cart&id=<?php echo $data['id_produk']; ?>" style="width: 49%; border-top-left-radius: 0px;border-bottom-left-radius: 0px;">Beli</a>
	</div>
</div>

<?php } //} ?>
<script type="text/javascript">
	function pindah(id) {
		var dir = 
		document.location.href="?page=detail_produk&id_produk="+id;
	}
</script>