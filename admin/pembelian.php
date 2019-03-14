<?php
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

if (isset($_POST['kirim_brng'])) {
	$bnyk = $_POST['banyak'];
	$id_pembelian = $_POST['id_pembelian'];
	$id_produk = $_POST['id_produk'];
	$jml_stok = $_POST['jml_stok'];
	$db->KirimBarang($id_pembelian, $bnyk, $id_produk, $jml_stok);

	if (isset($_GET['urut']) && isset($_GET['urutkan'])) {
		$link = "location:?page=pembelian&urut=".$_GET['urut']."&urutkan";
	}else{
		$link = "location:?page=pembelian";
	}
	header($link);
	
}elseif (isset($_POST['batal_kirim'])) {
	$bnyk = $_POST['banyak'];
	$id_pembelian = $_POST['id_pembelian'];
	$id_produk = $_POST['id_produk'];
	$jml_stok = $_POST['jml_stok'];

	$db->BatalKirim($id_pembelian, $bnyk, $id_produk, $jml_stok);
	
	if (isset($_GET['urut']) && isset($_GET['urutkan'])) {
		$link = "location:?page=pembelian&urut=".$_GET['urut']."&urutkan";
	}else{
		$link = "location:?page=pembelian";
	}
	header($link);

}elseif (isset($_POST['ubah_status'])) {
	$status = $_POST['status'];
	$id_pembelian = $_POST['id_pembelian'];

	$db->UbahStatus($status, $id_pembelian);
	
	if (isset($_GET['urut']) && isset($_GET['urutkan'])) {
		$link = "location:?page=pembelian&urut=".$_GET['urut']."&urutkan";
	}else{
		$link = "location:?page=pembelian";
	}
	header($link);
}
?>
<div style="font-family: roboto">
	<h1>Pembelian</h1>
	<h3><a href="?page=pembelian&urutkan" style="<?php echo(isset($_GET['urutkan']))? 'color: #e64a19' : '' ; ?>">Filter</a>&nbsp; | &nbsp;<a href="print.php?ket=pembelian<?php echo(isset($_GET['urut']))? '&urut='.$_GET['urut'] : '' ?>" target="_blank">Print</a></h3>
	<?php if(isset($_GET['urutkan'])){ ?>
	<h4>Berdasarkan: &nbsp;&nbsp;&nbsp;
		<a href="?page=pembelian&urutkan&urut=belum_transfer" style="<?php echo($_GET['urut'] == 'belum_transfer')? 'color: #e64a19' : '' ; ?>">Belum Transfer</a>&nbsp;&nbsp;
		<a href="?page=pembelian&urutkan&urut=sudah_transfer" style="<?php echo($_GET['urut'] == 'sudah_transfer')? 'color: #e64a19' : '' ; ?>">Sudah Transfer</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="?page=pembelian&urutkan&urut=dikirim" style="<?php echo($_GET['urut'] == 'dikirim')? 'color: #e64a19' : '' ; ?>">Sedang Dikirim</a>&nbsp;&nbsp;
		<a href="?page=pembelian&urutkan&urut=sampai" style="<?php echo($_GET['urut'] == 'sampai')? 'color: #e64a19' : '' ; ?>">Sudah Sampai</a>
		<?php if(isset($_GET['urut'])){ ?>
		&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?page=pembelian">Refresh</a>
		<?php } ?>
	</h4>
	<?php } ?>
	<table cellpadding="10" cellspacing="0" style="margin-bottom: 50px;">
		<thead align="center">
			<th>No</th>
			<th>Invoice</th>
			<th>Pembeli</th>
			<th>Barang</th>
			<th>Banyaknya</th>
			<th>Harga</th>
			<th>Ongkir</th>
			<th>Total Bayar</th>
			<?php if(!isset($_GET['urut'])){ ?>
			<th>Status</th>
			<?php } ?>
			<?php if(!isset($_GET['urut']) || $_GET['urut'] != "belum_transfer"){ ?>
			<th style="background-color: #ff9800;">Action</th>
			<?php } ?>
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
			<?php if(isset($_GET['urut'])){}else{ ?>
			<td>
			<?php if($data['img'] == ""){ echo "Belum Transfer"; }elseif($data['img'] != "" && $data['status'] == 1){ echo "<font color='blue'>Sudah Transfer</font>"; }elseif($data['img'] != "" && $data['status'] == 2){ echo "<font color='blue'>Barang Sedang Dikirim</font>"; }else{ echo "<font color='blue'>Barang Sudah Sampai</font>"; }; ?>
			</td>
			<?php } ?>
			<?php if(!isset($_GET['urut']) || $_GET['urut'] != "belum_transfer"){ ?>
			<td>
				<?php
					if ($data['img'] != "" && file_exists("../upload/".$data['img'])) {
					?>
						<a href="?page=pembelian&lihat_transfer&inv=<?php echo $data['id_pembelian']; ?>&bt=<?php echo $data['img']; ?><?php echo(isset($_GET['urut']))? '&urut='.$_GET['urut'] : '' ?><?php echo(isset($_GET['urutkan']))? '&urutkan' : '' ?>">Lihat</a>
						
					<?php
					}
				?>
			</td>
			<?php } ?>
		</tr>
<?php $total += $data['total_bayar']; } ?>
		<tr align="center">
			<td colspan="7" style="background-color: white; border: none;">Total Pendapatan</td>
			<td style="background-color: #ff5722; font-weight: bold; color: white;"><?php echo "Rp. ".number_format($total)." ,-"; ?></td>
			<?php if(isset($_GET['urut']) && $_GET['urut'] != "belum_transfer"){ ?>
			<td style="background-color: white;" colspan="2">&nbsp;</td>
			<?php } ?>
		</tr>
	</table>
<?php
if (isset($_GET['lihat_transfer'])) {
echo "<br>";
	$inv = $_GET['inv'];
	$bt = $_GET['bt'];
	$q = "SELECT * FROM tbl_pembelian a INNER JOIN tbl_produk b ON a.id_produk=b.id_produk WHERE id_pembelian='$inv'";

	$lihat = $db->tampil($q);
	if ($lihat) {
		while ($data = $lihat->fetch_array()) {
			$status = $data['status'];
			$img = $data['img'];
			$nama = $data['nama_produk'];
			$byk = $data['banyak'];
			$id_produk = $data['id_produk'];
			$jml_stok = $data['stok'];
			
		}
		if ($status == 1) {

			
			?>
				<br>
				<div style="margin-bottom: 30px;">
				<label style="margin-top: 90px; font-weight: bold;">Bukti Transfer</label><br>
				<img src="../upload/<?php echo $bt; ?>" style="width: 300px; height: auto; margin-top: 10px;"><br>
				<form method="POST" action="">
					<table>
						<tr>
							<td style="border: none; background-color: white;">Nama Produk</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;"><?php echo $nama; ?></td>
						</tr>
						<tr>
							<td style="border: none; background-color: white;">Banyaknya</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;"><?php echo $byk; ?></td>
						</tr>
						<tr>
							<td style="border: none; background-color: white;">Status</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;">
							<?php if($status == 1){ echo "Barang Belum Dikirim"; }elseif($status == 2){ echo "Barang Sedang Dikirim"; }else{ echo "Barang Sudah Sampai"; }; ?>
							</td>
						</tr>
					</table>
					<input type="hidden" name="jml_stok" value="<?php echo $jml_stok; ?>">
					<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
					<input type="hidden" name="id_pembelian" value="<?php echo $inv; ?>">
					<input type="hidden" name="banyak" value="<?php echo $byk; ?>">
					<input class="btn" type="submit" name="kirim_brng" value="Kirim Barang">
				</form>
				</div>
			<?php
		}elseif ($status == 2) {
		?>
				<br>
					<div style="margin-bottom: 30px;">
					<label style="margin-top: 90px; font-weight: bold;">Bukti Transfer</label><br>
					<img src="../upload/<?php echo $bt; ?>" style="width: 300px; height: auto; margin-top: 10px;"><br>
					<form method="POST" action="">
						<table>
							<tr>
								<td style="border: none; background-color: white;">Nama Produk</td>
								<td style="margin-right: 20px; border: none; background-color: white;">:</td>
								<td style="border: none; background-color: white;"><?php echo $nama; ?></td>
							</tr>
							<tr>
								<td style="border: none; background-color: white;">Banyaknya</td>
								<td style="margin-right: 20px; border: none; background-color: white;">:</td>
								<td style="border: none; background-color: white;"><?php echo $byk; ?></td>
							</tr>
							<tr>
								<td style="border: none; background-color: white;">Status</td>
								<td style="margin-right: 20px; border: none; background-color: white;">:</td>
								<td style="border: none; background-color: white;">
								<?php if($status == 1){ echo "Barang Belum Dikirim"; }elseif($status == 2){ echo "Barang Sedang Dikirim"; }else{ echo "Barang Sudah Sampai"; }; ?>
								</td>
							</tr>
						</table>
						<input type="hidden" name="jml_stok" value="<?php echo $jml_stok; ?>">
						<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
						<input type="hidden" name="id_pembelian" value="<?php echo $inv; ?>">
						<input type="hidden" name="banyak" value="<?php echo $byk; ?>">
						<input class="btn" type="submit" name="batal_kirim" value="Batalkan" style="background-color: #f44336;">
					</form><br>
					<form method="POST" action="">
						<label>Ubah Status</label><br>
						<select name="status" style="padding: 8px 8px;">
							<option value="2">Sedang Dikirim</option>
							<option value="3">Sudah Sampai</option>
						</select>
						<input type="hidden" name="id_pembelian" value="<?php echo $inv; ?>">
						<input class="btn" type="submit" name="ubah_status" value="Ubah" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px; width: auto; padding: 10px 10px;">
					</form>
					</div>
		<?php
		}elseif ($status == 3) {
		?>
			<br>
				<div style="margin-bottom: 30px;">
				<label style="margin-top: 90px; font-weight: bold;">Bukti Transfer</label><br>
				<img src="../upload/<?php echo $bt; ?>" style="width: 300px; height: auto; margin-top: 10px;"><br>
				<form method="POST" action="">
					<table>
						<tr>
							<td style="border: none; background-color: white;">Nama Produk</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;"><?php echo $nama; ?></td>
						</tr>
						<tr>
							<td style="border: none; background-color: white;">Banyaknya</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;"><?php echo $byk; ?></td>
						</tr>
						<tr>
							<td style="border: none; background-color: white;">Status</td>
							<td style="margin-right: 20px; border: none; background-color: white;">:</td>
							<td style="border: none; background-color: white;">
							<?php if($status == 1){ echo "Barang Belum Dikirim"; }elseif($status == 2){ echo "Barang Sedang Dikirim"; }else{ echo "Barang Sudah Sampai"; }; ?>
							</td>
						</tr>
					</table>
					<input type="hidden" name="jml_stok" value="<?php echo $jml_stok; ?>">
					<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
					<input type="hidden" name="id_pembelian" value="<?php echo $inv; ?>">
					<input type="hidden" name="banyak" value="<?php echo $byk; ?>">
					<!-- <input type="submit" name="kirim_brng" value="Kirim Barang"> -->
				</form>
				</div>
		<?php
		}
		
	}
}
?>
</div>