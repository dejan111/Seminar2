<?php
	include_once 'mail.php';
	include_once 'dbConfig.php';
	
	session_start();
	//set time of demo.php last execution
	$cookie_executionTime = "execution_time";
	$cookie_execValue = date('d/m/Y H:i:s');
	setcookie($cookie_executionTime, $cookie_execValue, time() + (3600 * 24 * 30));
	$_SESSION['execution_time'] = date('d/m/Y H:i:s');
	
	//table names
	$table_name = "flights";
	$table_notif = "notifications";
	$table_user = "users";
	
	//step1
	$cSession = curl_init(); 
	//step2
	curl_setopt($cSession,CURLOPT_URL,"http://www.zagreb-airport.hr/mobilepolasci.aspx?tip=A");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	//step3
	$result=curl_exec($cSession);
	//step4
	curl_close($cSession);

	$dom = new DOMDocument();

	//supress error
	libxml_use_internal_errors(true);
	$dom->loadHTML($result);
	libxml_use_internal_errors(false);

	$rows = $dom->getELementsByTagName('tr');

	for ($i = 1; $i < $rows->length; $i++) {
		$cells = $rows->item($i)->getElementsByTagName('td');
		for ($j = 0; $j < $cells->length; $j++) {
			$table_data[$i][$j] = $cells->item($j)->textContent;
		}
	}

	for($j = 1; $j <$rows->length; $j++)
	{ 
		//initialization
		$flight_str = '';
		$flight_num = '';
		$flight_letters = '';
		$flight_label = '';
		$flight_destination = '';
		$flight_day = '';
		$flight_state = '';
		$flight_estimated_actual = '';
		$inactive = 0;
		$flag = 0;
		
		$flight_str = $table_data[$j][0];
				
		//Flight label - numbers
		preg_match_all('!\d+!', $flight_str, $matches);
		$flight_num = implode('',$matches[0]);
				
		$flight_str = trim($flight_str, $flight_num);
				
		//Flight label - letters
		$flight_letters = substr($flight_str, $flight_str - 3, 2);
				
		//Complete flight label
		$flight_label = $flight_letters . ' ' . $flight_num;
		
		//other flight info
		$flight_destination = substr($flight_str, 0, -3);
		$flight_day = $table_data[$j][1];
		$flight_state = $table_data[$j][3];
		$flight_estimated_actual = $table_data[$j][2];
		
		//parsing time to check if it passed 5min from landing. If it is, inactive flag = 1;
		/*$flight_time = substr($flight_estimated_actual, 8, 5);
		$flight_time = $flight_time.':00';
		$flight_time = date(' H:i:s', strtotime($flight_time));
		$adjusted_time = date('H:i:s',strtotime('+5 minutes',strtotime($flight_time)));
		$adjusted_time = strtotime($adjusted_time);
		$now = date(" H:i:s", time());
		$now = strtotime($now);*/
		
		$state_landed = 'Sletio';
		$flight_cancelled = 'OtkazanLet';
		
		if(str_replace(' ', '', $flight_state) == $state_landed || str_replace(' ', '', $flight_state) == $flight_cancelled)
		{
			$inactive = 1;
		}
		
		//if record exist update state and estimated/actual and save
		$flight1 = ORM::for_table($table_name)->where(array(
			'flight_num' => $flight_label,
			'day' => $flight_day
			))
			->find_one();
			
		if(!empty($flight1))
		{
			$flag = 1;
			if($flight1->inactive == 0)
			{
				$flight1->set(array(
				'state' => $flight_state,
				'estimated_actual' => $flight_estimated_actual
				));
				if($inactive == 1)
				{
					$flightID = $flight1->flightID;
					$notification = ORM::for_table($table_notif)->where('flightID', $flightID)->find_many();
					if(!empty($notification))
					{
						foreach($notification as $notif)
						{
							$userID = $notif->userID;
							$user = ORM::for_table($table_user)->where('userID', $userID)->find_one();
							if(!empty($user))
							{
								echo $user->first_name.' '.$user->email;
								$user_mail = $user->email;
								$user_name = $user->first_name;
							
								//send mail
								$mail->addAddress($user_mail, $user_name);
								$mail->Subject = 'Flight notification';
								$mail->Body    = 'Flight '.$flight1->flight_num.' from '.$flight1->destination.' has landed. Thank you for using our app.';
 
								$mail->send();
							}
						}
					}
					$flight1->inactive = 1;
				}
				$flight1->save();
				$flight1 = null;
			}
		}
		
		//if record doesn't exist, create new and save
		if($flag == 0)
		{
			$flight = ORM::for_table($table_name)->create();
		
			$flight->day = $flight_day;
			$flight->destination = $flight_destination;
			$flight->flight_num = $flight_label;
			$flight->state = $flight_state;
			$flight->estimated_actual = $flight_estimated_actual;
			if($inactive == 1)
			{
				$flight->inactive = 1;
			}
			$flight->save();
			$flight = null;
		}
	}
?>