<?php include_once '../../config.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>

<div class="container-fluid">
	<div class="head-detail">
		<div class="row">
			<div class="col-md-4 text-center">
				<h2><?php echo $_GET['q']; ?></h2>
			</div>
			<div class="col-md-4 text-center">
				<?php
					$sql_cus	=	"
									SELECT		*
									FROM		[Orders]
									INNER JOIN	[customers]	ON [customers].[Customer_code]	=	[Orders].[Customer_code]
									WHERE		[Orders].[Orders_No]	=	'".$_GET['q']."'
									";
					$query_cus	=	sqlsrv_query($connect_pos,$sql_cus) or die( 'SQL Error = '.$sql_cus.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
					$row_cus	=	sqlsrv_fetch_array($query_cus,SQLSRV_FETCH_ASSOC);
				?>
				<h2><small><?php echo $row_cus['emp_code']; ?></small></h2>
			</div>
			<div class="col-md-4 text-center">
				<h2><small><?php echo $row_cus['Customer_FName'] . ' ' . $row_cus['Customer_LName']; ?></small></h2>
			</div>
		</div>
		<hr class="hrline">
	</div>
	<div class="row row-detail">
		<div class="col-md-12">
			
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th class="text-center" width="5%">#</th>
						<th width="20%">Img</th>
						<th>Des</th>
						<th width="8%">Qty</th>
						<th width="10%">Price</th>
					</tr>
				</thead>
				<tbody>
					<?php
					global $connect_pos;
					$sql_detail			=	"SELECT		[Orders].*, [Orders_detail].*,(SELECT TOP 1 Description FROM [item] WHERE [item].[Item No_]=[Orders_detail].[Item_No]) AS Description
												FROM		 [Orders]
											INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
											WHERE		[Orders].[Orders_No]							=	'".$_GET['q']."'
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
							<td class="text-center align-middle">
								<img class="card-img-top"	src="http://10.10.2.31:8081/CBL-POS/images/pattern/<?php echo $row_detail['Item Category Code'] ?>/<?php echo $row_detail['Item Category Code'].'-'.sprintf("%04d",$row_detail['item_screen']) ?>.jpg">
							</td>
							<td class="align-middle">
								<?php
								$item_array	=	explode(' ', $row_detail['Description']);
								echo $item_array[1].' '.$item_array[3];
								?>
							</td>
							<td class="align-middle">
								<input class="form-control form-control-sm text-center" name="qty[]" value="<?php echo $row_detail['Orders_detail_Qty'] ?>" onkeyup="$('#subtotal_show').val(gettotle());">
							</td>
							<td class="align-middle">
								<input class="form-control form-control-sm" name="price[]" value="<?php echo ($row_detail['Orders_detail_Price']*$row_detail['Orders_detail_Qty']); ?>" onkeyup="$('#subtotal_show').val(gettotle());">
							</td>
						</tr>
						<?php
						$i++;
					}
					?>
				</tbody>
			</table>

		<!--
			<div class="panel-cart-detail">
				<ul class="list-group list-group-flush">
					<?php
					global $connect_pos;
					$sql_detail			=	"
											SELECT		*
											FROM		[Orders]
											INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
											INNER JOIN	[item\$]		ON	[item\$].[No_]				=	[Orders_detail].[Item_No]
											WHERE		[Orders].[Orders_No]							=	'".$_GET['q']."'
											";
					$query_detail		=	sqlsrv_query($connect_pos,$sql_detail) or die( 'SQL Error = '.$sql_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
					$i					=	1;
					while($row_detail	=	sqlsrv_fetch_array($query_detail,SQLSRV_FETCH_ASSOC))
					{
						?>

						<li class="list-group-item">
							<div class="row">
								<div class="col-3 padding-item-img" style="border: 1px solid red;">
									<div class="row">
										<div class="col-2 text-center" style="border: 1px solid blue; padding: 0;">
											<?php echo $i; ?>
										</div>
										<div class="col-10" style="border: 1px solid blue; padding: 0;">
											<img class="card-img-top"	src="http://10.10.2.31:8081/CBL-POS/images/pattern/<?php echo $row_detail['Item Category Code'] ?>/<?php echo $row_detail['Item Category Code'].'-'.sprintf("%04d",$row_detail['item_screen']) ?>.jpg">
										</div>
									</div>
								</div>
								<div class="col-5 padding-item-des" style="border: 1px solid red;">
									<?php
									$item_array	=	explode(' ', $row_detail['Description']);
									echo $item_array[1].' '.$item_array[3];
									?>
								</div>
								<div class="col-1" style="border: 1px solid red;">
									<input class="form-control form-control-sm" name="qty[]" value="<?php echo $row_detail['Orders_detail_Qty'] ?>">
								</div>
								<div class="col-2" style="border: 1px solid red;">
									<input class="form-control form-control-sm" name="checkout[]" value="<?php echo ($row_detail['Orders_detail_Price']*$row_detail['Orders_detail_Qty']); ?>">
								</div>
								<div class="col-1 padding-item-close" style="border: 1px solid red;">
									<a class="btn-clear" href="?order=<?php echo $row_detail['Orders_No'] ?>&row=<?php echo $row_detail['Orders_detail_ID'] ?>" onclick="return confirm('ยืนยันการลบ <?php echo $row_detail['Orders_No'] ?> รายการที่ <?php echo $i; ?>');">
										<i class="far fa-times-circle fa-sm"></i>
									</a>
								</div>
							</div>
						</li>
						<?php
						$i++;
					}
					?>
				</ul>
			</div>
		-->
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
<script type="text/javascript">

	$(document).ready(function(){
		$("#subtotal_show").val(gettotle());
	});

	$("#checkout").click(function(){
		printDiv('printarea'); 
	});

	//var qty = $('input[name="qty[]"]').val();



	function gettotle()
	{
		var qty 	=	0;
		var totle 	=	0;
		var iqty 	= document.getElementsByName('qty[]');
		var iprice 	= document.getElementsByName('price[]');
		for (var i = 0; i <iqty.length; i++) {
			var qtys	=	iqty[i];
			var prices	=	iprice[i];
			var suminline	=	parseInt(iqty[i].value) * parseInt(iprice[i].value);
			totle =	  totle + suminline;
		}
		return totle;
	}



	function getqtyall()
	{

		var qty 	=	0;
		var inps = document.getElementsByName('qty[]');
		for (var i = 0; i <inps.length; i++) {
			var inp=inps[i];
			qty =	 qty + parseInt(inp.value);
		}	
		return qty;
	}



	

	function getfinal()
	{
		var totle	=	gettotle();
		var discount	=	$('#discount').val();
		var	vat			=	$('#vat').val();


		var data	=	totle - discount +(totle*vat/100);
		$('#total').val(data);

	}


</script>