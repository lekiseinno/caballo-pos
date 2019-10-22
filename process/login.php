
 <?php
     include_once '../config.php'; 
    header('Content-Type: text/html; charset=utf-8'); 

        $srvsql		    =	new	srvsql();
        $connect_pos	=	$srvsql->connect_pos();

	$username=trim($_POST['username']);
    $password=md5(trim($_POST['password']));
    echo $password;

	$sql		=	"
							SELECT	*
							FROM	[CBL-POS].[dbo].[employees] WHERE [emp_username] = '$username' AND [emp_password]='$password';
							";
			$query		=	sqlsrv_query($connect_pos,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
			$row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		
		


		
        print "<script>";
    if($row['emp_username']!=''){
        $_SESSION['emp_id']=$row['emp_id'];
		$_SESSION['emp_code']=$row['emp_code'];
		$_SESSION['emp_username']=$row['emp_username'];
        $_SESSION['emp_level']=$row['emp_level'];
        
        print "alert('ยินดีต้อนรับ');";
		print "window.location.href='../index.php'";
    }else{
        print "alert('username หริอ password ไม่ถูกต้อง');";
        print "window.location.href='../login.php'";
    }
	print "</script>";


	 sqlsrv_close($connect_pos); 
?>