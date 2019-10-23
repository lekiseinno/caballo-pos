<?php $row=$_POST['row']; ?>
<tr>
	<td></td>
	<td align="right">DEPOSIT </td>
	<td><!--<input type="date" name="deposit_date[]" >--></td>
	<td><input type="text" name="deposit_amount[]" value="0" class="cal_deposit" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" style="text-align: right" onkeyup="cal_deposit()"></td>
</tr>