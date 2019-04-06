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


class artificial_intelligence extends database_connection {

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
	}

	#get user preferences and match jobs
	public function get_job_preferences($account_id)
	{
		$fetch_preferences = "SELECT * FROM user_preference WHERE account_id = :account_id ";
		$prepare_preferences = $this->pdo_connect->prepare($fetch_preferences);

		$prepare_preferences->execute(array(":account_id" => $account_id));
		$results = $prepare_preferences->rowCount();

		//check result collumns
		if ($results) {
			while ($rows = $prepare_preferences->fetch(PDO::FETCH_ASSOC)) {
				$location = $rows['pref_location'];
				$category = $rows['pref_category'];
				$type = $rows['pref_type'];
			}
			// fetch job records with matching preferences
			$select_jobs = "SELECT * FROM jobs WHERE job_type = :type OR category = :cat OR location = :loc ORDER BY job_id DESC LIMIT 4";
			$prepare_select_jobs = $this->pdo_connect->prepare($select_jobs);

			try {
				$data_array = array(":type" => $type,
			                        ":cat"  => $category,
			                        ":loc"  => $location);

				$prepare_select_jobs->execute($data_array);
				$result_set = $prepare_select_jobs->rowCount();

				//check row count
				if ($result_set > 0) {
					while ($rows = $prepare_select_jobs->fetch(PDO::FETCH_ASSOC)) {
						$url = "single.php?jobID=" . $rows['job_id'];
						?>

						<div class="single-popular-post d-flex flex-row">
							<div class="thumb">
								<img src="<?php echo $rows['icon']; ?>" alt="" height="100px" width="100px">
								<a class="btns text-uppercase" href="<?php echo $url; ?>">View Job</a>
							</div>
							<div class="details">
								<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
								<h6><?php echo $rows['location']; ?></h6>
								<p><?php echo $rows['preview']; ?></p>
							</div>
						</div>

						<?php
					}
				}
			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}

		}else{
			$select_other_records = "SELECT * FROM jobs ORDER BY RAND() LIMIT 4";
			$prepare_select = $this->pdo_connect->prepare($select_other_records);

			try {
				$prepare_select->execute();
				$result_set = $prepare_select->rowCount();

				if ($result_set) {
					while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
						$url = "single.php?jobID=" . $rows['job_id'];
						?>

						<div class="single-popular-post d-flex flex-row">
							<div class="thumb">
								<img src="<?php echo $rows['icon']; ?>" alt="" height="200px" width="200px">
								<a class="btns text-uppercase" href="<?php echo $url; ?>">View Job</a>
							</div>
							<div class="details">
								<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
								<h6><?php echo $rows['location']; ?></h6>
								<p><?php echo $rows['preview']; ?></p>
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
	}

	#show suggested job listings
	public function get_suggested_jobs($account_id)
	{
		$fetch_preferences = "SELECT * FROM user_preference WHERE account_id = :account_id ";
		$prepare_preferences = $this->pdo_connect->prepare($fetch_preferences);

		$prepare_preferences->execute(array(":account_id" => $account_id));
		$results = $prepare_preferences->rowCount();

		//check result collumns
		if ($results) {
			while ($rows = $prepare_preferences->fetch(PDO::FETCH_ASSOC)) {
				$location = $rows['pref_location'];
				$category = $rows['pref_category'];
				$type = $rows['pref_type'];
			}
			// fetch job records with matching preferences
			$select_jobs = "SELECT * FROM jobs WHERE job_type = :type AND category = :cat AND location = :loc ORDER BY job_id DESC LIMIT 4";
			$prepare_select_jobs = $this->pdo_connect->prepare($select_jobs);

			try {
				$data_array = array(":type" => $type,
			                        ":cat"  => $category,
			                        ":loc"  => $location);

				$prepare_select_jobs->execute($data_array);
				$result_set = $prepare_select_jobs->rowCount();

				//check row count
				if ($result_set > 0) {
					while ($rows = $prepare_select_jobs->fetch(PDO::FETCH_ASSOC)) {
						$url = "single.php?jobID=" . $rows['job_id'];
						?>

						<div class="single-rated">
							<img class="img-fluid" src="<?php echo $rows['icon']; ?>" alt="">
							<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
							<h6><?php echo $rows['category']; ?></h6>
							<p><?php echo $rows['preview']; ?></p>
							<h5>Job Nature: <?php echo $rows['location']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span><?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
							<a href="#" class="btns text-uppercase">Apply job</a>
						</div>

						<?php
					}
				}else{
					?>
					<div class="single-rated">
						<h4>There  are no suggestions yet</h4>
					</div>
					<?php
				}
			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}

		}else{
			$select_other_records = "SELECT * FROM jobs ORDER BY RAND() LIMIT 2";
			$prepare_select = $this->pdo_connect->prepare($select_other_records);

			try {
				$prepare_select->execute();
				$result_set = $prepare_select->rowCount();

				if ($result_set) {
					while ($rows = $prepare_select->fetch(PDO::FETCH_ASSOC)) {
						$url = "single.php?jobID=" . $rows['job_id'];
						?>

						<div class="single-rated">
							<img class="img-fluid" src="<?php echo $rows['icon']; ?>" alt="">
							<a href="<?php echo $url; ?>"><h4><?php echo $rows['job_name']; ?></h4></a>
							<h6><?php echo $rows['category']; ?></h6>
							<p><?php echo $rows['preview']; ?></p>
							<h5>Job Nature: <?php echo $rows['location']; ?></h5>
							<p class="address"><span class="lnr lnr-map"></span><?php echo $rows['location']; ?></p>
							<p class="address"><span class="lnr lnr-database"></span> <?php echo $rows['pay']; ?></p>
							<a href="#" class="btns text-uppercase">Apply job</a>
						</div>

						<?php
					}
				}

			} catch (PDOException $exception) {
				#case of error, redirect user with error message
				header("Location: 504.php?msg=" . $exception->getMessage());
			}
		}
	}

}