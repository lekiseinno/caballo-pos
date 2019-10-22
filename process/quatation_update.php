<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();
$quotation_no		=	$_POST['quotation_no'];

if($_POST['discount1']!=$_POST['discount1_old']){
	$sql = "UPDATE [dbo].[quotation_head] SET discount1 = ".$_POST['discount1']." , discount1_date = GETDATE() WHERE quotation_no = '$quotation_no'";
	$query		=	sqlsrv_query($connect_pos,$sql);
}
if($_POST['discount2']!=$_POST['discount2_old']){
	$sql = "UPDATE [dbo].[quotation_head] SET discount2 = ".$_POST['discount2']." , discount2_date = GETDATE() WHERE quotation_no = '$quotation_no'";
	$query		=	sqlsrv_query($connect_pos,$sql);
}
if($_POST['discount3']!=$_POST['discount3_old']){
	$sql = "UPDATE [dbo].[quotation_head] SET discount3 = ".$_POST['discount3']." , discount3_date = GETDATE() WHERE quotation_no = '$quotation_no'";
	$query		=	sqlsrv_query($connect_pos,$sql);
}


foreach ($_POST['quotation_line_id'] as $key => $quotation_line_id) {
	if($_POST['quantity'][$key]!=$_POST['quantity_old'][$key]){
		$sql = "UPDATE [dbo].[quotation_line] SET quantity = ".$_POST['quantity'][$key]."  WHERE quotation_line_id = '$quotation_line_id'";
		$query		=	sqlsrv_query($connect_pos,$sql);

	}
}


foreach ($_POST['deposit_id'] as $key => $deposit_id) {
	if($_POST['deposit_amount'][$key]!=$_POST['deposit_amount_old'][$key]){
		$sql = "UPDATE [dbo].[deposit] SET deposit_amount = ".$_POST['deposit_amount'][$key]."  WHERE deposit_id = '$deposit_id'";
		#echo $sql;
		$query		=	sqlsrv_query($connect_pos,$sql);
	}
}



		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location.href='../quotation.php';</script>";
?>
