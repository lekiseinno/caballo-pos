<?php include_once '../config.php'; ?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
$srvsql				=	new	srvsql();
$connect_pos		=	$srvsql->connect_pos();





$sql		=	"
					UPDATE [dbo].[Orders_tmp]
					SET	Orders_tmp_Status   =   'cancel'
					WHERE [Orders_tmp_ID]	=	'".$_GET['Orders_tmp_ID']."'
					";
$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. 	print_r( sqlsrv_errors(), true) . '</pre>');

if($query){
    echo 1 ;
}else{
    echo 0 ;
}


?>
