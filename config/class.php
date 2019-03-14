<?php
/**
 * 
 */
class database
{
	private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbpass = "";
	private $dbnama = "ecommerce";

	public $aksi;
	function __construct()
	{
		$this->koneksi();
	}

	function koneksi()
	{
		$this->aksi = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbnama);
		if (!$this->aksi) {
			$this->aksi->connect_error;
			return false;
		}
	}

	//Fungsi untuk User & ADMIN
	function login($username, $password)
	{
		if ($username == "admin") {
			$sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
			$hasil = $this->aksi->query($sql) or die($this->aksi->error);
			while ($data = $hasil->fetch_array()) {
				$id = $data['id_user'];
				$level = $data['level'];
			}
		}else{
			$sql = "SELECT * FROM tbl_user a INNER JOIN tbl_pelanggan b ON a.id_user=b.id_user WHERE username='$username' AND password='$password'";
			$hasil = $this->aksi->query($sql) or die($this->aksi->error);
			while ($data = $hasil->fetch_array()) {
				$id_user = $data['id_user'];
				$id_pelanggan = $data['id_pelanggan'];
				$nama = $data['nama_pelanggan'];
				$level = $data['level'];
			}
		}
		if ($hasil->num_rows == 1) {
			if ($level == 1) {
				$_SESSION['status'] = "login";
				$_SESSION['level'] = "admin";
				$_SESSION['id'] = $id;
				$_SESSION['username'] = $username;
				echo "<script>alert('Anda Berhasil Login');document.location.href='admin'</script>";
			}elseif ($level == 2) {
				$_SESSION['status'] = "login";
				$_SESSION['level'] = "user";
				$_SESSION['id_user'] = $id_user;
				$_SESSION['id_pelanggan'] = $id_pelanggan;
				$_SESSION['nama'] = $nama;
				$_SESSION['username'] = $username;
				if (isset($_SESSION['cart'])) {
					header("location:?page=bayar");
				}else{
					header("location:index.php");
				}
			}
		}else{
			echo "<font color='red'>Username atau Password Salah</font>";
		}
	}

	function daftar($nama, $alamat, $email, $no_hp, $username, $password)
	{
		$lvl = 2;
		$sql = "SELECT * FROM tbl_user WHERE username='$username'";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		//$sql = "INSERT INTO tbl_user VALUES('', '$username', '$password', '$lvl')";
		

		if ($hasil->num_rows == 1) {
			echo "<font color='red' face='roboto'>Username Sudah Terdaftar, Silahkan Masukkan Username Yang Lain</font><br><br>";
			}else{
				$sql1 = "INSERT INTO tbl_user VALUES('', '$username', '$password', '$lvl')";
				$hasil1 = $this->aksi->query($sql1) or die($this->aksi->error);
				if ($hasil1) {
					$sql2 = "SELECT * FROM tbl_user WHERE username='$username'";
					$lihat = $this->aksi->query($sql2) or die($this->aksi->error);
					while ($data = $lihat->fetch_array()) {
						$user_id = $data['id_user'];
					}

					$sql0 = "INSERT INTO tbl_pelanggan VALUES('', '$user_id', '$nama', '$alamat', '$email', '$no_hp')";
					$hasil0 = $this->aksi->query($sql0) or die($this->aksi->error);
					if ($hasil0) {
						echo "<script>alert('Anda Berhasil Daftar');document.location.href='?page=login'</script>";
					}
				}
			}

	}

	function logout()
	{
		session_start();
		$status = $_SESSION['status'];
		$level = $_SESSION['level'];
		if ($status == "login" && $level == "admin") {
			session_destroy();
			header("location:../?page=login&pesan=sudah_logout");	
		}elseif ($status == "login") {
			session_destroy();
			header("location:index.php?page=login&pesan=sudah_logout");
		}
	}

	function validasi()
	{
		if ($_SESSION['status'] != "login" && $_SESSION['level'] != "admin") {
			header("location:../index.php?page=login&pesan=belum_login");
		}
	}

	//Fungsi untuk Halaman ADMIN
	function tampil($sql)
	{
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil) {
			return $hasil;
		}
	}

	function hitung($sql)
	{
		$query = $this->aksi->query($sql) or die($this->aksi->error);
		$hasil = $query->num_rows;
		if ($hasil) {
			return $hasil;
		}
	}

	function TambahProduk($kode, $nama, $stok, $desc, $harga, $img, $tmp)
	{
		$dir = "../upload/";
		$sql = "INSERT INTO tbl_produk VALUES('', '$kode', '$nama', '$stok', '$desc', '$harga', '$img')";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil) {
			if (is_uploaded_file($tmp)) {
				$cek = move_uploaded_file($tmp, $dir.$img);
				if ($cek) {
					return $hasil;
				}
			}
		}
	}

	function HapusProduk($id)
	{
		$sql = "DELETE FROM tbl_produk WHERE id_produk='$id'";
		$sql0 = "DELETE FROM tbl_stok WHERE id_produk='$id'";
		$hasil0 = $this->aksi->query($sql0) or die($this->aksi->error);
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil0 && $hasil) {
			echo "<script>alert('Data Berhasil Dihapus');document.location.href='index.php?page=produk'</script>";
		}
	}

	function UpdateProduk($id_produk, $kode, $nama, $desc, $harga, $img0, $img1, $tmp)
	{
		if ($img1 == "") {
			$sql = "UPDATE tbl_produk SET kode_produk='$kode', nama_produk='$nama', deskripsi='$desc', harga='$harga', img='$img0' WHERE id_produk='$id_produk'";
		}else{
			$dir = "../upload/";
			$sql = "UPDATE tbl_produk SET kode_produk='$kode', nama_produk='$nama', deskripsi='$desc', harga='$harga', img='$img1' WHERE id_produk='$id_produk'";
		}
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil && $img1 != "") {
			if (is_uploaded_file($tmp)) {
				$cek = move_uploaded_file($tmp, $dir.$img1);
				if ($cek) {
					return $hasil;
				}
			}
		}else{
			return $hasil;
		}
	}

	function HapusStok($id_produk, $id_stok)
	{
		$sql = "SELECT * FROM tbl_produk a INNER JOIN tbl_stok b ON a.id_produk = b.id_produk WHERE a.id_produk='$id_produk' AND b.id_stok='$id_stok'";
		$baca = $this->aksi->query($sql) or die($this->aksi->error);
		while ($data = $baca->fetch_array()) {
			$stok = $data['stok'];
			$jml_stok = $data['jml_stok'];
		}
		$jml = $stok-$jml_stok;
		$hasil = "UPDATE tbl_produk SET stok='$jml' WHERE id_produk='$id_produk'";
		$hasil0 = "DELETE FROM tbl_stok WHERE id_stok='$id_stok'";
		$this->aksi->query($hasil) or die($this->aksi->error);
		$this->aksi->query($hasil0) or die($this->aksi->error);
		echo "<script>alert('Data Berhasil Dihapus');document.location.href='index.php?page=stok'</script>";
	}

	function TambahStok($id_produk, $tmbh)
	{
		$sql = "SELECT * FROM tbl_produk WHERE id_produk='$id_produk'";
		$baca = $this->aksi->query($sql) or die($this->aksi->error);
		while ($data = $baca->fetch_array()) {
			$stok = $data['stok'];
		}
		$jml = $stok + $tmbh;
		$hasil = "UPDATE tbl_produk SET stok='$jml' WHERE id_produk='$id_produk'";
		$tgl = date("Y:m:d");
		$hasil0 = "INSERT INTO tbl_stok VALUES('', '$id_produk', '$tmbh', '$tgl')";
		if ($hasil && $hasil0) {
			$this->aksi->query($hasil) or die($this->aksi->error);
			$this->aksi->query($hasil0) or die($this->aksi->error);
			echo "<script>alert('Stok Berhasil Ditambahkan');document.location.href='index.php?page=produk'</script>";
		}
	}

	function EditStok($id_s, $id_p, $tmbh_stok)
	{
		$sql = "SELECT * FROM tbl_produk a INNER JOIN tbl_stok b ON a.id_produk = b.id_produk WHERE a.id_produk='$id_p' AND b.id_stok='$id_s'";
		$baca = $this->aksi->query($sql) or die($this->aksi->error);
		while ($data = $baca->fetch_array()) {
			$stok = $data['stok'];
			$jml_stok = $data['jml_stok'];
		}
		if ($tmbh_stok > $jml_stok) {
			$jm = $stok - $jml_stok;
			$jml = $jm + $tmbh_stok;

			$hasil = "UPDATE tbl_stok SET jml_stok='$tmbh_stok' WHERE id_stok='$id_s'";
			$hasil0 = "UPDATE tbl_produk SET stok='$jml' WHERE id_produk='$id_p'";
			if ($hasil && $hasil0) {
				$this->aksi->query($hasil) or die($this->aksi->error);
				$this->aksi->query($hasil0) or die($this->aksi->error);
				echo "<script>alert('Stok Berhasil Diedit');document.location.href='index.php?page=stok'</script>";
			}
		}elseif ($tmbh_stok < $jml_stok) {
			$jm = $stok - $jml_stok;
			$jml = $jm + $tmbh_stok;

			$hasil = "UPDATE tbl_stok SET jml_stok='$tmbh_stok' WHERE id_stok='$id_s'";
			$hasil0 = "UPDATE tbl_produk SET stok='$jml' WHERE id_produk='$id_p'";
			if ($hasil && $hasil0) {
				$this->aksi->query($hasil) or die($this->aksi->error);
				$this->aksi->query($hasil0) or die($this->aksi->error);
				echo "<script>alert('Stok Berhasil Diedit');document.location.href='index.php?page=stok'</script>";
			}
		}
	}

	function LihatInvoice($id_pelanggan)
	{
		$sql = "SELECT * FROM tbl_pembelian WHERE id_pelanggan='$id_pelanggan' GROUP BY invoice";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil->num_rows > 0) {
			return $hasil;
		}
	}

	function TampilProdukId($id_produk)
	{
		$sql = "SELECT * FROM tbl_produk WHERE id_produk='$id_produk'";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil->num_rows > 0) {
			$data = $hasil->fetch_array();
		}
		return $data;
	}

	function AddCart($id_produk, $banyak)
	{
		session_start();
		if (!isset($_SESSION['cart'])) {
			$data = array();
		}else{
			$data = $_SESSION['cart'];
		}

		$data[$id_produk] = $banyak;
		$_SESSION['cart'] = $data;

		return $_SESSION['cart'];
	}

	function kurir()
	{
		$sql = "SELECT * FROM tbl_kurir";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil) {
			return $hasil;
		}
	}

	function invoice()
	{
		$tgl = date('Y-m-d');
		$hit = substr($tgl, 0, 10);
		$sql = "SELECT * FROM tbl_pembelian WHERE SUBSTRING(tgl_pembelian, 1, 10) = '$hit' ORDER BY invoice ASC";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil->num_rows > 0) {
			while ($data = $hasil->fetch_array()) {
				$inv = $data['invoice'];
			}
			//menghitung panjang pada invoice yang sudah ada di database
			$panjang = strlen($inv);
			//mencek berapa panjang nomer urut yang sudah ada di database
			$urut = $panjang - 9;

			//megmabil nomer urut dari database
			$no_urut = substr($inv, 9, $urut);
			//membuat nomer urut baru
			$urut_baru = $no_urut + 1;

			//membuat invoice baru
			$invoice = "INV".date("dmy").$urut_baru;
		}else{
			$invoice = "INV".date('dmy')."1";
		}
		return $invoice;
	}

	function bayar($id_pelanggan, $cart, $kurir, $ongkir)
	{
		$tgl = date('Y-m-d');
		$total = 0;
		$invoice = $this->invoice();
		$status = 1;
		foreach ($cart as $key => $value) {
			$id_produk = $value['produk']['id_produk'];
			$banyak = $value['banyak'];

			$total_harga = $value['produk']['harga'] * $value['banyak'];
			$total += $total_harga;
			$total_bayar = $total + $ongkir;

			$sql = "INSERT INTO tbl_pembelian VALUES('', '$invoice', '$tgl', '$id_pelanggan', '$id_produk', '$banyak', '$kurir', '$total_bayar', '$status', '')";
			$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		}
		unset($_SESSION['cart']);
		header("location:?page=finish&inv=$invoice");
	}

	function bukti($inv, $img, $tmp)
	{
		$sql = "UPDATE tbl_pembelian SET img='$img' WHERE invoice='$inv'";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		if ($hasil) {
			$dir = "upload/";
			if (is_uploaded_file($tmp)) {
				$cek = move_uploaded_file($tmp, $dir.$img);
				if ($cek) {
					echo "<script>alert('Bukti Transfer Berhasil Dikirim');document.location.href='invoice.php?inv=$inv'</script>";
				}
			}
		}
	}

	function KirimBarang($id_pembelian, $bnyk, $id_produk, $jml_stok)
	{
		$st = 2;
		$op = $jml_stok - $bnyk;
		$sql = "UPDATE tbl_produk SET stok='$op' WHERE id_produk='$id_produk'";
		$sql0 = "UPDATE tbl_pembelian SET status='$st' WHERE id_pembelian='$id_pembelian'";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		$hasil0 = $this->aksi->query($sql0) or die($this->aksi->error);

		if ($hasil && $hasil0) {
			return $hasil;
		}

	}

	function BatalKirim($id_pembelian, $bnyk, $id_produk, $jml_stok)
	{
		$st = 1;
		$op = $jml_stok + $bnyk;
		$sql = "UPDATE tbl_produk SET stok='$op' WHERE id_produk='$id_produk'";
		$sql0 = "UPDATE tbl_pembelian SET status='$st' WHERE id_pembelian='$id_pembelian'";
		$hasil = $this->aksi->query($sql) or die($this->aksi->error);
		$hasil0 = $this->aksi->query($sql0) or die($this->aksi->error);

		if ($hasil && $hasil0) {
			return $hasil;
		}
	}

	function UbahStatus($status, $id_pembelian)
	{
		$sql0 = "UPDATE tbl_pembelian SET status='$status' WHERE id_pembelian='$id_pembelian'";
		$hasil0 = $this->aksi->query($sql0) or die($this->aksi->error);
		if ($hasil0) {
			header("location:?page=pembelian");
		}
	}

}
?>