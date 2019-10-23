<?php include_once '../../config.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>

<div class="container-fluid">
	<div class="head-detail">
		<div class="row">
			<div class="col-md-6 text-center">
				<h2><?php echo $_GET['q']; ?></h2>
			</div>
			<div class="col-md-6 text-center">
				<?php
					$sql_cus	=	"
									SELECT		*
									FROM		[Orders]
									INNER JOIN	[customers]	ON	[customers].[Customer_code]	=	[Orders].[Customer_code]
									WHERE		[Orders].[Orders_No]	=	'".$_GET['q']."'
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
		<div class="col-md-9">
			<form action="" id="form-order-detail" method="post">
			<input type="hidden" name="Orders_No" value="<?php echo $_GET['q'] ?>">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center" width="5%">#</th>
							<th width="20%">Img</th>
							<th>Des</th>
							<th width="8%">Qty</th>
							<th width="10%">Price</th>
							<th width="5%">Menu</th>
						</tr>
					</thead>
					<tbody>
						<?php
						global $connect_pos;
						$sql_detail			=	"
												SELECT		[Orders].*, [Orders_detail].*,(SELECT TOP 1 Description FROM [item] WHERE [item].[Item No_]=[Orders_detail].[Item_No]) AS des,(SELECT TOP 1 [Item Category Code]	FROM [item] WHERE [item].[Item No_]=[Orders_detail].[Item_No]) AS 'Item Category Code'
												FROM		[Orders]
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
								<input type="hidden" name='Item_No[]' value="<?php echo $row_detail['Item_No'] ?>">
									<?php echo $i; ?>
								</td>
								<td class="text-center align-middle">
									<img class="card-img-top"	src="http://10.10.2.31:8081/CBL-POS/images/pattern/<?php echo $row_detail['Item Category Code'] ?>/<?php echo $row_detail['Item Category Code'].'-'.sprintf("%04d",$row_detail['item_screen']) ?>.jpg">
								</td>
								<td class="align-middle">
									<?php
									//$item_array	=	explode(' ', $row_detail['des']);
									//echo $item_array[1].' '.$item_array[3];
									echo $row_detail['des'];
									?>
								</td>
								<td class="align-middle">
									<input class="form-control form-control-sm text-center" name="qty[]" value="<?php echo $row_detail['Orders_detail_Qty'] ?>" onkeyup="$('#subtotal_show').val(gettotle());">
								</td>
								<td class="align-middle">
									<input class="form-control form-control-sm" name="price[]" value="<?php echo ($row_detail['Orders_detail_Price']*$row_detail['Orders_detail_Qty']); ?>" onkeyup="$('#subtotal_show').val(gettotle());">
								</td>
								<td class="align-middle text-right">
									<a class="btn-clear" href="?order=<?php echo $row_detail['Orders_No'] ?>&row=<?php echo $row_detail['Orders_detail_ID'] ?>" onclick="return confirm('ยืนยันการลบ <?php echo $row_detail['Orders_No'] ?> รายการที่ <?php echo $i; ?>');">
										<i class="far fa-times-circle fa-sm"></i>
									</a>
								</td>

							</tr>
							<?php
							$i++;
						}
						?>
					</tbody>
				</table>	
			</form>

			<script type="text/javascript">
				$('.panel-cart-detail').css({
					height: ($(window).height() - 47),
					'overflow-y': 'auto',
					'padding':'1%'
				});
			</script>
		</div>
		<div class="col-md-3 col-detail-right">
			<div class="aside-inner-right">
				<div class="panel-money">
					<div class="row">
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad7" tabindex="-1">7</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad8" tabindex="-1">8</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad9" tabindex="-1">9</button>
						</div>
					</div>
					<div class="row rownumpad">
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad4" tabindex="-1">4</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad5" tabindex="-1">5</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad6" tabindex="-1">6</button>
						</div>
					</div>
					<div class="row rownumpad">
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad1" tabindex="-1">1</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad2" tabindex="-1">2</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad3" tabindex="-1">3</button>
						</div>
					</div>
					<div class="row rownumpad">
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpad0" tabindex="-1">0</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100"	id="numpaddot" tabindex="-1">.</button>
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4">
							<button class="btn btn-outline-secondary btn-lg btn-100" id="del" tabindex="-1">Del</button>
						</div>
					</div>
				</div>
				<div class="panel-checkout">
					<ul class="list-group list-group-flush">
						<li class="list-group-item panel-order-cash">
							<div class="row">
								<div class="col-6 panel-ckeckout-left">
									<span class="order-subtotal-text">รวม</span>
								</div>
								<div class="col-6 panel-ckeckout-right">
									<!-- <span class="order-subtotal-price">92.00</span> -->
									<div class="panel-customer">
										<div class="input-group input-group-sm">
											<input type="text" class="subtotal form-control " id="subtotal_show" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item panel-order-cash">
							<div class="row">
								<div class="col-6 panel-ckeckout-left">
									<span class="order-discount-text">ส่วนลด</span>
								</div>
								<div class="col-6 panel-ckeckout-right">
									<div class="panel-customer">
										<div class="input-group input-group-sm">
											<input type="text" class="discount form-control " id="discount" onkeypress="return ((event.charCode >= 46 && event.charCode <= 57) && getdiscount());">
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item panel-order-cash">
							<div class="row">
								<div class="col-6 panel-ckeckout-left">
									<span class="order-vat-text">VAT</span>
								</div>
								<div class="col-6 panel-ckeckout-right">
									<div class="panel-customer">
										<div class="input-group input-group-sm">
											<input type="text" class="vat form-control " id="vat" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item panel-order-cash">
							<div class="row">
								<div class="col-6 panel-ckeckout-left">
									<span class="order-total-text">รวมทั้งสิ้น</span>
								</div>
								<div class="col-6 panel-ckeckout-right">
									<!-- <span class="order-total-price" id="total"></span> -->
									<div class="panel-customer">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control total" id="total" onfocus="getfinal();">
										</div>
									</div>
								</div>
							</div>
						</li> 
					</ul>
					<div class="row row-top-2 left-2 right-2">
						<div class="col-md-4" style="padding-right: 2px;">
							<a href="process/order_hold.php?Orders_No=<?php echo $_GET['q']; ?>" class="btn btn-outline-danger btn-lg" style="width: 100%;">
								พัก
							</a>
						</div>
						<div class="col-md-8" style="padding-left: 2px;">
							<a class="btn btn-outline-primary btn-lg" style="width: 100%;" href="#" id="checkout">
								ชำระเงิน
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">

	$(document).ready(function(){
		$("#subtotal_show").val(gettotle());
	});
	$("#checkout").click(function(){

		$.ajax({
				url: 'process/check_stock.php',
				type: 'POST',
				dataType: 'TEXT',
				async: false,
				data: $("#form-order-detail").serialize()
			}).done(function(data) {
				if(confirm(data)){
					$.ajax({
						url: 'process/order_checkout.php',
						type: 'POST',
						dataType: 'TEXT',
						async: false,
						data: $("#form-order-detail").serialize()
					}).done(function(data) {
						alert(data);
						printDiv('printarea'); 
						//alert('ดำเนินการสำเร็จ');
						window.close();
					}); 			
				}
			}); 
		
		
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