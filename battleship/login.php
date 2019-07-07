<?php

define('LOGIN', false);
require_once 'includes/inc.global.php';

// i don't care who they are, or where they come from
// if they hit this page, log them out
$GLOBALS['Player'] = new GamePlayer( );
$GLOBALS['Player']->log_out(false, true);
$date_format = 'D, M j, Y g:i a';
$approve_users = false;
$new_users = true;
$max_users = 0;
if (class_exists('Settings') && Settings::test( )) {
	$date_format = Settings::read('long_date');
	$approve_users = Settings::read('approve_users');
	$new_users = Settings::read('new_users');
	$max_users = Settings::read('max_users');
}
call($GLOBALS);
$username_err = $_SESSION["username_err"];
$password_err = $_SESSION["password_err"];
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Login to The Sh!t</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="stylesheet" type="text/css" media="screen" href="css/layout.css" />	
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

</head>
<body id="login_page">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<form  method = "post" action = "index.php">
				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Login to the Sh!t
					</span>						
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" id="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<span class="help-block"><?php echo $username_err; ?></span>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<span class="help-block"><?php echo $password_err; ?></span>
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="login" value="Log in" />
					</div>
					<div class="text-center p-t-12">
						<label for="remember" class="inline">
							<span class="txt2">Remember me</span>
							<input type="checkbox" id="remember" name="remember" checked="checked"/>
						</label>
					</div>
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="t-rex-runner/index.html">
							Username / Password?
						</a>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
				</form>
			</div>
		</div>
	</div>	
	<!--===============================================================================================-->		
	<!--Animation picture-->
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/tilt/tilt.jquery.min.js"></script>
		<script >
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script>
		<script src="scripts/main.js"></script>
	<!--===============================================================================================-->
		

</body>
</html>