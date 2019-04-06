	<?php
	require_once('../classes/validate_classes.php');
	
	$val = new validate();
	
	$val->check_session();
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
		<title>Create Job</title>

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
								Create a new Job			
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="create.php"> New Jobs</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start Sample Area -->
			<section class="sample-text-area">
				<div class="container">
					<h3 class="text-heading">Text Sample</h3>
					<p class="sample-text">
						Every avid independent filmmaker has <b>Bold</b> about making that <i>Italic</i> interest documentary, or short film to show off their creative prowess. Many have great ideas and want to “wow” the<sup>Superscript</sup> scene, or video renters with their big project.  But once you have the<sub>Subscript</sub> “in the can” (no easy feat), how do you move from a <del>Strike</del> through of master DVDs with the <u>“Underline”</u> marked hand-written title inside a secondhand CD case, to a pile of cardboard boxes full of shiny new, retail-ready DVDs, with UPC barcodes and polywrap sitting on your doorstep?  You need to create eye-popping artwork and have your project replicated. Using a reputable full service DVD Replication company like PacificDisc, Inc. to partner with is certainly a helpful option to ensure a professional end result, but to help with your DVD replication project, here are 4 easy steps to follow for good DVD replication results: 

					</p>
				</div>
			</section>
			<!-- End Sample Area -->
			
			<!-- Start Align Area -->
			<div class="whole-wrap">
				<div class="container">
					
					<div class="section-top-border">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<h3 class="mb-30">Form Element</h3>
								<form action="#">
									<div class="mt-10">
										<input type="text" name="first_name" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="last_name" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="last_name" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required class="single-input">
									</div>
									<div class="mt-10">
										<input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
									</div>
									<div class="input-group-icon mt-10">
										<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
										<input type="text" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required class="single-input">
									</div>
									<div class="input-group-icon mt-10">
										<div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
										<div class="form-select" id="default-select"">
											<select>
												<option value="1">City</option>
												<option value="1">Dhaka</option>
												<option value="1">Dilli</option>
												<option value="1">Newyork</option>
												<option value="1">Islamabad</option>
											</select>
										</div>
									</div>
									<div class="input-group-icon mt-10">
										<div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
										<div class="form-select" id="default-select"">
											<select>
												<option value="1">Country</option>
												<option value="1">Bangladesh</option>
												<option value="1">India</option>
												<option value="1">England</option>
												<option value="1">Srilanka</option>
											</select>
										</div>
									</div>
									
									<div class="mt-10">
										<textarea class="single-textarea" placeholder="Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'" required></textarea>
									</div>
								
									<div class="mt-10">
										<input type="text" name="first_name" placeholder="Primary color" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary color'" required class="single-input-primary">
									</div>
									<div class="mt-10">
										<input type="text" name="first_name" placeholder="Accent color" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Accent color'" required class="single-input-accent">
									</div>
									<div class="mt-10">
										<input type="text" name="first_name" placeholder="Secondary color" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Secondary color'" required class="single-input-secondary">
									</div>
								</form>
							</div>
							<div class="col-lg-3 col-md-4 mt-sm-30">
								<div class="single-element-widget">
									<h3 class="mb-30">Switches</h3>
									<div class="switch-wrap d-flex justify-content-between">
										<p>01. Sample Switch</p>
										<div class="primary-switch">
											<input type="checkbox" id="default-switch">
											<label for="default-switch"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>02. Primary Color Switch</p>
										<div class="primary-switch">
											<input type="checkbox" id="primary-switch" checked>
											<label for="primary-switch"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>03. Confirm Color Switch</p>
										<div class="confirm-switch">
											<input type="checkbox" id="confirm-switch" checked>
											<label for="confirm-switch"></label>
										</div>
									</div>
								</div>
								<div class="single-element-widget mt-30">
									<h3 class="mb-30">Selectboxes</h3>
									<div class="default-select" id="default-select"">
										<select>
											<option value="1">English</option>
											<option value="1">Spanish</option>
											<option value="1">Arabic</option>
											<option value="1">Portuguise</option>
											<option value="1">Bengali</option>
										</select>
									</div>
								</div>
								<div class="single-element-widget mt-30">
									<h3 class="mb-30">Checkboxes</h3>
									<div class="switch-wrap d-flex justify-content-between">
										<p>01. Sample Checkbox</p>
										<div class="primary-checkbox">
											<input type="checkbox" id="default-checkbox">
											<label for="default-checkbox"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>02. Primary Color Checkbox</p>
										<div class="primary-checkbox">
											<input type="checkbox" id="primary-checkbox" checked>
											<label for="primary-checkbox"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>03. Confirm Color Checkbox</p>
										<div class="confirm-checkbox">
											<input type="checkbox" id="confirm-checkbox">
											<label for="confirm-checkbox"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>04. Disabled Checkbox</p>
										<div class="disabled-checkbox">
											<input type="checkbox" id="disabled-checkbox" disabled>
											<label for="disabled-checkbox"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>05. Disabled Checkbox active</p>
										<div class="disabled-checkbox">
											<input type="checkbox" id="disabled-checkbox-active" checked disabled>
											<label for="disabled-checkbox-active"></label>
										</div>
									</div>
								</div>
								<div class="single-element-widget mt-30">
									<h3 class="mb-30">Radios</h3>
									<div class="switch-wrap d-flex justify-content-between">
										<p>01. Sample radio</p>
										<div class="primary-radio">
											<input type="checkbox" id="default-radio">
											<label for="default-radio"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>02. Primary Color radio</p>
										<div class="primary-radio">
											<input type="checkbox" id="primary-radio" checked>
											<label for="primary-radio"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>03. Confirm Color radio</p>
										<div class="confirm-radio">
											<input type="checkbox" id="confirm-radio" checked>
											<label for="confirm-radio"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>04. Disabled radio</p>
										<div class="disabled-radio">
											<input type="checkbox" id="disabled-radio" disabled>
											<label for="disabled-radio"></label>
										</div>
									</div>
									<div class="switch-wrap d-flex justify-content-between">
										<p>05. Disabled radio active</p>
										<div class="disabled-radio">
											<input type="checkbox" id="disabled-radio-active" checked disabled>
											<label for="disabled-radio-active"></label>
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