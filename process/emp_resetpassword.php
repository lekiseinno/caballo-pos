<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();
$sql_head			=	"
						UPDATE	[dbo].[employees]
						SET 	[emp_password]	=	'".strtoupper(md5('123456'))."'
						WHERE	[emp_code]		=	'".$_GET['emp_code']."'
						";
$query_head			=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location.href='../employee.php'</script>";
?>