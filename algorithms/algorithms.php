<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/

class app_algorithms {

	#Declare class variables with
	private $pdo_connect = null;
	

	#create constructor class to instantiate the database connection
	function __construct($database_connection)
	{
		$this->pdo_connect = $database_connection;

	}

	#check user login session
	public function check_session()
	{
		if (!isset($_SESSION[''])) {
			$msg = "Access Restricted. Please Login to continue!";
			header("Location: ./index.php?msg=" . $msg);
		}else if (time() > $_SESSION['session_timeout']) {
			$msg = "Session expired!";
			header("Location: ./index.php?msg=" . $msg);
		}
	}


}

?>