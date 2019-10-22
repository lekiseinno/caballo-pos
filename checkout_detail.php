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


<<<<<<< HEAD

=======
>>>>>>> Last Final real real
<script type="text/javascript">
	$(document).ready(function(){
		$(document).ajaxStart(function(){
			$("#load").fadeIn();
		}).ajaxStop(function(){
			$("#load").fadeOut();
		});
		$.get( "resource/ajax/checkout_detail.php?q=<?php echo $_GET['Orders_No']; ?>", function( data ) {
			//console.log('resource/ajax/order_detail.php?q=<?php echo $_GET['Orders_No']; ?>');
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

<div class="text-center">
	<button class="btn btn-outline-primary" onclick="addnewitem('<?php echo $_GET['Orders_No']; ?>');">Add new item</button>
</div>

<script type="text/javascript">
	function addnewitem(id)
	{
		var str		=	'Add item for Order : [' + id + ']';
		var	input	=	prompt(str);

	
		if(input	!=	null)
		{
			var	uri		=	'process/order_add_inweb.php?order_no='+id+'&itemno='+input
			$.get( uri , function( input ) {
				//console.log(input);
				location.reload();
			});
		}
	}
</script>


<<<<<<< HEAD


<div id="printarea">
	
	

=======
<div id="printarea">
>>>>>>> Last Final real real
</div>

<script type="text/javascript">
	$.get( "resource/ajax/print_slip.php?q=<?php echo $_GET['Orders_No']; ?>", function( data ) {
		$( "#printarea" ).html( data );
	});
</script>


<<<<<<< HEAD

=======
>>>>>>> Last Final real real
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



<<<<<<< HEAD



























=======
>>>>>>> Last Final real real
<?php include_once 'footer.php'; ?>




<<<<<<< HEAD














=======
>>>>>>> Last Final real real
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
<<<<<<< HEAD
		
=======

>>>>>>> Last Final real real
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