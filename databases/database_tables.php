<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/

class app_tables extends database_connection{
	#declare and set class variables
	//private $pdo_connect;

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
		//$this->pdo_connect = new database_connection();
	}

	public function create_account_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS accounts (
				account_id int(11) not null auto_increment,
				first_name varchar(25) not null,
				last_name  varchar(25) not null,
				email      varchar(70) not null,
			    password   varchar(250) not null,
				phone_number int(11) not null,
				national_id int(15) not null,
				date_joined varchar(25) not null,
				PRIMARY KEY (account_id))";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_profile_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS profile (
				profile_id int(11) not null auto_increment,
				career varchar(1025) default null, 
				professional varchar(1025) default null,
				education varchar(1025) default null,
				technical varchar(1025) default null,
				experience varchar(1025) default null,
				resume varchar(250) not null,
				account_id int(11) not null,
				PRIMARY KEY (profile_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";
		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}	
	}

	public function create_jobs_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS jobs (
				job_id int(11) not null auto_increment,
				job_name varchar(70) not null,
				icon varchar(250) not null,
				pay varchar(25) not null,
				job_type varchar(50) not null,
				category varchar(100) not null,
				description varchar(1050) not null,
				preview varchar(100) not null,
				duration varchar(50) not null,
				location varchar(50) not null,
				area varchar(25) not null,
				status varchar(25) not null,
				date_posted varchar(25) not null,
				time_posted varchar(25) not null,
				account_id int(11) not null,
				PRIMARY KEY (job_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_myapplications_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS myapplications (
				application_id int(11) not null auto_increment,
				username varchar(100) not null,
				job_name varchar(100) not null,
				date_applied varchar(50) not null,
				time_applied varchar(50) not null,
				status varchar(50) not null,
				pay varchar(50) not null,
				client_id int(11) not null,
				account_id int(11) not null,
				job_id int(11) not null,
				PRIMARY KEY (application_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE,
				FOREIGN KEY (job_id) REFERENCES jobs (job_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_notifications_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS notifications (
				notification_id int(11) not null auto_increment,
				notification varchar(50) not null,
				job_name varchar(100) not null,
				job_id int(11) not null,
				username varchar(100) not null,
				pay varchar(25) not null,
				status varchar(25) not null,
				account_id int(11) not null,
				user_id int(11) not null,
				PRIMARY KEY (notification_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function job_details_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS job_details (
				details_id int(11) not null auto_increment,
				who varchar(1025) default null,
				experience varchar(1025) default null,
				features varchar(1025) default null,
				education varchar(1025) default null,
				job_id int(11) not null,
				PRIMARY KEY (details_id),
				FOREIGN KEY (job_id) REFERENCES jobs (job_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_preference_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS user_preference (
				pref_id int(11) not null auto_increment,
				pref_location varchar(50) not null,
				pref_category varchar(50) not null,
				pref_type varchar(50) not null,
				account_id int(11) not null,
				PRIMARY KEY (pref_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";
		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_wallet_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS wallet (
				wallet_id int(11) not null auto_increment,
				amount double not null,
				date_updated varchar(25) not null,
				time_updated varchar(25) not null,
				status varchar(50) not null,
				account_id int(11) not null,
				PRIMARY KEY (wallet_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_applications_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS myapplications (
				application_id int(11) not null auto_increment,
				job_name varchar(50) not null,
				date_applied varchar(25) not null,
				time_applied varchar(25) not null,
				status varchar(25) not null,
				client_id int(11) not null,
				account_id int(11) not null,
				job_id int(11) not null,
				PRIMARY KEY (application_id),
				FOREIGN KEY (job_id) REFERENCES jobs (job_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();

		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}

	public function create_myjobs_table()
	{
		$create_table = "CREATE TABLE IF NOT EXISTS myjobs (
				myjob_id int(11) not null auto_increment,
				job_name varchar(50) not null,
				date_time varchar(70) not null,
				job_id int(11) not null,
				account_id int(11) not null,
				PRIMARY KEY (myjob_id),
				FOREIGN KEY (account_id) REFERENCES accounts (account_id) ON DELETE CASCADE ON UPDATE CASCADE)";

		#try executing statement
		try {
			$prepare_table = $this->pdo_connect->prepare($create_table);
			$prepare_table->execute();
			
		} catch (PDOException $exception) {
			#case of error, redirect user with error message
			header("Location: 504.php?msg=" . $exception->getMessage());
		}
	}
}

?>