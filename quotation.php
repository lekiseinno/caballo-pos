<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php include_once 'body-start-noright.php'; ?>


<?php

$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();


$array_item = array(
								'BLACK T-SHIRT (SS)' => 95,
								'BLACK T-SHIRT (S)' => 105,
								'BLACK T-SHIRT (M)' => 110,
								'BLACK T-SHIRT (L)' => 115,
								'BLACK T-SHIRT (XL)' => 125,
								'WHITE T-SHIRT (SS)' => 85,
								'WHITE T-SHIRT (S)' => 95,
								'WHITE T-SHIRT (M)' => 100,
								'WHITE T-SHIRT (L)' => 105,
								'WHITE T-SHIRT (XL)' => 115,
								'BLACK TIEDYE (SS)' => 115,
								'BLACK TIEDYE (S)' => 125,
								'BLACK TIEDYE (M)' => 130,
								'BLACK TIEDYE (L)' => 135,
								'BLACK TIEDYE (XL)' => 145,
								'HOOD (S)' => 380,
								'HOOD (M)' => 380,
								'HOOD (L)' => 400,
								'HOOD (XL)' => 420,
								'COLOR TIEDYE (SS)' => 110,
								'COLOR TIEDYE (S)' => 120,
								'COLOR TIEDYE (M)' => 130,
								'COLOR TIEDYE (L)' => 140,
								'COLOR TIEDYE (XL)' => 150,
								'SWEATHER (S)' => 120,
								'SWEATHER (M)' => 130,
								'SWEATHER (L)' => 140,
								'SWEATHER (XL)' => 150,
								'4D-REVET[BLACK] (SS)' => 115,
								'4D-REVET[BLACK] (S)' => 125,
								'4D-REVET[BLACK] (M)' => 130,
								'4D-REVET[BLACK] (L)' => 135,
								'4D-REVET[BLACK] (XL)' => 145,
								'PANTS[ADULT] (Freesize)' => 110,
								'4D-REVET[BLACK TIEDYE] (SS)' => 135,
								'4D-REVET[BLACK TIEDYE] (S)' => 145,
								'4D-REVET[BLACK TIEDYE] (M)' => 150,
								'4D-REVET[BLACK TIEDYE] (L)' => 155,
								'4D-REVET[BLACK TIEDYE] (XL)' => 165,
								'LONG SLEEVE[BLACK] (S)' => 130,
								'LONG SLEEVE[BLACK] (M)' => 140,
								'LONG SLEEVE[BLACK] (L)' => 150,
								'LONG SLEEVE[BLACK] (XL)' => 160,
								'4D-REVET[COLOR TIEDYE] (SS)' => 130,
								'4D-REVET[COLOR TIEDYE] (S)' => 140,
								'4D-REVET[COLOR TIEDYE] (M)' => 150,
								'4D-REVET[COLOR TIEDYE] (L)' => 160,
								'4D-REVET[COLOR TIEDYE] (XL)' => 170,
								'JOGGER PANTS (S)' => 330,
								'JOGGER PANTS (M)' => 330,
								'JOGGER PANTS (L)' => 350,
								'JOGGER PANTS (XL)' => 350,
								'SUPER TREM (SS)' => 105,
								'SUPER TREM (S)' => 115,
								'SUPER TREM (M)' => 120,
								'SUPER TREM (L)' => 125,
								'SUPER TREM (XL)' => 135,
								'4DX (SS)' => 115,
								'4DX (S)' => 125,
								'4DX (M)' => 130,
								'4DX (L)' => 135,
								'4DX (XL)' => 145,
								'TANKTOP (SS)' => 95,
								'TANKTOP (S)' => 105,
								'TANKTOP (M)' => 110,
								'TANKTOP (L)' => 115,
								'TANKTOP (XL)' => 125,
								'MAX (SS)' => 160,
								'MAX (S)' => 160,
								'MAX (M)' => 180,
								'MAX (L)' => 180,
								'MAX (XL)' => 180,
								'TOTE BAGS (Freesize)' => 110
 						);

?>


<style>
	th,td{
		border: 1px solid gray;
		padding: 5px;
	}

	th{text-align: center}
</style>


<div >
	<div id="form-q" style="border : 1px solid blue;padding: 10px;display: none">
		<br><div class="show"></div>
		<form action="process/add_quotation.php" method="post" id="quotation_form">
		<table border="0" align="center">
			
			<thead>
				<tr>
					<th>Name : </th>
					<th colspan="3"><input type="text"  style="width: 100%" name="quotation_name"></th>
				</tr>
				<tr>
					<th style="width: 20%">QUANTITY</th>
					<th style="width: 40%">DESCRIPTION</th>
					<th style="width: 20%">UNIT PRICE</th>
					<th style="width: 20%">AMOUNT</th>
				</tr>
			</thead>
			<tbody>
				<tr>
<<<<<<< HEAD
					<td><input  type="text" value="0"  name="quantity[]" onkeyup="cal_amount(1)" class=" quantity quantity1" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right"></td>
=======
					<td><input  type="text" value="0"  name="quantity[]" onkeyup="cal_amount(1)" class="quantity quantity1" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right"></td>
>>>>>>> Last Final real real
					<td>
					<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
					<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
						<select name="item[]"  class=" item item1" onchange="cal_amount(1)" style="width: 100%">
							<option value="">---เลือกสินค้า---</option>
					<?php foreach ($array_item as $item => $price) { ?>
							<option value="<?php echo $item.','.$price  ?>"><?php echo $item ?></option>
					<?php } ?>
						</select>
						<script type="text/javascript">
							$('.item').select2();
						</script>
					</td>
					<td class="price price1" align="right"></td>
					<td class="amount amount1" align="right"></td>
				</tr>
				<input type="hidden" value="1" id="count_row">
				<tr>
					<td align="right" class="sum_quantity" style="border-bottom: 3px solid gray">0</td>
					<td></td>
					<td></td>
					<td align="right" class="sum_amount" style="border-bottom: 3px solid #007bff">0</td>
				</tr>
				<tr>
					<td></td>
<<<<<<< HEAD
					<td align="right">Discount </td>
					<td></td>
					<td><input type="text" name="deposit_amount[]" value="0" class="deposit1 deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit(1)"></td>
=======
					<td align="right">Discount1 </td>
					<td></td>
					<td><input type="text" name="discount1" value="0" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit()"></td>
				</tr>
				<tr>
					<td></td>
					<td align="right">Discount2 </td>
					<td></td>
					<td><input type="text" name="discount2" value="0" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit()"></td>
				</tr>
				<tr>
					<td></td>
					<td align="right">Discount3 </td>
					<td></td>
					<td><input type="text" name="discount3" value="0" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit()"></td>
>>>>>>> Last Final real real
				</tr>
				<tr>
					<td></td>
					<td align="right">DEPOSIT </td>
<<<<<<< HEAD
					<td><input type="date" name="deposit_date[]" ></td>
					<td><input type="text" name="deposit_amount[]" value="0" class="deposit1 deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit(1)"></td>
=======
					<td><!--<input type="date" name="deposit_date[]" >--></td>
					<td><input type="text" name="deposit_amount[]" value="0" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit()"></td>
>>>>>>> Last Final real real
				</tr>
				<input type="hidden" value="1" id="count_de">
				<tr>
					<td colspan="3"></td>
					<td class="sum_deposit" align="right" style="border-bottom: 3px solid #ffc107">0</td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<td class="sumprice" align="right" style="border-bottom: 10px double green">0</td>
				</tr>
			</tbody>
		</table><br>

		<button class="btn btn-outline-primary" type="button" onclick="add_item(count_row.value)">add item</button>
		<button class="btn btn-outline-warning" type="button" onclick="add_deposit(count_de.value)">add deposit</button>
		<br>
		<div align="center">
			<button type="button" class="btn btn-success btn-lg" onclick="form_submit()">บันทึกข้อมูล</button>
		</div>
		<div>
			<label>remark</label>
			<textarea class="form-control"></textarea>
		</div>
		</form>
	</div>
<<<<<<< HEAD

<?php 
	$srvsql				=	new	srvsql();
	$connect_pos		=	$srvsql->connect_pos();

=======
<?php 
	$srvsql				=	new	srvsql();
	$connect_pos		=	$srvsql->connect_pos();
>>>>>>> Last Final real real
	$sql		=	"
						SELECT	*
						FROM	[CBL-POS].[dbo].[quotation_head] 
					";
		$query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
<<<<<<< HEAD
		

=======
>>>>>>> Last Final real real
 ?>
 	<br>
	<h4 align="center">รายการใบเสนอราคา <button type="button" class="btn btn-primary btn-lg btn-form-q"  >สร้างใหม่</button></h4>
	<table class="table table-bordered">

		<thead>
			<th>#</th>
			<th>No.</th>
			<th>Name</th>
			<th>Date</th>
			<th>Action</th>
		</thead>
		<tbody>
<?php $count=1; while ($row		=	sqlsrv_fetch_array($query)) { $quotation_no=$row['quotation_no']; ?>
			<tr>
				<td width="20" align="center"><?php echo $count++ ?></td>
				<td align="center"><?php echo $quotation_no ?></td>
				<td width="50%" align="center"><?php echo $row['quotation_name'] ?></td>
				<td align="center"><?php echo $row['quotation_date'] ?></td>
				<td align="center">
					<button type="button" class="btn btn-info btn-sm" onclick="goto_page('q_print.php?quotation_no=<?php echo $quotation_no ?>')" >Print</button>
<<<<<<< HEAD
					<button type="button" class="btn btn-warning btn-sm" >Edit</button>
=======
					<a href="quatation_detail.php?quotation_no=<?php echo $quotation_no ?>"><button type="button" class="btn btn-warning btn-sm">Edit</button></a>
>>>>>>> Last Final real real
				</td>
			</tr>
<?php } ?>
		</tbody>
	</table>
	
</div>



<<<<<<< HEAD

=======
<form action="process/quatation_update.php" method='POST'>
	<div class="modal fade" id="quatation_update" tabindex="-1" role="dialog" aria-labelledby="modalAddorderTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
			<div class="modal-content">
				<div class="modal-header"><h5>แก้ไขใบเสนอราคา</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
					<div class="modal-body"></div>
			</div>		
		</div>
	</div>
</form>
>>>>>>> Last Final real real



<script type="text/javascript">

<<<<<<< HEAD

=======
>>>>>>> Last Final real real
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
		var price = $('.item'+row).val().split(',');
		price=parseInt(price[1]);

		$('.price'+row).text(price);
		$('.amount'+row).text(quantity*price);
		sum_amount();
		sum_quantity();
		sum_price();
	}


<<<<<<< HEAD
	function cal_deposit(row){
		var sum_deposit=0;
		$("input[name='deposit_amount[]']").each(function(){
=======
	function cal_deposit(){
		var sum_deposit=0;
		$("input[class='cal_deposit']").each(function(){
>>>>>>> Last Final real real
	      sum_deposit+=parseInt($(this).val());
	    });
		$('.sum_deposit').html(sum_deposit);
		sum_price();
	}

<<<<<<< HEAD
=======

>>>>>>> Last Final real real
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

<<<<<<< HEAD
	
=======


>>>>>>> Last Final real real
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
<<<<<<< HEAD

=======
<?php include_once 'body-end.php'; ?>
<?php include_once 'footer.php'; ?>
>>>>>>> Last Final real real
