	<?php
	require_once('../classes/myactions_classes.php');

	require_once('../classes/validate_classes.php');
	
	$val = new validate();
	
	$val->check_session();
	$actions = new myactions();
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
		<title>Mj Job Listings</title>

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
								Taskpay				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Homepage </a>  <span class="lnr lnr-arrow-right"></span>  <a href="myapplications.php"> My Application Profile</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
				
			<!-- Start price Area -->
			<section class="price-area section-gap" id="price">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">See what you've been upto in your application profile</h1>
								<p>Below are the details of all the tasks you've applied for and their subsequent application statuses.</p>
							</div>
						</div>
					</div>						
					<div class="row">
						
						<?php
						if (isset($_COOKIE['validate_login_id'])) {
							$actions->get_my_applications($_COOKIE['validate_login_id']);
						}
						?>
														
					</div>
				</div>	
			</section>
			<!-- End price Area -->	

			<!-- Start submit Area -->
			<section class="submit-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="submit-left">
								<h4>Submit Your Resume Today</h4>
								<p>
									Submit your updated resume today so that your employers can stay in touch with you and know what suits you best.
								</p>
								<a href="upload_cv.php" class="primary-btn header-btn">Submit Your CV</a>	
							</div>
						</div>
						<div class="col-lg-6 ">
							<div class="submit-right">
								<h4>Submit a New Job Now!</h4>
								<p>
									Get tasks and chores done for you at the comfort and convienience of your choice with simple steps.
								</p>
								<a href="create_task.php" class="primary-btn header-btn">Post a Job</a>		
							</div>			
						</div>

					</div>
				</div>	
			</section>
			<!-- End submit Area -->
			
		
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



