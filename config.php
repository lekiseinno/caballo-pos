<?php
session_start();
$title				=	'Caballo POS';
$baseurl			=	'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$baseurl_resource	=	'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'resource/';

class srvsql
{/*
	public function connect_frontstore()
	{
		$serverName		=	"10.10.2.31";
		//$serverName			=	"lekise.dyndns.biz,1135";
		$connectionInfo		=	array(
										"Database"					=>	"CBL-front-store",
										"UID"						=>	"innovation_cbl",
										"PWD"						=>	"Passw0rd@1",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"				=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);
		$connect_frontstore	=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$connect_frontstore) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$connect_frontstore;
		}
	}
*/

	public function connect_pos()
	{
		$serverName		=	"10.10.2.31";
<<<<<<< HEAD
=======
		
>>>>>>> Last Final real real
		//$serverName			=	"lekise.dyndns.biz,1135";
		$connectionInfo		=	array(
										"Database"					=>	"CBL-POS",
										"UID"						=>	"innovation_cbl",
										"PWD"						=>	"Passw0rd@1",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"				=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);
		$connect_pos		=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$connect_pos) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$connect_pos;
		}
	}
	/*
	public function query($sql)
	{
		$connect	=	$this->connect();
		$query		=	sqlsrv_query($connect,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		$row		=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		return		$row;
	}
	*/
}




?>

