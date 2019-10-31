<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();




$sql1		=	"
				UPDATE	[dbo].[item]	SET
					[Remaining Quantity]	=	([Remaining Quantity] + ".$_GET['Quantity'].")
				WHERE	[Item No_]	=			'".$_GET['item_no']."'
				";

$query1			=	sqlsrv_query($connect_pos,$sql1) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

$date=date('Y-m-d');
$time=date('H:i:s');
$emp_code=$_SESSION['emp_code'];
$import = 2;
$sql2="INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,lot_no,pdr,[Lot Name],Lot) VALUES('".$_GET['item_no']."','".$_GET['Quantity']."','$date','$time','$emp_code','$import','','','','','')";


$query2	=	sqlsrv_query($connect_pos,$sql2) or die( 'SQL Error = '.$sql2.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');  


//echo "<script>alert('success');window.location.href='../inventory.php'</script>";


?>
