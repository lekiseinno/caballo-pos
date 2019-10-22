<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>

<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>

<style type="text/css">
	.loader
	{
		background-color:rgba(201, 255, 222, 0.5);
		cursor: not-allowed;
		user-select: none;
		z-index: 2000;
		position: fixed;
		height: 100%;
		width: 100%;
		margin: auto;
		top: 0;
		left: 0;
	}
	.page-load
	{
		position: absolute;
		margin-left: 45%;
		padding-top: 15%;
		color: #286090;
	}

	.col-detail-left
	{
		padding-right: 2px;
	}
	.col-detail-right
	{
		padding-left: 2px;
	}
	.hrline
	{
		margin-top: 0;
		margin-bottom: 0;
	}
	#printarea
	{
		display: none;
	}
</style>



<script type="text/javascript">
	$(document).ready(function(){
		$(document).ajaxStart(function(){
			$("#load").fadeIn();
		}).ajaxStop(function(){
			$("#load").fadeOut();
		});
		$.get( "resource/ajax/order_list.php?q=<?php echo $_GET['Orders_No']; ?>", function( data ) {
			$( "#loaddata" ).html( data );
		});
	});
</script>
<div class="loader" id="load">
	<div class="page-load">
		Loading . . . 
		<hr>
		<i class="fas fa-sync-alt fa-spin fa-5x"></i>
		<hr>
		Loading . . . 
	</div>
</div>

<div id="loaddata"></div>







<div id="printarea">
    
</div>


<script type="text/javascript">
function printDiv(divName)
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>






















		<?php
		/*
		$sql_order			=	"
								SELECT		*
								FROM		[Orders]
								INNER JOIN	[Orders_detail]		ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
								WHERE		[Orders].[Orders_No]	=	'".$_GET['Orders_No']."'
								";
		$query_order		=	sqlsrv_query($connect_pos,$sql_order) or die( 'SQL Error = '.$sql_order.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		while($row_order	=	sqlsrv_fetch_array($query_order,SQLSRV_FETCH_ASSOC))
		{
			?>
			<?php
		}
		*/
		?>









<?php include_once 'footer.php'; ?>


















<script type="text/javascript">
	$(document).ready(function(){
		
		/*
		$("#subtotal").keyup(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});

		$("#discount").keyup(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});
		*/
		
		$("#subtotal").change(function(){
			$('#vat').val($("#subtotal").val()*7/100);
			$('#total').val(($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()));
		});
		$("#discount").change(function(){
			$('#vat').val( $("#subtotal").val() * 7 / 100 );
			$('#total').val( ($("#subtotal").val() - $('#discount').val()) + parseInt($('#vat').val()) );
		});
		$('#checkout').click(function(){
			alert($('#total').val());
		});	
	});
</script>