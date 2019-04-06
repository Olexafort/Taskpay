<?php
require_once('classes/accounts_classes.php');

?>

<!DOCTYPE HTML>
<html>
<head>
<title>504 Error</title>
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
		
		<h1><a href="index.php">TaskPay 504 Error Page</a></h1>
		<div class="login-bottom">
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
			<div class="login-bottom">
				<div class="col-md-12 login-do">
					<a href="index.php" class="hvr-shutter-in-horizontal">Back Home</a>
				</div>
				
				<div class="clearfix"> </div>
				</form>
			</div>
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

