
<link rel="stylesheet" href="../resource/css/bootstrap.css">

<script type="text/javascript" src="../resource/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../resource/js/popper.min.js"></script>
<script type="text/javascript" src="../resource/js/bootstrap.js"></script>
<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();


if(	empty($_POST['Customer_region'])	OR
	empty($_POST['Customer_IDCard'])	OR	
	empty($_POST['Customer_FName'])		OR	
	empty($_POST['Customer_LName'])		OR	
	empty($_POST['Customer_NickName'])	OR	
	empty($_POST['Customer_Address'])	OR	
	empty($_POST['Customer_Tel'])		OR	
	empty($_POST['Customer_Email'])		OR	
	empty($_POST['Customer_WhatApp'])	OR	
	empty($_POST['Customer_WeChat'])	OR	
	empty($_POST['Customer_Line']))
{
	echo "<script>alert('กรุณากรอกข้อมูลให้ครบ');window.history.back();</script>";
}
else
{
	$sql_chk			=	"
							SELECT	COUNT(*) as 'chk'
							FROM	[CBL-POS].[dbo].[customers]
							WHERE	(
										(
											[CBL-POS].[dbo].[customers].[Customer_FName]	=	'".$_POST['Customer_FName']."'
											AND
											[CBL-POS].[dbo].[customers].[Customer_LName]	=	'".$_POST['Customer_LName']."'
										)
										OR
										(
											[CBL-POS].[dbo].[customers].[Customer_IDCard]	=	'".$_POST['Customer_IDCard']."'
										)
										OR
										(
											[CBL-POS].[dbo].[customers].[Customer_Tel]		=	'".$_POST['Customer_Tel']."'
										)
										OR
										(
											[CBL-POS].[dbo].[customers].[Customer_Email]	=	'".$_POST['Customer_Email']."'
										)

									)
							";
	$query_chk			=	sqlsrv_query($connect_pos,$sql_chk) or die( 'SQL Error = '.$sql_chk.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$row_chk			=	sqlsrv_fetch_array($query_chk);

	if($row_chk['chk']>0)
	{
		?>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alert ! <small>warning </small></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<div class="alert alert-danger" role="alert">
							พบชื่อ <b><?php echo $_POST['Customer_FName'] .' '. $_POST['Customer_LName']; ?></b>
							<br>
							หรือ IDCARD  <b><?php echo $_POST['Customer_IDCard']; ?></b>
							<br>
							หรือ Tel <b><?php echo $_POST['Customer_Tel']; ?></b>
							<br>
							หรือ Email <b><?php echo $_POST['Customer_Email']; ?></b> ในระบบแล้ว
							<br>
							ยืนยันการบันทึกข้อมูล
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<a href="#" class="btn btn-outline-primary" style="width: 45%;" id="conf" 	>Confirm</a>
								<a href="#" class="btn btn-outline-danger" style="width: 45%;" 	id="can" 	>Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#exampleModal').modal({
					backdrop: 'static',
					keyboard: false
				});
			});
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			var uri	=	'cus_add.php';
			$.ajax({
				type:	"POST",
				url:	uri,
				data:	{
					Customer_region		:	"<?php echo $_POST['Customer_region']; ?>",
					Customer_IDCard		:	"<?php echo $_POST['Customer_IDCard']; ?>",
					Customer_FName		:	"<?php echo $_POST['Customer_FName']; ?>",
					Customer_LName		:	"<?php echo $_POST['Customer_LName']; ?>",
					Customer_NickName	:	"<?php echo $_POST['Customer_NickName']; ?>",
					Customer_Address	:	"<?php echo $_POST['Customer_Address']; ?>",
					Customer_Tel		:	"<?php echo $_POST['Customer_Tel']; ?>",
					Customer_Email		:	"<?php echo $_POST['Customer_Email']; ?>",
					Customer_WhatApp	:	"<?php echo $_POST['Customer_WhatApp']; ?>",
					Customer_WeChat		:	"<?php echo $_POST['Customer_WeChat']; ?>",
					Customer_Line		:	"<?php echo $_POST['Customer_Line']; ?>"
				}
			}).done(function( msg ) {
				alert('บันทึกข้อมูลเรียบร้อย');
				window.location.href='../customer.php';
				//alert( "Data Saved: " + msg );
			}); 
		</script>
		<?php
	}
}
?>
<script type="text/javascript">
	$("#can").click(function(){
		window.history.back();
	});
</script>
<script type="text/javascript">
	$("#conf").click(function(){
		var uri	=	'cus_add.php';
		$.ajax({
			type:	"POST",
			url:	uri,
			data:	{
				Customer_region		:	"<?php echo $_POST['Customer_region']; ?>",
				Customer_IDCard		:	"<?php echo $_POST['Customer_IDCard']; ?>",
				Customer_FName		:	"<?php echo $_POST['Customer_FName']; ?>",
				Customer_LName		:	"<?php echo $_POST['Customer_LName']; ?>",
				Customer_NickName	:	"<?php echo $_POST['Customer_NickName']; ?>",
				Customer_Address	:	"<?php echo $_POST['Customer_Address']; ?>",
				Customer_Tel		:	"<?php echo $_POST['Customer_Tel']; ?>",
				Customer_Email		:	"<?php echo $_POST['Customer_Email']; ?>",
				Customer_WhatApp	:	"<?php echo $_POST['Customer_WhatApp']; ?>",
				Customer_WeChat		:	"<?php echo $_POST['Customer_WeChat']; ?>",
				Customer_Line		:	"<?php echo $_POST['Customer_Line']; ?>"
			}
		}).done(function( msg ) {
			alert('บันทึกข้อมูลเรียบร้อย');
			window.location.href='../customer.php';
		}); 
	});
</script>