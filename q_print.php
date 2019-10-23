<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="window.print();">

<?php 
 	include_once 'config.php'; 

 	date_default_timezone_set('asia/bangkok');
 	$srvsql				=	new	srvsql();
	$connect_pos		=	$srvsql->connect_pos();
	$quotation_no=$_GET['quotation_no'];
	$sql="SELECT	* FROM	[CBL-POS].[dbo].[quotation_head] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$row1=sqlsrv_fetch_array($query);



 ?>
<h1 align="center">CABALLO SHOP / ร้านคาบาลโล</h1>
<h4 align="center">INVOICE / ใบแจ้งหนี้</h4>
<table cellpadding="5" cellspacing="0" align="center" width="70%" border="0">
	<tr>
 		<th width="15%" align="left"></a>No : </th>
 		<td  align="left" width="50%"><?php echo $quotation_no ?></td>
 		<td>โทร.</td>
 		<td> 02-6562510</td>
 	</tr>
 	<tr>
 		<th align="left">Name : </th>
 		<td><?php echo $row1['quotation_name'] ?></td>
 		<td>DATE</td>
 		<td><?php echo date('d/m/Y') ?></td>
 	</tr>
</table>
 <table border="1" cellpadding="5" cellspacing="0" align="center" width="70%">
 	<tr>
 		<th>QUANTITY</th>
 		<th>DESCRIPTION</th>
 		<th>UNIT PRICE</th>
 		<th>AMOUNT</th>
 	</tr>
<?php 

	$sql="SELECT	* FROM	[CBL-POS].[dbo].[quotation_line] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$sum_quantity=0;
	$sum_price=0;
	while ($row=sqlsrv_fetch_array($query)) { 
		$price=$row['quantity']*$row['unit_price'];
		$sum_quantity=$sum_quantity+$row['quantity'];
		$sum_price=$sum_price+$price;
?>
	<tr>
		<td align="right"><?php echo $row['quantity'] ?></td>
		<td align="right"><?php echo $row['item_name'] ?></td>
		<td align="right"><?php echo number_format($row['unit_price'],2) ?></td>
		<td align="right"><?php echo number_format($price,2) ?></td>
	</tr>
<?php 
	}	
	$sum_deposit=0;
	$sum_deposit=$row1['discount1']+$row1['discount2']+$row1['discount3'];
?>
	<tr>
		<td align="right" style="color: red"><?php echo $sum_quantity ?></td>
		<td></td>
		<td></td>
		<td align="right" ><?php echo number_format($sum_price,2) ?></td>
	</tr>

	<tr>
		<td align="right" colspan="3">DISCOUNT1 <?php echo $row1['discount1_date']; ?></td>
		<td align="right" ><?php echo number_format($row1['discount1'],2) ?></td>
	</tr>
	<tr>
		<td align="right" colspan="3">DISCOUNT2 <?php echo $row1['discount2_date']; ?></td>
		<td align="right" ><?php echo number_format($row1['discount2'],2) ?></td>
	</tr>
	<tr>
		<td align="right" colspan="3">DISCOUNT3 <?php echo $row1['discount3_date']; ?></td>
		<td align="right" ><?php echo number_format($row1['discount3'],2) ?></td>
	</tr>

<?php 

	$sql="SELECT	* FROM	[CBL-POS].[dbo].[deposit] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	
	while ($row=sqlsrv_fetch_array($query)) { 
		$sum_deposit=$sum_deposit+$row['deposit_amount'];

?>
	<tr>
		<td align="right" colspan="3">DEPOSIT <?php echo date_format(date_create($row['deposit_date']),'Y-m-d') ?></td>
		<td align="right" ><?php echo number_format($row['deposit_amount'],2) ?></td>
	</tr>
<?php }	?>
	<tr>
		<td align="right" colspan="3"></td>
		<td align="right" ><?php echo number_format($sum_deposit,2) ?></td>
	</tr>
	<tr>
		<td align="right" colspan="3"></td>
		<td align="right" style="border-bottom: 10px double black"><?php echo number_format($sum_price-$sum_deposit,2) ?></td>
	</tr>
 </table>
</body>
</html>