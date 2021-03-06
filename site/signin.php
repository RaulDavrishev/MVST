<?php
require "db.php";

$data = $_POST;

    
if(isset($data["do_signup"])){
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $password = md5(filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING));

    $user_check = oci_parse($conn, "SELECT count(login) from users where login='$login'");
    $user_pass = oci_parse($conn, "SELECT password from users where login='$login'");
    oci_execute($user_pass);
	$pass_user = oci_fetch_row($user_pass);
	oci_execute($user_check);
	$num_user = oci_fetch_row($user_check);
    
	$errors = array();
	if(trim($data["login"]) == ""){
		$errors[] = "Enter login!";
	}
	if($data["password"] == ""){
		$errors[] = "Enter password!";
	}
	if($num_user[0]==0){
		$errors[] = "This login not registered!";
	}
	if($pass_user[0]!=$password){
		$errors[] = "Incorrect password!";
	}

	if(empty($errors) && $login=='admin'){
        $_SESSION["logged_user"] = $login;
	    header ('Location: admin.php');
            exit();
	}
	if(empty($errors) && $login!=='admin'){
        $_SESSION["logged_user"] = $login;
	    header ('Location: index.php');
            exit();
	}
	else{
		echo '<div class="alert alert-danger" role="alert" style="color:white">'.array_shift($errors).'</div>';
	}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet"> 

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">

	<title>FlixGo</title>

</head>
<body class="body">

	<div class="sign section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form action="signin.php" class="sign__form" method="POST">
							<a href="index.php" class="sign__logo">
								<img src="img/logo.svg" alt="">
							</a>

							<div class="sign__group">
								<input type="text" class="sign__input" name="login" placeholder="login">
							</div>

							<div class="sign__group">
								<input type="password" class="sign__input" name="password" placeholder="Password">
							</div>

							<div class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">Remember Me</label>
							</div>
							
							<button class="sign__btn" type="submit" name="do_signup">Sign in</button>

							<span class="sign__text">Don't have an account? <a href="signup.php">Sign up!</a></span>
						</form>
						<!-- end authorization form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/wNumb.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/jquery.morelines.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/photoswipe-ui-default.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>