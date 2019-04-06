<?php
require_once('tests.php');

echo $b;

if (time() > $b) {
	$msg = "Session Timeout";
	echo "<br>" . $b . " with error message " . $msg;
}

?>