<?php
include 'config/class.php';
$db = new database();


?>
<div class="profil-user">
	<div class="profil-isi">
		<h1>Terima Kasih Sudah Berbelanja Di Website Kami</h1>
		<h3>Silahkan Cek Invoice Anda <a href="invoice.php?inv=<?php echo $_GET['inv']; ?>" target="_blank"><?php echo $_GET['inv']; ?></a></h3>
	</div>
</div>