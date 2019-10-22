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
<div class="table-responsive padding-table" style="height: 100%; overflow: auto; font-size: 12px;">
	<table class="table table-hover table-bordered" id="example">
		<thead>
			<tr>
                <th>Item No.</th> 
				<th>in/out</th>
				<th>quantity</th>
				<th>emp.</th>
				<th>date-time</th>
				<th>Order</th>
				<th>Lot</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql		=	"
							SELECT	*
							FROM	[CBL-POS].[dbo].[item_log]
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php echo $row['item_no']; ?></td>
                <td><?php if($row['import']==1){echo 'in';}else{echo 'out';} ?></td>
                <td><?php echo number_format($row['quantity'],0); ?></td>
                <td><?php echo $row['emp_code']; ?></td>
                <td><?php echo date_format(date_create($row['action_date']),"d/m/y").' '.date_format(date_create($row['action_time']) ,"H:i:s"); ?></td>
                <td><?php echo $row['po_no']; ?></td>
				<td><?php echo $row['Lot Name']; ?></td>
                </tr><?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>






<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"order": [[ 0, "desc" ]],
			"pageLength": 12,
			buttons: [
				{
					extend:		'copyHtml5',
					text:		'<i class="far fa-copy"></i> copy',
					titleAttr:	'Copy'
				},{
					extend:		'excelHtml5',
					text:		'<i class="far fa-file-excel"></i> .xlsx',
					titleAttr:	'Excel'
				},{
					extend:		'csvHtml5',
					text:		'<i class="far fa-file-alt"></i> .csv',
					titleAttr:	'CSV'
				},{
					extend:		'pdfHtml5',
					text:		'<i class="far fa-file-pdf"></i> .pdf',
					titleAttr:	'PDF'
				}
			]
		});
		table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
	} );
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