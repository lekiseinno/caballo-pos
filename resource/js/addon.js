$(document).ready(function(){
	$('body').css({
		height: $(window).height()
	});
	$('.warpper').css({
		height: ($(window).height() - $('.nav-top').height() - 40)
	});
	$('.warpper-noright').css({
		height: ($(window).height() - $('.nav-top').height() - 40)
	});
	$('.tab_menu').css({
		height: ($(window).height() - $('.warpper').height() - 62)
	});
	$('.panel-cart').css({
		height: ($(window).height() - 60 - $('.panel-customer').height() - 225),
		'overflow':'auto'
	});
	$('.panel-cart-detail').css({
		height: ($(window).height() - $('.head-detail').height()),
		'overflow':'auto'
	});
	$('.panel-checkout').css({
		height: ($(window).height() - 60 - 48 - $('.panel-cart').height()),
		
	});
	$('#panel-item-list').css({
		height: ($(window).height() - 62 - $('.tab_menu').height()),
		'overflow-y': 'auto',
		'padding':'1%'
	});












	if($('#Customer_code').val()=='')
	{
		$('#panel-item-list').click(function(){return false;});
	}

	$('#Customer_code').change(function(){
		alert('test');
	});
	


	window.onresize = function(event) {
		$('body').css({
			height: $(window).height()
		});
		$('.warpper').css({
			height: ($(window).height() - $('.nav-top').height() - 40)
		});
		$('.tab_menu').css({
			height: ($(window).height() - $('.warpper').height() - 62)
		});
		$('.panel-cart').css({
			height: ($(window).height() - 60 - $('.panel-customer').height() - 225),
			'overflow':'auto'
		});
		$('.panel-checkout').css({
			height: ($(window).height() - 60 - 48 - $('.panel-cart').height()),
		'border-top':'1px solid rgba(0, 0, 0, 0.125)',
		});
	};








	


});