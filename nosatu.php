<!DOCTYPE html>
<html>
<head>
	<title>I Kadek Candradinata</title>
	<style type="text/css">
		table{
			border: solid;
		}
		th{
			text-align: center;
			border: solid;
		}
		tr td{
			text-align: center;
			border: solid;
		}
	</style>
</head>
<body>
	<form method="GET"><input type="submit" value="Home" name="home" placeholder="Home"></form>
	<?php
		session_start();
		if (isset($_GET['home'])) {
			# code...
			echo "sdasdsad";

			header('Location:index.php');
			session_destroy();
		}
	?>
    <form method="GET">
    	Nama Pelanggan: <select name="namapelanggan" id="namapelanggan" required="required">
    		<option disabled="disabled" selected="selected" value="">Pilih nama pelanggan</option>
		  <?php
		  	$namapel = json_decode(file_get_contents('https://api-test.godig1tal.com/customer/all_customer'));
		  	foreach ($namapel->data as $nama) {
		  		echo '<option value="'.$nama->customer_name.'">'.$nama->customer_name.'</option>',htmlspecialchars($nama->customer_name);
		  	}
		  ?>
		</select>
		<br><br>
		Nama Produk:
		<select name="namaproduk" id="namaproduk" required="required">
			<option disabled="disabled" selected="selected" value="">Pilih nama produk</option>
		  <?php
		  	$namaprod = json_decode(file_get_contents('https://api-test.godig1tal.com/product/all_product'));
		  	foreach ($namaprod->data as $namapr) {
		  		echo '<option value="'.$namapr->product_name.'">'.$namapr->product_name.'</option>',htmlspecialchars($namapr->product_name);
		  	}
		  ?>
		</select>
		<br><br>
		Region:
		<select name="region" id="Region" required="">
		  <option disabled="disabled" selected="selected" value="">Pilih Region</option>
		  <option value="US">US</option>
		  <option value="CA">CA</option>
		</select>
		<br><br>
		<!-- <label for="jumlah">Jumlah Pembayaran</label> -->
		Jumlah Pembayaran: $<input type="number" id="jumlah" name="jumlah" placeholder="Hanya nominal" required="required">
		<br><br>
		<input type="submit" name="submit" value="Submit">
    </form>
    <br><br>
    <?php 
    	if (isset($_GET['submit'])) {
    		# code...
    		$pel = $_GET['namapelanggan'];
    		$prod = $_GET['namaproduk'];
    		$regi = $_GET['region'];
    		$jml = $_GET['jumlah'];

    		echo "Transaksi berhasil! <br>Nama Pelanggan: ".$pel."<br>Nama Produk: ".$prod."<br>Region: ".$regi."<br>Jumlah Pembayaran: ".$jml;
    		echo "<br><br>No Transaksi: ".$regi."-".date("Y")."-".$_SESSION["notrans"];
    		$_SESSION["notrans"]++;
    	}
     ?>
</body>
</html>