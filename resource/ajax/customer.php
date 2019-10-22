<?php include_once '../../config.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>
<style type="text/css">
	body
	{
		font-size: 14px;
	}
</style>
<table class="table table-hover">
	<thead>
		<tr>
			<th align="center">รหัสลูกค้า</th>
			<th>ชื่อ-นามสกุล</th>
			<th>เบอร์โทรศัพท์</th>
			<th>Email</th>
		</tr>
	</thead>
	<?php 
		$sql_cus	=	"
							SELECT	*
							FROM	[CBL-POS].[dbo].[customers]
							where	Customer_code	LIKE	'%".$_GET['q']."%'
							";
		$query_cus		=	sqlsrv_query($connect_pos,$sql_cus) or die( 'SQL Error = '.$sql_cus.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		$i				=	1;
		while($row_cus	=	sqlsrv_fetch_array($query_cus,SQLSRV_FETCH_ASSOC))
		{
			?>
			<tr>
				<td align="center">
					<a href="#" id="btn_cus_select<?php echo $row_cus['Customer_code']?>" class="btn btn-outline-dark btn-sm">
						<?php echo $row_cus['Customer_code']?>
					</a>
					<script type="text/javascript">
						$("#btn_cus_select<?php echo $row_cus['Customer_code']?>").click(function(){
							$('#Customer_code').val('<?php echo $row_cus['Customer_code']?>');
							$('#Customer_name').val('<?php echo $row_cus['Customer_FName'] . ' ' . $row_cus['Customer_LName']?>');
							$("#dialog_cus_search").dialog('close');
							$('#Customer_code').show();
							$('#Customer_name').show();
						});
					</script>
				</td>
				<td><?php echo $row_cus['Customer_FName'] . ' ' . $row_cus['Customer_LName']?></td>
				<td><?php echo $row_cus['Customer_Tel']?></td>
				<td><?php echo $row_cus['Customer_Email']?></td>
			</tr>
			<?php
		}
	?>
</table>