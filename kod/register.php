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

    <title><?php echo $lang['REGISTRATION'];?></title>

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
			<a href="register.php?lang=en" class="language" rel="en-US"><img class="language_img" src="images/flag_of_GB.png" alt="English" /></a>
			<a href="register.php?lang=hr" class="language" rel="hr-HR"><img class="language_img" src="images/flag_of_Croatia.png" alt="Croatian" /></a>
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
		<h1><?php echo $lang['REGISTRATION'];?></h1>
		<hr>
		
		<!-- forma za registraciju -->
		<div class="col-sm-6">
			<form role="form" onsubmit="return validate();" action="<?php echo htmlspecialchars("index.php");?>" method="post">
				<div class="form-group">
					<label id="nameValidation" class="nameValidation" style="display: none;">Nema imena</label>
					<label class="sr-only" for="form-first-name"><?php echo $lang['FIRST_NAME'];?></label>
					<input type="text" name="form-first-name" placeholder="&#40;<?php echo $lang['REQUIRED'];?>&#41; <?php echo $lang['FIRST_NAME'];?>&#46;&#46;&#46;" class="form-control" id="form-first-name">
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-last-name"><?php echo $lang['LAST_NAME'];?></label>
					<input type="text" name="form-last-name" placeholder="<?php echo $lang['LAST_NAME'];?>&#46;&#46;&#46;" class="form-control" id="form-last-name">
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-email"><?php echo $lang['EMAIL'];?></label>
					<input type="text" name="form-email" placeholder="&#40;<?php echo $lang['REQUIRED'];?>&#41; <?php echo $lang['EMAIL'];?>&#46;&#46;&#46;" class="form-control" id="form-email">
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-password"><?php echo $lang['PASSWORD'];?></label>
					<input type="password" name="form-password" placeholder="&#40;<?php echo $lang['REQUIRED'];?>&#41; <?php echo $lang['PASSWORD'];?>&#46;&#46;&#46;" class="form-control" id="form-password">
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-password-confirm"><?php echo $lang['CONFIRM_PASS'];?></label>
					<input type="password" name="form-password-confirm" placeholder="&#40;<?php echo $lang['REQUIRED'];?>&#41; <?php echo $lang['CONFIRM_PASS'];?>&#46;&#46;&#46;" class="form-control" id="form-password-confirm">
				</div>
				<button type="submit" name="submit" onclick="return validate();" class="btn btn-info"><?php echo $lang['REGISTER'];?>&#33;</button>
				<br /><br />
			</form>
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
		function validate()
		{ 
			var name = document.getElementById('form-first-name').value;
			var email = document.getElementById('form-email').value;
			var pass = document.getElementById('form-password').value;
			var pass2 = document.getElementById('form-password-confirm').value;
			var atposition = email.indexOf("@");
			var dotposition = email.indexOf(".");
			var letters = /^[A-Za-z'-]+$/;
			
			// alerts
			var name_alert = <?php echo json_encode($lang['NAME_ALERT']); ?>;
			var name_letters = <?php echo json_encode($lang['NAME_LETTERS']); ?>;
			var name_lenght_alert = <?php echo json_encode($lang['NAME_LENGTH_ALERT']); ?>;
			var email_alert = <?php echo json_encode($lang['EMAIL_ALERT']); ?>;
			var email_validation = <?php echo json_encode($lang['EMAIL_VALIDATION']); ?>;
			var pass_alert = <?php echo json_encode($lang['PASS_ALERT']); ?>;
			var pass_length_alert = <?php echo json_encode($lang['PASS_LENGTH_ALERT']); ?>;
			var pass2_alert = <?php echo json_encode($lang['PASS2_ALERT']); ?>;
			var pass_equal = <?php echo json_encode($lang['PASS_EQUAL']); ?>;
			
			if(isEmpty(name))
			{
				alert(name_alert);
				document.getElementById("form-first-name").style.border = "1px solid red";
				return false;
			}
			else if(!name.match(letters))
			{
				alert(name_letters);
				document.getElementById("form-first-name").style.border = "1px solid red";
				return false;
			}
			else if(name.length< 3 || name.length > 50)
			{
				alert(name_length_alert);
				document.getElementById('form-first-name').style.border = "1px solid red";
			}
			else if(isEmpty(email))
			{
				alert(email_alert);
				document.getElementById('form-email').style.border = "1px solid red";
				return false;
			}
			else if(atposition < 1 || (dotposition - atposition < 2))
			{
				alert(email_validation);
				document.getElementById('form-email').style.border = "1px solid red";
				return false
			}
			else if(isEmpty(pass))
			{
				alert(pass_alert);
				document.getElementById('form-password').style.border = "1px solid red";
				return false;
			}
			else if(pass.length<5)
			{
				alert(pass_length_alert);
				document.getElementById('form-password').style.border = "1px solid red";
				return false;
			}
			else if(isEmpty(pass2))
			{
				alert(pass2_alert);
				document.getElementById('form-password-confirm').style.border = "1px solid red";
				return false;
			}
			else if(pass != pass2)
			{
				alert(pass_equal);
				document.getElementById('form-password-confirm').style.border = "1px solid red";;
				return false
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
