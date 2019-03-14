<?php
include 'config/class.php';
$db = new database();

if (isset($_POST['daftar'])) {
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$no_hp = $_POST['no_hp'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$db->daftar($nama, $alamat, $email, $no_hp, $username, $password);
}
?>
<div style="font-family: roboto; font-size: 14px; font-weight: bold;">
	<form method="POST" action="">
		<label>Nama</label><br>
		<input type="text" name="nama" autofocus required><br><br>
		<label>Alamat</label><br>
		<input type="text" name="alamat" autofocus required><br><br>
		<label>Email</label><br>
		<input type="text" name="email" autofocus required><br><br>
		<label>No Hp</label><br>
		<input type="number" name="no_hp" max="9999999999999" autofocus required><br><br><br>
		<label>Username</label><br>
		<input type="text" name="username" autofocus required><br><br>
		<label>Password</label><br>
		<input type="password" name="password" autofocus required><br><br>
		<input class="btn" type="submit" name="daftar" value="Daftar">&nbsp;&nbsp;
		<a href="?page=login" style="color: #ff6f00; text-decoration: none; text-decoration: underline;">Login</a>
	</form>
</div>