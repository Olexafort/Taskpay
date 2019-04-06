<?php

if (session_start()) {
	session_unset();
	session_destroy();

	$msg_p = "Logout Successful";
	header("Location: ../index.php?msg_p=" . $msg_p);

}

?>