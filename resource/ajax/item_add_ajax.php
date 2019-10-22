
 <?php
     include_once '../../config.php'; 
    header('Content-Type: text/html; charset=utf-8'); 

        $srvsql		    =	new	srvsql();
        $connect_pos	=	$srvsql->connect_pos();

$sql			=	"
					SELECT		[Item No_],
								[Source No_],
								[Document No_],
								[Description],
								[Location Code],
								SUM([Quantity]) as quantity,
								[Document Date],
								[Prod_ Order No_],
								[Item Category Code],
								[Lot No_],
								[Posting Date]
					FROM		[10.10.2.9].[CAL-GOLIVE].[dbo].[Caballo Co_,Ltd_\$Item Ledger Entry]
					WHERE		[Document No_] = '".$doc_no."'
					AND			[Entry Type] = 6
					AND			[Location Code] = 'WH-FG_02'
					GROUP BY	[Item No_],
								[Source No_],
								[Document No_],
								[Description],
								[Location Code],
								[Document Date],
								[Prod_ Order No_],
								[Item Category Code],
								[Lot No_],
								[Posting Date]
					";



$query			=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');


	 sqlsrv_close($connect_pos); 
?>