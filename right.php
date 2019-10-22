<?php include_once 'fn.php'; ?>
<aside class="aside-right">
	<div class="aside-inner-right">
		<nav class="navbar nav-top-right">
			<div class="row" style="width: 100%; margin-right: 0px; margin-left: 0px;">
				<div class="col-4" style="padding-left: 0; padding-right: 0;">
					<a href="#" class="btn btn-link btn-sm">
						<i class="fas fa-trash-alt fa-2x"></i>
					</a>
				</div>
				<div class="col-4" style="padding-left: 0; padding-right: 0;">
					<button class="btn btn-link">
						<?php
						global $connect_pos;
						$sql_qty		=	"
										SELECT		SUM(Orders_detail_Qty) as 'qty'
										FROM		[Orders]
										INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
										WHERE		[Orders].[Orders_Session]	=	'".session_id()."'
										";
						$query_list		=	sqlsrv_query($connect_pos,$sql_qty) or die( 'SQL Error = '.$sql_qty.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$row_qty		=	sqlsrv_fetch_array($query_list,SQLSRV_FETCH_ASSOC);
						?>
						Cart( <?php echo $row_qty['qty'];	?> )
					</button>
				</div>
				<div class="col-4 text-right" style="padding-left: 0; padding-right: 0;">
					<a href="#" class="btn btn-link btn-sm">
						<i class="fas fa-tags fa-2x"></i>
					</a>
				</div>
			</div>
		</nav>
		<div class="panel-customer">
			<div class="input-group input-group-lg">
				<input type="text"	name="Customer_code" 		id="Customer_code" 		class="form-control customer" hidden>
				<input type="text"	name="Customer_name" 		id="Customer_name"		class="form-control customer">
				<script type="text/javascript">
					$('#Customer_code').click(function(){
						$("#dialog_cus_search").dialog({
							width: "50%",
							maxWidth: "768px"
						});
					});
					$('#Customer_name').click(function(){
						$("#dialog_cus_search").dialog({
							width: "50%",
							maxWidth: "768px"
						});
					});
				</script>
				<div class="input-group-prepend">
					<span class="input-group-text customer">
						<i class="fas fa-user-circle"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="panel-cart">
			<ul class="list-group list-group-flush">
				<?php
				global $connect_pos;
				$sql_list		=	"
									SELECT		*
									FROM		[Orders]
									INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
									INNER JOIN	[v_item\$]		ON	[v_item\$].[No_]			=	[Orders_detail].[Item_No]
									WHERE		[Orders].[Orders_Session]						=	'".session_id()."'
									";
				$query_list		=	sqlsrv_query($connect_pos,$sql_list) or die( 'SQL Error = '.$sql_list.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
				while($row_list	=	sqlsrv_fetch_array($query_list,SQLSRV_FETCH_ASSOC))
				{
					?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-1 padding-item-img">
								<!-- <img class="img-item-incart" src="http://127.0.0.1/cbl-pos/resource/images/ico/favicon.png"> -->
								<img class="card-img-top"	src="http://10.10.2.31:8081/cbl_frontstore/images/pattern/<?php echo $row['Item_Pattern_Name'] ?>/<?php echo sprintf("%04d",$row['Item_screen']) ?>.jpg">
							</div>
							<div class="col-7 padding-item-des">
								<?php
								$item_array	=	explode(' ', $row_list['Description']);
								echo $item_array[1].' '.$item_array[3]; ?> x <?php echo $row_list['Orders_detail_Qty'];
								?>
							</div>
							<div class="col-3 padding-item-price">
								<?php echo number_format(($row_list['Orders_detail_Price']*$row_list['Orders_detail_Qty']),2) ?>
							</div>
							<div class="col-1 padding-item-close">
								<a class="btn-clear" href="?order=<?php echo $row_list['Orders_No'] ?>&row=<?php echo $row_list['Orders_detail_ID'] ?>" onclick="return confirm('ยืนยันการลบ <?php echo $row_list['Orders_No'] ?> รายการที่ <?php echo $row_list['Item_No'] ?>');">
									<i class="far fa-times-circle fa-sm"></i>
								</a>
							</div>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
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
							<span class="order-subtotal-price" id="subtotal_show"></span>
							<input hidden id="subtotal">
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
									<input type="text" class="form-control discount" id="discount" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
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
							<!-- <span class="order-vat-price">92.00</span> -->
							<input id="vat">
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
							<input id="total">
						</div>
					</div>
				</li> 
			</ul>
			<div class="row row-top-2 left-2 right-2">
				<div class="col-md-4" style="padding-right: 2px;">
					<a href="#" class="btn btn-outline-danger" style="width: 100%;">
						พัก
					</a>
				</div>
				<div class="col-md-8" style="padding-left: 2px;">
					<a href="#" class="btn btn-outline-primary" style="width: 100%;" id="checkout">
						ชำระเงิน
					</a>
				</div>
			</div>
		</div>
	</div>
</aside>

<script type="text/javascript">
	$(document).ready(function(){
		/*
		$("#subtotal").keyup(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});

		$("#discount").keyup(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});
		*/
		
		$("#subtotal").change(function(){
			$('#vat').val($("#subtotal").val()*7/100);
			$('#total').val(($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()));
		});
		$("#discount").change(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});
		$('#checkout').click(function(){
			alert($('#total').val());
		});	
	});
</script>



