<div class="panel-alert">
	<div class="alerts">
		<div class="alert alert-primary fade show" role="alert">
			<strong>Success.</strong> add item to cart.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(".panel-alert").hide();

	function showAlert()
	{
		$(".panel-alert").fadeTo(2000, 500).slideUp(500, function(){
			$(".panel-alert").slideUp(500);
		}); 
	}
</script>


