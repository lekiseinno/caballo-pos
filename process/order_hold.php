<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();


$sql_head	=	"
				UPDATE [CBL-POS].[dbo].[Orders]	SET
					[Orders_Status]		=	'Hold',
					[lastupdate]		=	GETDATE()
				WHERE [Orders_No]		=	'".$_GET['Orders_No']."'
				";
$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

echo "success";


?>