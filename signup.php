<?php
require_once('classes/accounts_classes.php');

//Declaration 
$error = array();
$create_user = new accounts_class();

#get data from form
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	
	$first_name = $create_user->security($_POST['first']);
	$last_name = $create_user->security($_POST['last']);
	$email = $create_user->security($_POST['email']);
	$national = $create_user->security($_POST['myid']);
	$phone = $create_user->security($_POST['phone']);
	$password = $create_user->security($_POST['password']);
	$confirm_pass = $create_user->security($_POST['confirm_pass']);

	if ($password != $confirm_pass) {
		array_push($error, "Passwords do not match!");
	}else if($first_name == ""){
		array_push($error, "First Name can not be empty!");
	}else if($last_name == ""){
		array_push($error, "Last Name can not be empty!");
	}else if($email == ""){
		array_push($error, "Email can not be empty!");
	}else if($phone == ""){
		array_push($error, "Phone can not be empty!");
	}else if($national == ""){
		array_push($error, "National ID can not be empty!");
	}else if($password == ""){
		array_push($error, "Passwords can not be empty!");
	}else{
		$new_account = $create_user->create_account($first_name, $last_name, $email, $password, $phone, $national);
	}
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Create Account</title>
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
			<h2>Account Register</h2>
			<form action="signup.php" method="POST" enctype="multipart/form-data">
				<div class="col-md-6">
					<div class="login-mail">
						<input type="text" name="first" placeholder="First Name" required="">
						<i class="fa fa-user"></i>
					</div>
					<div class="login-mail">
						<input type="text" name="last" placeholder="Last Name" required="">
						<i class="fa fa-user"></i>
					</div>
					<div class="login-mail">
						<input type="text" name="email" placeholder="Email" required="">
						<i class="fa fa-envelope"></i>
					</div>
					<div class="login-mail">
						<input type="text" name="phone" placeholder="Phone Number" required="">
						<i class="fa fa-phone"></i>
					</div>
					<div class="login-mail">
						<input type="text" name="myid" placeholder="ID Number" required="">
						<i class="fa fa-pen"></i>
					</div>
					<div class="login-mail">
						<input type="password" name="password" placeholder="Password" required="">
						<i class="fa fa-lock"></i>
					</div>
					<div class="login-mail">
						<input type="password" name="confirm_pass" placeholder="Repeated password" required="">
						<i class="fa fa-lock"></i>
					</div>
		
				</div>
				<div class="col-md-6 login-do">
					<label class="hvr-shutter-in-horizontal login-sub">
						<input name="submit" type="submit" value="Create Account">
						</label>
						<p>Already register</p>
					<a href="index.php" class="hvr-shutter-in-horizontal">Login</a>
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

