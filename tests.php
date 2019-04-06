<?php
require_once('databases/database_connect.php');
require_once('classes/accounts_classes.php');

$db_connection = new database_connection();
$create_user = new accounts_class($db_connection);

#get data from form
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	
	$first_name = $create_user->$_POST['first'];
	$last_name = $create_user->$_POST['last'];

	echo $first_name . " " . $last_name;
}

?>