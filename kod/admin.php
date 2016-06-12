<?php
	//configuration for ORM and languages
	include_once 'common.php';
	include_once 'dbConfig.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Seminar 2">
    <meta name="author" content="Dejan Pavkovic">

    <title><?php echo $lang['ADMIN_PANEL'];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

	<!-- custom css for bootstrap</!-->
	<link href="css/custom.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container languages">
			<a href="kontakt.php?lang=en" class="language" rel="en-US"><img class="language_img" src="images/flag_of_GB.png" alt="English" /></a>
			<a href="kontakt.php?lang=hr" class="language" rel="hr-HR"><img class="language_img" src="images/flag_of_Croatia.png" alt="Croatian" /></a>
		</div>
		<?php
			$message2 = $lang['PERMISSION'];
			$cookie_name = 'username';
			$session_name = 'username';
			$table_users = 'users';
			$admin_false = 0;
			if(isset($_SESSION[$session_name])){
				$user = ORM::for_table($table_users)->where('first_name', $_SESSION[$session_name])->find_one();
				if(!empty($user))
				{
					if($user->admin == $admin_false)
					{
						echo "<script type='text/javascript'>alert('$message2');</script>";
						header('refresh:0.0001;url=index.php');
					}
				}
				echo '
				<div class="container registers">
					<p class="hello_user">'.$lang['HELLO'].' '.$_SESSION[$session_name].'!</p>
					<button onclick="logout();" type="button" id="LogoutButton">'.$lang['LOGOUT'].'</button>
				</div>';
			}
			else if(isset($_COOKIE[$cookie_name])){
				$user = ORM::for_table($table_users)->where('first_name', $_COOKIE[$cookie_name])->find_one();
				if(!empty($user))
				{
					if($user->admin == $admin_false)
					{
						echo "<script type='text/javascript'>alert('$message2');</script>";
						header('refresh:0.0001;url=index.php');
					}
				}
				echo '
				<div class="container registers">
					<p class="hello_user">'.$lang['HELLO'].' '.$_COOKIE[$cookie_name].'!</p>
					<button onclick="logout();" type="button" id="LogoutButton">'.$lang['LOGOUT'].'</button>
					
				</div>';
			}
			else{
				echo'
				<div class="container registers">
					<a href="register.php">'.$lang['REGISTER'].'</a>
					<a href="login.php">'.$lang['LOGIN'].'</a>
				</div>';
			}
		?>
		<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Notiflyer</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="upute.php"><?php echo $lang['MANUAL'];?></a></a>
                    </li>
                    <li>
                        <a href="kontakt.php"><?php echo $lang['CONTACT'];?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Body -->
    <div class="container">
		<?php
			$cookie_executionTime = "execution_time";
			$users_table = "users";
		
			$users = ORM::for_table($users_table)->find_many();
		?>
		<br />
		<h4><?php echo $lang['LAST_DATAFETCH'];?>: <?php 
		if(isset($_SESSION['execution_time']))
		{
			echo $_SESSION['execution_time'];
		}
		else if(isset($_COOKIE['execution_time']))
		{
			echo $_COOKIE['execution_time'];
		}
		?></h4>
		<br />
		
		<table class="table">
					<thead>
						<tr>
							<th><?php echo $lang['FIRST_NAME'];?></th>
							<th><?php echo $lang['LAST_NAME'];?></th>
							<th><?php echo $lang['EMAIL'];?></th>
							<th><?php echo $lang['ACTIVE'];?></th>
							<th><?php echo $lang['ADMIN'];?></th>
							<th><?php echo $lang['DELETE'];?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$false = 0;
							$true = 1;
							foreach($users as $user)
							{
								echo '
								<tr>
									<td>'.$user->first_name.'</td>
									<td>'.$user->last_name.'</td>
									<td>'.$user->email.'</td>
									<td>'.$user->active.'</td>
									<td>'.$user->admin.'</td>';
									if($user->active == $true)
									{
										echo '<td><button type="button" onclick="deleteUser(this)" class="btn btn-info">'.$lang['DELETE'].'</button></td>';
									}
									else
									{
										echo '<td><button type="button" onclick="activateUser(this)" class="btn btn-info">'.$lang['ACTIVATE'].'</button></td>';
									}
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		function logout(){
			document.location = 'logout.php';
		}
		
		function deleteUser(element)
		{
			var cells = [];
			var cells = element.parentNode.parentNode.getElementsByTagName('td');
			var email = cells[2].innerText;
			var active = cells[3].innerText;
			if(active == "1")
			{
				var confirmDeactivation = confirm('<?php echo $lang["DEACTIVATE"];?>');
				if(confirmDeactivation == true)
				{
					document.cookie = "deactivate_email="+email;
					document.location = 'deactiv.php';
				}
			}
			else
			{
				alert('<?php echo $lang['INACTIVE'];?>');
			}
		}
		
		function activateUser(element)
		{
			var cells = [];
			var cells = element.parentNode.parentNode.getElementsByTagName('td');
			var email = cells[2].innerText;
			var active = cells[3].innerText;
			if(active == "0")
			{
				var confirmActivation = confirm('<?php echo $lang["ACTIVATION"];?>');
				if(confirmActivation == true)
				{
					document.cookie = "activate_email="+email;
					document.location = 'activate.php';
				}
			}
			else
			{
				alert('<?php echo $lang['ALREADY_ACTIVE'];?>');
			}
			
			
		}
	</script>

</body>

</html>
