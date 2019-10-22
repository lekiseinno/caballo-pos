<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php include_once 'body-start-noright.php'; ?>


<?php

$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();

?>
<style>
	th,td{
		border: 1px solid gray;
		padding: 5px;
	}

	th{text-align: center}
</style>


<?php 
 	

 	date_default_timezone_set('asia/bangkok');
 	$srvsql				=	new	srvsql();
	$connect_pos		=	$srvsql->connect_pos();
	$quotation_no=$_GET['quotation_no'];
	$sql="SELECT	* FROM	[CBL-POS].[dbo].[quotation_head] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$row1=sqlsrv_fetch_array($query);

 ?>
 <br>
<h4 align="center">แก้ไขใบเสนอราคา</h4>
<form action="process/quatation_update.php" method="post">
<input type="hidden" name="quotation_no" value="<?php  echo $quotation_no ?>">
<table cellpadding="5" cellspacing="0" align="center" width="70%" border="0">
	<tr>
 		<th width="15%" align="left"></a>No : </th>
 		<td  align="left" width="50%"><?php echo $quotation_no ?></td>
 	</tr>
 	<tr>
 		<th align="left">Name : </th>
 		<td><?php echo $row1['quotation_name'] ?></td>
 		
 	</tr>
 	<tr>
 		<th align="left">Date : </th>
 		<td><?php echo date('d/m/Y') ?></td>
 	</tr>
</table>
 <table border="1" cellpadding="5" cellspacing="0" align="center" width="70%">
 	<tr>
 		<th>QUANTITY</th>
 		<th>DESCRIPTION</th>
 		<th>UNIT PRICE</th>
 		<th>AMOUNT</th>
 	</tr>
<?php 

	$sql="SELECT	* FROM	[CBL-POS].[dbo].[quotation_line] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	$sum_quantity=0;
	$sum_price=0;
	$count=1;
	while ($row=sqlsrv_fetch_array($query)) { 
		$price=$row['quantity']*$row['unit_price'];
		$sum_quantity=$sum_quantity+$row['quantity'];
		$sum_price=$sum_price+$price;
?>
	<tr>
		<td align="right">
			<input type="hidden" name="quantity_old[]" value="<?php echo $row['quantity'] ?>">
			<input type="hidden" name="quotation_line_id[]" value="<?php echo $row['quotation_line_id'] ?>">
			<input name="quantity[]" class="quantity quantity<?php echo $count ?>"  onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" value="<?php echo $row['quantity'] ?>" onkeyup="cal_amount(<?php echo $count ?>)">
		</td>
		<td align="right"><?php echo $row['item_name'] ?></td>
		<td align="right" ><?php echo $row['unit_price'] ?><input type="hidden"  value="<?php echo $row['unit_price'] ?>" class="unit_price unit_price<?php echo $count ?>"></td>
		<td align="right" class="amount amount<?php echo $count ?>"><?php echo $price ?></td>
	</tr>
<?php 
	$count++;
	}	
	$sum_deposit=0;
	$sum_deposit=$row1['discount1']+$row1['discount2']+$row1['discount3'];
?>
	<tr>
		<td align="right" class="sum_quantity" style="color: red"><?php echo $sum_quantity ?></td>
		<td></td>
		<td></td>
		<td align="right" class="sum_amount"><?php echo $sum_price; ?></td>
	</tr>

	<tr>
		<td align="right" colspan="3">DISCOUNT1 <input type="hidden" name="discount1_old" value="<?php echo $row1['discount1'] ?>"></td>
		<td align="right" ><input name="discount1" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" value="<?php echo $row1['discount1'] ?>" onkeyup="cal_deposit()"></td>
	</tr>
	<tr>
		<td align="right" colspan="3">DISCOUNT2 <input type="hidden" name="discount2_old" value="<?php echo $row1['discount2'] ?>"></td>
		<td align="right" ><input name="discount2" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" value="<?php echo $row1['discount2'] ?>" onkeyup="cal_deposit()"></td>
	</tr>
	<tr>
		<td align="right" colspan="3">DISCOUNT3 <input type="hidden" name="discount3_old" value="<?php echo $row1['discount3'] ?>"></td>
		<td align="right" ><input name="discount3" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" value="<?php echo $row1['discount3'] ?>" onkeyup="cal_deposit()"></td>
	</tr>

<?php 

	$sql="SELECT	* FROM	[CBL-POS].[dbo].[deposit] WHERE quotation_no='$quotation_no'";
	$query=sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
	
	while ($row=sqlsrv_fetch_array($query)) { 
		$sum_deposit=$sum_deposit+$row['deposit_amount'];

?>
	<tr>
		<td align="right" colspan="3">DEPOSIT </td>
		<td align="right" >
			<input type="hidden" name="deposit_id[]" value="<?php echo $row['deposit_id'] ?>">
			<input type="hidden" name="deposit_amount_old[]" value="<?php echo $row['deposit_amount'] ?>">
			<input name="deposit_amount[]" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" value="<?php echo $row['deposit_amount'] ?>" onkeyup="cal_deposit()">
		</td>
	</tr>
<?php }	?>
	<tr>
		<td align="right" colspan="3"></td>
		<td align="right" class="sum_deposit"><?php echo $sum_deposit ?></td>
	</tr>
	<tr>
		<td align="right" colspan="3"></td>
		<td align="right" class="sumprice" style="border-bottom: 10px double black"><?php echo $sum_price-$sum_deposit ?></td>
	</tr>
 </table><br>
 <div align="center">
 	<button type="submit" class="btn btn-success btn-lg" >บันทึกข้อมูล</button>
	<a href="quotation.php"><button type="button" class="btn  btn-lg">ยกเลิก</button></a>
 </div>
 </form>



<script type="text/javascript">


	function goto_page(url){
		window.open(url);
	}
	
	function add_deposit(row){
		row=parseInt(row)+1;
		$.ajax({
         url: 'add_deposit.php',
         type: 'POST',
         dataType: 'TEXT',
         async: false,
         data: {row:row}
      }).done(function(data) {
         $(data).insertBefore('#count_de');
         $('#count_de').val(row);
      }); 
	}


	function add_item(row){
		row=parseInt(row)+1;
		$.ajax({
         url: 'add_item.php',
         type: 'POST',
         dataType: 'TEXT',
         async: false,
         data: {row:row}
      }).done(function(data) {
         $(data).insertBefore('#count_row');
         $('#count_row').val(row);
      }); 
	}

	function sum_amount(){
		var sum_amount=0;
		$(".amount").each(function(){
	      sum_amount+=parseInt($(this).text());
	    });
		$('.sum_amount').html(sum_amount);
	}	

	function sum_quantity(){
		var sum_quantity=0;
		$("input[name='quantity[]']").each(function(){
	      sum_quantity+=parseInt($(this).val());
	    });
		$('.sum_quantity').html(sum_quantity);
	}


	function cal_amount(row){
		var quantity=parseInt($('.quantity'+row).val());
		var price = parseInt($('.unit_price'+row).val());


		$('.price'+row).text(price);
		$('.amount'+row).text(quantity*price);
		sum_amount();
		sum_quantity();
		sum_price();
	}


	function cal_deposit(){
		var sum_deposit=0;
		$("input[class='cal_deposit']").each(function(){
	      sum_deposit+=parseInt($(this).val());
	    });
		$('.sum_deposit').html(sum_deposit);
		sum_price();
	}

	function sum_price(){
		var sumprice=parseInt($('.sum_amount').text())-parseInt($('.sum_deposit').text());
		$('.sumprice').html(sumprice);
	}


	function form_submit(){
		if(confirm('ยืนยันเพื่อดำเนินการต่อ')){
			$.ajax({
	         url: 'process/quatation_add.php',
	         type: 'POST',
	         dataType: 'TEXT',
	         async: false,
	         data: $("#quotation_form").serialize()
	      }).done(function(data) {
	      	//$('.show').html(data);
	         location.reload();
	      }); 
	  }
	}

$(document).ready(function(){
  $(".btn-form-q").click(function(){
    $("#form-q").slideToggle();
  });
});

function quatation_update(quotation_no){

	$('#quatation_update').modal('show');
	$.ajax({
	    url: 'quatation_detail.php',
	    type: 'GET',
	    dataType: 'TEXT',
	    async: false,
	    data: {quotation_no:quotation_no}
	}).done(function(data) {
	  	$('.modal-body').html(data);
	}); 
}







</script>


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
</script>
<?php include_once 'body-end.php'; ?>
<?php include_once 'footer.php'; ?>
