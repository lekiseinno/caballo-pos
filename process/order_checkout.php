<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
$sql_head	=	"
				UPDATE [CBL-POS].[dbo].[Orders]	SET
					[Orders_Status]		=	'Success',
					[lastupdate]		=	GETDATE()
<<<<<<< HEAD
				WHERE [Orders_No]		=	'".$_GET['Orders_No']."'
				";
$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
echo "success";
?>
=======
				WHERE [Orders_No]		=	'".$_POST['Orders_No']."'
				";
$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');


$arr_item=array();
$all_item_no =implode("','",$_POST['Item_No']);
$sql = "SELECT * FROM [CBL-POS].[dbo].[item] WHERE [Item No_] IN('$all_item_no') AND [Remaining Quantity]!=0  AND Lot!=-1";
$query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

while ($row	  =	sqlsrv_fetch_array($query)) {
	$arr_item[$row['Item No_']][$row['Lot']]=$row['Remaining Quantity'].'_'.$row['Lot Name'];
}
	#echo '<pre>';
	#print_r($arr_item);
	#echo '<pre>';

	
	#print_r($_POST);
	#echo $sql_head;
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$emp_code=$_SESSION['emp_code'];
	$import=0;
	$po_no=$_POST['Orders_No'];
foreach ($_POST['Item_No'] as $key => $Item_No) {
	$qty=$_POST['qty'][$key];
	ksort($arr_item[$Item_No]);
	foreach ($arr_item[$Item_No] as $key2 => $qty_stock) {
		echo $qty_stock.'/'.$qty."\n";
		$qty_stock=explode('_',$qty_stock);
		$lot_name=$qty_stock[1];
		$qty_stock=$qty_stock[0];
		if($qty!=0){
			if($qty>=$qty_stock){
				$sql="UPDATE [CBL-POS].[dbo].[item] SET [Remaining Quantity]=0 WHERE [Item No_]='$Item_No' AND [Lot]=".$key2;
				$sql2="INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,Lot,[Lot Name]) VALUES('$Item_No','$qty_stock','$date','$time','$emp_code','$import','$po_no','$key2','$lot_name')";
				$qty=$qty-$qty_stock;
				unset($arr_item[$Item_No][$key2]);
				
			}else{
				$sql="UPDATE [CBL-POS].[dbo].[item] SET [Remaining Quantity]=[Remaining Quantity]-$qty WHERE [Item No_]='$Item_No' AND [Lot]=".$key2;		
				$sql2="INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,Lot,[Lot Name]) VALUES('$Item_No','$qty','$date','$time','$emp_code','$import','$po_no','$key2','$lot_name')";	
				$qty=0;
				

			}
			$query_cut_stock	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
			
			$query2	=	sqlsrv_query($connect_pos,$sql2) or die( 'SQL Error = '.$sql2.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
			#echo $sql;
			#echo $sql2;
		}

	}

	if($qty>0){
		$qty=$qty*(-1);
		$sql2="INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,Lot,[Lot Name]) VALUES('$Item_No','$qty','$date','$time','$emp_code','$import','$po_no','-1','over')";
		$query2	=	sqlsrv_query($connect_pos,$sql2) or die( 'SQL Error = '.$sql2.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
		#echo $sql2;
	}
	
}





?>   
>>>>>>> Last Final real real
