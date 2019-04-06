	<?php
	//Include relevant files
	require_once('../classes/app_functions_classes.php');
	require_once('../classes/task_classes.php');
	require_once('../classes/myactions_classes.php');
	require_once('../classes/validate_classes.php');
	
	$val = new validate();
	
	$val->check_session();
	//instantiate new classes
	$app_functions = new app_functions();
	$task = new app_tasks();
	$actions = new myactions();

	#get data from form
	if (isset($_POST['submit']) && !empty($_POST['submit'])) {
		//Get specific job data
		$pref_location = $actions->security($_POST['location']);
		$pref_category = $actions->security($_POST['category']);
		$pref_type = $actions->security($_POST['type']);
		$account_id = $actions->security($_POST['account_id']);
		

		if ($pref_location == "" || $pref_category == "" || $pref_type == "" || $account_id == "") {
			?>
			<script type="text/javascript">
				alert("Fields can  not be empty!");
			</script>
			<?php
		}else{
			//echo $name . "<br>" . $pay . "<br>" . $location . "<br>" . $area . "<br>" . $account_id . "<br>" . $type . "<br>" . $duration . "<br>" . $category . "<br>" . $description . "<br>" . $filedir . "<br>"; 
			$add = $actions->set_preferences($pref_location, $pref_category, $pref_type, $account_id);
		}
	}

	?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/elements/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Preferences</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/nice-select.css">			
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Taskpay			
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="preferences.php"> Set your Preferences for a better experience.</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			
			<!-- Start Align Area -->
			<div class="whole-wrap">
				<div class="container">	
					<div class="section-top-border">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<?php
								if (isset($_COOKIE['validate_login_id'])) {
									$id = $_COOKIE['validate_login_id'];
									$actions->preferences($id);
								}
								?>
							</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Align Area -->


			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>			
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>	
			<script src="js/mail-script.js"></script>				
			<script src="js/main.js"></script>	
		</body>
	</html>