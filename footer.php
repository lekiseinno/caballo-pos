
	<?php include_once 'modal.php'; ?>
	<script src="resource/js/popper.min.js"></script>
	<script src="resource/js/bootstrap.js"></script>
	<script src="resource/js/bootstrap-datepicker.js"></script>
	<script src="resource/js/fontawesome.all.js"></script>
	<script src="resource/js/select2.js"></script>
	<script src="resource/js/datatable/jquery.dataTables.js"></script>
	<script src="resource/js/datatable/dataTables.bootstrap4.js"></script>
	<script src="resource/js/datatable/dataTables.buttons.js"></script>
	<script src="resource/js/datatable/buttons.bootstrap4.js"></script>
	<script src="resource/js/datatable/jszip.js"></script>
	<script src="resource/js/datatable/pdfmake.js"></script>
	<script src="resource/js/datatable/vfs_fonts.js"></script>
	<script src="resource/js/datatable/buttons.html5.js"></script>
	<script src="resource/js/datatable/buttons.print.js"></script>
	<script src="resource/js/datatable/buttons.colVis.js"></script>
	<script src="resource/js/addon.js"></script>
	<!-- <script src="resource/jqueryui/jquery-ui.min.js"></script> -->
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
		$('.datepicker').datepicker({
			language: "th",
			autoclose: true,
			todayHighlight: true
		});
	</script>
</body>
</html> 