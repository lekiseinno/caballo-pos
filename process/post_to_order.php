<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();

$cusCustomer_code=$_POST['cusCustomer_code'];


$sql_get_doc_no		=	"
						SELECT	COUNT(Orders_No) as 'Orders_No'
						FROM	[CBL-POS].[dbo].[Orders]
						WHERE	[CBL-POS].[dbo].[Orders].[Orders_Date]	LIKE	'".date('Y-m')."%'
						";
$query_get_doc_no	=	sqlsrv_query($connect_pos,$sql_get_doc_no) or die( 'SQL Error = '.$sql_get_doc_no.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_get_doc_no		=	sqlsrv_fetch_array($query_get_doc_no);

$sql_get_session	=	"
						SELECT		TOP 1 *
						FROM		[CBL-POS].[dbo].[Orders_tmp] WHERE emp_code = '".$_SESSION['emp_code']."' AND  Orders_tmp_Status = 'in cart';
						";
$query_get_session	=	sqlsrv_query($connect_pos,$sql_get_session) or die( 'SQL Error = '.$sql_get_session.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$row_get_session	=	sqlsrv_fetch_array($query_get_session);



// Head

	$po_number	=	"PO-POS-".date('Ym')."-".sprintf("%03d",($row_get_doc_no['Orders_No']+1));
	$sql_head	=	"
					INSERT INTO [CBL-POS].[dbo].[Orders] ([Orders_No],[Customer_code],[Orders_Date],[Orders_Time],[Orders_VAT],[Orders_Discount],[Orders_Session],[Orders_Status],[datecreate],[lastupdate],[emp_code])
					VALUES
					(
						'".$po_number."',
						'$cusCustomer_code',
						GETDATE(),
						GETDATE(),
						'7',
						'0',
						'".$row_get_session['Orders_tmp_session']."',
						'New',
						GETDATE(),
                        GETDATE(),
                        '".$_SESSION['emp_code']."'
					)
					";
	$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');



//Line
$sql	=	"
						SELECT	     *
						FROM		[CBL-POS].[dbo].[Orders_tmp] WHERE emp_code = '".$_SESSION['emp_code']."' AND  Orders_tmp_Status = 'in cart' ORDER BY Orders_tmp_ID;
						";
$query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$count  =   1;
while ($row	  =	sqlsrv_fetch_array($query)) {
    $sql_line	=	"
    INSERT INTO [dbo].[Orders_detail] ([Orders_No],[Item_No],[Orders_detail_Qty],[Orders_detail_Remark],[Orders_detail_Sequence],[Orders_detail_Price])
    VALUES
    (
        '".$po_number."',
        '".$row['Orders_tmp_Item_No']."',
        '".$row['Orders_tmp_Qty']."',
        '',
        '".$count."',
        '0'
    )
    ";
$query_line	=	sqlsrv_query($connect_pos,$sql_line) or die( 'SQL Error = '.$sql_line.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
$count++;
} 

$sql_update	=	"
						UPDATE	[CBL-POS].[dbo].[Orders_tmp] SET Orders_tmp_Status = 'Post to order' WHERE emp_code = '".$_SESSION['emp_code']."' AND  Orders_tmp_Status = 'in cart' AND Orders_tmp_session = '".$row_get_session['Orders_tmp_session']."'
						";
$query_update	=	sqlsrv_query($connect_pos,$sql_update) or die( 'SQL Error = '.$sql_update.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
   


echo "<script>alert('success');window.location.href='../order_tmp_list.php'</script>";


?>