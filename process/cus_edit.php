<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();





$sql_head		=	"
					UPDATE [dbo].[customers]
					SET	
						[Customer_region]	=	'".$_POST['Customer_region_'.$_GET['Customer_code']]."',
						[Customer_IDCard]	=	'".$_POST['Customer_IDCard_'.$_GET['Customer_code']]."',
						[Customer_FName]	=	'".$_POST['Customer_FName_'.$_GET['Customer_code']]."',
						[Customer_LName]	=	'".$_POST['Customer_LName_'.$_GET['Customer_code']]."',
						[Customer_NickName]	=	'".$_POST['Customer_NickName_'.$_GET['Customer_code']]."',
						[Customer_Address]	=	'".$_POST['Customer_Address_'.$_GET['Customer_code']]."',
						[Customer_Tel]		=	'".$_POST['Customer_Tel_'.$_GET['Customer_code']]."',
						[Customer_Email]	=	'".$_POST['Customer_Email_'.$_GET['Customer_code']]."',
						[Customer_Social]	=	'WhatApp : ".$_POST['Customer_WhatApp_'.$_GET['Customer_code']].",WeChat : ".$_POST['Customer_WeChat_'.$_GET['Customer_code']].",Line : ".$_POST['Customer_Line_'.$_GET['Customer_code']]."',
						[lastupdate]		=	GETDATE()
					WHERE [Customer_code]	=	'".$_GET['Customer_code']."'
					";
$query_head		=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

			echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location.href='../customer.php';</script>";
?>
