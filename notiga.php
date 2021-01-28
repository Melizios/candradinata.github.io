<!DOCTYPE html>
<html>
<head>
	<title>I Kadek Candradinata</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<meta name="description" content="Bootstrap.">  
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!--Load your JQuery here!-->
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	<!-- Load your Bootstrap JS Library Here -->
	<script src="js/bootstrap.bundle.js"></script>
	<script src="js/bootstrap.js"></script>	

	<!-- Load your CSS Style Here! -->
	<style type="text/css">
		body{
			background-color: #FDEFDE;
			padding-top: 45px;
		}
		body, html{
			height: 100%;
    		margin: 0;
		}
		.bg #x1,#x2{
			padding: 1% 5% 0% 5%;
			background-color: rgba(0,0,230,0.3);
			max-width: 50%;
			border-radius: 10px
		}
		#header1,#header2{
			margin-bottom: 5px;
			color: white;
		}
		.footer{
		   position: fixed;
		   left: 0;
		   bottom: 0;
		   width: 100%;
		   color: black;
		   text-align: center;
		}
		.marker{
			top: 50px;
		}
		nav {
			display: flex;
			justify-content: center;
			
			color: black;
		}
		.navbar-default {
			background-color: #ffffcc;
			color: black;
		}

		tr:nth-child(even){
			background-color: #f2f2f2;
		}
		th, td{
			border: 1px solid #ddd;
  			padding: 8px;
		}
		th{
			background-color: ##74c489;
			position: sticky;
		}
		tr{
			background-color: #add8e6;
		}
		.show{
			display: table;
		}
		.hidden{
			display: none;
		}
		.container{
			background-color: blue;
		}
		b{
			color: white;
		}
	</style>
	<script src="sort-table.js"></script>
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
	<div class="bg">
		<div class="marker">
			<div class="container show" id="menus" data-parent=".bg">
				<div class="bg row">
					<div class="col-sm-12" id="header1">
						<header><center><h4>All data</h4></center></header>
					</div>
				</div>
				<form class="bg">
					<div class="form-group">
						<div class="col-sm-12"><center>
							<div><button id="btn-allorder" type="button">All Order</button></div></br></center>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12"><center>
							<div><button id="btn-totaljual" type="button">Total Penjualan</button></div></br></center>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12"><center>
							<div><button id="btn-palinglaris" type="button">Produk paling laris</button></div></br></center>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12"><center>
							<div><button id="btn-kuranglaris" type="button">Produk kurang laris</button></div></br></center>
						</div>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				var click = document.getElementById('btn-allorder');
				click.addEventListener('click', myfunction);

				function myfunction() {
				  var tablewrap = document.getElementById('dataorder-id');
				  tablewrap.classList.toggle('hidden');
				  tablewrap.classList.toggle('show');
				};
			</script>
			
			<div class="container hidden" id="dataorder-id" data-parent=".bg" >
				<div class="row">
					<div class="col-sm-12" id="header1">
						<header><center><h4>All data order</h4></center></header>
					</div>
				</div>
				<b>*klik pada nama kolom untuk mengurutkan</b>
				<div>
					<table id="datatabel" class="js-sort-table table bg">
						<thead>
							<tr>
								<th>Order ID</th>
								<th class="js-sort-date">Tanggal Order</th>
								<th>ID Pelanggan</th>
								<th>Region</th>
								<th>Nama Produk</th>
								<th>Sales</th>
							</tr>
						</thead>
						<tbody>
							<?php 
				              $dataorder = json_decode(file_get_contents('https://api-test.godig1tal.com/order/all_order'));
				              // print_r($response->data);
				              foreach ($dataorder->data as $value ) {
				                echo "<tr><td>". $value->order_id ."</td><td>". $value->date."</td><td>".$value->customer_name."</td><td>". $value->region."</td><td>". $value->product_name."</td><td>". $value->sales."</td></tr>";
				              }
				            ?>
				            
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- <p>*klik pada nama kolom untuk mengurutkan</p>
	<div>
		<table id="datatabel #x1" class="js-sort-table table bg">
			<thead>
				<tr>
					<th>Order ID</th>
					<th class="js-sort-date">Tanggal Order</th>
					<th>ID Pelanggan</th>
					<th>Region</th>
					<th>Nama Produk</th>
					<th>Sales</th>
				</tr>
			</thead>
			<tbody>
				<?php 
	              $dataorder = json_decode(file_get_contents('https://api-test.godig1tal.com/order/all_order'));
	              // print_r($response->data);
	              foreach ($dataorder->data as $value ) {
	                echo "<tr><td>". $value->order_id ."</td><td>". $value->date."</td><td>".$value->customer_name."</td><td>". $value->region."</td><td>". $value->product_name."</td><td>". $value->sales."</td></tr>";
	              }
	            ?>
	            
			</tbody>
		</table>
	</div> -->
	
</body>
</html>