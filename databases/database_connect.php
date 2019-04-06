<?php
/**
************* @author Nashon Odhiambo Odiwuor    				      **************
************* Project Name: TaskPay   								  **************
************* Project Type: School Project   						  **************
************* Project Category: Web Application                       **************
************* Project Languages: PHP, HTML, CSS, JAVASCRIPT, AJAX     **************
************* Project Frameworks: Bootstrap, Bootswatch, FontAwesome  **************
*/

session_start();

class database_connection {

	public $pdo_connect;

	private $hostname          = "localhost";
	private $database_name     = "taskpay";
	private $database_user 	   = "root";
	private $database_password = "";

	public function __construct()
	{
		$this->database_connect();
	}


	public function database_connect()
	{
		$this->pdo_connect = null;

		try {
			$this->pdo_connect = new PDO('mysql:host='. $this->hostname . '; dbname='. $this->database_name, $this->database_user, $this->database_password);
			$this->pdo_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo_connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		} catch (PDOException $exception) {
				
			header("Location: 504.php?msg=" . $exception->getMessage());	
		}

	}

	function __destruct()
	{
		$this->pdo_connect = null;
	}

}

?>