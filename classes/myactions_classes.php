<?php
require_once('../databases/database_connect.php');
require_once('../databases/database_tables.php');
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/

class myactions extends database_connection {

	#declare and set class variables
	//private $pdo_connect;

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
		//$this->pdo_connect = $database_connection;
		$tables = new app_tables();
		$tables->create_myapplications_table();
		$tables->create_notifications_table();
		$tables->create_wallet_table();
		$tables->create_myjobs_table();

	}

	#this method cleans user input data
	public function security($input)
	{
		htmlspecialchars($input);
		stripslashes($input);

		return $input;
	}

	#create user preferences
	public function preferences($account_id)
	{
		//instantiate and create a new class
		$tables = new app_tables();
		$tables->create_preference_table();

		$select_preferences = "SELECT * FROM user_preference WHERE account_id = :acc_id ";
		$prepare_select = $this->pdo_connect->prepare($select_preferences);

		try {
			$prepare_select->execute(array(":acc_id" => $account_id));

			//get total results
			$results = $prepare_select->rowCount();

			switch ($results) {
				case 0:
					?>
					<form action="preferences.php" method="POST" enctype="multipart/form-data">
						<h3 class="mb-30">Set your preferences</h3>
									
						<div class="input-group-icon mt-10">
							<div class="form-select" id="default-select"">
								<select name="location">
									<option selected="">Please select your prefered job location</option>
									<option>Nairobi</option>
									<option>Mombasa</option>
									<option>Kisumu</option>
									<option>Nakuru</option>
								</select>
							</div>
						</div>
									
						<div class="mt-10">
							<input type="hidden" name="account_id" value="<?php if(isset($_COOKIE['validate_login_id'])) {echo $_COOKIE['validate_login_id']; } ?>" required disable="true" class="single-input">
						</div>

						<div class="input-group-icon mt-10">
							<div class="form-select" id="default-select"">
								<select name="type">
									<option selected="">Please select your prefered job type</option>
									<option>Part Time</option>
									<option>Full Time</option>
									<option>Contract</option>
									<option>Single</option>
								</select>
							</div>
						</div>
									
						<div class="input-group-icon mt-10">
							<div class="form-select" id="default-select"">
								<select name="category">
									<option selected="">Please select your prefered job category</option>
									<option>JuaKali</option>
									<option>Business Finance</option>
									<option>Software Development</option>
									<option>Technology</option>
									<option>Media News</option>
									<option>Banking Insurance</option>
									<option>Goverment NGO</option>
								</select>
							</div>
						</div>
									
						<br>
						<div class="form-group">
								<input style="color: blue;"type="submit" name="submit" value="Set Preferences" class="btn btn-primary single-input-secondary">
							</div>
						</div>
					</form>
					<?php
					break;
				
				case 1:
					if ($results > 0) {
					while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
						?>
						<form action="preferences.php" method="POST" enctype="multipart/form-data">
							<h3 class="mb-30">Set your preferences</h3>
										
							<div class="input-group-icon mt-10">
								<div class="form-select" id="default-select"">
									<select name="location">
										<option selected=""><?php echo $rows['pref_location']; ?></option>
										<option>Nairobi</option>
										<option>Mombasa</option>
										<option>Kisumu</option>
										<option>Nakuru</option>
									</select>
								</div>
							</div>
										
							<div class="mt-10">
								<input type="hidden" name="account_id" value="<?php echo $rows['account_id']; } ?>" required class="single-input">
							</div>

							<div class="input-group-icon mt-10">
								<div class="form-select" id="default-select"">
									<select name="type">
										<option selected=""><?php echo $rows['pre_type']; ?></option>
										<option>Part Time</option>
										<option>Full Time</option>
										<option>Contract</option>
										<option>Single</option>
									</select>
								</div>
							</div>
										
							<div class="input-group-icon mt-10">
								<div class="form-select" id="default-select"">
									<select name="category">
										<option selected=""><?php echo $rows['pref_category']; ?></option>
										<option>JuaKali</option>
										<option>Business Finance</option>
										<option>Software Development</option>
										<option>Technology</option>
										<option>Media News</option>
										<option>Banking Insurance</option>
										<option>Goverment NGO</option>
									</select>
								</div>
							</div>
										
							<br>
							<div class="form-group">
									<input style="color: blue;"type="submit" name="submit" value="Update Preferences" class="btn btn-primary single-input-secondary">
								</div>
							</div>
						</form>
						<?php
					}
					
					break;

				default:
					# code...
					break;
			}
			
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}


	//allow user to set his preference
	public function set_preferences($pref_location, $pref_category, $pref_type, $account_id)
	{
		$check_available = "SELECT * FROM user_preference WHERE account_id = :id ";
		$prepare_check = $this->pdo_connect->prepare($check_available);

		$prepare_check->execute(array(":id" => $account_id));

		if ($res = $prepare_check->rowCount() > 0) {

			$update_preferences = "UPDATE user_preference SET pref_location = :loc, pref_category = :cat, pref_type = :type WHERE account_id = :id ";
			$prepare_insert = $this->pdo_connect->prepare($update_preferences);

			try {
				$data_array = array(":loc" => $pref_location,
			                        ":cat" => $pref_category,
			                        ":type" => $pref_type,
			                        ":id"  => $account_id);

				$prepare_insert->execute($data_array);

				$msg = "Your preferences have been updated successfully";
				header("Location: index.php?msg=" . $msg);

			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}
		}else{
			$insert_preferences = "INSERT INTO user_preference (pref_location, pref_category, pref_type, account_id) VALUES (:loc, :cat, :type, :id) ";
			$prepare_insert = $this->pdo_connect->prepare($insert_preferences);

			try {
				$data_array = array(":loc" => $pref_location,
			                        ":cat" => $pref_category,
			                        ":type" => $pref_type,
			                        ":id"  => $account_id);

				$prepare_insert->execute($data_array);

				$msg = "Your preferences have been stored successfully";
				header("Location: index.php?msg=" . $msg);

			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}
		}

	}

	#create method to apply for a job
	public function send_application($job_id, $username, $pay, $job_name, $client_id, $account_id)
	{
		#send data do application table
		$send_application = "INSERT INTO myapplications (username, job_name, date_applied, time_applied, status, pay, client_id, account_id, job_id) VALUES 
				(:user, :name, :d_app, :t_app, :stat, :pay, :client_id, :acc_id, :job_id) ";
		$prepare_send_application = $this->pdo_connect->prepare($send_application);
		#execute try catch block
		try {
			$array_data = array(":user" => $username,
								":name" => $job_name,
								":d_app" => Date('D, d-M, Y'),
							    ":t_app" => Date('G:i:s a'),
								":stat" => "Applied",
								":pay" => $pay,
								":client_id" => $client_id,
								":acc_id" => $account_id,
								":job_id" => $job_id);
			$prepare_send_application->execute($array_data);
			#send the applicant mail

            $msg = "Your application was successful";
			header("Location: myapplications.php?msg=" . $msg);
			/***create code snippet to send application to client
			$send_client = "INSERT INTO notifications (notification, job_name, job_id, username, pay, status, account_id, user_id) VALUES (:not, :job, :id, :user, :pay, :status, :acc_id, :u_id) ";
			$prepare_send_client = $this->pdo_connect->prepare($send_client);
			#execute_try_catch block
			try {
				$notification = "New Job Application";
				$new_data_array = array(":not" => $notification,
			                            ":job" => $job_name,
			                            ":id"  => $job_id,
			                            ":user" => $username, 
			                            ":pay" => $pay,
			                            ":stat" => "Pending Approval/Decline",
			                            ":acc_id" => $client_id,
			                            ":u_id" => $account_id);

				$prepare_send_client->execute($new_data_array);
				#send client notification email
			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}*/
			
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//get user application 
	public function get_my_applications($account_id)
	{
		$select_app = "SELECT * FROM myapplications WHERE account_id = :acc_id ORDER BY application_id DESC ";
		$prepare_select = $this->pdo_connect->prepare($select_app);

		try {
			$prepare_select->execute(array(":acc_id" => $account_id));

            if ($result_set = $prepare_select->rowCount() > 0) {
            	while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
            		?>
                    <div class="col-lg-4">
						<div class="single-price no-padding">
							<div class="price-top">
								<h4><?php echo $rows['job_name']; ?></h4>
							</div>
							<ul class="lists">
								<li><?php echo $rows['username']; ?></li>
								<li>Date Applied: <b><?php echo $rows['date_applied']; ?></b></li>
								<li>Time Applied: <b><?php echo $rows['time_applied']; ?></b></li>
								<li>Application Status: <b><?php echo $rows['status']; ?></b></li>
								<li>Expected Pay: <b><?php echo $rows['pay']; ?></b></li>
							</ul>
							
						</div>
					</div>
            		<?php
            	}
            }else{
            	?>
                <div class="col-lg-4">
					<div class="single-price no-padding">
						<div class="price-top">
							<h4>You do not have any applications</h4>
						</div>
							
					</div>
				</div>
				<?php
            }
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//get user job application 
	public function get_job_applications($account_id)
	{
		$select_app = "SELECT * FROM myapplications WHERE client_id = :acc_id ORDER BY application_id DESC ";
		$prepare_select = $this->pdo_connect->prepare($select_app);

		try {
			$prepare_select->execute(array(":acc_id" => $account_id));

            if ($result_set = $prepare_select->rowCount() > 0) {
            	while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
            		$view_profile = "view_profile.php?userID=" . $rows['account_id'];
            		$accept = "accept.php?value=Accept"; 
            		$decline = "accept.php?value=Decline"; 
            		?>
            		<div class="table-row">
						<div class="serial"><?php echo $rows['application_id']; ?></div>
						<div class="country"><?php echo $rows['username']; ?></div>
						<div class="visit"><?php echo $rows['pay']; ?></div>
						<div class="visit"><?php echo $rows['date_applied'] . ", " . $rows['time_applied']; ?></div>
						<div class="visit"><a href="<?php echo $accept; ?>"><button class="btn btn-primary">Accept</button></a></div>
						<div class="visit"><a href="<?php echo $decline; ?>"><button class="btn btn-danger">Decline</button></a></div>
						
					</div>

            		<?php
            	}
            }else{
            	?>
                <div class="col-lg-4">
					<div class="single-price no-padding">
						<div class="price-top">
							<h4>You do not have any applications</h4>
						</div>
							
					</div>
				</div>
				<?php
            }
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	#create function to confirm/approve application
	public function approve_application($job_id, $status)
	{
		#create statement to add job to myjobs
		$create_insert_jobs = "INSERT INTO myjobs (job_name, date_time, job_id, account_id) VALUES (:j_name, :date_time, :job_id, :acc_id) ";
		$prepare_create_insert = $this->pdo_connect->prepare($create_insert_jobs);

		#update job status to Cleared or Declined
		$update_status = "UPDATE notifications SET status = :status WHERE job_id = :job_id ";
		$prepare_update = $this->pdo_connect->prepare($update_status);
		#execute tra_catch block
		try {
			$prepare_update->execute(array(":status" => $status, ":job_id" => $job_id));
			#send client email notification of status

			#fetch data to get user id
			$get_job_details = "SELECT * FROM notifications WHERE job_id = :job_id ";
			$prepare_get_job = $this->pdo_connect->prepare($get_job_details);

			$prepare_get_job->execute(array(":job_id" => $job_id));
			$result_set = $prepare_get_job->rowCount();

			if ($result_set > 0) {
				while ($rows = $prepare_get_job->fetch(PDO::FETCH_ASSOC)) {
					$user_id = $rows['user_id'];
					$job_name = $rows['job_name'];
					$mydatetime = Date('D, d-M, Y') . " at " . Date('G:i:s a');

					$create_array_data = array(":j_name" => $job_name,
				                               ":date_time" => $mydatetime,
				                               ":job_id" => $job_id,
				                               ":acc_id" => $user_id);
				}

				#check application status
				switch ($status) {
					case 'Approved':
						$prepare_create_insert->execute($create_array_data);
						#send user email notification
						break;
					
					case 'Declined':
						$msg = "Sorry, your application was declcined. Apply for more jobs today!";
						header("Location: myapps.php?msg=" . $msg);
						break;

					default:
						$msg = "No action performed";
						header("Location: myapps.php?msg=" . $msg);
						break;
				}

				#update myapplications table to reference job application status
				$update_myapplications = "UPDATE myapplications SET status = :status WHERE account_id = :acc_id ";
				$prepare_update_myapplicattions = $this->pdo_connect->prepare($update_myapplications);

				$prepare_update_myapplicattions->execute(array(":status" => $status, ":acc_id" => $user_id));

				$msg = "Success. Your actions were successfully completed";
				header("Location: notification.php?msg=" . $msg);
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}


}

?>