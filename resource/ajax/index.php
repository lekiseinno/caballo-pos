<?php include_once '../../config.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
?>


<div id="panel-item-list">
	<div class="row" style="margin: 0;">
		<div class="col-3 padding-l-0 padding-r-0">
			<?php
			$sql		=	"
							SELECT		TOP 10
										[item\$].[Item_screen],
										[item\$].[Item_pattern],
										[Item_pattern].[Item_Pattern_Name]
							FROM		[item\$]
							INNER JOIN	[Item_pattern]	ON	[Item_pattern].[Item_Pattern_Code]	=	[item\$].[Item_pattern]
							WHERE		[Item_pattern].[Item_Pattern_Code]	>	0
							AND			LEN([item\$].[No_]) = 20
							GROUP BY	[Item_screen],[Item_pattern],[Item_Pattern_Name]
							ORDER BY	NEWID()
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	1;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
				<div class="row" style="margin: 0;">
					<div class="col padding-l-5 padding-r-5 padding-b-5">
						<div class="card">
							<a href="#" data-toggle="modal" data-target="#itemno_<?php echo $row['Item_Pattern_Name'] ?>_<?php echo sprintf("%04d",$row['Item_screen']) ?>">
								<img class="card-img-top" src="http://10.10.2.31:8081/cbl_frontstore/images/pattern/<?php echo $row['Item_Pattern_Name'] ?>/<?php echo sprintf("%04d",$row['Item_screen']) ?>.jpg">
							</a>
							<div class="modal fade" id="itemno_<?php echo $row['Item_Pattern_Name'] ?>_<?php echo sprintf("%04d",$row['Item_screen']) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%;">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $row['Item_Pattern_Name']; ?> - ลายที่ : <?php echo $row['Item_screen']; ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-3">
													<img class="card-img-top" src="http://10.10.2.31:8081/cbl_frontstore/images/pattern/<?php echo $row['Item_Pattern_Name'] ?>/<?php echo sprintf("%04d",$row['Item_screen']) ?>.jpg">
													<hr>
												</div>
												<div class="col-md-9">
													<div class="row">
														<div class="col-6">
															<label>ประเภท</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_type		=	"
																					SELECT		[CBL-front-store].[dbo].[item\$].[item_type],
																								[CBL-front-store].[dbo].[Item_type].[Item_Type_Name]
																					FROM		[CBL-front-store].[dbo].[item\$]
																					INNER JOIN	[CBL-front-store].[dbo].[Item_type]	ON	[CBL-front-store].[dbo].[Item_type].[Item_Type_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_type]
																					WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																					AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																					GROUP BY	[CBL-front-store].[dbo].[item\$].[item_type],[CBL-front-store].[dbo].[Item_type].[Item_Type_Name]
																					";
																$query_type		=	sqlsrv_query($connect_pos,$sql_type) or die( 'SQL Error = '.$sql_type.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_type	=	sqlsrv_fetch_array($query_type,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','type','<?php echo sprintf("%02d",$row_type['item_type']); ?>')">
																		<input type="radio" name="type" autocomplete="off" > <?php echo $row_type['Item_Type_Name']; ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
															<label>เนื้อผ้า</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_cotton			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_cotton],[CBL-front-store].[dbo].[Item_cotton].[Item_Cotton_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_cotton]	ON	[CBL-front-store].[dbo].[Item_cotton].[Item_Cotton_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_cotton]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_cotton],[CBL-front-store].[dbo].[Item_cotton].[Item_Cotton_Name]
																						";
																$query_cotton		=	sqlsrv_query($connect_pos,$sql_cotton) or die( 'SQL Error = '.$sql_cotton.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_cotton	=	sqlsrv_fetch_array($query_cotton,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','cotton','<?php echo sprintf("%02d",$row_cotton['Item_cotton']); ?>')">
																		<input type="radio" name="cotton" autocomplete="off"> <?php echo $row_cotton['Item_Cotton_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
															<label>สี</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_color			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_color],[CBL-front-store].[dbo].[Item_color].[Item_Color_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_color]	ON	[CBL-front-store].[dbo].[Item_color].[Item_Color_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_color]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_color],[CBL-front-store].[dbo].[Item_color].[Item_Color_Name]
																						";
																$query_color		=	sqlsrv_query($connect_pos,$sql_color) or die( 'SQL Error = '.$sql_color.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_color	=	sqlsrv_fetch_array($query_color,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','color','<?php echo sprintf("%02d",$row_color['Item_color']); ?>')">
																		<input type="radio" name="color" autocomplete="off"> <?php echo $row_color['Item_Color_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
															<label>แขน</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_arm			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_arm],[CBL-front-store].[dbo].[Item_arm].[Item_Arm_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_arm]	ON	[CBL-front-store].[dbo].[Item_arm].[Item_Arm_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_arm]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_arm],[CBL-front-store].[dbo].[Item_arm].[Item_Arm_Name]
																						";
																$query_arm			=	sqlsrv_query($connect_pos,$sql_arm) or die( 'SQL Error = '.$sql_arm.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_arm		=	sqlsrv_fetch_array($query_arm,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','arm','<?php echo sprintf("%02d",$row_arm['Item_arm']); ?>')">
																		<input type="radio" name="arm" autocomplete="off"> <?php echo $row_arm['Item_Arm_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
														</div>
														<div class="col-6">
															<label>กระเป๋า</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_bag			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_bag],[CBL-front-store].[dbo].[Item_bag].[Item_Bag_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_bag]	ON	[CBL-front-store].[dbo].[Item_bag].[Item_Bag_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_bag]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_bag],[CBL-front-store].[dbo].[Item_bag].[Item_Bag_Name]
																						";
																$query_bag			=	sqlsrv_query($connect_pos,$sql_bag) or die( 'SQL Error = '.$sql_bag.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_bag		=	sqlsrv_fetch_array($query_bag,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','bag','<?php echo sprintf("%02d",$row_bag['Item_bag']); ?>')">
																		<input type="radio" name="bag" autocomplete="off"> <?php echo $row_bag['Item_Bag_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
															<label>ประดับ</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_acc			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_accessory],[CBL-front-store].[dbo].[Item_accessory].[Item_Accessory_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_accessory]	ON	[CBL-front-store].[dbo].[Item_accessory].[Item_Accessory_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_accessory]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_accessory],[CBL-front-store].[dbo].[Item_accessory].[Item_Accessory_Name]
																						";
																$query_acc			=	sqlsrv_query($connect_pos,$sql_acc) or die( 'SQL Error = '.$sql_acc.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_acc		=	sqlsrv_fetch_array($query_acc,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','acc','<?php echo sprintf("%02d",$row_acc['Item_accessory']); ?>')">
																		<input type="radio" name="accessory" autocomplete="off"> <?php echo $row_acc['Item_Accessory_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
															<label>Size</label><br>
															<div class="btn-group-toggle" data-toggle="buttons">
																<?php
																$sql_size			=	"
																						SELECT		[CBL-front-store].[dbo].[item\$].[Item_size],[CBL-front-store].[dbo].[Item_size].[Item_Size_Name]
																						FROM		[CBL-front-store].[dbo].[item\$]
																						INNER JOIN	[CBL-front-store].[dbo].[Item_size]	ON	[CBL-front-store].[dbo].[Item_size].[Item_Size_Code]	=	[CBL-front-store].[dbo].[item\$].[Item_size]
																						WHERE		[CBL-front-store].[dbo].[item\$].[Item_screen]	=	'".$row['Item_screen']."'
																						AND			[CBL-front-store].[dbo].[item\$].[Item_pattern]	=	'".$row['Item_pattern']."'
																						GROUP BY	[CBL-front-store].[dbo].[item\$].[Item_size],[CBL-front-store].[dbo].[Item_size].[Item_Size_Name]
																						";
																$query_size			=	sqlsrv_query($connect_pos,$sql_size) or die( 'SQL Error = '.$sql_size.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
																while($row_size		=	sqlsrv_fetch_array($query_size,SQLSRV_FETCH_ASSOC))
																{
																	?>
																	<label class="btn btn-outline-primary btn-sm " onclick="select_item('<?php echo $row['Item_Pattern_Name']; ?>','<?php echo sprintf("%04d",$row['Item_screen']); ?>','size','<?php echo sprintf("%02d",$row_size['Item_size']); ?>')">
																		<input type="radio" name="size" autocomplete="off"> <?php echo $row_size['Item_Size_Name'] ?>
																	</label>
																	<?php
																}
																?>
															</div>
															<hr>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<div class="col-3">
												<div class="input-group">
													<div class="input-group-prepend">
														<button class="btn btn-outline-success" id="qty_del" type="button">-</button>
													</div>
													<input type="text" class="form-control text-center" id="qty_tocart_<?php echo $row['Item_Pattern_Name']	.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>" placeholder="จำนวน" style="border:1px solid #28a745;"  onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" value="1">
													<div class="input-group-append">
														<button class="btn btn-outline-success" id="qty_add" type="button">+</button>
													</div>
													<script type="text/javascript">
														$("#qty_add").click(function(){
															var qty=$("#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>").val();
															$("#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>").val(Number(qty)+1);
														});
														$("#qty_del").click(function(){
															if($("#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>").val() > 1)
															{
																var qty=$("#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>").val();
																$("#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>").val(Number(qty)-1);
															}
														});
													</script>
												</div>
												<div style="display: none;">
													<br>item_type		<input id="item_type_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_cotton		<input id="item_cotton_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_color		<input id="item_color_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_arm		<input id="item_arm_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_bag		<input id="item_bag_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_pattern	<input id="item_pattern_<?php echo $row['Item_Pattern_Name']	.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="<?php echo $row['Item_pattern']; ?>">
													<br>item_screen		<input id="item_screen_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="<?php echo $row['Item_screen']; ?>">
													<br>item_acc		<input id="item_acc_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
													<br>item_size		<input id="item_size_<?php echo $row['Item_Pattern_Name']		.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="00">
												</div>
												<input style="width: 250px;" id="itemno_tocart_<?php echo $row['Item_Pattern_Name']	.	'_'	.	sprintf("%04d",$row['Item_screen']); ?>"	value="0000000000<?php echo $row['Item_pattern'].$row['Item_screen'];?>0000" >
											</div>
											<div class="col-9 text-right">
												<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-outline-primary" onclick="addtocart($('#itemno_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']); ?>').val(),$('#qty_tocart_<?php echo $row['Item_Pattern_Name'].'_'.sprintf("%04d",$row['Item_screen']);?>').val());">Add To Cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body text-center">
								<p class="card-text"> <?php echo 'ลายที่' . $row['Item_screen']; ?> </p>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-6">
										<span style="font-size: 14px;">
											<span class="span-text-item" >Price</span>
										</span>
									</div>
									<div class="col-6 text-right">
										<span style="font-size: 14px;">
											<span class="span-text-item" >Qty</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$i++;
			}
			?>
		</div>
	</div>
</div>

<div id="noclick"></div>
<div id="text">เลือกลูกค้าก่อน</div>