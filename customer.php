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





<div class="table-responsive padding-table" style="height: 100%; overflow: auto;">
	<table class="table table-hover table-bordered" id="example">
		<thead>
			<tr>
				<th style="width: 5%">Code</th>
				<th style="width: 1%">Region</th>
				<th>Name</th>
				<th style="width: 20%">Address</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Level</th>
				<th>Point</th>
				<th style="width: 13%">Detail</th>
				<th style="width: 1%"> </th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql		=	"
								SELECT		*
								FROM		[CBL-POS].[dbo].[customers]
								";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?>
				<tr>
					<td>
						<a class="btn btn-link" href="#" onclick="PopupCenter('customer_detail.php?Customer_code=<?php echo $row['Customer_code']; ?>','CBL-POS','1240','600');  ">
							<?php echo $row['Customer_code']; ?>
						</a>
					</td>
					<td class="text-center">
						<img class="flag-icon" src="resource/images/flag/<?php echo $row['Customer_region']; ?>.svg">
					</td>
					<td class="align-middle">
						<?php echo $row['Customer_FName'] . ' ' . $row['Customer_LName']; ?>
					</td>
					<td class="align-middle">
						<?php echo $row['Customer_Address']; ?>
					</td>
					<td class="align-middle"><?php echo $row['Customer_Tel']; ?></td>
					<td class="align-middle"><?php echo $row['Customer_Email']; ?></td>
					<td class="align-middle"><?php echo $row['Customer_Level']; ?></td>
					<td class="align-middle">0</td>
					<td class="align-middle">
						<?php
						$sql_detail		=	"
											SELECT		*
											FROM		[CBL-POS].[dbo].[customers]
											WHERE		[CBL-POS].[dbo].[customers].[Customer_code]		=	'".$row['Customer_code']."'
											";
						$query_detail	=	sqlsrv_query($connect_pos,$sql_detail) or die( 'SQL Error = '.$sql_detail.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$num[$i]		=	0;
						$total[$i]		=	0;
						while($row_detail		=	sqlsrv_fetch_array($query_detail,SQLSRV_FETCH_ASSOC))
						{
							$num[$i]	+=	$row_detail['Orders_detail_Qty'];
							$total[$i]	+=	$row_detail['Orders_detail_Price'];
						}
						echo 'Amount : <span style="color: green"><b>' . $num[$i] . '</b></span> | Item : <span style="color: green"><b>' . $total[$i] . '</b></span>';
						?>
					</td>
					<td class="align-middle">
						<a href="#" data-toggle="modal" data-target="#edit_<?php echo $row['Customer_code']; ?>">
							<i class="fas fa-pen" style="color:orange;"></i>
						</a>
						<div class="modal fade" id="edit_<?php echo $row['Customer_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit : <?php echo $row['Customer_code']; ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="POST" action="process/cus_edit.php?Customer_code=<?php echo $row['Customer_code']; ?>" >
										<div class="modal-body">
											<div class="row">
												<div class="col-2">
													<label>Region</label>
													<br>
													<select class="form-control" style="width: 100%;"  name="Customer_region_<?php echo $row['Customer_code']; ?>">
														<option value="<?php echo $row['Customer_region']; ?>"><?php echo $row['Customer_region']; ?></option>
														<option value="AD">AD - Andorra</option>
														<option value="AE">AE - United Arab Emirates</option>
														<option value="AF">AF - Afghanistan</option>
														<option value="AG">AG - Antigua and Barbuda</option>
														<option value="AI">AI - Anguilla</option>
														<option value="AL">AL - Albania</option>
														<option value="AM">AM - Armenia</option>
														<option value="AN">AN - Netherlands Antilles</option>
														<option value="AO">AO - Angola</option>
														<option value="AQ">AQ - Antarctica</option>
														<option value="AR">AR - Argentina</option>
														<option value="AS">AS - American Samoa</option>
														<option value="AT">AT - Austria</option>
														<option value="AU">AU - Australia</option>
														<option value="AW">AW - Aruba</option>
														<option value="AZ">AZ - Azerbaijan</option>
														<option value="BA">BA - Bosnia and Herzegovina</option>
														<option value="BB">BB - Barbados</option>
														<option value="BD">BD - Bangladesh</option>
														<option value="BE">BE - Belgium</option>
														<option value="BF">BF - Burkina Faso</option>
														<option value="BG">BG - Bulgaria</option>
														<option value="BH">BH - Bahrain</option>
														<option value="BI">BI - Burundi</option>
														<option value="BJ">BJ - Benin</option>
														<option value="BM">BM - Bermuda</option>
														<option value="BN">BN - Brunei Darussalam</option>
														<option value="BO">BO - Bolivia</option>
														<option value="BR">BR - Brazil</option>
														<option value="BS">BS - Bahamas</option>
														<option value="BT">BT - Bhutan</option>
														<option value="BV">BV - Bouvet Island</option>
														<option value="BW">BW - Botswana</option>
														<option value="BY">BY - Belarus</option>
														<option value="BZ">BZ - Belize</option>
														<option value="CA">CA - Canada</option>
														<option value="CC">CC - Cocos (Keeling Islands)</option>
														<option value="CF">CF - Central African Republic</option>
														<option value="CG">CG - Congo</option>
														<option value="CH">CH - Switzerland</option>
														<option value="CI">CI - Cote D’Ivoire (Ivory Coast)</option>
														<option value="CK">CK - Cook Islands</option>
														<option value="CL">CL - Chile</option>
														<option value="CM">CM - Cameroon</option>
														<option value="CN">CN - China</option>
														<option value="CO">CO - Colombia</option>
														<option value="CR">CR - Costa Rica</option>
														<option value="CU">CU - Cuba</option>
														<option value="CV">CV - Cape Verde</option>
														<option value="CX">CX - Christmas Island</option>
														<option value="CY">CY - Cyprus</option>
														<option value="CZ">CZ - Czech Republic</option>
														<option value="DE">DE - Germany</option>
														<option value="DJ">DJ - Djibouti</option>
														<option value="DK">DK - Denmark</option>
														<option value="DM">DM - Dominica</option>
														<option value="DO">DO - Dominican Republic</option>
														<option value="DZ">DZ - Algeria</option>
														<option value="EC">EC - Ecuador</option>
														<option value="EE">EE - Estonia</option>
														<option value="EG">EG - Egypt</option>
														<option value="EH">EH - Western Sahara</option>
														<option value="ER">ER - Eritrea</option>
														<option value="ES">ES - Spain</option>
														<option value="ET">ET - Ethiopia</option>
														<option value="FI">FI - Finland</option>
														<option value="FJ">FJ - Fiji</option>
														<option value="FK">FK - Falkland Islands (Malvinas)</option>
														<option value="FM">FM - Micronesia</option>
														<option value="FO">FO - Faroe Islands</option>
														<option value="FR">FR - France</option>
														<option value="FX">FX - France, Metropolitan</option>
														<option value="GA">GA - Gabon</option>
														<option value="GD">GD - Grenada</option>
														<option value="GE">GE - Georgia</option>
														<option value="GF">GF - French Guiana</option>
														<option value="GH">GH - Ghana</option>
														<option value="GI">GI - Gibraltar</option>
														<option value="GL">GL - Greenland</option>
														<option value="GM">GM - Gambia</option>
														<option value="GN">GN - Guinea</option>
														<option value="GP">GP - Guadeloupe</option>
														<option value="GQ">GQ - Equatorial Guinea</option>
														<option value="GR">GR - Greece</option>
														<option value="GS">GS - S. Georgia and S. Sandwich Isls.</option>
														<option value="GT">GT - Guatemala</option>
														<option value="GU">GU - Guam</option>
														<option value="GW">GW - Guinea-Bissau</option>
														<option value="GY">GY - Guyana</option>
														<option value="HK">HK - Hong Kong</option>
														<option value="HM">HM - Heard and McDonald Islands</option>
														<option value="HN">HN - Honduras</option>
														<option value="HR">HR - Croatia (Hrvatska)</option>
														<option value="HT">HT - Haiti</option>
														<option value="HU">HU - Hungary</option>
														<option value="ID">ID - Indonesia</option>
														<option value="IE">IE - Ireland</option>
														<option value="IL">IL - Israel</option>
														<option value="IN">IN - India</option>
														<option value="IO">IO - British Indian Ocean Territory</option>
														<option value="IQ">IQ - Iraq</option>
														<option value="IR">IR - Iran</option>
														<option value="IS">IS - Iceland</option>
														<option value="IT">IT - Italy</option>
														<option value="JM">JM - Jamaica</option>
														<option value="JO">JO - Jordan</option>
														<option value="JP">JP - Japan</option>
														<option value="KE">KE - Kenya</option>
														<option value="KG">KG - Kyrgyzstan (Kyrgyz Republic)</option>
														<option value="KH">KH - Cambodia</option>
														<option value="KI">KI - Kiribati</option>
														<option value="KM">KM - Comoros</option>
														<option value="KN">KN - Saint Kitts and Nevis</option>
														<option value="KP">KP - Korea (North) (People’s Republic)</option>
														<option value="KR">KR - Korea (South) (Republic)</option>
														<option value="KW">KW - Kuwait</option>
														<option value="KY">KY - Cayman Islands</option>
														<option value="KZ">KZ - Kazakhstan</option>
														<option value="LA">LA - Laos</option>
														<option value="LB">LB - Lebanon</option>
														<option value="LC">LC - Saint Lucia</option>
														<option value="LI">LI - Liechtenstein</option>
														<option value="LK">LK - Sri Lanka</option>
														<option value="LR">LR - Liberia</option>
														<option value="LS">LS - Lesotho</option>
														<option value="LT">LT - Lithuania</option>
														<option value="LU">LU - Luxembourg</option>
														<option value="LV">LV - Latvia</option>
														<option value="LY">LY - Libya</option>
														<option value="MA">MA - Morocco</option>
														<option value="MC">MC - Monaco</option>
														<option value="MD">MD - Moldova</option>
														<option value="ME">ME - Montenegro</option>
														<option value="MG">MG - Madagascar</option>
														<option value="MH">MH - Marshall Islands</option>
														<option value="MK">MK - Macedonia</option>
														<option value="ML">ML - Mali</option>
														<option value="MM">MM - Myanmar</option>
														<option value="MN">MN - Mongolia</option>
														<option value="MO">MO - Macau</option>
														<option value="MP">MP - Northern Mariana Islands</option>
														<option value="MQ">MQ - Martinique</option>
														<option value="MR">MR - Mauritania</option>
														<option value="MS">MS - Montserrat</option>
														<option value="MT">MT - Malta</option>
														<option value="MU">MU - Mauritius</option>
														<option value="MV">MV - Maldives</option>
														<option value="MW">MW - Malawi</option>
														<option value="MX">MX - Mexico</option>
														<option value="MY">MY - Malaysia</option>
														<option value="MZ">MZ - Mozambique</option>
														<option value="NA">NA - Namibia</option>
														<option value="NC">NC - New Caledonia</option>
														<option value="NE">NE - Niger</option>
														<option value="NF">NF - Norfolk Island</option>
														<option value="NG">NG - Nigeria</option>
														<option value="NI">NI - Nicaragua</option>
														<option value="NL">NL - Netherlands</option>
														<option value="NO">NO - Norway</option>
														<option value="NP">NP - Nepal</option>
														<option value="NR">NR - Nauru</option>
														<option value="NT">NT - Neutral Zone (Saudia Arabia/Iraq)</option>
														<option value="NU">NU - Niue</option>
														<option value="NZ">NZ - New Zealand</option>
														<option value="OM">OM - Oman</option>
														<option value="PA">PA - Panama</option>
														<option value="PE">PE - Peru</option>
														<option value="PF">PF - French Polynesia</option>
														<option value="PG">PG - Papua New Guinea</option>
														<option value="PH">PH - Philippines</option>
														<option value="PK">PK - Pakistan</option>
														<option value="PL">PL - Poland</option>
														<option value="PM">PM - St. Pierre and Miquelon</option>
														<option value="PN">PN - Pitcairn</option>
														<option value="PR">PR - Puerto Rico</option>
														<option value="PT">PT - Portugal</option>
														<option value="PW">PW - Palau</option>
														<option value="PY">PY - Paraguay</option>
														<option value="QA">QA - Qatar</option>
														<option value="RE">RE - Reunion</option>
														<option value="RO">RO - Romania</option>
														<option value="RS">RS - Serbia</option>
														<option value="RU">RU - Russian Federation</option>
														<option value="RW">RW - Rwanda</option>
														<option value="SA">SA - Saudi Arabia</option>
														<option value="SB">SB - Solomon Islands</option>
														<option value="SC">SC - Seychelles</option>
														<option value="SD">SD - Sudan</option>
														<option value="SE">SE - Sweden</option>
														<option value="SG">SG - Singapore</option>
														<option value="SH">SH - St. Helena</option>
														<option value="SI">SI - Slovenia</option>
														<option value="SJ">SJ - Svalbard and Jan Mayen Islands</option>
														<option value="SK">SK - Slovakia (Slovak Republic)</option>
														<option value="SL">SL - Sierra Leone</option>
														<option value="SM">SM - San Marino</option>
														<option value="SN">SN - Senegal</option>
														<option value="SO">SO - Somalia</option>
														<option value="SR">SR - Suriname</option>
														<option value="ST">ST - Sao Tome and Principe</option>
														<option value="SU">SU - Soviet Union (former)</option>
														<option value="SV">SV - El Salvador</option>
														<option value="SY">SY - Syria</option>
														<option value="SZ">SZ - Swaziland</option>
														<option value="TC">TC - Turks and Caicos Islands</option>
														<option value="TD">TD - Chad</option>
														<option value="TF">TF - French Southern Territories</option>
														<option value="TG">TG - Togo</option>
														<option value="TH">TH - Thailand</option>
														<option value="TJ">TJ - Tajikistan</option>
														<option value="TK">TK - Tokelau</option>
														<option value="TM">TM - Turkmenistan</option>
														<option value="TN">TN - Tunisia</option>
														<option value="TO">TO - Tonga</option>
														<option value="TP">TP - East Timor</option>
														<option value="TR">TR - Turkey</option>
														<option value="TT">TT - Trinidad and Tobago</option>
														<option value="TV">TV - Tuvalu</option>
														<option value="TW">TW - Taiwan</option>
														<option value="TZ">TZ - Tanzania</option>
														<option value="UA">UA - Ukraine</option>
														<option value="UG">UG - Uganda</option>
														<option value="UK">UK - United Kingdom (Great Britain)</option>
														<option value="UM">UM - US Minor Outlying Islands</option>
														<option value="US">US - United States</option>
														<option value="UY">UY - Uruguay</option>
														<option value="UZ">UZ - Uzbekistan</option>
														<option value="VA">VA - Vatican City State (Holy See)</option>
														<option value="VC">VC - Saint Vincent and The Grenadines</option>
														<option value="VE">VE - Venezuela</option>
														<option value="VG">VG - Virgin Islands (British)</option>
														<option value="VI">VI - Virgin Islands (US)</option>
														<option value="VN">VN - Viet Nam</option>
														<option value="VU">VU - Vanuatu</option>
														<option value="WF">WF - Wallis and Futuna Islands</option>
														<option value="WS">WS - Samoa</option>
														<option value="YE">YE - Yemen</option>
														<option value="YT">YT - Mayotte</option>
														<option value="YU">YU - Yugoslavia</option>
														<option value="ZA">ZA - South Africa</option>
														<option value="ZM">ZM - Zambia</option>
														<option value="ZR">ZR - Zaire</option>
														<option value="ZW">ZW - Zimbabwe</option>
													</select>
												</div>
												<div class="col-3">
													<label>ID Card</label>
													<input class="form-control" name="Customer_IDCard_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_IDCard']; ?>">
												</div>
												<div class="col-7">
													<div class="row">
														<div class="col-4">
															<label>First Name</label>
															<input class="form-control" name="Customer_FName_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_FName']; ?>">
														</div>
														<div class="col-4">
															<label>Last Name</label>
															<input class="form-control" name="Customer_LName_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_LName']; ?>">
														</div>
														<div class="col-4">
															<label>Nick Name</label>
															<input class="form-control" name="Customer_NickName_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_NickName']; ?>">
														</div>
													</div>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-12">
													<label>Address</label>
													<input class="form-control" name="Customer_Address_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_Address']; ?>">
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-2">
													<label>Tel</label>
													<input class="form-control" name="Customer_Tel_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_Tel']; ?>">
												</div>
												<div class="col-2">
													<label>Email</label>
													<input class="form-control" name="Customer_Email_<?php echo $row['Customer_code']; ?>" value="<?php echo $row['Customer_Email']; ?>">
												</div>
												<?php
												$social		=	explode(",", $row['Customer_Social']);
												$WhatApp	=	explode(" ", $social[0]);
												$WeChat		=	explode(" ", $social[1]);
												$Line		=	explode(" ", $social[2]);
												?>
												<div class="col-2">
													<label>WhatApp</label>
													<input class="form-control" name="Customer_WhatApp_<?php echo $row['Customer_code']; ?>" value="<?php echo $WhatApp[2]; ?>">
												</div>
												<div class="col-2">
													<label>WeChat</label>
													<input class="form-control" name="Customer_WeChat_<?php echo $row['Customer_code']; ?>" value="<?php echo $WeChat[2]; ?>">
												</div>
												<div class="col-2">
													<label>Line</label>
													<input class="form-control" name="Customer_Line_<?php echo $row['Customer_code']; ?>" value="<?php echo $Line[2]; ?>">
												</div>
											</div>
										
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form action="process/cus_chk.php" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Add new Customer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-2">
							<label>Region</label>
							<br>
							<select class="form-control" id="region" style="width: 100%;"  name="Customer_region">
								<option selected disabled>== select ==</option>
								<option value="AD">AD - Andorra</option>
								<option value="AE">AE - United Arab Emirates</option>
								<option value="AF">AF - Afghanistan</option>
								<option value="AG">AG - Antigua and Barbuda</option>
								<option value="AI">AI - Anguilla</option>
								<option value="AL">AL - Albania</option>
								<option value="AM">AM - Armenia</option>
								<option value="AN">AN - Netherlands Antilles</option>
								<option value="AO">AO - Angola</option>
								<option value="AQ">AQ - Antarctica</option>
								<option value="AR">AR - Argentina</option>
								<option value="AS">AS - American Samoa</option>
								<option value="AT">AT - Austria</option>
								<option value="AU">AU - Australia</option>
								<option value="AW">AW - Aruba</option>
								<option value="AZ">AZ - Azerbaijan</option>
								<option value="BA">BA - Bosnia and Herzegovina</option>
								<option value="BB">BB - Barbados</option>
								<option value="BD">BD - Bangladesh</option>
								<option value="BE">BE - Belgium</option>
								<option value="BF">BF - Burkina Faso</option>
								<option value="BG">BG - Bulgaria</option>
								<option value="BH">BH - Bahrain</option>
								<option value="BI">BI - Burundi</option>
								<option value="BJ">BJ - Benin</option>
								<option value="BM">BM - Bermuda</option>
								<option value="BN">BN - Brunei Darussalam</option>
								<option value="BO">BO - Bolivia</option>
								<option value="BR">BR - Brazil</option>
								<option value="BS">BS - Bahamas</option>
								<option value="BT">BT - Bhutan</option>
								<option value="BV">BV - Bouvet Island</option>
								<option value="BW">BW - Botswana</option>
								<option value="BY">BY - Belarus</option>
								<option value="BZ">BZ - Belize</option>
								<option value="CA">CA - Canada</option>
								<option value="CC">CC - Cocos (Keeling Islands)</option>
								<option value="CF">CF - Central African Republic</option>
								<option value="CG">CG - Congo</option>
								<option value="CH">CH - Switzerland</option>
								<option value="CI">CI - Cote D’Ivoire (Ivory Coast)</option>
								<option value="CK">CK - Cook Islands</option>
								<option value="CL">CL - Chile</option>
								<option value="CM">CM - Cameroon</option>
								<option value="CN">CN - China</option>
								<option value="CO">CO - Colombia</option>
								<option value="CR">CR - Costa Rica</option>
								<option value="CU">CU - Cuba</option>
								<option value="CV">CV - Cape Verde</option>
								<option value="CX">CX - Christmas Island</option>
								<option value="CY">CY - Cyprus</option>
								<option value="CZ">CZ - Czech Republic</option>
								<option value="DE">DE - Germany</option>
								<option value="DJ">DJ - Djibouti</option>
								<option value="DK">DK - Denmark</option>
								<option value="DM">DM - Dominica</option>
								<option value="DO">DO - Dominican Republic</option>
								<option value="DZ">DZ - Algeria</option>
								<option value="EC">EC - Ecuador</option>
								<option value="EE">EE - Estonia</option>
								<option value="EG">EG - Egypt</option>
								<option value="EH">EH - Western Sahara</option>
								<option value="ER">ER - Eritrea</option>
								<option value="ES">ES - Spain</option>
								<option value="ET">ET - Ethiopia</option>
								<option value="FI">FI - Finland</option>
								<option value="FJ">FJ - Fiji</option>
								<option value="FK">FK - Falkland Islands (Malvinas)</option>
								<option value="FM">FM - Micronesia</option>
								<option value="FO">FO - Faroe Islands</option>
								<option value="FR">FR - France</option>
								<option value="FX">FX - France, Metropolitan</option>
								<option value="GA">GA - Gabon</option>
								<option value="GD">GD - Grenada</option>
								<option value="GE">GE - Georgia</option>
								<option value="GF">GF - French Guiana</option>
								<option value="GH">GH - Ghana</option>
								<option value="GI">GI - Gibraltar</option>
								<option value="GL">GL - Greenland</option>
								<option value="GM">GM - Gambia</option>
								<option value="GN">GN - Guinea</option>
								<option value="GP">GP - Guadeloupe</option>
								<option value="GQ">GQ - Equatorial Guinea</option>
								<option value="GR">GR - Greece</option>
								<option value="GS">GS - S. Georgia and S. Sandwich Isls.</option>
								<option value="GT">GT - Guatemala</option>
								<option value="GU">GU - Guam</option>
								<option value="GW">GW - Guinea-Bissau</option>
								<option value="GY">GY - Guyana</option>
								<option value="HK">HK - Hong Kong</option>
								<option value="HM">HM - Heard and McDonald Islands</option>
								<option value="HN">HN - Honduras</option>
								<option value="HR">HR - Croatia (Hrvatska)</option>
								<option value="HT">HT - Haiti</option>
								<option value="HU">HU - Hungary</option>
								<option value="ID">ID - Indonesia</option>
								<option value="IE">IE - Ireland</option>
								<option value="IL">IL - Israel</option>
								<option value="IN">IN - India</option>
								<option value="IO">IO - British Indian Ocean Territory</option>
								<option value="IQ">IQ - Iraq</option>
								<option value="IR">IR - Iran</option>
								<option value="IS">IS - Iceland</option>
								<option value="IT">IT - Italy</option>
								<option value="JM">JM - Jamaica</option>
								<option value="JO">JO - Jordan</option>
								<option value="JP">JP - Japan</option>
								<option value="KE">KE - Kenya</option>
								<option value="KG">KG - Kyrgyzstan (Kyrgyz Republic)</option>
								<option value="KH">KH - Cambodia</option>
								<option value="KI">KI - Kiribati</option>
								<option value="KM">KM - Comoros</option>
								<option value="KN">KN - Saint Kitts and Nevis</option>
								<option value="KP">KP - Korea (North) (People’s Republic)</option>
								<option value="KR">KR - Korea (South) (Republic)</option>
								<option value="KW">KW - Kuwait</option>
								<option value="KY">KY - Cayman Islands</option>
								<option value="KZ">KZ - Kazakhstan</option>
								<option value="LA">LA - Laos</option>
								<option value="LB">LB - Lebanon</option>
								<option value="LC">LC - Saint Lucia</option>
								<option value="LI">LI - Liechtenstein</option>
								<option value="LK">LK - Sri Lanka</option>
								<option value="LR">LR - Liberia</option>
								<option value="LS">LS - Lesotho</option>
								<option value="LT">LT - Lithuania</option>
								<option value="LU">LU - Luxembourg</option>
								<option value="LV">LV - Latvia</option>
								<option value="LY">LY - Libya</option>
								<option value="MA">MA - Morocco</option>
								<option value="MC">MC - Monaco</option>
								<option value="MD">MD - Moldova</option>
								<option value="ME">ME - Montenegro</option>
								<option value="MG">MG - Madagascar</option>
								<option value="MH">MH - Marshall Islands</option>
								<option value="MK">MK - Macedonia</option>
								<option value="ML">ML - Mali</option>
								<option value="MM">MM - Myanmar</option>
								<option value="MN">MN - Mongolia</option>
								<option value="MO">MO - Macau</option>
								<option value="MP">MP - Northern Mariana Islands</option>
								<option value="MQ">MQ - Martinique</option>
								<option value="MR">MR - Mauritania</option>
								<option value="MS">MS - Montserrat</option>
								<option value="MT">MT - Malta</option>
								<option value="MU">MU - Mauritius</option>
								<option value="MV">MV - Maldives</option>
								<option value="MW">MW - Malawi</option>
								<option value="MX">MX - Mexico</option>
								<option value="MY">MY - Malaysia</option>
								<option value="MZ">MZ - Mozambique</option>
								<option value="NA">NA - Namibia</option>
								<option value="NC">NC - New Caledonia</option>
								<option value="NE">NE - Niger</option>
								<option value="NF">NF - Norfolk Island</option>
								<option value="NG">NG - Nigeria</option>
								<option value="NI">NI - Nicaragua</option>
								<option value="NL">NL - Netherlands</option>
								<option value="NO">NO - Norway</option>
								<option value="NP">NP - Nepal</option>
								<option value="NR">NR - Nauru</option>
								<option value="NT">NT - Neutral Zone (Saudia Arabia/Iraq)</option>
								<option value="NU">NU - Niue</option>
								<option value="NZ">NZ - New Zealand</option>
								<option value="OM">OM - Oman</option>
								<option value="PA">PA - Panama</option>
								<option value="PE">PE - Peru</option>
								<option value="PF">PF - French Polynesia</option>
								<option value="PG">PG - Papua New Guinea</option>
								<option value="PH">PH - Philippines</option>
								<option value="PK">PK - Pakistan</option>
								<option value="PL">PL - Poland</option>
								<option value="PM">PM - St. Pierre and Miquelon</option>
								<option value="PN">PN - Pitcairn</option>
								<option value="PR">PR - Puerto Rico</option>
								<option value="PT">PT - Portugal</option>
								<option value="PW">PW - Palau</option>
								<option value="PY">PY - Paraguay</option>
								<option value="QA">QA - Qatar</option>
								<option value="RE">RE - Reunion</option>
								<option value="RO">RO - Romania</option>
								<option value="RS">RS - Serbia</option>
								<option value="RU">RU - Russian Federation</option>
								<option value="RW">RW - Rwanda</option>
								<option value="SA">SA - Saudi Arabia</option>
								<option value="SB">SB - Solomon Islands</option>
								<option value="SC">SC - Seychelles</option>
								<option value="SD">SD - Sudan</option>
								<option value="SE">SE - Sweden</option>
								<option value="SG">SG - Singapore</option>
								<option value="SH">SH - St. Helena</option>
								<option value="SI">SI - Slovenia</option>
								<option value="SJ">SJ - Svalbard and Jan Mayen Islands</option>
								<option value="SK">SK - Slovakia (Slovak Republic)</option>
								<option value="SL">SL - Sierra Leone</option>
								<option value="SM">SM - San Marino</option>
								<option value="SN">SN - Senegal</option>
								<option value="SO">SO - Somalia</option>
								<option value="SR">SR - Suriname</option>
								<option value="ST">ST - Sao Tome and Principe</option>
								<option value="SU">SU - Soviet Union (former)</option>
								<option value="SV">SV - El Salvador</option>
								<option value="SY">SY - Syria</option>
								<option value="SZ">SZ - Swaziland</option>
								<option value="TC">TC - Turks and Caicos Islands</option>
								<option value="TD">TD - Chad</option>
								<option value="TF">TF - French Southern Territories</option>
								<option value="TG">TG - Togo</option>
								<option value="TH">TH - Thailand</option>
								<option value="TJ">TJ - Tajikistan</option>
								<option value="TK">TK - Tokelau</option>
								<option value="TM">TM - Turkmenistan</option>
								<option value="TN">TN - Tunisia</option>
								<option value="TO">TO - Tonga</option>
								<option value="TP">TP - East Timor</option>
								<option value="TR">TR - Turkey</option>
								<option value="TT">TT - Trinidad and Tobago</option>
								<option value="TV">TV - Tuvalu</option>
								<option value="TW">TW - Taiwan</option>
								<option value="TZ">TZ - Tanzania</option>
								<option value="UA">UA - Ukraine</option>
								<option value="UG">UG - Uganda</option>
								<option value="UK">UK - United Kingdom (Great Britain)</option>
								<option value="UM">UM - US Minor Outlying Islands</option>
								<option value="US">US - United States</option>
								<option value="UY">UY - Uruguay</option>
								<option value="UZ">UZ - Uzbekistan</option>
								<option value="VA">VA - Vatican City State (Holy See)</option>
								<option value="VC">VC - Saint Vincent and The Grenadines</option>
								<option value="VE">VE - Venezuela</option>
								<option value="VG">VG - Virgin Islands (British)</option>
								<option value="VI">VI - Virgin Islands (US)</option>
								<option value="VN">VN - Viet Nam</option>
								<option value="VU">VU - Vanuatu</option>
								<option value="WF">WF - Wallis and Futuna Islands</option>
								<option value="WS">WS - Samoa</option>
								<option value="YE">YE - Yemen</option>
								<option value="YT">YT - Mayotte</option>
								<option value="YU">YU - Yugoslavia</option>
								<option value="ZA">ZA - South Africa</option>
								<option value="ZM">ZM - Zambia</option>
								<option value="ZR">ZR - Zaire</option>
								<option value="ZW">ZW - Zimbabwe</option>
							</select>
							<script type="text/javascript">
								$('#region').select2();
							</script>
						</div>
						<div class="col-3">
							<label>ID Card</label>
							<input class="form-control" name="Customer_IDCard">
						</div>
						<div class="col-7">
							<div class="row">
								<div class="col-4">
									<label>First Name</label>
									<input class="form-control" name="Customer_FName">
								</div>
								<div class="col-4">
									<label>Last Name</label>
									<input class="form-control" name="Customer_LName">
								</div>
								<div class="col-4">
									<label>Nick Name</label>
									<input class="form-control" name="Customer_NickName">
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-12">
							<label>Address</label>
							<input class="form-control" name="Customer_Address">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-2">
							<label>Tel</label>
							<input class="form-control" name="Customer_Tel">
						</div>
						<div class="col-2">
							<label>Email</label>
							<input class="form-control" name="Customer_Email">
						</div>
						<div class="col-2">
							<label>WhatApp</label>
							<input class="form-control" name="Customer_WhatApp">
						</div>
						<div class="col-2">
							<label>WeChat</label>
							<input class="form-control" name="Customer_WeChat">
						</div>
						<div class="col-2">
							<label>Line</label>
							<input class="form-control" name="Customer_Line">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>




<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"order": [[ 0, "desc" ]],
			buttons: [
				{
					text: 'Add new Customer',
					action: function ( e, dt, button, config ) {
						$('#exampleModalCenter').modal('show')
					}
				},{
					extend:		'copyHtml5',
					text:		'<i class="far fa-copy"></i> copy',
					titleAttr:	'Copy'
				},{
					extend:		'excelHtml5',
					text:		'<i class="far fa-file-excel"></i> .xlsx',
					titleAttr:	'Excel'
				},{
					extend:		'csvHtml5',
					text:		'<i class="far fa-file-alt"></i> .csv',
					titleAttr:	'CSV'
				},{
					extend:		'pdfHtml5',
					text:		'<i class="far fa-file-pdf"></i> .pdf',
					titleAttr:	'PDF'
				}
			]
		});
		table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
	} );
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