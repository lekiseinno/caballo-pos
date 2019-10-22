<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();



if($_POST['emp_password']	==	$_POST['re_emp_password'])
{
	$sql_get_emp_no		=	"
							SELECT	COUNT(emp_code) as 'emp_code'
							FROM	[CBL-POS].[dbo].[employees]
							";
	$query_get_emp_no	=	sqlsrv_query($connect_pos,$sql_get_emp_no) or die( 'SQL Error = '.$sql_get_emp_no.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$row_get_emp_no		=	sqlsrv_fetch_array($query_get_emp_no);
	$emp_code			=	"EMP".sprintf("%03d",($row_get_emp_no['emp_code']+1));
	$sql_head			=	"
							INSERT INTO [CBL-POS].[dbo].[employees] ([emp_code],[emp_username],[emp_password],[emp_name],[emp_startdate],[emp_status])
							VALUES
							(
								'".$emp_code."',
								'".$_POST['emp_username']."',
								'".md5($_POST['emp_password'])."',
								'".$_POST['emp_name']."',
								GETDATE(),
								'Active'
							)
							";
	$query_head			=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location.href='../employee.php'</script>";
}
else
{
	echo "<script>alert('รหัสผ่านไม่ตรงกัน');window.history.back();</script>";
}
	
?>