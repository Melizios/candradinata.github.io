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
	<!--bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
  <!--DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" />
  <!--Daterangepicker -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <style type="text/css">.header h2 {
      font-weight: lighter;
      text-align: center;
      margin: 0
    }
    .header h3 {
      font-weight: lighter;
      text-align: center;
      margin: 0
    }
    .number{
      text-align: right;
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
	<p>*klik pada nama kolom untuk mengurutkan</p>
	<div><!--Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!--Boostrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!--DataTables -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <!--DateRangePicker -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  
		<script>
	
//fungsi untuk filtering data berdasarkan tanggal 
 var start_date;
 var end_date;
 var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
    var dateStart = parseDateValue(start_date);
    var dateEnd = parseDateValue(end_date);
    //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
    //nama depan = 0
    //nama belakang = 1
    //tanggal terdaftar =2
    var evalDate= parseDateValue(aData[1]);
      if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
           ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
           ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
           ( dateStart <= evalDate && evalDate <= dateEnd ) )
      {
          return true;
      }
      return false;
});

// fungsi untuk converting format tanggal YYYY-MM-DD menjadi format tanggal javascript menggunakan zona aktubrowser
function parseDateValue(rawDate) {
    var dateArray= rawDate.split("/");
    var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11   
    return parsedDate;
}    

$( document ).ready(function() {
//konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
 var $dTable = $('#datatabel').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

 //menambahkan daterangepicker di dalam datatables
 $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range.."> </div>');

 document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

 //konfigurasi daterangepicker pada input dengan id datesearch
 $('#datesearch').daterangepicker({
    autoUpdateInput: false
  });

 //menangani proses saat apply date range
  $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
     $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
     start_date=picker.startDate.format('YYYY-MM-DD');
     end_date=picker.endDate.format('YYYY-MM-DD');
     $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
     $dTable.draw();
  });

  $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    start_date='';
    end_date='';
    $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
    $dTable.draw();
  });
});
		</script>
		<table id="datatabel" class="js-sort-table table">
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
	
</body>
</html>