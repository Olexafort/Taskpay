	<?php
	//Include relevant files
	require_once('../classes/profile_classes.php');
	require_once('../classes/validate_classes.php');
	
	$val = new validate();
	
	$val->check_session();
	//instantiate new classes
	$profile = new profile_class();

	#get data from form
	if (isset($_POST['submit']) && !empty($_POST['submit'])) {
		//Get form data
		$career = $profile->security($_POST['career']);
		$professional = $profile->security($_POST['professional']);
		$education = $profile->security($_POST['education']);
		$technical = $profile->security($_POST['technical']);
		$experience = $profile->security($_POST['experience']);
		$account_id = $profile->security($_POST['account_id']);
		
		//get resume
		$filetmp = $_FILES["resume"]["tmp_name"];
		$filename = basename($_FILES["resume"]["name"]);
		$filedir = "documents/" . $filename;

		move_uploaded_file($filetmp, $filedir);

		if ($career == "" || $professional == "" || $education == "" || $technical == "") {
			?>
			<script type="text/javascript">
				alert("Fields can  not be empty!");
			</script>
			<?php
		}else{
			#echo $career ." <br>". $professional ." <br>". $education ." <br>". $technical ." <br>". $experience ." <br>". $resume ." <br>". $account_id;
			$add = $profile->upload_profile($career, $professional, $education, $technical, $experience, $filedir, $account_id);
		}
	}

	?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Set Profile</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
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
								Contact Us				
							</h1>	
							<p class="text-white"><a href="index.php">Homepage </a>  <span class="lnr lnr-arrow-right"></span>  <a href="myprofile.php"> Set profile</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
			<section class="contact-page-area section-gap">
				<div class="container">
					<div class="row">
						<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
						<div class="col-lg-4 d-flex flex-column">
							<a class="contact-btns" href="contact.php">Contact Us</a>
							<a class="contact-btns" href="create_profile.php">Post New Job</a>
							<a class="contact-btns" href="index.php">View Jobs</a>
						</div>
						<div class="col-lg-8">
							<form class="form-area contact-form text-right" action="myprofile.php" method="POST" enctype="multipart/form-data" >
								<div class="row">	
									<div class="col-lg-12 form-group">
										<div class="form-group">
											<textarea class="common-textarea mt-10 form-control" name="career" placeholder="Briefly describe your career objectives" required=""></textarea>
										</div>

										<div class="form-group">
											<textarea class="common-textarea mt-10 form-control" name="professional" placeholder="Are you experienced with any professional services" required=""></textarea>
										</div>

										<div class="form-group">
											<textarea class="common-textarea mt-10 form-control" name="education" placeholder="What is your educational background" required=""></textarea>
										</div>

										<div class="form-group">
											<textarea class="common-textarea mt-10 form-control" name="technical" placeholder="Are you experienced with any technical services" required=""></textarea>
										</div>

										<div class="form-group">
											<textarea class="common-textarea mt-10 form-control" name="experience" placeholder="Do you have any rellevant work experiences" required=""></textarea>
										</div>

										<span>Upload resume</span>
										<input name="resume" placeholder="Select your resume" class="common-input mb-20 form-control" required="" type="file">

										<input name="account_id" placeholder="Select your resume" class="common-input mb-20 form-control" required="" value="<?php if(isset($_COOKIE['validate_login_id'])) {echo $_COOKIE['validate_login_id']; } ?>" type="hidden">

										<div class="form-group">
											<input class="btn btn-primary mt-20 text-white" style="float: right;" type="submit" name="submit" value="Upload Profile">
										</div>
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->
			
	
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



