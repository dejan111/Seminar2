<!-- za višejezičnost -->
<?php
	include_once 'common.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Seminar 2">
    <meta name="author" content="Dejan Pavkovic">

    <title><?php echo $lang['LOGIN'];?></title>

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
			<a href="login.php?lang=en" class="language" rel="en-US"><img class="language_img" src="images/flag_of_GB.png" alt="English" /></a>
			<a href="login.php?lang=hr" class="language" rel="hr-HR"><img class="language_img" src="images/flag_of_Croatia.png" alt="Croatian" /></a>
		</div>
		<div class="container registers">
			<a href="register.php"><?php echo $lang['REGISTER'];?></a>
			<a href="login.php"><?php echo $lang['LOGIN'];?></a>
		</div>
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
		<h1><?php echo $lang['LOGIN'];?></h1>
		<hr>
		
		<!-- forma za registraciju -->
		<div class="col-sm-6">
			<form role="form" action="login_check.php" method="post">
				<div class="form-group">
					<label class="sr-only" for="form-email-login"><?php echo $lang['EMAIL'];?></label>
					<input type="text" name="form-email-login" placeholder="<?php echo $lang['EMAIL'];?>..." class="form-control" id="form-email">
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-password-login"><?php echo $lang['PASSWORD'];?></label>
					<input type="password" name="form-password-login" placeholder="<?php echo $lang['PASSWORD'];?>&#46;&#46;&#46;" class="form-password form-control" id="form-password">
				</div>
				<button type="submit" onclick="return(login());" class="btn btn-info"><?php echo $lang['LOGIN'];?>&#33;</button>
			</form>
			<br /><br />
		</div>
		
		<hr class="clear-hr">
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
		function login()
		{
			var email = document.getElementById('form-email').value;
			var pass = document.getElementById('form-password').value;
			var atposition = email.indexOf("@");
			
			var email_alert = <?php echo json_encode($lang['EMAIL_ALERT']); ?>;
			var email_validation = <?php echo json_encode($lang['EMAIL_VALIDATION']); ?>;
			var pass_alert = <?php echo json_encode($lang['PASS_ALERT']); ?>;
			
			if(isEmpty(email))
			{
				alert(email_alert);
				document.getElementById('form-email').style.border = "1px solid red";
				return false;
			}
			else if(atposition < 1)
			{
				alert(email_validation);
				document.getElementById('form-email').style.border = "1px solid red";
				return false;
			}
			else if(isEmpty(pass))
			{
				alert(pass_alert);
				document.getElementById('form-password').style.border = "1px solid red";
				return false;
			}
			
			return true;
		}
		
		function isEmpty(str)
		{
			return !str.replace(/^\s+/g, '').length;
		}
	</script>
</body>

</html>
