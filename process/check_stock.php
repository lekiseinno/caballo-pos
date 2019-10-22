
<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();

$arr_qty     = $_POST['qty'];
$arr_item_no = implode("','",$_POST['Item_No']);
$sql	=	" SELECT SUM([Remaining Quantity]) AS sum_qty ,Description,[Item No_]
                FROM [CBL-POS].[dbo].[item] WHERE [Item No_] IN('$arr_item_no') AND Lot!=-1 GROUP BY Description,[Item No_]";
$query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');


#echo $sql;
$txt='';
while ($row	  =	sqlsrv_fetch_array($query)) {
    $key = array_search($row['Item No_'],$_POST['Item_No']);
    //echo $key;
	if($_POST['qty'][$key]>$row['sum_qty']){
        $item_array	=	explode(' ', $row['Description']);
        $txt.= $item_array[1].' '.$item_array[3]." \n ";
       
    }
}

if($txt!=''){
    $txt.='จำนวนต้องการมากกว่าใน stock ยืนยันเพื่อดำเนินการ';
}else{
    $txt.='ยืนยันเพื่อดำเนินการ';
}

echo $txt;
?>