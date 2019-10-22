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
		$.get( "resource/ajax/customer_order_list_detail.php?q=<?php echo $_GET['Customer_code']; ?>", function( data ) {
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

<?php 
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<?php include_once('footer-filter.php'); ?>

<?php include_once 'footer.php'; ?>














