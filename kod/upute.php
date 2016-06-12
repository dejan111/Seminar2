<?php
	//configuration for ORM and languages
	include_once 'common.php';
	include_once 'dbConfig.php';
	require_once 'idiorm.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Seminar 2">
    <meta name="author" content="Dejan Pavkovic">

    <title><?php echo $lang['MANUAL'];?></title>

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
			<a href="upute.php?lang=en" class="language" rel="en-US"><img class="language_img" src="images/flag_of_GB.png" alt="English" /></a>
			<a href="upute.php?lang=hr" class="language" rel="hr-HR"><img class="language_img" src="images/flag_of_Croatia.png" alt="Croatian" /></a>
		</div>
		<?php
			$cookie_name = 'username';
			$session_name = 'username';
			if(isset($_SESSION[$session_name])){
				echo '
				<div class="container registers">
					<p class="hello_user">'.$lang['HELLO'].' '.$_SESSION[$session_name].'!</p>
					
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
		<h1 class="page-header"><?php echo $lang['TITLE_MANUAL'];?></h1>
		<hr>
		<img class="img-responsive img-border img-left manualImg" src="images/manual.jpg" alt="User guide">
		<p><?php echo $lang['TEXT_MANUAL'];?></p>
		
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
	</script>
</body>

</html>
