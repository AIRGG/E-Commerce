<?php
include 'config/class.php';
$db = new database();

$id = $_GET['id_user'];
$sql = "SELECT * FROM tbl_user a INNER JOIN tbl_pelanggan b ON a.id_user=b.id_user WHERE a.id_user='$id'";
$baca = $db->tampil($sql);

while ($data = $baca->fetch_array()) {
?>
<div class="profil-user">
	<div class="profil-isi">
		<p style="font-size: 32px; font-weight: bolder;">Profil</p>
		<table>
			<tr>
				<td style="border: none; background-color: white;">Nama</td>
				<td style="border: none; background-color: white;">:</td>
				<td style="border: none; background-color: white;">&nbsp;</td>
				<td style="border: none; background-color: white;"><?php echo $data['nama_pelanggan']; ?></td>
			</tr>
			<tr>
				<td style="border: none; background-color: white;">Alamat</td>
				<td style="border: none; background-color: white;">:</td>
				<td style="border: none; background-color: white;">&nbsp;</td>
				<td style="border: none; background-color: white;"><?php echo $data['alamat']; ?></td>
			</tr>
			<tr>
				<td style="border: none; background-color: white;">No Hp</td>
				<td style="border: none; background-color: white;">:</td>
				<td style="border: none; background-color: white;">&nbsp;</td>
				<td style="border: none; background-color: white;"><?php echo $data['no_hp']; ?></td>
			</tr>
			<tr>
				<td style="border: none; background-color: white;">E-Mail</td>
				<td style="border: none; background-color: white;">:</td>
				<td style="border: none; background-color: white;">&nbsp;</td>
				<td style="border: none; background-color: white;"><?php echo $data['email']; ?></td>
			</tr>
			<tr><td style="border: none; background-color: white;"><hr></td></tr>
			<tr>
				<td style="border: none; background-color: white;">Username</td>
				<td style="border: none; background-color: white;">:</td>
				<td style="border: none; background-color: white;">&nbsp;</td>
				<td style="border: none; background-color: white;"><?php echo $data['username']; ?></td>
			</tr>
		</table>
	</div>
</div>
<?php } ?>