<?php session_start();
include '../config/class.php';
$db = new database();

if (isset($_GET['aksi'])) {
	if ($_GET['aksi'] == "logout") {
		$db->logout();
	}elseif ($_GET['aksi'] == "edit") {
		
	}elseif ($_GET['aksi'] == "hapus") {
		$id = $_GET['id_produk'];
		$db->HapusProduk($id);
	}elseif ($_GET['aksi'] == "hapus_stok") {
		$id_produk = $_GET['id_produk'];
		$id_stok = $_GET['id_stok'];
		$db->HapusStok($id_produk, $id_stok);
	}
}else{
	$db->validasi();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman ADMIN</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="shortcut icon" href="../img/ci-icon.ico" type="image/x-icon" />
</head>
<body>
<div class="container">
<header style="font-size: 50px; text-align: center; font-weight: bold; font-family: roboto;"><div style="margin-top: 22px;">Halaman ADMIN</div>
</header>
<aside>
		<nav>
			<ul id="menu">
				<li class="menu-item">
					<a href="index.php" class="<?php echo !isset($_GET['page']) ? "active" : "" ?>" >Dashbord</a>
				</li>
				<li class="menu-item">
					<a href="?page=produk" class="<?php echo ($_GET['page'] == 'produk') ? "active" : "" ?>">Produk</a>
				</li>
				<li class="menu-item">
					<a href="?page=stok" class="<?php echo ($_GET['page'] == 'stok') ? "active" : "" ?>">Stok</a>
				</li>
				<li class="menu-item">
					<a href="?page=pembelian" class="<?php echo ($_GET['page'] == 'pembelian') ? "active" : "" ?>">Pembelian</a>
				</li>
				<li class="menu-item">
					<a href="../" class="<?php echo ($_GET['page'] == 'homepage') ? "active" : "" ?>">Homepage</a>
				</li>
				<li class="menu-item">
					<a href="#">&nbsp;</a>
				</li>
				<li class="menu-item">
					<a href="?aksi=logout" class="<?php echo ($_GET['page'] == 'logout') ? "active" : "" ?>">Logout</a>
				</li>
			</ul>
		</nav>
	</aside>
	<section>
		<?php
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}else{
			$page = "home";
		}
		switch ($page) {
			case 'produk':
				include 'produk.php';
				break;
			case 'stok':
				include 'stok.php';
				break;
			case 'pembelian':
				include 'pembelian.php';
				break;
			case 'tambah_produk':
				include 'tambah_produk.php';
				break;
			case 'edit_produk':
				include 'edit_produk.php';
				break;

			default:
				include 'home.php';
				break;
		}
		?>
	</section>
<br class="clearfloat"/>
<footer style="text-align: center; font: 20px 'roboto'; vertical-align: middle;">&copy; Copyright DTX | All Right Reserved 2018
</footer>
</div>
</body>
</html>