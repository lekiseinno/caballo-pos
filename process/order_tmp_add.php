<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
$session_id     =   session_id();

            $arr_item   = array();
            $sql2        =   "
                            SELECT  *
                            FROM    [CBL-POS].[dbo].[Orders_tmp] WHERE emp_code='".$_SESSION['emp_code']."' AND Orders_tmp_Status='in cart' ORDER BY Orders_tmp_seq 
                            ";
            $query2     =   sqlsrv_query($connect_pos,$sql2) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
            $i          =   0;
            while($row  =   sqlsrv_fetch_array($query2,SQLSRV_FETCH_ASSOC)){
                $arr_item[] = $row['Orders_tmp_Item_No'];
            }


foreach ($_REQUEST['item_no'] as $key => $item_no) {
    if(in_array($item_no, $arr_item)){
        $qty = $_REQUEST['quantity'][$key];
        $sql    = "UPDATE [dbo].[Orders_tmp] SET [Orders_tmp_Qty] = [Orders_tmp_Qty]+$qty WHERE emp_code='".$_SESSION['emp_code']."' AND Orders_tmp_Status='in cart' AND [Orders_tmp_Item_No]= '$item_no'";    
    }else{
        $arr_item[] =   $_REQUEST['item_no'][$key]; 
        $sql    =   "
            INSERT INTO [dbo].[Orders_tmp] 
            (
                [Orders_tmp_seq]
                ,[Orders_tmp_session]
                ,[Orders_tmp_Item_No]
                ,[Orders_tmp_Descriptions]
                ,[Orders_tmp_Qty]
                ,[Orders_tmp_Price]
                ,[Orders_tmp_Status]
                ,[Orders_Date]
                ,[Orders_Time]
                ,[emp_code]
            )
            VALUES
            (
                '".($key+1)."',
                '".$session_id."',
                '".$_REQUEST['item_no'][$key]."',
                '".$_REQUEST['description'][$key]."',
                '".$_REQUEST['quantity'][$key]."',
                '0',
                'in cart',
                '".date('Y-m-d')."',
                '".date('H:i:s')."',
                '".$_SESSION['emp_code']."'
            )
            ";
    }
    $query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

}

?>

<script>
    alert('success');
    window.location.href='../order_tmp_list.php';
</script>    

