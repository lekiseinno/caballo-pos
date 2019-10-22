<?php
$srvsql			=	new	srvsql();
$connect_pos	=	$srvsql->connect_pos();



function noworder_json($type,$q)
{
	global $connect_pos;
	$sql			=	"
						SELECT		*
						FROM		[Orders]
						INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
						WHERE		[Orders].[Orders_Session]	=	'".$q."'
						";
	$query			=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');

	if($type		=	'json')
	{
		while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$data[]	=	$row;
		}
		$return		=		json_encode($data);
	}

	return	$return;
}

function qty_in_cart($q)
{
	global $connect_pos;
	$sql		=	"
					SELECT		SUM(Orders_detail_Qty) as 'qty'
					FROM		[Orders]
					INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
					WHERE		[Orders].[Orders_Session]	=	'".$q."'
					";
	$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	$row		=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	return	$row['qty'];
}


function getdatetime($date)
{
	$d		=	explode(" ", $date);
	$date	=	explode("-", $d[0]);
	$time	=	explode(".", $d[1]);
	return	$date[2].'-'.$date[1].'-'.$date[0].' '.$time[0];
}
function gettimes($date)
{
	$d		=	explode(".", $date);
	return	$d[0];
	//$time	=	explode(".", $d[1]);
	//return	$time[0];
}
function getdates($date)
{
	$d		=	explode(" ", $date);
	$date	=	explode("-", $d[0]);
	return	$date[2].'/'.$date[1].'/'.$date[0];
}
<<<<<<< HEAD
=======


/*
function qty_in_cart($q)
{
	global $connect_pos;
	$sql		=	"
					SELECT		SUM(Orders_detail_Qty) as 'qty'
					FROM		[Orders]
					INNER JOIN	[Orders_detail]	ON	[Orders_detail].[Orders_No]	=	[Orders].[Orders_No]
					WHERE		[Orders].[Orders_Session]	=	'".$q."'
					";
	$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	$row		=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	return	$row['qty'];
}*/
>>>>>>> Last Final real real
?>