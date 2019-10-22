<?php
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


 						$row=$_POST['row'];

?>			


			<tr>
				<td><input value="0" style="text-align: right" type="text" name="quantity[]" onkeyup="cal_amount(<?php echo $row ?>)" class=" quantity quantity<?php echo $row ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"></td>
				<td>
				<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
				<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
					<select name="item[]"  class=" item item<?php echo $row ?>" onchange="cal_amount(<?php echo $row ?>)" style="width: 100%">
						<option value="">---เลือกสินค้า---</option>
				<?php foreach ($array_item as $item => $price) { ?>
						<option value="<?php echo $item.','.$price  ?>"><?php echo $item ?></option>
				<?php } ?>
					</select>
					<script type="text/javascript">
						$('.item').select2();
					</script>
				</td>
				<td align="right" class="price price<?php echo $row ?>"></td>
				<td align="right" class="amount amount<?php echo $row ?>"></td>
			</tr>