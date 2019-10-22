<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<<<<<<< HEAD
<?php include_once 'right.php'; ?>
<?php include_once 'body-start.php'; ?>

=======
<?php /*include_once 'right.php';*/ ?>
<?php /*include_once 'body-start.php';*/ ?>
<?php include_once 'body-start-noright.php'; ?>
>>>>>>> Last Final real real

<?php

$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();

?>
<div class="order_list">
	<table class="table table-hover">
		<thead>
			<tr>
				<th style="width: 20%">No</th>
				<th>Detail</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
<<<<<<< HEAD
			$sql		=	"
								SELECT		[Orders_No],[Orders_Status]
								FROM		[CBL-POS].[dbo].[Orders]
								WHERE		[Orders_Status]		=	'Success'
=======
			$where='';
			if($_SESSION['emp_level']!=0){
				$where=" AND emp_code='".$_SESSION['emp_code']."' ";
			}
			$sql		=	"
								SELECT		[Orders_No],[Orders_Status]
								FROM		[CBL-POS].[dbo].[Orders]
								WHERE		[Orders_Status]		=	'POS from windows_App NO CUT STOCK' $where
>>>>>>> Last Final real real
								GROUP BY	[Orders_No],[Orders_Status]
								";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
				<tr>
					<td>
						<a class="btn btn-link" href="#" onclick="PopupCenter('order_list_detail.php?Orders_No=<?php echo $row['Orders_No']; ?>','CBL-POS','1240','600');  ">
							<?php echo $row['Orders_No']; ?>
						</a>
					</td>
					<td>
						<?php
<<<<<<< HEAD
						$sql_detail		=	"
											SELECT		*
											FROM		[Orders]
											INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
											INNER JOIN	[item]		ON	[item].[item No_]				=	[Orders_detail].[Item_No]
											WHERE		[Orders].[Orders_No]							=	'".$row['Orders_No']."'
=======
						
						$sql_detail		=	"
											SELECT		[Orders].*, [Orders_detail].*,(SELECT TOP 1 Description FROM [item] WHERE [item].[Item No_]=[Orders_detail].[Item_No]) AS des
											FROM		[Orders]
											INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]

											WHERE		[Orders].[Orders_No]							=	'".$row['Orders_No']." '
>>>>>>> Last Final real real
											";
						$query_detail	=	sqlsrv_query($connect_pos,$sql_detail) or die( 'SQL Error = '.$sql_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$num[$i]		=	0;
						$total[$i]		=	0;
						while($row_detail		=	sqlsrv_fetch_array($query_detail,SQLSRV_FETCH_ASSOC))
						{
							$num[$i]	+=	$row_detail['Orders_detail_Qty'];
							$total[$i]	+=	$row_detail['Orders_detail_Price'];
						}
						echo '<b>Qty: <span style="color: green">' . $num[$i] . '</span> | Total : <span style="color: green">' . $total[$i] . '</span></b> ';
						?>
					</td>
					<td>
						<?php
						if($row['Orders_Status']	==	"Success")
						{
							?>
							<span style="font-size: 18px; background-color: #007bff; color:white; padding: 5px; border-radius: 10px;"> success </span>
							<?php
						}
						?>
					</td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#order_list').css({
			height: ($(window).height() - ($(window).height()*12.5/100)),
			'overflow': 'auto'
		});
	});
</script>



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

