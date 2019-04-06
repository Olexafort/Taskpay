<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/


#Require database connection file to execute querry
#Include file path
require_once('../databases/database_connect.php');
#Require data tables to reference storage points
require_once('../databases/database_tables.php');


class profile_class extends database_connection {

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
		//$this->pdo_connect =  new database_connection();

		//Declaration 
		$accounts_tbl = new app_tables();
		$accounts_tbl->create_profile_table();

	}

	#this method cleans user input data
	public function security($input)
	{
		htmlspecialchars($input);
		stripslashes($input);

		return $input;
	}

	//check user profile
	public function get_user_profile($account_id)
	{
		$select_profile = "SELECT * FROM profile WHERE account_id = :acc ";
		$prepare_Select = $this->pdo_connect->prepare($select_profile);

		try {
			$prepare_Select->execute(array(":acc" => $account_id));

			if ($result_set = $prepare_Select->rowCount() > 0) {
				while ($rows = $prepare_Select->fetch(PDO::FETCH_ASSOC)) {
					?>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-user"></span>Career Objective</h4>
							<p>
								<?php echo $rows['career']; ?>
							</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-license"></span>Professional Services</h4>
							<p>
								<?php echo $rows['professional']; ?>
							</p>								
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-phone"></span>Educational Background</h4>
							<p>
								<?php echo $rows['education']; ?>
							</p>								
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-rocket"></span>Technical Skills</h4>
							<p>
								<?php echo $rows['technical']; ?>
							</p>				
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-diamond"></span>Experiences</h4>
							<p>
								<?php echo $rows['experience']; ?>
							</p>								
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-service">
							<h4><span class="lnr lnr-bubble"></span>Resume</h4>
							<p>
								<?php echo $rows['resume']; ?>
							</p>									
						</div>
					</div>
					<?php
				}
			}else{
				$msg_n = "You need to set your profile first";
				header("Location: myprofile.php?msg_n=" . $msg_n);
			}

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//upload user_profile
	public function upload_profile($career, $professional, $education, $technical, $experience, $resume, $account_id)
	{
		$insert_profile = "INSERT INTO profile (career, professional, education, technical, experience, resume, account_id) VALUES (:car, :prof, :edu, :tech, :exp, :res, :acc)";
		$prepare_insert = $this->pdo_connect->prepare($insert_profile);

		try {
			$data_array = array(":car" => $career,
		                        ":prof" => $professional,
		                        ":edu" => $education,
		                        ":tech" => $technical,
		                        ":exp" => $experience,
		                        ":res" => $resume,
		                        ":acc" => $account_id);

			$prepare_insert->execute($data_array);

			$msg_p = "Profile updated successfully";
			header("Location: profile.php?msg_p=" . $msg_p);

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

}