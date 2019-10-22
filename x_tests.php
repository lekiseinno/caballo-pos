<?php include_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="resource/css/bootstrap.css">
	<link rel="stylesheet" href="resource/css/bootstrap-datepicker3.standalone.css">
	<link rel="stylesheet" href="resource/css/fontawesome.all.css">
	<link rel="stylesheet" href="resource/css/select2.css">
	<link rel="stylesheet" href="resource/css/datatable/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="resource/css/datatable/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="resource/css/addon.css">
	<link rel="stylesheet" href="resource/jqueryui/jquery-ui.min.css">

	<link rel="icon" type="image/png" href="resource/images/ico/favicon.png" />

	<title><?php echo $title; ?></title>

	
	<script src="resource/js/jquery-3.3.1.min.js"></script>

</head>
<body>



<input type="text" class="form-control datepicker">








	
	<?php include_once 'config.php'; ?>


	<script src="resource/js/popper.min.js"></script>
	<script src="resource/js/bootstrap.js"></script>
	<script src="resource/js/bootstrap-datepicker.js"></script>
	<script src="resource/js/fontawesome.all.js"></script>
	<script src="resource/js/select2.js"></script>
	<script src="resource/js/datatable/jquery.dataTables.min.js"></script>
	<script src="resource/js/datatable/dataTables.bootstrap4.min.js"></script>
	<script src="resource/js/datatable/dataTables.buttons.min.js"></script>
	<script src="resource/js/datatable/buttons.bootstrap4.min.js"></script>
	<script src="resource/js/datatable/jszip.min.js"></script>
	<script src="resource/js/datatable/pdfmake.min.js"></script>
	<script src="resource/js/datatable/vfs_fonts.js"></script>
	<script src="resource/js/datatable/buttons.html5.min.js"></script>
	<script src="resource/js/datatable/buttons.print.min.js"></script>
	<script src="resource/js/datatable/buttons.colVis.min.js"></script>
	<script src="resource/js/addon.js"></script>




	<script type="text/javascript">
		$(document).ready(function(){
			/* Onclick at main.php only */
			$("#keyboard-numpad").hide();
			$("#callnumpad").click(function(){$("#dialog").dialog({width: 280});});
			valid = '';
			//$('input:text').click(function(){valid= '#'+this.id;$("#dialog").dialog();});
			$('.numbers').click(function(){valid= '#'+this.id;});
			$('.btn-numspad').click(function(){$(valid).focus();if(!isNaN($(':focus').val())){if(parseInt($(':focus').val())==0){$(':focus').val($(this).text());}else{$(':focus').val($(':focus').val()+$(this).text());}}});
			$('#del').click(function(){$(valid).val($(valid).val().substring(0,$(valid).val().length-4));});
			$('#info-detail-server').css({height: ($(window).height()-($(window).height()*40/100)),'overflow': 'auto','padding-top':'2.5%','padding-left':'2.5%','padding-right':'2.5%'});
			window.onresize = function(event) {$('#info-detail-server').css({height: ($(window).height()-($(window).height()*40/100)),'overflow':'auto','padding-top':'2.5%','padding-left':'2.5%','padding-right':'2.5%'});};
		});
	</script>

	<script type="text/javascript">
		$('.datepicker').datepicker({
			language: "th",
			autoclose: true,
			todayHighlight: true
		});
	</script>



</body>
</html> 