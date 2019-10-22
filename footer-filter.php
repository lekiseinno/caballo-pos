<footer class="footer-filter">
	<div class="container-fluid">
		<?php
		if(!empty($_GET['Customer_code']))
		{
			$n	=	'Customer_code';
			$v	=	$_GET['Customer_code'];
		}
		else
		if(!empty($_GET['emp_code']))
		{
			$n	=	'emp_code';
			$v	=	$_GET['emp_code'];
		}
		?>
		<form action="<?php echo $url; ?>"  method="GET">
			<input hidden name="<?php echo $n; ?>" value="<?php echo $v; ?>">
			<div class="row">
				<div class="col"></div>
				<div class="col-3">
					<input class="form-control form-control-sm datepicker" name="datestart" value="<?php echo date('Y-m-d'); ?>">
				</div>
				<div class="col-3">
					<input class="form-control form-control-sm datepicker" name="dateend" value="<?php echo date('Y-m-d'); ?>">
				</div>
				<div class="col-1">
					<button class="btn btn-light btn-sm" type="submit">
						<i class="fas fa-search"></i> Filter
					</button>
				</div>
				<div class="col"></div>
			</div>
		</form>
	</div>
</footer> 