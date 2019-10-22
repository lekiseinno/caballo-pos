<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"		content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description"	content="Bootstrap Admin App + jQuery">
	<meta name="keywords"		content="app, responsive, jquery, bootstrap, dashboard, admin">
	<meta name="theme-color"	content="#C5E6FA">

	<title>LeKise :: E-leaves :: Signin</title>
	
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css" id="bscss">
	<link rel="stylesheet" href="css/app.css" id="maincss">
	<link rel="icon" type="image/png" href="favicon.png" />
	<style type="text/css">
		.bg-custom
		{
			background-image: url("img/bg/whitey.jpg");
			background-repeat: all;
		}
	</style>

	<!--[if lt IE 9]>
		<script type="text/javascript">
			alert('เบราเซอร์ที่กำลังใช้งาน ไม่รองรับกับความต้องการของระบบ \n\r\n\r กรุณาเข้าใช้งานผ่าน : Google Chrome , Firefox , Safari , IE10+');
		</script>
		<style type="text/css">
			body{
				display: none;
			}
		</style>
	<![endif]-->




</head>
<body>
	<div class="wrapper bg-custom">
		<div class="block-center mt-4 wd-xl">
			<div class="card card-flat">
				<div class="card-header text-center bg-dark">
					<a href="#">
						<img class="block-center rounded" src="img/logo_lekise.png" alt="Image">
					</a>
				</div>
				<div class="card-body">
					<p class="text-center py-2">SIGN IN TO CONTINUE.</p>
					<form class="mb-3" id="loginForm" role="form" novalidate="" action="process/signin.php" method="POST">
						<div class="form-group">
							<div class="input-group with-focus">
								<input class="form-control border-right-0" id="exampleInputEmail1" name="username" type="text" placeholder="Username" autocomplete="off" required>
								<div class="input-group-append">
									<span class="input-group-text fa fa-envelope text-muted bg-transparent border-left-0"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group with-focus">
								<input class="form-control border-right-0" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
								<div class="input-group-append">
									<span class="input-group-text fa fa-lock text-muted bg-transparent border-left-0"></span>
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="checkbox c-checkbox float-left mt-0">
								<label>
									<input type="checkbox" value="" name="remember">
									<span class="fa fa-check"></span>Remember Me
								</label>
							</div>
							<div class="float-right">
								<a class="text-muted" href="#">Forgot your password?</a>
							</div>
						</div>
						<button class="btn btn-block btn-primary mt-3" type="submit">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="vendor/modernizr/modernizr.custom.js"></script>
	<script src="vendor/jquery/dist/jquery.js"></script>
	<script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
	<script src="vendor/js-storage/js.storage.js"></script>
	<script src="vendor/parsleyjs/dist/parsley.js"></script>
	<script src="js/app.js"></script>
</body>
</html>