<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<<<<<<< HEAD
<?php include_once 'right.php'; ?>
<?php include_once 'body-start.php'; ?>
=======
<?php /*include_once 'right.php';*/ ?>
<?php /*include_once 'body-start.php';*/ ?>
<?php include_once 'body-start-noright.php'; ?>


>>>>>>> Last Final real real


<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>

<div id="checkout_list"></div>
<<<<<<< HEAD
=======
<?php  ?>




>>>>>>> Last Final real real
<script type="text/javascript">
	$(document).ready(function(){
		var uri	=	'resource/ajax/checkout_list.php';
		setInterval(function(){
			$.get(uri, function( data ){
				$('#checkout_list').html(data);
			});
		},1000);

		$('#checkout_list').css({
			height: ($(window).height() - ($(window).height()*12.5/100)),
			'overflow': 'auto'
		});
	});
</script>



<<<<<<< HEAD
=======


>>>>>>> Last Final real real
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
<<<<<<< HEAD
</script>
=======


</script> 
>>>>>>> Last Final real real





<?php include_once 'body-end.php'; ?>

<?php include_once 'footer.php'; ?>

