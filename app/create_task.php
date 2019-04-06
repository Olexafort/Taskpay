	<?php
	//Include relevant files
	require_once('../classes/app_functions_classes.php');
	require_once('../classes/task_classes.php');

	require_once('../classes/validate_classes.php');
	
	$val = new validate();
	
	$val->check_session();
	//instantiate new classes
	$app_functions = new app_functions();
	$task = new app_tasks();

	#get data from form
	if (isset($_POST['submit']) && !empty($_POST['submit'])) {
		//Get specific job data
		$name = $task->security($_POST['name']);
		$pay = $task->security($_POST['pay']);
		$location = $task->security($_POST['location']);
		$area = $task->security($_POST['area']);
		$account_id = $task->security($_POST['account_id']);
		//Get job profile data
		$type = $task->security($_POST['type']);
		$duration = $task->security($_POST['duration']);
		$category = $task->security($_POST['category']);
		$description = $task->security($_POST['description']);
			//get job icon
		$filetmp = $_FILES["photo"]["tmp_name"];
		$filename = basename($_FILES["photo"]["name"]);
		$filedir = "uploads/" . $filename;

		move_uploaded_file($filetmp, $filedir);

		if ($name == "" || $pay == "" || $location == "" || $type == "") {
			?>
			<script type="text/javascript">
				alert("Fields can  not be empty!");
			</script>
			<?php
		}else{
			//echo $name . "<br>" . $pay . "<br>" . $location . "<br>" . $area . "<br>" . $account_id . "<br>" . $type . "<br>" . $duration . "<br>" . $category . "<br>" . $description . "<br>" . $filedir . "<br>"; 
			$add = $task->create_task($name, $pay, $category, $description, $duration, $area, $type, $location, $filedir, $account_id);
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
		<title>Create Task</title>

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

			  <header id="header" id="home">
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				         <a href="index.php"><h2>TaskPay</h2></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="index.php">Home</a></li>
				          <li><a href="contact.php">Contact Us</a></li>
						  <li><a href="profile.php">My Profile</a></li>
				          <li class="menu-has-children"><a href="">Job Profile</a>
				            <ul>
								<li><a href="myjobs.php">My Jobs</a></li>
								<li><a href="myapplications.php">My Applications</a></li>
								<li><a href="notifications.php">My Notifications</a></li>
				            </ul>
				          </li>
				          <li><a class="ticker-btn" href="create_task.php">Create Job</a></li>
				          <li><a class="ticker-btn" href="logout.php">Logout</a></li>				          				          
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Taskpay			
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="create_task.php"> Create Task</a></p>
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
								<form action="create_task.php" method="POST" enctype="multipart/form-data">
									<h3 class="mb-30">Basic Job details</h3>
									<div class="mt-10">
										<input type="text" name="name" placeholder="Enter the task name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter the task name'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="pay" placeholder="Enter pay (15k - 20k)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter pay (15k - 20k)'" required class="single-input">
									</div>
									<div class="input-group-icon mt-10">
										<div class="form-select" id="default-select"">
											<select name="location">
												<option selected="">Select Job Location</option>
												<option>Nairobi</option>
												<option>Mombasa</option>
												<option>Kisumu</option>
												<option>Nakuru</option>
												<option>Naivasha</option>
												<option>Eldoret</option>
												<option>Thika</option>
												<option>Others</option>
											</select>
										</div>
									</div>
									<div class="mt-10">
										<input type="text" name="area" placeholder="Enter specific Location/Area (CBD)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter specific Location/Area (CBD)'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="hidden" name="account_id" value="<?php if(isset($_COOKIE['validate_login_id'])) {echo $_COOKIE['validate_login_id']; } ?>" required disable="true" class="single-input">
									</div>

									<br><h3 class="mb-30">Job Profile Details</h3>
									<div class="input-group-icon mt-10">
										<div class="form-select" id="default-select"">
											<select name="type">
												<option selected="">Select Job Type</option>
												<option>Part Time</option>
												<option>Full Time</option>
												<option>Contract</option>
												<option>Single</option>
											</select>
										</div>
									</div>
									<div class="input-group-icon mt-10">
										<div class="form-select" id="default-select"">
											<select name="duration">
												<option selected="">Select Job Duration</option>
												<option>1hr - 24hrs</option>
												<option>5 Days</option>
												<option>14 Days</option>
												<option>1 Month</option>
												<option>Over 1 Month</option>
											</select>
										</div>
									</div>
									<div class="input-group-icon mt-10">
										<div class="form-select" id="default-select"">
											<select name="category">
												<option selected="">Select Job Category</option>
												<option>JuaKali</option>
												<option>Business-Finance</option>
												<option>Software Development</option>
												<option>Technology</option>
												<option>Media-News</option>
												<option>Banking-Insurance</option>
												<optgroup>Goverment-NGO</optgroup>
											</select>
										</div>
									</div>
									<div class="mt-10">
										<textarea class="single-textarea" name="description" placeholder="Briefly describe the task here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Briefly describe the task here...'" required></textarea>
									</div>


									<div class="mt-10">
										<span>Select Icon</span>
										<input type="file" name="photo" placeholder="Select Icon" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Select Icon'" required class="single-input">
									</div>
									<br>
									<div class="form-group">
										<div class="col-md-4">
											<input style="color: red;" type="button" name="cancel" value="Cancel" class="btn btn-danger single-input-secondary mb-2">
											<input style="color: blue;"type="submit" name="submit" value="Create Task" class="btn btn-primary single-input-secondary mb-2">
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-3 col-md-4 mt-sm-30">
								<div class="single-element-widget">
									<h3 class="mb-30">Select Actions</h3>
									<div class="switch-wrap d-flex justify-content-between">
										<p>Show to potential applicants</p>
										<div class="primary-switch">
											<input type="checkbox" id="default-switch" checked>
											<label for="default-switch"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>Make Private</p>
										<div class="primary-switch">
											<input type="checkbox" id="primary-switch">
											<label for="primary-switch"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>Create task Ads</p>
										<div class="confirm-switch">
											<input type="checkbox" id="confirm-switch" checked>
											<label for="confirm-switch"></label>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Align Area -->

			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-3  col-md-12">
							<div class="single-footer-widget">
								<h6>Top Links</h6>
								<ul class="footer-nav">
									<li><a href="#">Home</a></li>
									<li><a href="#">Job Market</a></li>
									<li><a href="#">My Jobs</a></li>
									<li><a href="#">My Wallet</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6  col-md-12">
							<div class="single-footer-widget newsletter">
								<h6>Newsletter</h6>
								<p>You can trust us. we only send job listings, not a single spam.</p>
								<div id="mc_embed_signup">
									<form >

										<div class="form-group row" style="width: 100%">
											<div class="col-lg-8 col-md-12">
												<input name="email" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
											</div> 
										
											<div class="col-lg-4 col-md-12">
												<button name="submit" class="nw-btn primary-btn">Subscribe<span class="lnr lnr-arrow-right"></span></button>
											</div> 
										</div>		
										<div class="info"></div>
									</form>
								</div>		
							</div>
						</div>
						<div class="col-lg-3  col-md-12">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">Instant Job Feed</h6>
								<ul class="instafeed d-flex flex-wrap">
									<li><img src="img/i1.jpg" alt=""></li>
									<li><img src="img/i2.jpg" alt=""></li>
									<li><img src="img/i3.jpg" alt=""></li>
									<li><img src="img/i4.jpg" alt=""></li>
									<li><img src="img/i5.jpg" alt=""></li>
									<li><img src="img/i6.jpg" alt=""></li>
									<li><img src="img/i7.jpg" alt=""></li>
									<li><img src="img/i8.jpg" alt=""></li>
								</ul>
							</div>
						</div>						
					</div>
				</div>
			</footer>
			<!-- End footer Area -->


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