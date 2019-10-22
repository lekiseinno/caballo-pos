<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php /*include_once 'right.php';*/ ?>
<?php /*include_once 'body-start.php';*/ ?>
<?php include_once 'body-start-noright.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>
<div class="table-responsive padding-table" style="height: 100%; overflow: auto; font-size: 12px;">
	<table class="table table-hover table-bordered" id="example">
		<thead>
			<tr>
                <th>#</th>
				<th>Code</th>
				<th>Description</th>
				<th>Quantity</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql		=	"
							SELECT	*
							FROM	[CBL-POS].[dbo].[Orders_tmp] WHERE emp_code='".$_SESSION['emp_code']."' AND Orders_tmp_Status='in cart' ORDER BY Orders_tmp_seq 
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php echo $i+1; ?></td>
                    <td><?php echo $row['Orders_tmp_Item_No']; ?></td>
                    <td><?php echo $row['Orders_tmp_Descriptions']; ?></td>
                    <td><?php echo $row['Orders_tmp_Qty']; ?>
                    <td align="center"><i class='fas fa-trash-alt' onClick=order_tmp_del(<?php echo $row['Orders_tmp_ID'] ?>) style="cursor:pointer"></i></td>
                </tr>
            <?php
				$i++;
			}
			?>
		</tbody>
	</table>
    <div align="center">
		<form action="process/post_to_order.php" method="POST" class="form-group">
	
			<?php 
				$sql	=	"
						SELECT	     *
						FROM		[CBL-POS].[dbo].[customers] 
						";
				$query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
				
	?>
			<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
			
			<select name="cusCustomer_code" class='select-two'>
			<script>
				$(document).ready(function() {
					$('.select-two').select2();
				});
			</script>
	<?php
		while ($row	  =	sqlsrv_fetch_array($query)) {
	?>
				<option value="<?php echo $row['Customer_code'] ?>"><?php echo $row['Customer_code'].' : '.$row['Customer_FName'].' '.$row['Customer_LName'].' ('.$row['Customer_Tel'].')';  ?></option>
	<?php } ?>
			</select>
				<button type="submit" class="btn btn-success btn-lg" data-dismiss="modal">Post to order</button>
		
		</form>
	</div>
</div>



<form action="process/order_tmp_add.php" method='POST'>
	<div class="modal fade" id="modalAddorder" tabindex="-1" role="dialog" aria-labelledby="modalAddorderTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document" style="min-width:50%">
			<div class="modal-content">
				<form action="process/item_add.php" method="POST">
					<div class="modal-header">
						<h5 class="modal-title" id="modalAddorderTitle">Add new order <button type="button" class="btn btn-primary" onClick="row_add_item(row_count.value)">add item.</button></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width='30%'>Item No</th>
									<th width='52%'>Description</th>
									<th width='16%'>Quantity</th>
								</tr>
							</thead>
							<tbody>
								<tr class='row_item0'>
									<td><input class="form-control item_no0" name="item_no[]" onblur='item_description(this.value,0)'></td>
									<td><input class="form-control description0" name="description[]" readonly></td>
									<td>
										<input class="form-control quantity0" name="quantity[]">
										
									</td>
									<td><i class='fas fa-trash-alt' onClick='del_row_item(0)'></i></td>
									
								</tr>
								<tr class='tr-bottom' style="display:none">
									<td colspan=3></td>
								</tr>
							</tbody>
							<input type="hidden" id="row_count" value='0'>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</form>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable({
			"order": [[ 0, "desc" ]],
			"pageLength": 12,
			buttons: [
				{
					text: 'Add new item.',
					action: function ( e, dt, button, config ) {
						$('#modalAddorder').modal('show')
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





    function row_add_item(row){
		row=parseInt(row)+1;
		$('#row_count').val(row);
		$("<tr class='row_item"+row+"'><td><input class='form-control item_no"+row+"' name='item_no[]'  onblur='item_description(this.value,"+row+")'></td><td><input readonly class='form-control description"+row+"' name='description[]' ></td><td><input class='form-control quantity"+row+"' name='quantity[]'></td><td><i class='fas fa-trash-alt' onClick='del_row_item("+row+")'></i></td></tr>").insertBefore(".tr-bottom");
	}

	function del_row_item(row){
		$('.row_item'+row).remove();
	}

	function item_description(item_no,row){
		var uri	=	'resource/ajax/item_description.php';
		$.get(uri,{item_no:item_no}, function( data ){
			if(data==0){
				//alert('No this item');
				$('.item_no'+row).val('');
				//$('.item_no'+row).focus();
				$('.description'+row).val('No this item');
			}else{
				$('.description'+row).val(data);
			}
			
		});
	}


    function order_tmp_del(Orders_tmp_ID){
        var uri	=	'process/order_tmp_cancel.php';
		$.get(uri,{Orders_tmp_ID:Orders_tmp_ID}, function( data ){
			if(data==1){
                location.reload();
			}else{
				alert('cancel false!!')
			}
			
		});
    }
</script>
<?php include_once 'body-end.php'; ?>
<?php include_once 'footer.php'; ?>