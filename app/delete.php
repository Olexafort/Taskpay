<?php
require_once('../classes/accounts_classes.php');

$account = new accounts_class();

if (isset($_GET['account_id'])) {
	$account->delete_user($_GET['account_id']);
}

?>