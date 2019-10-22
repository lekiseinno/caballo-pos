<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();



//Line
$sql_line	=	"
				INSERT INTO [dbo].[Orders_detail] ([Orders_No],[Item_No],[Orders_detail_Price],[Orders_detail_Qty],[Orders_detail_Remark],[Orders_detail_Sequence])
				VALUES
				(
					'".$_GET['order_no']."',
					'".$_GET['itemno']."',
					'0',
					'1',
					'add this item on web',
					'Sequence is cannot to use'
				)
				";
$query_line	=	sqlsrv_query($connect_pos,$sql_line) or die( 'SQL Error = '.$sql_line.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_line	=	sqlsrv_fetch_array($query_line);



echo "success";


?>