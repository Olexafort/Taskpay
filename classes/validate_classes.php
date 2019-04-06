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


class validate extends database_connection {

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();

	}

	public function check_session()
	{
		if (!isset($_SESSION['current_session_id'])) {
			$msg = "Access Restricted to Users only!";

			header("Location: ../index.php?msg=" . $msg);
		}
	}

}
?>