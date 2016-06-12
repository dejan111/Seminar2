<?php
	include_once 'dbConfig.php';
	
	$table_name_fly = "flights";
	$table_name_not = "notifications";
	$table_name_user = "users";
	
	$userID = $_COOKIE['userID'];
	$dest_num = $_COOKIE['dest_num'];
	$day = $_COOKIE['day'];
	
	
	$flight_label = flightLabel($dest_num);
	
	$flight = ORM::for_table($table_name_fly)->where(array(
			'flight_num' => $flight_label,
			'day' => $day
			))
			->find_one();
			
	$user = ORM::for_table($table_name_user)->where_id_is($userID)->find_one();
	
	if(!empty($flight) && !empty($user))
	{
		$flightID = $flight->flightID;
		$notification = ORM::for_table($table_name_not)->create();
		$notification->flightID = $flightID;
		$notification->userID = $userID;
		$notification->save();
		$notification = null;
	}
	
	header('Location: index.php');
	
	// flight label in a XY 1111 form
	function flightLabel($dest_num)
	{
		//Flight label - numbers
		preg_match_all('!\d+!', $dest_num, $matches);
		$flight_num = implode('',$matches[0]);
				
		$flight_string = trim($dest_num, $flight_num);
				
		//Flight label - letters
		$flight_letters = substr($flight_string, $flight_string - 3, 2);
				
		//Complete flight label
		$flight_label = $flight_letters . ' ' . $flight_num;
		
		return $flight_label;
	}
?>