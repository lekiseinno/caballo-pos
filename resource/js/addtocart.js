





function addtocart(itemno,qty)
{
	var	uri	=	"process/add_order.php";
	$.ajax({
		method:	"POST",
		url:	uri,
		data:	{
					n_itemno:	itemno,
					n_qty:		qty
				}
	}).done(function( msg ) {
		showAlert();
		//alert( "Data Saved: " + msg );
	});


	//alert(itemno + ' - ' + qty);
}


/*
	$("#item_type_"+pattern+"_"+screen).val();
	$("#item_cotton_"+pattern+"_"+screen).val();
	$("#item_color_"+pattern+"_"+screen).val();
	$("#item_arm_"+pattern+"_"+screen).val();
	$("#item_bag_"+pattern+"_"+screen).val();
	$("#item_pattern_"+pattern+"_"+screen).val();
	$("#item_screen_"+pattern+"_"+screen).val();
	$("#item_acc_"+pattern+"_"+screen).val();
	$("#item_size_"+pattern+"_"+screen).val();
*/
//$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();



function select_item(pattern,screen,typeonclick,onclick)
{
	$("#item_"+typeonclick+"_"+pattern+"_"+screen).val( onclick );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}





/*
function select_type(pattern,screen,types)
{
	$("#item_type_"+pattern+"_"+screen).val( types );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_cotton(pattern,screen,cotton)
{
	$("#item_cotton_"+pattern+"_"+screen).val( cotton );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_color(pattern,screen,color)
{
	$("#item_color_"+pattern+"_"+screen).val( color );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_arm(pattern,screen,arm)
{
	$("#item_arm_"+pattern+"_"+screen).val( arm );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_bag(pattern,screen,bag)
{
	$("#item_bag_"+pattern+"_"+screen).val( bag );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_acc(pattern,screen,acc)
{
	$("#item_acc_"+pattern+"_"+screen).val( acc );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}

function select_size(pattern,screen,size)
{
	$("#item_size_"+pattern+"_"+screen).val( size );
	var	itemno	=		$("#item_type_"+pattern+"_"+screen).val()	+	$("#item_cotton_"+pattern+"_"+screen).val()	+	$("#item_color_"+pattern+"_"+screen).val()	+	$("#item_arm_"+pattern+"_"+screen).val()	+	$("#item_bag_"+pattern+"_"+screen).val()	+	$("#item_pattern_"+pattern+"_"+screen).val()	+	$("#item_screen_"+pattern+"_"+screen).val()	+	$("#item_acc_"+pattern+"_"+screen).val()	+	$("#item_size_"+pattern+"_"+screen).val();
	$("#itemno_tocart_"+pattern+"_"+screen).val( itemno );
}
*/