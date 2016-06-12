<?php
	require_once 'idiorm.php';
	$username = 'root';
	$pass = '';
	ORM::configure('mysql:host=localhost;dbname=notiflyerdb');
	ORM::configure('username', $username);
	ORM::configure('password', $pass);
	ORM::configure('return_result_sets', true);
	ORM::configure('id_column_overrides',array(
		'users' => 'userID',
		'flights' => 'flightID',
		'notifications' => 'notificationID'
	));
?>