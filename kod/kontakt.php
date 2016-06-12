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

    <title><?php echo $lang['CONTACT'];?></title>

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
		<h1><?php echo $lang['ABOUT_US'];?></h1>
		<hr>
		<img class="img-responsive img-border img-left manualImg" src="images/manual.jpg" alt="User guide">
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque 
		laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi 
		architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas 
		sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione 
		voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, 
		consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et 
		dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum 
		exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, 
		vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
		<hr>
		
	<div class="row">
            <div class="box">
                <div class="col-lg-6">
                    <h2 class="intro-text text-center"><?php echo $lang['CONTACT_US'];?></strong>
                    </h2>
                    <hr>
                    <form role="form">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label><?php echo $lang['NAME'];?></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label><?php echo $lang['EMAIL'];?></label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label><?php echo $lang['TEL_NUM'];?></label>
                                <input type="tel" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label><?php echo $lang['MESSAGE'];?></label>
                                <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default"><?php echo $lang['SEND'];?></button>
                            </div>
                        </div>
                    </form>
                </div>
				<div class="col-lg-6">
                    <h2 class="intro-text text-center"><?php echo $lang['INFO'];?>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6 text-center">
					<iframe class="mapIframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.092690861659!2d15.967852415018244!3d45.80940201836452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d6fb532390a7%3A0x9ee647b20027ba22!2sHrvatsko+narodno+kazali%C5%A1te+u+Zagrebu!5e0!3m2!1shr!2shr!4v1459428344255" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-6 text-center">
                    <p><?php echo $lang['TEL_NUM'];?>:
                        <strong>+385 (0)1 2222 666</strong>
                    </p>
                    <p><?php echo $lang['EMAIL'];?>:
                        <strong><a href="mailto:name@example.com">info@notiflyer.hr</a></strong>
                    </p>
                    <p><?php echo $lang['ADDRESS'];?>:
                        <strong>Trg maršala Tita 15; 
                            <br />10000, Zagreb</strong>
                    </p>
                </div>
            </div>
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
		function logout(){
			document.location = 'logout.php';
		}
	</script>

</body>

</html>
