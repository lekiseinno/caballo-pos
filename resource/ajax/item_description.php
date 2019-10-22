
 <?php
     include_once '../../config.php'; 
    header('Content-Type: text/html; charset=utf-8'); 

        $srvsql		    =	new	srvsql();
        $connect_pos	=	$srvsql->connect_pos();

	$item_no=trim($_GET['item_no']);
    

	$sql		=	"
							SELECT	TOP 1 [Item No_],Description
							FROM	[CBL-POS].[dbo].[item] WHERE [Item No_] = '$item_no' ;
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		
		


		
        
    if($row['Item No_']!=''){
        echo $row['Description'];
    }else{
        echo '0';
    }
	

	 sqlsrv_close($connect_pos); 
?>