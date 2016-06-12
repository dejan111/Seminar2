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

    <title>Notiflyer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

	<!-- custom css for bootstrap</!-->
	<link href="css/custom.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</head>

<body>
	<!-- MODAL for choosing flight for notification -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><strong><?php echo $lang['REMINDER'];?></strong></h4>
				</div>
				<div class="modal-body">
					<p><?php echo $lang['MODAL_TEXT1'];?> <strong><?php echo $_COOKIE['dest_num'];?></strong> 
					 <?php echo $lang['ON_DAY'];?> <strong><?php echo $_COOKIE['day'];?></strong> 
					 <?php echo $lang['WHEN_LANDED'];?>.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="set_notif" onclick="check_auth();" class="btn btn-primary">Set notification</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- login, validation, cookies...-->
	<?php
		$errors = '';
		$cookie_name = "username";
		$cookie_userID = "userID";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// inputs from registration
			$fname = $_POST['form-first-name'];
			$lname = $_POST['form-last-name'];
			$email = $_POST['form-email'];
			$pass = $_POST['form-password'];
			$pass2 = $_POST['form-password-confirm'];
			
			$cookie_value = $fname;
			if(!$fname==""){
				if(preg_match('/^[a-zA-Z)]+$/',$fname)){
					if(strlen($fname)>=3 and strlen($fname) <=50){
						if(!$email==""){
							if(!$pass==""){
								if(strlen($pass)>=5){
									if(!$pass2==""){
										if($pass == $pass2){
											// creating and populating ORM
											$table_name = "users";
											$user = ORM::for_table($table_name)->create();
											
											$hash_pass = password_hash($pass, PASSWORD_BCRYPT);
											$user->first_name = $fname;
											$user->last_name = $lname;
											$user->password = $hash_pass;
											$user->email = $email;
											$user->date_Created = date('Y-m-d');
											$user->save();
											setcookie($cookie_userID, $user->userID, time() + (3600 * 24 * 30));
											$user = null;
											
											$_SESSION['username'] = $fname;
											setcookie($cookie_name, $cookie_value, time() + (3600 * 24 * 30));
										}
										else{
											$errors = $lang['PASS_EQUAL'];
										}
									}
									else{
										$errors = $lang['PASS2_ALERT'];
									}
								}
								else{
									$errors = $lang['PASS_LENGTH_ALERT'];
								}
							}
							else{
								$errors = $lang['PASS_ALERT'];
							}
						}
						else{
							$errors = $lang['EMAIL_ALERT'];
						}
					}
					else{
						$errors = $lang['NAME_LENGTH_ALERT'];
					}
				}
				else{
					$errors = $lang['NAME_LETTERS'];
				}
			}else{
				$errors = $lang['NAME_ALLERT'];
			}
			
			if($errors!=''){
				$message = $lang['ERROR_REG'];
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	?>
	
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container languages">
			<a href="index.php?lang=en" class="language" rel="en-US"><img class="language_img" src="images/flag_of_GB.png" alt="English" /></a>
			<a href="index.php?lang=hr" class="language" rel="hr-HR"><img class="language_img" src="images/flag_of_Croatia.png" alt="Croatian" /></a>
		</div>
		<?php
			if(isset($_SESSION['username'])){
				echo '
				<div class="container registers">
					<p class="hello_user">'.$lang['HELLO'].' '.$_SESSION['username'].'!</p>
					
					<button onclick="logout();" type="button" id="LogoutButton">'.$lang['LOGOUT'].'</button>
				</div>';
			}
			else if(isset($_COOKIE[$cookie_name])){
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
		<!--<div class="container registers"><a>'.$lang['LOGOUT'].'</a>
			<a href="register.php"><?php echo $lang['REGISTER'];?></a>
			<a href="login.php"><?php echo $lang['LOGIN'];?></a>
		</div>-->
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
        <div class="row">
            <!-- Letovi -->
            <div class="col-md-8">
				<?php
					$start=0;
					$limit=10;
 
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						$start = ($id-1)*$limit;
					}
					else
					{
						$id = 1;
					}
					
					$dest = "";
					if(isset($_COOKIE['destFilter']))
					{
						$dest = $_COOKIE['destFilter'];
					}
					
					$flightNum = "";
					if(isset($_COOKIE['flightFilter']))
					{
						$flightNum = $_COOKIE['flightFilter'];
					}
					
					$day = "";
					if(isset($_COOKIE['dayFilter']))
					{
						$day = $_COOKIE['dayFilter'];
					}
					
					//Fetch from database first 10 items
					$table_name = "flights";
					$flights_10 = ORM::for_table($table_name)
						->raw_query('select * from '.$table_name.' where(
						inactive=0 and (
							if (LENGTH("'.$dest.'")>0, destination LIKE "%'.$dest.'%", 1)
							and if(LENGTH("'.$flightNum.'")>0, flight_num LIKE "%'.$flightNum.'%", 1)
							and if(LENGTH("'.$day.'")>0, day LIKE "%'.$day.'%", 1))
						)
						LIMIT '.$start.', '.$limit)
						->find_many();
						
						/*setcookie("destFilter", "", time() + (-3600 * 24 * 30));
						setcookie("flightFilter", "", time() + (-3600 * 24 * 30));
						setcookie("dayFilter", "", time() + (-3600 * 24 * 30));*/
				?>
                <h1 class="page-header">
                    <?php echo $lang['BIG_TITLE'];?>
                </h1>
				<table class="table">
					<thead>
						<tr>
							<th><?php echo $lang['DESTINATION'];?> &#47; <?php echo $lang['FLIGHT_NUM'];?></th>
							<th><?php echo $lang['DAY'];?></th>
							<th><?php echo $lang['ESTIMATED'];?>&#45;<?php echo $lang['ACTUAL'];?></th>
							<th><?php echo $lang['STATE'];?></th>
							<th><?php echo $lang['REMINDER'];?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							/* PAGINATION */
							//print 10 items
							foreach($flights_10 as $flight)
							{
								echo '
								<tr>
									<td>'.$flight->destination.' &#47; '.$flight->flight_num.'</td>
									<td>'.$flight->day.'</td>
									<td>'.$flight->estimated_actual.'</td>
									<td>'.$flight->state.'</td>
									<td><button type="button" data-toggle="modal" onclick="setFlightCookies(this)" id="modalBtn" data-target="#myModal" class="btn btn-info btn-circle">&#8826;</button></td>
								</tr>';
							}
						?>
					</tbody>
				</table>
				<?php
					//fetch all the data from database.
					$flights = ORM::for_table($table_name)
						->raw_query('select * from '.$table_name.' where(
						inactive=0 and (
							if (LENGTH("'.$dest.'")>0, destination LIKE "%'.$dest.'%", 1)
							and if(LENGTH("'.$flightNum.'")>0, flight_num LIKE "%'.$flightNum.'%", 1)
							and if(LENGTH("'.$day.'")>0, day LIKE "%'.$day.'%", 1))
						)
						LIMIT '.$start.', '.$limit)
						->find_many();
					$num_of_flights = ORM::for_table($table_name)->count();
						
					//calculate total page number for the given table in the database
					$total=ceil($num_of_flights/$limit);
					echo '<div class="pagination_div">';
					if($id>1)
					{
						//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
						echo '<a href="?id='.($id-1).'"><button class="btn btn-info previous">PREVIOUS</button></a>';
					}
						
					if($id!=$total)
					{
						//Go to previous page to show next 10 items.
						echo '<a href="?id='.($id+1).'"><button class="btn btn-info">NEXT</button></a>';
					}
					echo '</div>';
				?>
			</div>

            <!-- Filter -->
            <div class="well col-md-4 filter">
				<h3><?php echo $lang['SEARCH'];?></h3><br />
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo $lang['DESTINATION'];?></label>
						<div class="col-sm-8">
							<input class="form-control" id="destFilter" type="text" placeholder="<?php echo $lang['DESTINATION_VALUE'];?>&#46;&#46;&#46;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo $lang['FLIGHT_NUM'];?></label>
						<div class="col-sm-8">
							<input class="form-control" id="flightFilter" type="text" placeholder="<?php echo $lang['FLIGHT_NUM_VALUE'];?>&#46;&#46;&#46;">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo $lang['DAY'];?></label>
						<div class="col-sm-8">
							<input class="form-control" id="dayFilter" type="text" placeholder="<?php echo $lang['DATE_VALUE'];?>&#46;&#46;&#46;">
						</div>
					</div>
					<button class="btn btn-info searchBtn" onclick="setFilter()" type="button"><?php echo $lang['START_SEARCH'];?></button>
					<button class="btn btn-info clearFilterBtn" onclick="clearFilter()" type="button"><?php echo $lang['CLEAR_FILTER'];?></button>
				</form>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Dejan Pavković 2016</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

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
		
		$('#myModal').on('shown.bs.modal', function () {
			$('#myInput').focus()
		})
		
		function check_auth()
		{
			//setFlightCookies();
			if(checkCookie())
			{
				document.location = 'set_notif.php';
			}
			else
			{
				alert('<?php echo $lang['MUST_LOGIN']; ?>');
			}
		}
		
		function getCookie(cname) 
		{
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i <ca.length; i++) 
			{
				var c = ca[i];
				while (c.charAt(0)==' ') 
				{
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) 
				{
					return c.substring(name.length,c.length);
				}
			}
		}
		
		function checkCookie() 
		{
			var cname = "username";
			var user = getCookie(cname);
			if (user != "" && user!=undefined) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function setFlightCookies(element)
		{
			delete_cookie("dest_num");
			delete_cookie("day");
			var cells = [];
			var cells = element.parentNode.parentNode.getElementsByTagName('td');
			var dest_num = cells[0].innerText;
			var day = cells[1].innerText;
			document.cookie = "dest_num="+dest_num;
			document.cookie = "day="+day;
		}
		
		function delete_cookie( name ) 
		{
			document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		}
		
		function setFilter()
		{
			var dest = document.getElementById('destFilter').value;
			var flight = document.getElementById('flightFilter').value;
			var day = document.getElementById('dayFilter').value;
			document.cookie = "destFilter="+dest;
			document.cookie = "flightFilter="+flight;
			document.cookie = "dayFilter="+day;
			delete_cookie("flag");
			
			document.location = "index.php";
		}
		
		function clearFilter()
		{
			var dest = "destFilter";
			var flight = "flightFilter";
			var day = "dayFilter";
			delete_cookie(dest);
			delete_cookie(flight);
			delete_cookie(day);
			
			document.location = "index.php";
		}
	</script>
</body>
</html>
