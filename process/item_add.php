<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();


    $doc_no    =   trim($_POST['doc_no']);


    $sql        =   "
					SELECT			[Item No_],
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
						WHERE		[Document No_]	=	'".$doc_no."'
						AND			(
									[Entry Type]	=	4
									OR
									[Entry Type]	=	6
									)
						AND			[Location Code]	=	'WH-FG_02'
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



    $query	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

    $sql_lot_name		=	"
							SELECT	TOP 1 CAST(SUBSTRING([Lot Name], 8, 3) AS int) AS 'lot_name'
							FROM	[CBL-POS].[dbo].[item]
                            WHERE [Lot Name] LIKE '%".date('Ym')."%' order by [Lot Name] DESC";                 
    $query_lot_name	=	sqlsrv_query($connect_pos,$sql_lot_name) or die( 'SQL Error = '.$sql_lot_name.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
    $lot_name		=	sqlsrv_fetch_array($query_lot_name);
    $lot_name       =   date('Ym').'-'.sprintf("%03d",$lot_name['lot_name']+1);

    while ($row		=	sqlsrv_fetch_array($query)) {
        echo $row['Item No_'];

        $quantity   = $row['quantity']+0;
        $sql		=	"
							SELECT	MAX([Lot]) AS 'max_lot'
							FROM	[CBL-POS].[dbo].[item]
                            WHERE [Item No_]='".$row['Item No_']."'";
                            
        $query2	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');
        $max_lot		=	sqlsrv_fetch_array($query2);

        $max_lot     = $max_lot['max_lot']+1;

            
            $description        =   '';
            $item_cate          =   '';
            $unit               =   '';
            $retail_price       =   0;
            $wholesales_price   =   0;
            $sql		=	"
                                INSERT INTO	[CBL-POS].[dbo].[item]	(
                                    [Item No_]
                                    ,[Description]
                                    ,[Item Category Code]
                                    ,[Remaining Quantity]
                                    ,[Unit of Measure Code]
                                    ,[Retail Price]
                                    ,[Wholesales Price]
                                    ,[Lot]
                                    ,[Lot Name]
                                )
                                VALUES
                                (
                                    '".$row['Item No_']."',
                                    '".$row['Description']."',
                                    '".$row['Item Category Code']."',
                                    '".$quantity."',
                                    'ตัว',
                                    '0',
                                    '0',
                                    '".$max_lot."',
                                    '".$lot_name."'
                                )
                                ";
   
        $query3			=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

        $date=date('Y-m-d');
        $time=date('H:i:s');
        $emp_code=$_SESSION['emp_code'];
	    $import = 1;
        $sql="INSERT INTO [CBL-POS].[dbo].[item_log] (item_no,quantity,action_date,action_time,emp_code,import,po_no,lot_no,pdr,[Lot Name],Lot) VALUES('".$row['Item No_']."','$quantity','$date','$time','$emp_code','$import','','".$row['Lot No_']."','".$row['Prod_ Order No_']."','".$lot_name."','$max_lot')";
        
        $query4	=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$ssqll2.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');  

    }    

           echo "<script>alert('success');window.location.href='../inventory.php'</script>";


?>
