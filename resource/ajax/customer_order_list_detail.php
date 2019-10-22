<?php include_once '../../config.php'; ?>
<?php include_once '../../fn.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>

<div class="container-fluid">
	<div class="head-detail">
		<div class="row">
			<div class="col-md-6 text-center">
				<h2>
					<?php echo $_GET['q']; ?>
				</h2>
			</div>
			<div class="col-md-6 text-center">
				<?php
					$sql_cus	=	"
									SELECT		*
									FROM		[customers]
									WHERE		[customers].[Customer_code]	=	'".$_GET['q']."'
									";
					$query_cus	=	sqlsrv_query($connect_pos,$sql_cus) or die( 'SQL Error = '.$sql_cus.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
					$row_cus	=	sqlsrv_fetch_array($query_cus,SQLSRV_FETCH_ASSOC);
				?>
				<h2><small><?php echo $row_cus['Customer_FName'] . ' ' . $row_cus['Customer_LName']; ?></small></h2>
			</div>
		</div>
		<hr class="hrline">
	</div>
	<div class="row row-detail">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center" width="5%">#</th>
						<th width="30%">Order No</th>
						<th width="20%">Empsale</th>
						<th>Datetime</th>
						<th width="15%">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
					global $connect_pos;
					$sql_detail			=	"
											SELECT		[CBL-POS].[dbo].[Orders].[Orders_No],
														[CBL-POS].[dbo].[Orders].[emp_code],
														[CBL-POS].[dbo].[Orders].[Orders_Date],
														[CBL-POS].[dbo].[Orders].[Orders_Time],
														SUM([CBL-POS].[dbo].[Orders_detail].[Orders_detail_Price] * [CBL-POS].[dbo].[Orders_detail].[Orders_detail_Qty]) as 'Amount'
											FROM		[CBL-POS].[dbo].[customers]
											INNER JOIN	[CBL-POS].[dbo].[Orders]			ON	[CBL-POS].[dbo].[Orders].[Customer_code]	=	[CBL-POS].[dbo].[customers].[Customer_code]
											INNER JOIN	[CBL-POS].[dbo].[Orders_detail]		ON	[CBL-POS].[dbo].[Orders_detail].[Orders_No]	=	[CBL-POS].[dbo].[Orders].[Orders_No]
											WHERE		[CBL-POS].[dbo].[customers].[Customer_code]	=	'".$_GET['q']."'
											GROUP BY	[CBL-POS].[dbo].[Orders].[Orders_No],
														[CBL-POS].[dbo].[Orders].[emp_code],
														[CBL-POS].[dbo].[Orders].[Orders_Date],
														[CBL-POS].[dbo].[Orders].[Orders_Time]
											";
					$query_detail		=	sqlsrv_query($connect_pos,$sql_detail) or die( 'SQL Error = '.$sql_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
					$i					=	1;
					while($row_detail	=	sqlsrv_fetch_array($query_detail,SQLSRV_FETCH_ASSOC))
					{
						?>
						<tr>
							<td class="text-center align-middle">
								<?php echo $i; ?>
							</td>
							<td class="align-middle">
								<a class="btn btn-link" data-toggle="collapse" href="#collap_<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collap_<?php echo $i; ?>">
									<?php echo $row_detail['Orders_No']; ?>
								</a>
							</td>
							<td class="align-middle">
								<?php echo $row_detail['emp_code']; ?>
							</td>
							<td class="align-middle">
								<?php echo getdates($row_detail['Orders_Date']) .' '. gettimes($row_detail['Orders_Time']); ?>
							</td>
							<td class="align-middle">
								<?php echo $row_detail['Amount']; ?>
							</td>
						</tr>
						<tr class="table-info collapse" id="collap_<?php echo $i; ?>">
							<td></td>
							<td colspan="4">

									<div class="row">
										<div class="col-md-2">
											Item_No
										</div>
										<div class="col-md-3">
											Desc
										</div>
										<div class="col-md-2">
											Price
										</div>
										<div class="col-md-2">
											Qty
										</div>
										<div class="col-md-2">
											Remark
										</div>
									</div>
									<?php
									$sql_order_detail		=	"
																SELECT	*
																FROM	[CBL-POS].[dbo].[Orders_detail]
																WHERE	[CBL-POS].[dbo].[Orders_detail].[Orders_No]	=	'".$row_detail['Orders_No']."'
																";
									$query_order_detail		=	sqlsrv_query($connect_pos,$sql_order_detail) or die( 'SQL Error = '.$sql_order_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
									while($row_order_detail	=	sqlsrv_fetch_array($query_order_detail,SQLSRV_FETCH_ASSOC))
									{
										?>
										<div class="row">
											<div class="col-md-2">
												<?php echo $row_order_detail['Item_No']; ?>
											</div>
											<div class="col-md-3">
												<?php echo $row_order_detail['Item_No']; ?>
											</div>
											<div class="col-md-2">
												<?php echo $row_order_detail['Orders_detail_Price']; ?>
											</div>
											<div class="col-md-2">
												<?php echo $row_order_detail['Orders_detail_Qty']; ?>
											</div>
											<div class="col-md-2">
												<?php echo $row_order_detail['Orders_detail_Remark']; ?>
											</div>
										</div>
										<?php
									}
									?>
									<hr style="margin-bottom: 0; margin-top: 0;">
									<?php
									$sql_order_detail		=	"
																SELECT	SUM(Orders_detail_Qty) as 'Qty',
																		SUM(Orders_detail_Price) as 'Price'
																FROM	[CBL-POS].[dbo].[Orders_detail]
																WHERE	[CBL-POS].[dbo].[Orders_detail].[Orders_No]	=	'".$row_detail['Orders_No']."'
																";
									$query_order_detail		=	sqlsrv_query($connect_pos,$sql_order_detail) or die( 'SQL Error = '.$sql_order_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
									while($row_order_detail	=	sqlsrv_fetch_array($query_order_detail,SQLSRV_FETCH_ASSOC))
									{
										?>
										<div class="row">
											<div class="col-md-5 text-right"><b>Total</b></div>
											<div class="col-md-2">
												<?php echo $row_order_detail['Price']; ?>
											</div>
											<div class="col-md-2">
												<?php echo $row_order_detail['Qty']; ?>
											</div>
											<div class="col-md-2"></div>
										</div>
										<?php
									}
									?>
							</td>
						</tr>
						<?php
						$i++;
					}
					?>
				</tbody>
			</table>

		
			<script type="text/javascript">
				$('.panel-cart-detail').css({
					height: ($(window).height() - 47),
					'overflow-y': 'auto',
					'padding':'1%'
				});
			</script>
		</div>
	</div>
</div>








<?php include_once('../../footer.php'); ?>

