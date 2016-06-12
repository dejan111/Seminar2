<?php
	include_once 'dbConfig.php';
	
	$table_name ="users";
	$cookie_name = "deactivate_email";
	$email = $_COOKIE[$cookie_name];
	
	$user = ORM::for_table($table_name)->where('email',$email)->find_one();
	if(!empty($user))
	{
		$user->active = 0;
		$user->save();
		$user = null;
	}
	setcookie($cookie_name, "", time() + (-3600 * 24 * 30));
	header('Location: admin.php');
?>