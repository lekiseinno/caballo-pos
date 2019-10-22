<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();



	$sql_get_cus_no		=	"
							SELECT	COUNT(Customer_code)	as	'Customer_code'
							FROM	[CBL-POS].[dbo].[customers]
							";
	$query_get_cus_no	=	sqlsrv_query($connect_pos,$sql_get_cus_no) or die( 'SQL Error = '.$sql_get_cus_no.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$row_get_cus_no		=	sqlsrv_fetch_array($query_get_cus_no);
	$cus_code			=	"CUS".sprintf("%03d",($row_get_cus_no['Customer_code']+1));
	$sql_head			=	"
							INSERT INTO	[CBL-POS].[dbo].[customers]	([Customer_code],[Customer_code_ERP],[Customer_region],[Customer_IDCard],[Customer_FName],[Customer_LName],[Customer_NickName],[Customer_Address],[Customer_Tel],[Customer_Email],[Customer_Social],[Customer_Level],[Customer_Status],[datecreate],[lastupdate])
							VALUES
							(
								'".$cus_code."',
								'CBL-030',
								'".$_POST['Customer_region']."',
								'".$_POST['Customer_IDCard']."',
								'".$_POST['Customer_FName']."',
								'".$_POST['Customer_LName']."',
								'".$_POST['Customer_NickName']."',
								'".$_POST['Customer_Address']."',
								'".$_POST['Customer_Tel']."',
								'".$_POST['Customer_Email']."',
								'WhatApp : ".$_POST['Customer_WhatApp'].",WeChat : ".$_POST['Customer_WeChat'].",Line : ".$_POST['Customer_Line']."',
								'0',
								'Active',
								GETDATE(),
								GETDATE()
							)
							";
	$query_head			=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');


?>
