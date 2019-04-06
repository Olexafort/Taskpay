<?php
//Include relevant files
require_once('../classes/app_functions_classes.php');
require_once('../classes/task_classes.php');
require_once('../classes/artificial_intelligence.php');
require_once('../classes/validate_classes.php');

//instantiate new classes
$app_functions = new app_functions();
$task = new app_tasks();
$ai = new artificial_intelligence();

$val = new validate();
$val->check_session();

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
		<title>TaskPay Dashboard</title>

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
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-12">
							<h1 class="text-white">
								<?php
								$app_functions->get_total_jobs();
								?>				
							</h1>	
							<form action="search.html" class="serach-form-area">
								<div class="row justify-content-center form-wrap">
									<div class="col-lg-4 form-cols">
										<input type="text" class="form-control" name="search" placeholder="what are you looking for?">
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects">
											<select>
												<option value="1">Select area</option>
												<option value="2">Nairobi</option>
												<option value="3">Mombasa</option>
												<option value="4">Kisumu</option>
												<option value="5">Nakuru</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 form-cols">
										<div class="default-select" id="default-selects2">
											<select>
												<option value="1">All Category</option>
												<option value="2">Medical</option>
												<option value="3">Technology</option>
												<option value="4">Goverment</option>
												<option value="5">Software Development</option>
											</select>
										</div>										
									</div>
									<div class="col-lg-2 form-cols">
									    <button type="button" class="btn btn-info">
									      <span class="lnr lnr-magnifier"></span> Search
									    </button>
									</div>								
								</div>
							</form>	
							<p class="text-white"> <span>Search by our tags:</span> Tecnology, Business, Consulting, IT Company, Design, Development</p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start features Area -->
			<section class="features-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Searching</h4>
								<p>
									We make it so much easier by allowing you to search and filter results directly.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Applying</h4>
								<p>
									With our new one click feature, you can now upload your resume and apply instantly.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Security</h4>
								<p>
									All our site data and user information are protected using various levels of encryption for security purposes.
								</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="single-feature">
								<h4>Notifications</h4>
								<p>
									Get email notifications sent directly to your phone when your apply or list.
								</p>
							</div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End features Area -->
			
			<!-- Start popular-post Area -->
			<section class="popular-post-area pt-100">
				<div class="container">
					<div class="row align-items-center">
						<div class="active-popular-post-carusel">
							
							<?php
							if (isset($_COOKIE['validate_login_id'])) {
								$account_id = $_COOKIE['validate_login_id'];
								$ai->get_job_preferences($account_id);
							}
							?>	
																		
						</div>
					</div>
				</div>	
			</section>
			<!-- End popular-post Area -->
			
			<!-- Start feature-cat Area -->
			<section class="feature-cat-area pt-100" id="category">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Our Popular Job Categories</h1>
								<p>List from our selected and sorted list of featured and popular job categories.</p>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Business-Finance";
								$business_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $business_url; ?>">
									<img src="img/o1.png" alt="">
								</a>
								<p>Business and Finance</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Software Development";
								$software_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $software_url; ?>">
									<img src="img/o2.png" alt="">
								</a>
								<p>Software Development</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Technology-Engineering";
								$tech_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $tech_url; ?>">
									<img src="img/o3.png" alt="">
								</a>
								<p>Technology & Engineering</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Media-Film";
								$media_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $media_url; ?>">
									<img src="img/o4.png" alt="">
								</a>
								<p>Media & News</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Banking-Insurance";
								$banking_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $banking_url; ?>">
									<img src="img/o5.png" alt="">
								</a>
								<p>Banking & Insurance</p>
							</div>
						</div>
						<div class="col-lg-2 col-md-4 col-sm-6">
							<div class="single-fcat">
								<?php
								$cat = "Goverment-NGO";
								$gov_url = "category.php?value=" . $cat;
								?>
								<a href="<?php echo $gov_url; ?>">
									<img src="img/o6.png" alt="">
								</a>
								<p>Goverment & NGO</p>
							</div>			
						</div>																											
					</div>
				</div>	
			</section>
			<!-- End feature-cat Area -->
			
			<!-- Start post Area -->
			<section class="post-area section-gap">
				<div class="container">
					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">
							<ul class="cat-list">
								<li><a href="#">Recent</a></li>
								<li><a href="#">Full Time</a></li>
								<li><a href="#">Intern</a></li>
								<li><a href="#">part Time</a></li>
							</ul>

							<?php
							$task->show_tasks();
							?>	
							
							<a class="text-uppercase loadmore-btn mx-auto d-block" href="category.html">Load More job Posts</a>

						</div>
						<div class="col-lg-4 sidebar">
							<div class="single-slidebar">
								<h4>Jobs by Location</h4>
								<ul class="cat-list">
									<?php
									$task->view_by_location();
									?>
									<li><a class="justify-content-between d-flex" href="category.html"><p>New York</p><span>37</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Park Montana</p><span>57</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Atlanta</p><span>33</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Arizona</p><span>36</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Florida</p><span>47</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Rocky Beach</p><span>27</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Chicago</p><span>17</span></a></li>
								</ul>
							</div>

							<div class="single-slidebar">
								<h4>Top suggested jobs for you</h4>
								<div class="active-relatedjob-carusel">

									<?php
									if (isset($_COOKIE['validate_login_id'])) {
										$account_id = $_COOKIE['validate_login_id'];
										$ai->get_suggested_jobs($account_id);
									}
									?>
																										
								</div>
							</div>														

						</div>
					</div>
				</div>	
			</section>
			<!-- End post Area -->

			<!-- Start download Area -->
			<section class="download-area section-gap" id="app">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 download-left">
							<img class="img-fluid" src="img/d1.png" alt="">
						</div>
						<div class="col-lg-6 download-right">
							<h1>Download the <br>
							TaskPay App Today!</h1>
							<p class="subs">
								It has never been as simple getting tasks within your area or locale. With the TaskPay Mobile Application, we bring you all the services within the comfort of your palm. Download now and start reaping your benefits.
							</p>
							<div class="d-flex flex-row">
								<div class="buttons">
									<i class="fa fa-apple" aria-hidden="true"></i>
									<div class="desc">
										<a href="#">
											<p>
												<span>Available</span> <br>
												on App Store
											</p>
										</a>
									</div>
								</div>
								<div class="buttons">
									<i class="fa fa-android" aria-hidden="true"></i>
									<div class="desc">
										<a href="#">
											<p>
												<span>Available</span> <br>
												on Play Store
											</p>
										</a>
									</div>
								</div>									
							</div>						
						</div>
					</div>
				</div>	
			</section>
			<!-- End download Area -->
		
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



