<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php include_once 'body-start-noright.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>
<div style="padding-left: 15%; padding-right: 15%; margin-top: 1%;">


<!--
	<input class="form-control" name="search" placeholder="search..." value="<?php echo $_GET['search'] ?>" >
	<input type="submit" hidden />
</form>
-->



	<form action="//<?php echo $_SERVER['HTTP_HOST']; ?>/cbl-pos/inventory-import.php" method="POST">
		<div class="input-group">
		<input type="text" class="form-control" name="doc_no" placeholder="Document no." autocomplete="off"  value="<?php echo $_POST['doc_no'] ?>">
			<div class="input-group-append">
			<span class="input-group-text"><i class="fas fa-qrcode"></i></span>
		</div>
		</div>
	</form>
	<hr>
<?php
if($_POST)
{
	?>

	<table class="table table-hover table-bordered" style="font-size: 12px;">
		<thead>
			<tr>
				<th>Code</th>
				<th>Description</th>
				<th>Category</th>
				<th>Quantity</th>
				<th>Unit</th>
				<th>ปลีก</th>
				<th>ส่ง</th>
			</tr>
		</thead>
		<tbody>
			<?php

				$sql	=	"
							SELECT		[Item No_],
										[Source No_],
										[Document No_],
										[Description],
										[Location Code],
										SUM([Remaining Quantity]) as quantity,
										[Document Date],
										[Prod_ Order No_],
										[Item Category Code],
										[Lot No_],
										[Posting Date]
							FROM		[10.10.2.9].[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry]
							WHERE		[Document No_] = '".$_POST['doc_no']."'
							AND			(
										[Entry Type]	=	4
										OR
										[Entry Type]	=	6
										)
							AND			[Location Code] = 'WH-FG_02'
							GROUP BY	[Item No_],
										[Source No_],
										[Document No_],
										[Description],
										[Location Code],
										[Document Date],
										[Prod_ Order No_],
										[Item Category Code],
										[Lot No_],
										[Posting Date]
							";
							
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
				<tr>
					<td><?php echo $row['Item No_']; ?></td>
					<td><?php echo $row['Description']; ?></td>
					<td><?php echo $row['Item Category Code']; ?></td>
					<td><?php echo number_format($row['quantity'],0); ?></td>
					<td><?php echo $row['Unit of Measure Code']; ?></td>
					<td><?php echo number_format($row['Retail Price'],2); ?></td>
					<td><?php echo number_format($row['Wholesales Price'],2); ?></td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
	<hr>
	<form class="text-center" action="//<?php echo $_SERVER['HTTP_HOST']; ?>/cbl-pos/process/item_add.php" method="POST">
		<input hidden name="doc_no"  value="<?php echo $_POST['doc_no'] ?>">
		<button class="btn btn-success btn-lg" onclick="return confirm('Are you sure you want to Add all item?');">Confirm Document no = [ <?php echo $_POST['doc_no'] ?> ]</button>
	</form>
	<?php
}
?>

</div>





<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
	function PopupCenter(url, title, w, h) {
		var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
		var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;
		var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
		var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		var top = ((height / 2) - (h / 2)) + dualScreenTop;
		var newWindow = window.open(url, title, 'scrollbars=yes,resizable=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
		if (window.focus) {
			newWindow.focus();
		}
	}
</script>
<?php include_once 'body-end.php'; ?>
<?php include_once 'footer.php'; ?>