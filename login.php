<?php
include 'config/class.php';
$db = new database();

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$db->login($username, $password);
}
?>
<div style="font-family: roboto; font-size: 14px; font-weight: bold;">
<h1>Login</h1>
	<?php
	if (isset($_GET['pesan'])) {
		if($_GET['pesan'] == "sudah_logout"){
			echo "<font color='green'>Anda Berhasil Logout</font>";
		}elseif ($_GET['pesan'] == "belum_login") {
			echo "<font color='red'>Silahkan Login Untuk Masuk Ke Halaman ADMIN</font>";
		}elseif ($_GET['pesan'] == "belum_daftar") {
			echo "<font color='orange'>Silahkan Login Untuk Meneruskan Pembayaran</font>";
		}
	}
	?>
	<form method="POST" action="">
		<label>Username</label><br>
		<input type="text" name="username" autofocus required><br><br>
		<label>Password</label><br>
		<input type="password" name="password" autofocus required><br><br>
		<input class="btn" type="submit" name="login" value="Login">&nbsp;&nbsp;
		<a href="?page=daftar_user" style="color: #ff6f00; text-decoration: none; text-decoration: underline;">Daftar</a>
	</form>
</div>