<?php
	session_start();
	setcookie("username", "", time() + (-3600 * 24 * 30));
	setcookie("userID", "", time() + (-3600 * 24 * 30));
	session_destroy();
	session_unset();
	header('Location: index.php');
?>