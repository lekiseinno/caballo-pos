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

<div class="table-responsive padding-table">
	<table class="table table-hover table-bordered" id="example">
		<thead>
			<tr>
				<th style="width: 20%">Code</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Menu</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql		=	"
							SELECT		*
							FROM		[CBL-POS].[dbo].[employees]
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
				<tr>
					<td>
						<a class="btn btn-link" href="#" onclick="PopupCenter('employee_detail.php?emp_code=<?php echo $row['emp_code']; ?>','CBL-POS','1240','600');  ">
							<?php echo $row['emp_code']; ?>
						</a>
					</td>
					<td><?php echo $row['emp_username']; ?></td>
					<td><?php echo $row['emp_name']; ?></td>
					<td><?php echo $row['emp_status']; ?></td>
					<td>
						<a class="btn btn-warning btn-sm" href="process/emp_resetpassword.php?emp_code=<?php echo $row['emp_code']; ?>">Reset Password</a>
						<a class="btn btn-danger btn-sm" href="#">Disable</a>
					</td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="process/emp_add.php" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Add new employee</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<label>Name</label>
							<input class="form-control" name="emp_name">
						</div>
						<div class="col-12">
							<label>Username</label>
							<input class="form-control" name="emp_username">
						</div>
						<div class="col-6">
							<label>Password</label>
							<input class="form-control" type="password" name="emp_password">
						</div>
						<div class="col-6">
							<label>Re-Password</label>
							<input class="form-control" type="password" name="re_emp_password">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>




<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"order": [[ 0, "desc" ]],
			buttons: [
				{
					text: 'Add new emp.',
					action: function ( e, dt, button, config ) {
						$('#exampleModalCenter').modal('show')
					}
				},{
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

