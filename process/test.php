<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">

	<link rel="stylesheet" href="datepicker/bootstrap-datepicker3.css">


	<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style type="text/css">
		.sum
		{
			font-size: 48px;
			font-weight: bolder;
		}
	</style>


	<?php
	include('_connect_srvsql.php');
	$srvsql		=	new	srvsql();
	$connect	=	$srvsql->connect();


	function getdatetime($date)
	{
		$d		=	explode(" ", $date);
		$date	=	explode("-", $d[0]);
		$time	=	explode(".", $d[1]);
		return	$date[2].'-'.$date[1].'-'.$date[0].' '.$time[0];
	}
	?>
</head>
<body>
	<?php
	/**/
	//$sale_code	=	"S01";
	if($_GET['salecode']!="")
	{
		$sale_code	=	$_GET['salecode'];	
	}
	else
	{
		$sale_code	=	'';
		echo "<script>alert('Error : not found session login');</script>";
		exit();
	}
	/**/
	?>
	<div class="container-fluid">
		<br>
		<div class="row">
            <table class="table ">
                <tr>
                    <td></td>
                    <td width="35%" style="vertical-align:middle;"><input type="text" class="form-control datepicker"></td>
                    <td width="5%" style="vertical-align:middle;">________</td>
                    <td width="35%" style="vertical-align:middle;"><input type="text" class="form-control datepicker"></td>
                    <td width="10%"><button type="submit" class="btn btn-outline-primary" style="font-weight:bold;font-size:40px;">Filter</button>
                    <td></td>
                </tr>
        </table>
		</div>
		<hr>
		<div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background-color:#007bff ;color:white;">Orders</th>
                            <th style="background-color:#28a745 ;color:white;">Price</th>
                            <th style="background-color:#17a2b8 ;color:white;">Qty [unit]</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$sql_sum	=	"
										SELECT		COUNT(*) as 'cou'
										FROM		[WEB-ERP].[dbo].[WTL_SalesHeader]
										WHERE		[WEB-ERP].[dbo].[WTL_SalesHeader].[Salesperson Code]	=	'".$sale_code."'
										";
						$query_sum	=	sqlsrv_query($connect,$sql_sum)	or die( 'SQL Error = '.$sql_sum.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
                        $row_sum	=	sqlsrv_fetch_array($query_sum,SQLSRV_FETCH_ASSOC);
                        
                        $sql_sum	=	"
										SELECT		sum(([Unit Price]*Quantity)) as 'price'
										FROM		[WEB-ERP].[dbo].[WTL_SalesHeader]
										INNER JOIN	[WEB-ERP].[dbo].[WTL_SalesLine]		ON	[WEB-ERP].[dbo].[WTL_SalesLine].[Document No_]	=	[WEB-ERP].[dbo].[WTL_SalesHeader].[No_]
										WHERE		[WEB-ERP].[dbo].[WTL_SalesHeader].[Salesperson Code]	=	'".$sale_code."'
										";
						$query_sum	=	sqlsrv_query($connect,$sql_sum)	or die( 'SQL Error = '.$sql_sum.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
                        $row_sum	=	sqlsrv_fetch_array($query_sum,SQLSRV_FETCH_ASSOC);
                        
                        $sql_sum	=	"
										SELECT		SUM(Quantity) as 'qty'
										FROM		[WEB-ERP].[dbo].[WTL_SalesHeader]
										INNER JOIN	[WEB-ERP].[dbo].[WTL_SalesLine]		ON	[WEB-ERP].[dbo].[WTL_SalesLine].[Document No_]	=	[WEB-ERP].[dbo].[WTL_SalesHeader].[No_]
										WHERE		[WEB-ERP].[dbo].[WTL_SalesHeader].[Salesperson Code]	=	'".$sale_code."'
										";
						$query_sum	=	sqlsrv_query($connect,$sql_sum)	or die( 'SQL Error = '.$sql_sum.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
						$row_sum	=	sqlsrv_fetch_array($query_sum,SQLSRV_FETCH_ASSOC);
					?>
                        <tr>
                            <td style="text-align: center;font-weight:bold;font-size:50px;"><?php echo number_format($row_sum['cou']); ?></td>
                            <td style="text-align: center;font-weight:bold;font-size:50px;"><?php echo number_format($row_sum['price'],2); ?></td>
                            <td style="text-align: center;font-weight:bold;font-size:50px;"><?php echo number_format($row_sum['qty']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
			
		</div>
		<hr>
		<div class="row">
			<div class="col-6">
				<table id="example" class="table table-striped table-bordered table-hover" style="width:100%; font-size: 13px;">
					<thead>
						<tr>
							<th width="80px">SO Number</th>
							<th>Date</th>
							<th>Customer</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql		=	"
										SELECT		*
										FROM		[WEB-ERP].[dbo].[WTL_SalesHeader]
										WHERE		[WEB-ERP].[dbo].[WTL_SalesHeader].[Salesperson Code]	=	'".$sale_code."'
										";
						$query		=	sqlsrv_query($connect,$sql)	or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<tr>
								<td>
									<a href="#" id="order_detail_<?php echo $row['No_'] ?>">
										<?php echo $row['No_'] ?>
									</a>
									<script type="text/javascript">
										$(document).ready(function(){
											$("#order_detail_<?php echo $row['No_'] ?>").click(function(){
												$.get( "order_detail.php?q=<?php echo $row['No_'] ?>", function( data ) {
													$( "#order_detail" ).html( data );
												});
											});
										});
									</script>
								</td>
								<td><?php echo getdatetime($row['Order Date']); ?></td>
								<td>
									<?php
										echo $row['Sell-to Customer No_'] . ' | ' . $row['Sell-to Customer Name'];
									?>
								</td>
								<td>
									<?php
										echo $row['Sell-to Address'] . ' ' . $row['Sell-to Address 2'] . ' ' . $row['Sell-to City'] . ' ' . $row['Sell-to Post Code'];
									?>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-6">
				<div id="order_detail"></div>
			</div>
		</div>
		<!--<hr>
		<div class="row">
			<div class="col">
				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</div>
		</div>-->
	</div>









	

	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>-->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/bootstraputtons/1.5.2/js/buttons.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>

	<!--<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>-->

	<script src="datepicker/bootstrap-datepicker.js"></script>

	<script type="text/javascript">
    	$('#example').DataTable();
		$('.datepicker').datepicker({
			format: "yyyy-mm-dd",
			language: "th",
			autoclose: true,
			todayHighlight: true
		});

		Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Report xx'
			},
			subtitle: {
				text: 'Source: Sale order online'
			},
			xAxis: {
				categories: [
				'2018'
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Rainfall (mm)'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: '1',
				data: [49.9]

			}, {
				name: '2',
				data: [83.6]

			}, {
				name: '3',
				data: [83.6]

			}, {
				name: '4',
				data: [83.6]

			}, {
				name: '5',
				data: [83.6]

			}, {
				name: '6',
				data: [83.6]

			}, {
				name: '7',
				data: [83.6]

			}, {
				name: '8',
				data: [83.6]

			}, {
				name: '9',
				data: [83.6]

			}, {
				name: '10',
				data: [83.6]

			}, {
				name: '11',
				data: [83.6]

			}, {
				name: '12',
				data: [83.6]

			}]
		});
	</script>
</body>
</html>

