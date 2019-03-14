<?php session_start();
if (isset($_GET['destroy'])) {
	include 'config/class.php';
	$db = new database();
	$db->logout();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kelontong Onlen</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="shortcut icon" href="img/ci-icon.ico" type="image/x-icon" />
</head>
<body>
<div class="container">
	<header style="background-image: url(img/header.jpg);">
		
	</header>
	<nav>
		<ul class="menu">
			<li class="menu-item">
				<a class="<?php echo(!isset($_GET['page']))? 'active' : ''; ?>" href="index.php">Home</a>
			</li>
			<li class="menu-item">
				<a class="<?php echo(isset($_GET['page']) && $_GET['page'] == 'produk')? 'active' : ''; ?>" href="?page=produk">Produk</a>
			</li>
			<?php
			if (isset($_SESSION['cart'])) {
			?>
			<li class="menu-item">
				<a class="<?php echo(isset($_GET['page']) && $_GET['page'] == 'cart')? 'active' : ''; ?>" href="?page=cart">Cart</a>
			</li>
			<?php }
			if (isset($_SESSION['status'])) {
				if ($_SESSION['status'] == "login" && $_SESSION['level'] != "admin" || $_SESSION['level'] == "user") {
					?>
					<li class="menu-item">
						<a class="<?php echo(isset($_GET['page']) && $_GET['page'] == 'tampil_invoice')? 'active' : ''; ?>" href="?page=tampil_invoice">Invoice</a>
					</li>
					<?php
				}
			}
			?>
			<li class="menu-item">
				<form class="form-control" method="GET" action=""><input type="search" name="cari" style="width: 200px; background-image: url('img/searchicon.png'); background-repeat: no-repeat; background-position: 5px 5px; padding-left: 35px; border: none;" <?php echo(isset($_GET['search']))? "value='".$_GET['cari']."'" : '' ; ?>><input class="btn-search" type="submit" name="search" value="Cari" style=" border-top-right-radius: 5px;  border-bottom-right-radius: 5px; "></form>
			</li>

			<!-- Menu Di Kanan -->
			<?php
			if (isset($_SESSION['status'])) {
				if ($_SESSION['status'] == "login" && $_SESSION['level'] != "admin" || $_SESSION['level'] == "user") {
			?>
				<li class="menu-item" style="float: right;">
					<a href="?destroy">Logout</a>
				</li>
			<?php 
				} 
			}elseif(!isset($_SESSION['status'])){
			?>
				<li class="menu-item" style="float: right;">
					<a class="<?php echo($_GET['page'] == 'login')? 'active' : ''; ?>" href="?page=login">Login</a>
				</li>
			<?php }else{ ?>
			
			<?php } ?>
			<?php
			if (isset($_SESSION['level'])) {
				if ($_SESSION['level'] == "admin") {
			?>
			<li class="menu-item" style="float: right;">
				<a href="admin">Dashboard</a>
			</li>
			<?php } }
			if (isset($_SESSION['status']) == "login" && isset($_SESSION['username'])) {
			?>
			<li class="menu-item" style="float: right;">
				<a href="<?php echo($_SESSION['level'] != 'admin')? '?page=profil_user&id_user='.$_SESSION['id_user']: '#' ?>">Hi, <?php echo(isset($_SESSION['nama']))? $_SESSION['nama'] : $_SESSION['username'] ?></a>
			</li>
			<?php } ?>
		</ul>
	</nav>
	<section>
		<?php
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}else{
			$page = "home";
		}

		switch ($page) {
			case 'login':
				include 'login.php';
				break;
			case 'cart':
					include 'cart.php';
					break;
			case 'produk':
					include 'produk.php';
					break;
			case 'detail_produk':
					include 'produk_detail.php';
					break;
			case 'daftar_user':
					include 'daftar.php';
					break;
			case 'profil_user':
					include 'profil_user.php';
					break;
			case 'bayar':
					include 'bayar.php';
					break;
			case 'finish':
					include 'finish.php';
					break;
			case 'tampil_invoice':
					include 'tampil_invoice.php';
					break;
			default:
				include 'home.php';
				break;
		}
		?>
	</section>
	<footer>
		&copy; Copyright DTX | All Right Reserved 2018
	</footer>
</div>
</body>
</html>