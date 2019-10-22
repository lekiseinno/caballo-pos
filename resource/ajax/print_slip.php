<?php include_once '../../config.php'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<style type="text/css">
		@media print{
			body
			{
				font-family: Arial, Helvetica, sans-serif;
				/*border:1px solid red;*/
				margin: 0;
				padding: 0;
				color: #000;
			}

			.text-center
			{
				text-align: center;
			}

			.logo
			{
				text-align: center;
			}
			.logo img
			{
				background-color: #fff;
				max-width: 70%;
				height: auto;
			}
			hr {
				margin-top: 1rem;
				margin-bottom: 1rem;
				border: 0;
				border-top: 1px solid rgba(0, 0, 0, 0.1);
			}
			.head
			{
				font-size: 12px;
			}
			.detail
			{
				font-size: 14px;
			}
			.footer
			{
				margin-top: 15px;
				text-align: center;
				font-size: 12px;
				margin-bottom: 15px;
			}
		}
	</style>
</head>
<body onload="window.print()">
	<div class="logo" >
		<img src="resource/images/logo.png">
	</div>
	<div class="text-center head">
		Caballo Thailand <br>
		ออกโดย Pratunam BKK <br>
		TAX ID # 000000000000 <br>
		Billing No # 20181105-001 <br>
		พนักงานขาย SALE01 <br>
		รายการที่ PO-POS-201811-001 <br>
		<?php echo date('d/m/Y H:i:s'); ?>
	</div>
	<hr>
	<div class="detail">
		<table width="100%" border="0">
			<tr>
				<td width="50%" align="left">SX-0001</td>
				<td width="25%" align="center"> x 1 </td>
				<td width="25%" align="right">150.00</td>
			</tr>
			<tr>
				<td width="50%" align="left">SX-0002</td>
				<td width="25%" align="center"> x 1 </td>
				<td width="25%" align="right">150.00</td>
			</tr>
			<tr>
				<td width="50%" align="left">SX-0003</td>
				<td width="25%" align="center"> x 1 </td>
				<td width="25%" align="right">150.00</td>
			</tr>
			<tr>
				<td width="75%" align="left" colspan="2">รวม</td>
				<td width="25%" align="right"><b>450.00</b></td>
			</tr>
		</table>
	</div>
	<div class="footer">
		Thank you very much
	</div>
</body>
</html>