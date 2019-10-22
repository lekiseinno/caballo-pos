<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();


$sql_get_doc_no		=	"
						SELECT	COUNT(Orders_No) as 'Orders_No'
						FROM	[CBL-POS].[dbo].[Orders]
						WHERE	[CBL-POS].[dbo].[Orders].[Orders_Date]	LIKE	'".date('Y-m')."%'
						";
$query_get_doc_no	=	sqlsrv_query($connect_pos,$sql_get_doc_no) or die( 'SQL Error = '.$sql_get_doc_no.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_get_doc_no		=	sqlsrv_fetch_array($query_get_doc_no);

$sql_get_session	=	"
						SELECT		TOP 1 *
						FROM		[CBL-POS].[dbo].[Orders]
						ORDER BY	Orders_ID	DESC
						";
$query_get_session	=	sqlsrv_query($connect_pos,$sql_get_session) or die( 'SQL Error = '.$sql_get_session.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_get_session	=	sqlsrv_fetch_array($query_get_session);



// Head
if($row_get_session['Orders_Session']	==	session_id())
{
	$po_number	=	"PO-POS-".date('Ym')."-".sprintf("%03d",$row_get_doc_no['Orders_No']);
	$sql_head	=	"
					UPDATE [CBL-POS].[dbo].[Orders]	SET
						[lastupdate]		=	GETDATE()
					WHERE [Orders_Session]	=	'".session_id()."'
					";
	$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
}
else
{
	$po_number	=	"PO-POS-".date('Ym')."-".sprintf("%03d",($row_get_doc_no['Orders_No']+1));
	$sql_head	=	"
					INSERT INTO [CBL-POS].[dbo].[Orders] ([Orders_No],[Customer_code],[Orders_Date],[Orders_Time],[Orders_VAT],[Orders_Discount],[Orders_Session],[Orders_Status],[datecreate],[lastupdate])
					VALUES
					(
						'".$po_number."',
						'".$_REQUEST['Customer_code']."',
						GETDATE(),
						GETDATE(),
						'7',
						'',
						'".session_id()."',
						'1',
						GETDATE(),
						GETDATE()
					)
					";
	$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
}



//print_r($_POST);


//Line
$sql_line	=	"
				INSERT INTO [dbo].[Orders_detail] ([Orders_ID],[Item_No],[Orders_detail_Qty],[Orders_detail_Remark],[Orders_detail_Sequence])
				VALUES
				(
					'".$po_number."',
					'".$_REQUEST['n_itemno']."',
					'".$_REQUEST['n_qty']."',
					'".$_REQUEST['n_remark']."',
					'Sequence is cannot to use'
				)
				";
$query_line	=	sqlsrv_query($connect_pos,$sql_line) or die( 'SQL Error = '.$sql_line.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_line	=	sqlsrv_fetch_array($query_line);



echo "success";


?>