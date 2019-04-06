<?php
require_once('classes/accounts_classes.php');

//Declaration 
$error = array();
$create_user = new accounts_class();

#get form data and POST
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	
	$username = $create_user->security($_POST['username']);
	$password = $create_user->security($_POST['password']);

	if ($username == "") {
		array_push($error, "Username can not be empty!");
	}else if ($password == "") {
		array_push($error, "Password can not be empty!");
	}else{
		//echo $username ."<br>" . $password;
		$user_login = $create_user->account_login($username, $password);
	}

}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Account Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
</head>
<body>
	<div class="login">
		<center>
			<?php
			if (isset($_GET['msg'])) {
				?>
				<div class="alert alert-danger" role="alert" style="width: 400px;">
					<?php if (isset($_GET['msg'])) { echo $_GET['msg']; } ?>
				</div>
				<?php
			}
			?>
		</center>
		<h1><a href="index.php">TaskPay </a></h1>
		<div class="login-bottom">
			<h2>User Login</h2>
			<form action="index.php" method="POST" enctype="multipart/form-data">
			<div class="col-md-6">
				<div class="login-mail">
					<input type="text" name="username" placeholder="Email or Phone" value="<?php if(isset($_COOKIE['user_mail'])) { echo $_COOKIE['user_mail']; } ?>" required="">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" name="password" placeholder="Password" required="">
					<i class="fa fa-lock"></i>
				</div>
			
			</div>
			<div class="col-md-6 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" name="submit" value="Login">
					</label>
					<p>Do not have an account?</p>
				<a href="signup.php" class="hvr-shutter-in-horizontal">Signup</a>
				<br>
				<a style="color: red; font-family: calibri;" class="" href="forgot.php">Forgot Password</a>
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> &copy; 2019 TaskPay. All Rights Reserved .</p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

