<?php //include_once '../config.php'; ?>
<?php //header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
$sql_head		=	"
					SELECT		*
					FROM		[Orders]
					INNER JOIN	[Orders_detail] ON [Orders_detail].[Orders_No] = [Orders].[Orders_No]
					WHERE		[Orders].[Orders_Status]	=	'POS from windows_App NO CUT STOCK'
					";
$query_head		=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
while($row_head	=	sqlsrv_fetch_array($query_head))
{
	$sql0	=	"
				UPDATE	[CBL-POS].[dbo].[item] SET
						[Remaining Quantity]	=	([Remaining Quantity]-".$row_head['Orders_detail_Qty'].")
				WHERE	[Item No_]				=	'".$row_head['Item_No']."'
				";
	$sql1	=	"
				UPDATE	[CBL-POS].[dbo].[Orders] SET
						[Orders_Status]				=	'POS from windows_App'
				WHERE	[Orders].[Orders_Status]	=	'POS from windows_App NO CUT STOCK'
				";
	$sql2	=	"
				INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,Lot,[Lot Name])
				VALUES
				(
					'".$row_head['Item_No']."',
					'".$row_head['Orders_detail_Qty']."',
					GETDATE(),
					GETDATE(),
					'".$_SESSION['emp_code']."',
					'0',
					'".$row_head['Orders_No']."',
					'0',
					'0'
				)
				";
	$query0	=	sqlsrv_query($connect_pos,$sql0) or die( 'SQL Error = '.$sql0.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$query1	=	sqlsrv_query($connect_pos,$sql1) or die( 'SQL Error = '.$sql1.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$query2	=	sqlsrv_query($connect_pos,$sql2) or die( 'SQL Error = '.$sql2.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
}

?>   