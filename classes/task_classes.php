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

class app_tasks extends database_connection {

	#declare and set class variables
	//private $pdo_connect;

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
		//$this->pdo_connect = $database_connection;
		$tables = new app_tables();
		$tables->create_jobs_table();
		$tables->job_details_table();
	}

	#this method cleans user input data
	public function security($input)
	{
		htmlspecialchars($input);
		stripslashes($input);

		return $input;
	}


	#creates new job profiles and adds data to the database 
	public function create_task($name, $pay, $category, $description, $duration, $area, $type, $location, $filedir, $account_id)
	{
		$create_task = "INSERT INTO jobs (job_name, icon, pay, job_type, category, description, preview, duration, location, area, status, date_posted, time_posted, account_id) VALUES 
			(:job, :icon, :pay, :type, :cat, :descript, :prev, :duration, :location, :area, :status, :dt, :tt, :acc_id)";

		$prepare_create_task = $this->pdo_connect->prepare($create_task);

		#try adding to data to the table
		try {
			$data_array = array(":job" => $name,
								":icon" => $filedir,
		                        ":pay" => $pay,
		                        ":type" => $type,
		                        ":cat" => $category,
		                        ":descript" => $description,
		                    	":prev" => $description,
		                    	":duration" => $duration,
		                    	":location" => $location,
		                    	":area" => $area,
		                    	":status"   => "Active",
		                    	":dt" => Date('D, d-M, Y'),
		                    	":tt" => Date('G:i:s a'),
		                    	":acc_id"   => $account_id);

		    $prepare_create_task->execute($data_array);

		    $select_task = "SELECT * FROM jobs WHERE job_name = :name AND category = :cat ";
		    $prepare_select_task = $this->pdo_connect->prepare($select_task);

		    $data = array(":name" => $name, ":cat" => $category);
		    $prepare_select_task->execute($data);

		    while ($rows = $prepare_select_task->fetch(PDO::FETCH_ASSOC)) {
		    	$jobID = $rows['job_id'];

		    	header("Location: job_details.php?jobID=" . $jobID);
		    }

		    //$msg = "Task added successfully";

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//add job details
	public function set_details($job_id, $who, $experience, $features, $education)
	{
		$insert_details = "INSERT INTO job_details (who, experience, features, education, job_id) VALUES (:who, :exp, :feat, :edu, :id) ";
		$prepare_insert = $this->pdo_connect->prepare($insert_details);

		//execute try catch block
		try {
			$data_array = array(":who" => $who,
		                        ":exp" => $experience,
		                        ":feat" => $features,
		                        ":edu"  => $education,
		                        ":id"   => $job_id);

			$prepare_insert->execute($data_array);

			$msg = "Job was successfully uploaded.";
			header("Location: myjobs.php?msg=" . $msg);
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//show tasks 
	public function show_tasks()
	{
		$select_tasks = "SELECT * FROM jobs ORDER BY job_id DESC LIMIT 10";
		$prepare_select = $this->pdo_connect->prepare($select_tasks);

		//execute try catch block
		try {
			$prepare_select->execute();

			//get total results
			$results = $prepare_select->rowCount();
			if ($results > 0) {
				while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
					$url = "single.php?jobID=" . $rows['job_id'];
					$application = "applications.php?jobID=" . $rows['job_id'];

					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="<?php echo $rows['icon']; ?>" alt="" width="300px" height="200px">
							<ul class="tags">
								<li>
									<a href="#"><?php echo $rows['status']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['date_posted']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['time_posted']; ?></a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6><?php echo $rows['category']; ?></h6>					
								</div>
								<ul class="btns">
									<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="<?php echo $url; ?>">Apply</a></li>
								</ul>
							</div>
							<p>	<?php echo $rows['preview']; ?> </p>
							<h5>Job Type: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span><?php echo $rows['location'] . ", " . $rows['area']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span><?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}else{
				$msg = "There are no tasks currently!";
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}


	#search for a paticular task
	public function search_task($search_criteria)
	{
		$search_data = "SELECT * FROM jobs WHERE MATCH (job_name, category, description, location) AGAINST (:search)";
		$prepare_search_data = $this->pdo_connect->prepare($search_data);

		try {
			$array_data = array(":search" => $search_criteria);
			$prepare_search_data->execute($array_data);

			$result_set = $prepare_search_data->rowCount();
			if ($result_set > 0) {
				while ($rows = $prepare_search_data->fetch(PDO::FETCH_ASSOC)) {
					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="img/post.png" alt="">
							<ul class="tags">
								<li>
									<a href="#">Art</a>
								</li>
								<li>
									<a href="#">Media</a>
								</li>
								<li>
									<a href="#">Design</a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="single.html"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6>Premium Labels Limited</h6>					
								</div>
								<ul class="btns">
									<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="#">Apply</a></li>
								</ul>
							</div>
							<p>
								<?php echo $rows['preview']; ?>
							</p>
							<h5>Job Nature: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span> <?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}else{

			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//get task by reference 
	public function get_single_task($task_id)
	{
		$get_task = "SELECT * FROM jobs WHERE job_id = :job_id ";
		$prepare_get_task = $this->pdo_connect->prepare($get_task);

		try {
			$prepare_get_task->execute(array(":job_id" => $task_id));

			if ($result_set = $prepare_get_task->rowCount() > 0) {
				while ($rows = $prepare_get_task->fetch(PDO::FETCH_ASSOC)) {
					$job_url = "single.php?jobID=" . $rows['job_id'];
					$apply_url = "application.php?jobID=" . $rows['job_id'];
					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img style="padding: 10px; margin: 10px;" src="<?php echo $rows['icon']; ?>" alt="" height="200px" width="200px">
							<ul class="tags">
								<li>
									<a href="#"><?php echo $rows['status']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['date_posted']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['time_posted']; ?></a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="<?php echo $job_url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6><?php echo $rows['category']; ?></h6>					
								</div>
								<ul class="btns">
									<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="<?php echo $apply_url; ?>">Apply</a></li>
								</ul>
							</div>
							<p><?php echo $rows['description']; ?></p>
							<h5>Job Type: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span> <?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function get_task_details($jobID)
	{
		$get_details = "SELECT * FROM jobs WHERE job_id = :id ";
		$prepare_get_details = $this->pdo_connect->prepare($get_details);

		try {
			$prepare_get_details->execute(array(":id" => $jobID));

			while ($rows = $prepare_get_details->fetch(PDO::FETCH_ASSOC)) {
				?>
				<div class="mt-10">
					<input type="hidden" name="job_id" value="<?php echo $rows['job_id']; ?>" required class="single-input">
				</div>

                <div class="mt-10">
					<input type="hidden" name="job_name" value="<?php echo $rows['job_name']; ?>" required class="single-input">
				</div>

				<div class="mt-10">
					<input type="hidden" name="client_id" value="<?php echo $rows['account_id']; ?>" required class="single-input">
				</div>
				<?php
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//get my jobs
	public function get_my_posts($account_id)
	{
		$get_mine = "SELECT * FROM jobs WHERE account_id = :account_id ORDER BY job_id DESC";
		$prepare_get_mine = $this->pdo_connect->prepare($get_mine);

		try {
			$prepare_get_mine->execute(array(":account_id" => $account_id));

			if ($result_set = $prepare_get_mine->rowCount() > 0) {
				while ($rows = $prepare_get_mine->fetch(PDO::FETCH_ASSOC)) {
					$url = "notification.php?jobID=" . $rows['job_id'];
					$delete_url = "delete.php?jobID=" . $rows['job_id'];
					$view = "single.php?jobID=" . $rows['job_id'];
					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="<?php echo $rows['icon']; ?>" style="padding: 10px; margin: 10px;" alt="" height="100px" width="100px">
							<ul class="tags">
								<li>
									<a href="#"><?php echo $rows['status']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['date_posted']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['time_posted']; ?></a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="<?php echo $view; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6><?php echo $rows['category']; ?></h6>					
								</div>
								<ul class="btns">
									<li><a href="<?php echo $delete_url; ?>">Delete</a></li>
									<li><a href="<?php echo $url; ?>">Applications</a></li>
								</ul>
							</div>
							<p><?php echo $rows['preview']; ?></p>
							<h5>Job Type: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span> <?php echo $rows['location'] . $rows['area']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}else{
				?>
				<p>You have not posted any new jobs!</p>
				<?php
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//get single job details
	public function get_single_task_details($task_id)
	{
		$select_task_details = "SELECT * FROM job_details WHERE job_id = :id ";
		$prepare_select_task_details = $this->pdo_connect->prepare($select_task_details);

		try {
			$prepare_select_task_details->execute(array(":id" => $task_id));
			while ($rows = $prepare_select_task_details->fetch(PDO::FETCH_ASSOC)) {
				?>
				<div class="single-post job-details">
					<h4 class="single-title">Whom we are looking for</h4>
					<p><?php echo $rows['who']; ?></p>
					
				</div>
				<div class="single-post job-experience">
					<h4 class="single-title">Experience Requirements</h4>
					<ul>
						<li>
							<img src="img/pages/list.jpg" alt="">
							<span><?php echo $rows['experience']; ?></span>
						</li>																											
					</ul>
				</div>
				<div class="single-post job-experience">
					<h4 class="single-title">Job Features & Overviews</h4>
					<ul>
						<li>
							<img src="img/pages/list.jpg" alt="">
							<span><?php echo $rows['features']; ?></span>
						</li>												
					</ul>
				</div>	
				<div class="single-post job-experience">
					<h4 class="single-title">Education Requirements</h4>
					<ul>
						<li>
							<img src="img/pages/list.jpg" alt="">
							<span><?php echo $rows['education']; ?></span>
						</li>																										
					</ul>
				</div>
				<?php
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}


	#delete particular task from database referencing the job id
	public function delete_task($job_id)
	{
		$delete_task = "DELETE FROM jobs WHERE job_id = :job_id ";
		$prepare_delete_task = $this->pdo_connect->prepare($delete_task);

		try {
			$prepare_delete_task->execute(array(":job_id" => $job_id));

			$msg = "Task deleted successfully!";
			header("Location: someplace.php?msg=" . $msg);

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	#check job status to applied
	public function job_status($job_id)
	{
		$update_status = "UPDATE jobs SET status = :stat WHERE job_id = :job_id ";
		$prepare_update = $this->pdo_connect->prepare($update_status);

		try {
			$prepare_update->execute(array(":stat" => "Closed", ":job_id" => $job_id));
			$msg = "Job status changed successfully!";

			header("Location: myjobs.php?msg=" . $msg);
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	#create function to request a task
	public function request_listing($job_id)
	{
		$select_job_specs = "SELECT * FROM jobs WHERE job_id = :job_id ";
		$prepare_select_jobs = $this->pdo_connect->prepare($select_job_specs);

		try {
			$prepare_select_jobs->execute(array(":job_id" => $job_id));
			$results = $prepare_select_jobs->rowCount();

			if ($results > 0) {
				while ($rows = $prepare_select_jobs->fetch(PDO::FETCH_ASSOC)) {
					$job_name = $rows['job_name'];
				}

				$add_application = "INSERT INTO myapplications (job_name, date_applied, time_applied, account_id, job_id) VALUES (:name, :d_app, :t_app, :acc_id, :job_id)";
				$prepare_add_application = $thi->pdo_connect->prepare($add_application);
				try {
					
					$data_array = array(":name" => $job_name,
				                        ":d_app" => Date('D, d-M, Y'),
				                        ":t_app" => Date('G:i:s a'),
				                        ":acc_id" => $_SESSION['current_session_id'],
				                        ":job_id" => $job_id);

					$prepare_add_application->execute($data_array);

					$msg = "Application for " . $job_name . "successful";
					header("Location: somepalce.php?msg=" . $msg);
					
				} catch (PDOException $exception) {
					#case of error, redirect user with error message
					header("Location: 504.php?msg=" . $exception->getMessage());
				}
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	#select task by location
	public function view_by_location()
	{
		$select_jobs_by_locale = "SELECT location FROM jobs ";
		$prepare_select_jobs = $this->pdo_connect->prepare($select_jobs_by_locale);

		$result_set = $prepare_select_jobs->rowCount();
		if ($result_set > 0) {
			while ($rows = $prepare_select_jobs->fetch(PDO::FETCH_ASSOC)) {
				$location_url = "location_jobs.php?location=" . $rows['location'];

				?>
				<li><a class="justify-content-between d-flex" href="<?php echo $location_url; ?>"><p><?php echo $rows['location']; ?></p><span><?php echo $rows['row_count']; ?></span></a></li>
				<?php
			}
		}else{
			$msg = "There are no Jobs posted by Locations so far!";
			#show error message
			?>
			<li><a class="justify-content-between d-flex" href=""><p><?php echo $msg; ?></p><span></span></a></li>
			<?php
		}
	}

	#show jobs by location selected
	public function select_jobs_by_location($location)
	{
		#select all matching rows
		$select_jobs = "SELECT * FROM jobs WHERE location = :locale ORDER BY job_id DESC";
		$prepare_select_jobs = $this->pdo_connect->prepare($select_jobs);

		#execute try catch block
		try {
			$data_array = array(":locale" => $location);
			$prepare_select_jobs->execute($data_array);

			$result_set = $prepare_select_jobs->rowCount();
			if ($result_set > 0) {
				while ($rows = $prepare_select_jobs->fetch(PDO::FETCH_ASSOC)) {
					$url = "single.php?jobID=" . $rows['job_id'];
					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="<?php echo $rows['icon']; ?>" alt="" haight="100px" width="100px">
							<ul class="tags">
								<li>
									<a href="#"><?php echo $rows['status']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['date_posted']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['time_posted']; ?></a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6><?php echo $rows['category']; ?></h6>					
								</div>
								<ul class="btns">
									<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="#">Apply</a></li>
								</ul>
							</div>
							<p>
								<?php echo $rows['preview']; ?>
							</p>
							<h5>Job Nature: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span> <?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}else{
				$msg = "There are no Jobs in this location!";
				/*
				*show and alert error message
				*/
			}

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	//set function to view jobs by category
	public function view_by_category($category)
	{
		$get_category_jobs = "SELECT * FROM jobs WHERE category = :cat ORDER BY job_id DESC ";
		$prepare_get = $this->pdo_connect->prepare($get_category_jobs);

		try {
			
			$prepare_get->execute(array(":cat" => $category));
			//check set results
			$result_set = $prepare_get->rowCount();

			if ($result_set > 0) {
				while ($rows = $prepare_get->fetch(PDO::FETCH_ASSOC)) {
					$url = "single.php?jobID=" . $rows['job_id'];
					?>
					<div class="single-post d-flex flex-row">
						<div class="thumb">
							<img src="<?php echo $rows['icon']; ?>" style="padding: 10px; margin: 10px;" alt="" height="200px" width="200px">
							<ul class="tags">
								<li>
									<a href="#"><?php echo $rows['status']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['date_posted']; ?></a>
								</li>
								<li>
									<a href="#"><?php echo $rows['time_posted']; ?></a>					
								</li>
							</ul>
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
									<h6><?php echo $rows['category']; ?></h6>					
								</div>
								<ul class="btns">
									<li><a href="#"><span class="lnr lnr-heart"></span></a></li>
									<li><a href="#">Apply</a></li>
								</ul>
							</div>
							<p>
								<?php echo $rows['preview']; ?>
							</p>
							<h5>Job Nature: <?php echo $rows['job_type']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span> <?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
						</div>
					</div>
					<?php
				}
			}else{
				?>
				<div class="single-post d-flex flex-row">
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a href="single.html"><h4>There are no jobs in this category yet.</h4></a>
									<h6></h6>					
								</div>
							</div>
							<p>
								We are sorry for all the inconvenience, we currently do not have any jobs posted in this category yet and would like to ask you to check out other rellevant jobs from your preferences. <br>
								<center><p style="color: yellow; font-family: forte; font-size: 25px;">Thank You!</p></center>
							</p>
						</div>
					</div>
				<?php
			}
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}
	
}

?>