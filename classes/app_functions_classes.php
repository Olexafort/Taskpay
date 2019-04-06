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

class app_functions extends database_connection {

	#declare and set class variables
	//private $pdo_connect;

	#create constructor class to instantiate the database connection
	function __construct()
	{
		parent::__construct();
		//$this->pdo_connect = $database_connection;
	}

	#create a function to send mail
	public function send_mail ($to, $from, $body, $title)
	{
		
	}

	public function get_total_jobs()
	{
		$tables = new app_tables();
		$tables->create_jobs_table();
		
		$select_all = "SELECT * FROM jobs";
		$prepare_select = $this->pdo_connect->prepare($select_all);

		try {
			$prepare_select->execute();
			$result_set = $prepare_select->rowCount();

			switch ($result_set) {
				case $result_set < 0:
					?>
					<span></span> There are no jobs posted yet. Post today!
					<?php
					break;
				
				case $result_set == 1:
                    ?>
					<span><?php echo $result_set; ?></span> Job posted so far
					<?php
                    break;

				case $result_set > 1:
                    ?>
					<span><?php echo $result_set; ?></span> Jobs posted so far
					<?php
                    break;

				default:
					?>
					<span><?php echo $result_set; ?></span> Jobs posted so far
					<?php
					break;
			}
		} catch (PDOException $exception) {
			
		}
	}

}

?>