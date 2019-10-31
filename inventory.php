<?php include_once 'config.php'; ?>
<?php include_once 'head.php'; ?>
<?php include_once 'alert.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once 'left.php'; ?>
<?php include_once 'body-start-noright.php'; ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();




$sql_type		=	"
					SELECT		SUBSTRING([Item No_],1,1) as 'Type',
								CASE
									WHEN	SUBSTRING([Item No_],1,1)	=	'1'	THEN	'เสื้อยืด'
									WHEN	SUBSTRING([Item No_],1,1)	=	'2'	THEN	'เสื้อมัดกัด'
									WHEN	SUBSTRING([Item No_],1,1)	=	'3'	THEN	'สเวตเตอร์'
									WHEN	SUBSTRING([Item No_],1,1)	=	'4'	THEN	'สเวตเตอร์+หมวก'
									WHEN	SUBSTRING([Item No_],1,1)	=	'5'	THEN	'เสื้อฮูด'
									WHEN	SUBSTRING([Item No_],1,1)	=	'6'	THEN	'โปโล'
									WHEN	SUBSTRING([Item No_],1,1)	=	'7'	THEN	'เสื้อมัดย้อม'
									WHEN	SUBSTRING([Item No_],1,1)	=	'8'	THEN	'เสื้อคอวี'
									WHEN	SUBSTRING([Item No_],1,1)	=	'9'	THEN	'เสื้อกล้าม'
									WHEN	SUBSTRING([Item No_],1,1)	=	'A'	THEN	'กางเกงผู้ใหญ่'
									WHEN	SUBSTRING([Item No_],1,1)	=	'B'	THEN	'กางเกงเด็ก'
									WHEN	SUBSTRING([Item No_],1,1)	=	'C'	THEN	'มัดกัดกางเกงเด็ก'
									WHEN	SUBSTRING([Item No_],1,1)	=	'D'	THEN	'มัดกัดกางเกงผู้ใหญ่'
									WHEN	SUBSTRING([Item No_],1,1)	=	'E'	THEN	'เสื้อมัดย้อม CTD-2'
									WHEN	SUBSTRING([Item No_],1,1)	=	'F'	THEN	'เสื้อกล้ามมัดกัด'
									WHEN	SUBSTRING([Item No_],1,1)	=	'G'	THEN	'เสื้อกล้าม CTD-1'
									WHEN	SUBSTRING([Item No_],1,1)	=	'H'	THEN	'เสื้อกล้าม CTD-2'
									WHEN	SUBSTRING([Item No_],1,1)	=	'I'	THEN	'เสื้อdess'
									WHEN	SUBSTRING([Item No_],1,1)	=	'J'	THEN	'เสื้อพิเศษ'
									WHEN	SUBSTRING([Item No_],1,1)	=	'K'	THEN	'เสื้อเดรสคอวี'
									WHEN	SUBSTRING([Item No_],1,1)	=	'L'	THEN	'ผ้าชิ้น'
									WHEN	SUBSTRING([Item No_],1,1)	=	'M'	THEN	'ผ้าเกรด B'
									WHEN	SUBSTRING([Item No_],1,1)	=	'N'	THEN	'กระเป๋า'
									WHEN	SUBSTRING([Item No_],1,1)	=	'O'	THEN	'เสื้อRASTA STYLE'
									WHEN	SUBSTRING([Item No_],1,1)	=	'P'	THEN	'เสื้อขึ้นไหล่ SX'
									WHEN	SUBSTRING([Item No_],1,1)	=	'Q'	THEN	'เสื้อมัดกัดขึ้นไหล่ SX'
									WHEN	SUBSTRING([Item No_],1,1)	=	'R'	THEN	'เสื้อกล้ามมัดย้อม'
									WHEN	SUBSTRING([Item No_],1,1)	=	'S'	THEN	'เสื้อฮูด ซิปเหล็ก'
									WHEN	SUBSTRING([Item No_],1,1)	=	'T'	THEN	'ผ้ากับเปื้อน'
									WHEN	SUBSTRING([Item No_],1,1)	=	'U'	THEN	'เสื้อช็อป'
									WHEN	SUBSTRING([Item No_],1,1)	=	'V'	THEN	'มัดกัดโค้ง'
									WHEN	SUBSTRING([Item No_],1,1)	=	'W'	THEN	''
									WHEN	SUBSTRING([Item No_],1,1)	=	'X'	THEN	''
									WHEN	SUBSTRING([Item No_],1,1)	=	'Y'	THEN	''
									WHEN	SUBSTRING([Item No_],1,1)	=	'Z'	THEN	''
									WHEN	SUBSTRING([Item No_],1,1)	=	'0'	THEN	''
								END as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],1,1)
					ORDER BY	SUBSTRING([Item No_],1,1)	ASC
					";
$sql_cotton		=	"
					SELECT		SUBSTRING([Item No_],2,1) as 'Cotton',
								CASE
									WHEN	SUBSTRING([Item No_],2,1)	=	'1'	THEN	'มาตรฐาน CB'
									WHEN	SUBSTRING([Item No_],2,1)	=	'2'	THEN	'ขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'3'	THEN	'WD ผ้าขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'4'	THEN	'RT ผ้าขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'5'	THEN	'พระราม ผ้าขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'6'	THEN	'WD ผ้ามาตรฐาน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'7'	THEN	'RT ผ้ามาตรฐาน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'8'	THEN	'พระราม ผ้ามาตรฐาน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'9'	THEN	'ป้ายลูกค้า + ผ้ามาตรฐาน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'0'	THEN	'ผ้าเกร็ดปลาพระราม'
									WHEN	SUBSTRING([Item No_],2,1)	=	'A'	THEN	'ป้ายลูกค้า + ขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'B'	THEN	'ผ้าเกร็ดปลาลูกค้า'
									WHEN	SUBSTRING([Item No_],2,1)	=	'C'	THEN	'ผ้าTC'
									WHEN	SUBSTRING([Item No_],2,1)	=	'D'	THEN	'Billy Eight ผ้ามาตรฐาน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'E'	THEN	'Billy Eight ผ้าขูดขน'
									WHEN	SUBSTRING([Item No_],2,1)	=	'F'	THEN	'ผ้าลูกค้า'
									WHEN	SUBSTRING([Item No_],2,1)	=	'G'	THEN	'เขียวเหลืองแดง'
									WHEN	SUBSTRING([Item No_],2,1)	=	'H'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'I'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'J'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'K'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'L'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'M'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'N'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'O'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'P'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'Q'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'R'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'S'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'T'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'U'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'V'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'W'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'X'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'Y'	THEN	''
									WHEN	SUBSTRING([Item No_],2,1)	=	'Z'	THEN	''
								END as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],2,1)
					ORDER BY	SUBSTRING([Item No_],2,1)	ASC
					";
$sql_color		=	"
					SELECT		SUBSTRING([Item No_],3,2) as 'color',
								CASE
									WHEN	SUBSTRING([Item No_],3,2)	=	'00'	THEN	'แยกสีไม่ได้'
									WHEN	SUBSTRING([Item No_],3,2)	=	'01'	THEN	'สีดำ'
									WHEN	SUBSTRING([Item No_],3,2)	=	'02'	THEN	'สีแดง'
									WHEN	SUBSTRING([Item No_],3,2)	=	'03'	THEN	'สีเหลือง'
									WHEN	SUBSTRING([Item No_],3,2)	=	'04'	THEN	'สีเขียว'
									WHEN	SUBSTRING([Item No_],3,2)	=	'05'	THEN	'สีส้ม'
									WHEN	SUBSTRING([Item No_],3,2)	=	'06'	THEN	'สีม่วง'
									WHEN	SUBSTRING([Item No_],3,2)	=	'07'	THEN	'สีฟ้า'
									WHEN	SUBSTRING([Item No_],3,2)	=	'08'	THEN	'สีน้ำตาล'
									WHEN	SUBSTRING([Item No_],3,2)	=	'09'	THEN	'สีเทา'
									WHEN	SUBSTRING([Item No_],3,2)	=	'10'	THEN	'สีน้ำเงิน'
									WHEN	SUBSTRING([Item No_],3,2)	=	'11'	THEN	'สีดำ01.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'12'	THEN	'สีแดง02.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'13'	THEN	'สีเหลือง03.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'14'	THEN	'สีเขียว04.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'15'	THEN	'สีส้ม05.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'16'	THEN	'สีม่วง06.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'17'	THEN	'สีฟ้า07.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'18'	THEN	'สีน้ำตาล08.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'19'	THEN	'สีเทา09.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'20'	THEN	'สีน้ำเงิน10.1'
									WHEN	SUBSTRING([Item No_],3,2)	=	'21'	THEN	'สีขาว'
									WHEN	SUBSTRING([Item No_],3,2)	=	'22'	THEN	'สีชมพู'
									WHEN	SUBSTRING([Item No_],3,2)	=	'31'	THEN	'สีดำ01.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'32'	THEN	'สีแดง02.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'33'	THEN	'สีเหลือง03.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'34'	THEN	'สีเขียว04.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'35'	THEN	'สีส้ม05.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'36'	THEN	'สีม่วง06.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'37'	THEN	'สีฟ้า07.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'38'	THEN	'สีน้ำตาล08.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'39'	THEN	'สีเทา09.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'40'	THEN	'สีน้ำเงิน10.2'
									WHEN	SUBSTRING([Item No_],3,2)	=	'41'	THEN	'สีดำ01.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'42'	THEN	'สีแดง02.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'43'	THEN	'สีเหลือง03.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'44'	THEN	'สีเขียว04.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'45'	THEN	'สีส้ม05.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'46'	THEN	'สีม่วง06.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'47'	THEN	'สีฟ้า07.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'48'	THEN	'สีน้ำตาล08.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'49'	THEN	'สีเทา09.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'50'	THEN	'สีน้ำเงิน10.3'
									WHEN	SUBSTRING([Item No_],3,2)	=	'80'	THEN	'ชมพูNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'81'	THEN	'ดำNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'82'	THEN	'เขียวNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'83'	THEN	'ส้มNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'84'	THEN	'ม่วงNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'85'	THEN	'น้ำตาลNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'86'	THEN	'น้ำเงินเข้มNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'87'	THEN	'น้ำเงินNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'88'	THEN	'เทาNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'89'	THEN	'ฟ้าNEW'
									WHEN	SUBSTRING([Item No_],3,2)	=	'96'	THEN	'สีรุ้ง'
									WHEN	SUBSTRING([Item No_],3,2)	=	'97'	THEN	'สีรุ้งพลาสเทล'
									WHEN	SUBSTRING([Item No_],3,2)	=	'98'	THEN	'ขาวมัดย้อม'
									WHEN	SUBSTRING([Item No_],3,2)	=	'99'	THEN	'เขียวเหลืองแดง'
								END as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],3,2)
					ORDER BY	SUBSTRING([Item No_],3,2)	ASC
					";
$sql_arm		=	"
					SELECT		SUBSTRING([Item No_],5,1) as 'arm',
								CASE
									WHEN	SUBSTRING([Item No_],5,1)	=	'0'	THEN	'ทั่วไป'
									WHEN	SUBSTRING([Item No_],5,1)	=	'1'	THEN	'ยาว(แขน,ขา)'
									WHEN	SUBSTRING([Item No_],5,1)	=	'2'	THEN	'สั้น(แขน,ขา)'
									WHEN	SUBSTRING([Item No_],5,1)	=	'3'	THEN	'กุด(แขน,ขา)'
									WHEN	SUBSTRING([Item No_],5,1)	=	'4'	THEN	'ผ้ากันเปื้อนครึ่งตัว'
									WHEN	SUBSTRING([Item No_],5,1)	=	'5'	THEN	'ผ้ากันเปื้อนเต็มตัว'
								END	as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],5,1)
					ORDER BY	SUBSTRING([Item No_],5,1)	ASC
					";
$sql_bag		=	"
					SELECT		SUBSTRING([Item No_],6,1) as 'bag',
								CASE
									WHEN	SUBSTRING([Item No_],6,1)	=	'0'	THEN	'ทั่วไป'
									WHEN	SUBSTRING([Item No_],6,1)	=	'1'	THEN	'กระเป๋าหน้า'
									WHEN	SUBSTRING([Item No_],6,1)	=	'2'	THEN	'กระเป๋าข้าง'
									WHEN	SUBSTRING([Item No_],6,1)	=	'-'	THEN	'กระเป๋าหลัง'
								END	as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],6,1)
					ORDER BY	SUBSTRING([Item No_],6,1)	ASC
					";
$sql_line_f		=	"
					SELECT		SUBSTRING([Item No_],7,2) as 'line_f',
								CASE
									WHEN	SUBSTRING([Item No_],7,2)	=	'01'	THEN	'Animal Fantasy'
									WHEN	SUBSTRING([Item No_],7,2)	=	'02'	THEN	'Bike Fantasy'
									WHEN	SUBSTRING([Item No_],7,2)	=	'03'	THEN	'Big Face'
									WHEN	SUBSTRING([Item No_],7,2)	=	'04'	THEN	'Dark Fantasy'
									WHEN	SUBSTRING([Item No_],7,2)	=	'05'	THEN	'Fantasy'
									WHEN	SUBSTRING([Item No_],7,2)	=	'06'	THEN	'Soldier Fantasy'
									WHEN	SUBSTRING([Item No_],7,2)	=	'07'	THEN	'Music'
									WHEN	SUBSTRING([Item No_],7,2)	=	'08'	THEN	'4D'
									WHEN	SUBSTRING([Item No_],7,2)	=	'09'	THEN	'MC'
									WHEN	SUBSTRING([Item No_],7,2)	=	'10'	THEN	'WO'
									WHEN	SUBSTRING([Item No_],7,2)	=	'11'	THEN	'GWO'
									WHEN	SUBSTRING([Item No_],7,2)	=	'12'	THEN	'RTO'
									WHEN	SUBSTRING([Item No_],7,2)	=	'13'	THEN	'ORDER'
									WHEN	SUBSTRING([Item No_],7,2)	=	'14'	THEN	'ROCK'
									WHEN	SUBSTRING([Item No_],7,2)	=	'15'	THEN	'4D-OD'
									WHEN	SUBSTRING([Item No_],7,2)	=	'16'	THEN	'Kids'
									WHEN	SUBSTRING([Item No_],7,2)	=	'17'	THEN	'SX'
									WHEN	SUBSTRING([Item No_],7,2)	=	'18'	THEN	'4D-SX'
									WHEN	SUBSTRING([Item No_],7,2)	=	'19'	THEN	'4DX'
									WHEN	SUBSTRING([Item No_],7,2)	=	'20'	THEN	'4DX (NO JELLY)'
									WHEN	SUBSTRING([Item No_],7,2)	=	'21'	THEN	'W'
									WHEN	SUBSTRING([Item No_],7,2)	=	'22'	THEN	'GW'
									WHEN	SUBSTRING([Item No_],7,2)	=	'23'	THEN	'RT'
									WHEN	SUBSTRING([Item No_],7,2)	=	'24'	THEN	'TDG'
									WHEN	SUBSTRING([Item No_],7,2)	=	'25'	THEN	'ลายลูกค้า'
									WHEN	SUBSTRING([Item No_],7,2)	=	'26'	THEN	'WC'
									WHEN	SUBSTRING([Item No_],7,2)	=	'27'	THEN	'เสื้อพนักงาน'
								END	as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],7,2)
					ORDER BY	SUBSTRING([Item No_],7,2)	ASC
					";
$sql_line_b		=	"
					SELECT		SUBSTRING([Item No_],13,2) as 'line_b',
								CASE
									WHEN	SUBSTRING([Item No_],13,2)	=	'01'	THEN	'Animal Fantasy'
									WHEN	SUBSTRING([Item No_],13,2)	=	'02'	THEN	'Bike Fantasy'
									WHEN	SUBSTRING([Item No_],13,2)	=	'03'	THEN	'Big Face'
									WHEN	SUBSTRING([Item No_],13,2)	=	'04'	THEN	'Dark Fantasy'
									WHEN	SUBSTRING([Item No_],13,2)	=	'05'	THEN	'Fantasy'
									WHEN	SUBSTRING([Item No_],13,2)	=	'06'	THEN	'Soldier Fantasy'
									WHEN	SUBSTRING([Item No_],13,2)	=	'07'	THEN	'Music'
									WHEN	SUBSTRING([Item No_],13,2)	=	'08'	THEN	'MC'
									WHEN	SUBSTRING([Item No_],13,2)	=	'09'	THEN	'BW'
									WHEN	SUBSTRING([Item No_],13,2)	=	'10'	THEN	'BG'
									WHEN	SUBSTRING([Item No_],13,2)	=	'11'	THEN	'BR'
									WHEN	SUBSTRING([Item No_],13,2)	=	'12'	THEN	'BC'
									WHEN	SUBSTRING([Item No_],13,2)	=	'13'	THEN	'ORDER'
									WHEN	SUBSTRING([Item No_],13,2)	=	'14'	THEN	'ROCK'
									WHEN	SUBSTRING([Item No_],13,2)	=	'15'	THEN	'4DX'
								END	as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],13,2)
					ORDER BY	SUBSTRING([Item No_],13,2)	ASC
					";
$sql_size		=	"
					SELECT		SUBSTRING([Item No_],19,2) as 'size',
								CASE
									WHEN	SUBSTRING([Item No_],19,2)	=	'00'	THEN	'Free Size'
									WHEN	SUBSTRING([Item No_],19,2)	=	'01'	THEN	'ผู้ใหญ่ Size SS'
									WHEN	SUBSTRING([Item No_],19,2)	=	'02'	THEN	'ผู้ใหญ่ Size S'
									WHEN	SUBSTRING([Item No_],19,2)	=	'03'	THEN	'ผู้ใหญ่ Size M'
									WHEN	SUBSTRING([Item No_],19,2)	=	'04'	THEN	'ผู้ใหญ่ Size L'
									WHEN	SUBSTRING([Item No_],19,2)	=	'05'	THEN	'ผู้ใหญ่ Size XL'
									WHEN	SUBSTRING([Item No_],19,2)	=	'06'	THEN	'ผู้ใหญ่ Size 2XL'
									WHEN	SUBSTRING([Item No_],19,2)	=	'07'	THEN	'ผู้ใหญ่ Size 3XL'
									WHEN	SUBSTRING([Item No_],19,2)	=	'08'	THEN	'ผู้ใหญ่ Size 4XL'
									WHEN	SUBSTRING([Item No_],19,2)	=	'09'	THEN	'เด็ก Size 2-4'
									WHEN	SUBSTRING([Item No_],19,2)	=	'10'	THEN	'เด็ก Size 4-6'
									WHEN	SUBSTRING([Item No_],19,2)	=	'11'	THEN	'เด็ก Size 6-8'
									WHEN	SUBSTRING([Item No_],19,2)	=	'12'	THEN	'เด็ก Size 8-10'
									WHEN	SUBSTRING([Item No_],19,2)	=	'13'	THEN	'เด็ก Size 10-12'
									WHEN	SUBSTRING([Item No_],19,2)	=	'14'	THEN	'เด็ก Size 12-14'
								END	as 'val'
					FROM		[CBL-POS].[dbo].[item]
					WHERE		LEN([Item No_])	=	'20'
					GROUP BY	SUBSTRING([Item No_],19,2)
					ORDER BY	SUBSTRING([Item No_],19,2)	ASC
					";









?>
<div style="padding-left: 1%; padding-right: 1%; margin-top: 1%;">
	<div class="card">
		<div class="card-header">
			Filter
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						$query		=	sqlsrv_query($connect_pos,$sql_type) or die( 'SQL Error = '.$sql_type.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['Type'] ?>"><?php echo $row['Type'].' | '.$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_cotton) or die( 'SQL Error = '.$sql_cotton.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['Cotton'] ?>"><?php echo $row['Cotton']. ' | ' .$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_color) or die( 'SQL Error = '.$sql_color.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['color'] ?>"><?php echo $row['color'] . ' | ' . $row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_arm) or die( 'SQL Error = '.$sql_arm.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['arm'] ?>"><?php echo $row['arm'].' | '.$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_bag) or die( 'SQL Error = '.$sql_bag.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['bag'] ?>"><?php echo $row['bag'].' | '.$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_line_f) or die( 'SQL Error = '.$sql_line_f.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['line_f'] ?>"><?php echo $row['line_f'].' | '.$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						$query		=	sqlsrv_query($connect_pos,$sql_line_b) or die( 'SQL Error = '.$sql_line_b.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['line_b'] ?>"><?php echo $row['line_b'].' | '.$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<select class="form-control">
						<option selected disabled>== select ==</option>
						<?php
						
						$query		=	sqlsrv_query($connect_pos,$sql_size) or die( 'SQL Error = '.$sql_size.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
						$i			=	0;
						while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
						{
							?>
							<option value="<?php echo $row['size'] ?>"><?php echo $row['size']. ' | ' .$row['val'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<button class="btn btn-info">
						Search
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="table-responsive padding-table" style="height: 100%; overflow: auto; font-size: 12px;">
	<table class="table table-hover table-bordered" id="example">
		<thead>
			<tr>
				<th>Code</th>
				<th>Description</th>
				<th>Category</th>
				<th>Quantity</th>
				<th>Unit</th>
				<th>ปลีก</th>
				<th>ส่ง</th>
				<th>Menu</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql		=	"
							SELECT	TOP 10 *
							FROM	[CBL-POS].[dbo].[item]
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$i			=	0;
			while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				?><tr><td><?php echo $row['Item No_']; ?></td><td><?php echo $row['Description']; ?></td><td><?php echo $row['Item Category Code']; ?></td><td><?php echo number_format($row['Remaining Quantity'],0); ?></td><td><?php echo $row['Unit of Measure Code']; ?></td><td><?php echo number_format($row['Retail Price'],2); ?></td><td><?php echo number_format($row['Wholesales Price'],2); ?></td>
					<td>
						<a href="#" class="btn btn-outline-info" onclick="adjust_item('<?php echo $row['Item No_']; ?>');"> <i class="fas fa-plus"></i> </a>
						<a href="#" class="btn btn-outline-warning" onclick="tf_item('<?php echo $row['Item No_']; ?>');"> <i class="fas fa-random"></i> </a>
					</td>
					</tr><?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>



<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
	function adjust_item(item_no)
	{
		var Quantity = prompt('Adjust Item no : ' + '\''+item_no+'\'');
		var	uri		=	'process/item_adjust.php?item_no='+item_no+"&Quantity="+Quantity
		$.get( uri , function( input ) {
			location.reload();
		});
	}
	function tf_item(item_no)
	{
		var Quantity = prompt('Tranfer Item no : ' + '\''+item_no+'\'');
		var	uri		=	'process/item_tranfer.php?item_no='+item_no+"&Quantity="+Quantity
		$.get( uri , function( input ) {
			location.reload();
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable( {
			"order": [[ 3, "desc" ]],
			"pageLength": 12,
			buttons: [
				{
					text: 'คลังติดลบ',
					action: function ( e, dt, button, config ) {
						window.location = 'inventory-minus.php';
					}
				},
				{
					text: 'คลังตำหนิ',
					action: function ( e, dt, button, config ) {
						window.location = 'inventory-tf.php';
					}
				},
				{
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