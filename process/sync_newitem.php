<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();
	$sql_head		=	"
					INSERT INTO [CBL-POS].[dbo].[item\$]
					SELECT		i.[No_],
								i.[Description],
								i.[Description 2],
								i.[Base Unit of Measure],
								i.[Short ID],
								i.[Item Category Code],
								i.[Shortcut Dimension 80 Code],
								i.[Shortcut Dimension 81 Code],
								i.[Shortcut Dimension 82 Code],
								i.[Shortcut Dimension 83 Code],
								i.[Shortcut Dimension 84 Code],
								i.[Shortcut Dimension 85 Code],
								i.[Shortcut Dimension 86 Code],
								i.[Shortcut Dimension 87 Code],
								i.[Shortcut Dimension 88 Code]
					FROM		[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry]	q
					INNER JOIN	[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item]					i	ON	i.No_	=	q.[Item No_]
					WHERE		q.[Location Code]	=	'WH-FG_02'
					EXCEPT
					SELECT		[No_],
								[Description],
								[Description 2],
								[Base Unit of Measure],
								[Short ID],
								[Item Category Code],
								[item_type],
								[item_cotton],
								[item_color],
								[item_arm],
								[item_bag],
								[item_pattern],
								[item_screen],
								[item_accessory],
								[item_size]
					FROM		[CBL-POS].[dbo].[item\$]
					";
$query_head	=	sqlsrv_query($connect_pos,$sql_head) or die( 'SQL Error = '.$sql_head.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');



$sql_qty		=	"
					INSERT INTO [CBL-POS].[dbo].[Import_item]
					SELECT		'IMPORT-000',
								GETDATE(),
								[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry].[Item No_],SUM([CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry].[Quantity]) as 'Qty',
								'Import DataBase Admin',
								GETDATE(),
								GETDATE()
					FROM		[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry]
					WHERE		[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry].[Item No_] IN 
								(
									SELECT		i.[No_]
									FROM		[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry]	q
									INNER JOIN	[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item]				i	ON	i.[No_]	=	q.[Item No_]
									WHERE		q.[Location Code]  = 'WH-FG_02'
									GROUP BY	i.[No_]
									EXCEPT
									SELECT		[Item_No]
									FROM		[CBL-POS].[dbo].[Import_item]
								)
					GROUP BY	[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry].[Item No_]
					";
$query_head	=	sqlsrv_query($connect_pos,$sql_qty) or die( 'SQL Error = '.$sql_qty.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
echo "success";
?>