<?php
	include_once 'common.php';
	include_once 'dbConfig.php';
	
	$login_email = $_POST['form-email-login'];
	$login_pass = $_POST['form-password-login'];
	$errors = '';
	
	if(!$login_email==""){
		if(!$login_pass==""){
			$table_name = "users";
			$user = ORM::for_table($table_name)->where(array(
			'email' => $login_email
			))->find_one();
			if(!empty($user))
			{
				if(!password_verify($login_pass, $user->password))
				{
				$errors = $lang['WRONG_ENTER'];
				}
			}
			else{
				$errors = $lang['NO_USER'];
			}
		}
	}
	else{
		$errors = $lang['EMAIL_ALERT'];
	}
	
	if($errors!=''){
		echo "<script type='text/javascript'>alert('$errors');</script>";
		header('refresh:0.1;url=login.php');
	}
	else if(isset($user)){
		if($user!=null){
			$user_name = $user->first_name;
			$isAdmin = $user->admin;
			$isActive = $user->active;
			$cookie_name = "username";
			$cookie_userID = "userID";
			$cookie_value = $user_name;
			$cookie_userID_value = $user->userID;
			
			$_SESSION['username'] = $user_name;
			setcookie($cookie_name, $cookie_value, time() + (3600 * 24 * 30));
			setcookie($cookie_userID, $cookie_userID_value, time() + (3600 * 24 * 30));
			$user = null;
			
			if($isActive == 1)
			{
				if($isAdmin == 1)
				{
					header('Location: admin.php');
				}
				else
				{
					header('Location: index.php');
				}
			}
			else
			{
				$message = $lang['INACTIVE_USER'];
				echo "<script type='text/javascript'>alert('$message');</script>";
				header('refresh:0.1;url=register.php');
			}
		}
		else{
			$message = $lang['WRONG_ENTER'];
			echo "<script type='text/javascript'>alert('$message');</script>";
			header('refresh:0.1;url=login.php');
		}
	}
	else{
		$message = $lang['WARNING'];
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('refresh:0.1;url=login.php');
	}
 ?>