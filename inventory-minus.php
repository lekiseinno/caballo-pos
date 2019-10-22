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
			$sum_remain	=	0;
			$sql		=	"
							SELECT	*
							FROM	[CBL-POS].[dbo].[item]
							WHERE	[CBL-POS].[dbo].[item].[Remaining Quantity]	<=	0
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$sum_remain	+=	$row['Remaining Quantity'];
				?>
				<tr>
					<td><?php echo $row['Item No_']; ?></td>
					<td><?php echo $row['Description']; ?></td>
					<td><?php echo $row['Item Category Code']; ?></td>
					<td><?php echo number_format($row['Remaining Quantity'],0); ?></td>
					<td><?php echo $row['Unit of Measure Code']; ?></td>
					<td><?php echo number_format($row['Retail Price'],2); ?></td>
					<td><?php echo number_format($row['Wholesales Price'],2); ?></td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td class="text-right" colspan="3"><b><u>Total</u></b></td>
				<td><b><?php echo $sum_remain; ?></b></td>
				<td colspan="3"><b>ตัว</b></td>
			</tr>
		</tfoot>
	</table>
</div>

<div class="modal fade" id="modalAdditem" tabindex="-1" role="dialog" aria-labelledby="modalAdditemTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<form action="process/item_add.php" method="POST">-->
				<div class="modal-header">
					<h5 class="modal-title" id="modalAdditemTitle">Add new item</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<label>Doc No.</label>
							<input class="form-control" name="doc_no" id="doc_no">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Send</button>
				</div>
			<!--</form>-->
		</div>
	</div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"order": [[ 3, "asc" ]],
			"pageLength": 12,
			buttons: [
				{
					text: 'คลังติดลบ',
					action: function ( e, dt, button, config ) {
						window.location = 'inventory-minus.php';
					}
				},
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