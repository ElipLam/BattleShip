<?php

define('LOGIN', false);
require_once 'includes/inc.global.php';

// if we have a player_id in session, log them in, and check for admin
if ( ! empty($_SESSION['player_id'])) {
	$GLOBALS['Player'] = new GamePlayer( );
	// this will redirect to login if failed
	$GLOBALS['Player']->log_in( );
}
$username_err = $email_err = $password_err = $confirm_password_err = "";
$no_new_users = (false == Settings::read('new_users'));
$max_users_set = (0 != Settings::read('max_users'));
$max_users_reached = (GamePlayer::get_count( ) >= Settings::read('max_users'));
$not_admin = empty($GLOBALS['Player']) || ! $GLOBALS['Player']->is_admin;

if ($not_admin && ($no_new_users || ($max_users_set && $max_users_reached))) {
	Flash::store('Sorry, but we are not accepting new registrations at this time.');
}

if ($not_admin && isset($_SESSION['player_id'])) {
	$GLOBALS['Player'] = array( );
	$_SESSION['player_id'] = false;
	unset($_SESSION['player_id']);
	unset($GLOBALS['Player']);
}

if (isset($_POST['register'])) {
	test_token( );

	try {
		$GLOBALS['Player'] = new GamePlayer( );
		$GLOBALS['Player']->register( );
		$Message = new Message($GLOBALS['Player']->id, $GLOBALS['Player']->is_admin);
		$Message->grab_global_messages( );
		header("location: wellcome.php");
		//Flash::store('Registration Successful !', 'wellcome.php');
		$_SESSION["username"]=$_POST["username"];
	}
	catch (MyException $e) {
		if ( ! defined('DEBUG') || ! DEBUG) {
			//Flash::store('Registration Failed !\n\n'.$e->outputMessage( ), true);
		}
		else {
			call('REGISTRATION ATTEMPT REDIRECTED TO REGISTER AND QUIT');
			call($e->getMessage( ));
		}
	}

	exit;
}

call($GLOBALS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up to The Shit</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/353957-200.png"/>
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
	<link rel="stylesheet" type="text/css" href="css/register.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	
	<script type="text/javascript" src="scripts/json.js"></script>
	<script type="text/javascript" src="scripts/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.tablesorter.js"></script>
	<!-- fancybox -->
	<link rel="stylesheet" type="text/css" media="screen" href="scripts/jquery.fancybox/jquery.fancybox-1.3.4.css" />
	<script type="text/javascript" src="scripts/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript">
		$(document).ready( function( ) {
			// set fancybox defaults
			$.fn.fancybox.defaults['overlayColor'] = '#000';

			$('a.help').fancybox({
				autoDimensions : false,
				width: 500,
				padding : 10,
				hideOnContentClick : false
			});
		});
	</script>	
	<script type="text/javascript">
		var debug = false;
		var debug_query_ = ""; var debug_query = "";
	</script>
	<script type="text/javascript">
	//<![CDATA[
		var profile = 0;
	//]]>
	</script>
	<script type="text/javascript" src="scripts/register.js"></script>
</head>
<body id="register_page">
	<div class="limiter">
		<div class="container-register100">
			<div class="wrap-register100">
			<form action="register.php" method="post">
				<div class="register100">
					<span class="register100-form-title">
						<h2>Sign Up</h2>
					</span>	
					<input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token'] ?>" />
					<input type="hidden" name="errors" id="errors" />
					<p>Please fill this form to create an account.</p>
					
					<div class="wrap-input100">
						
						<label class="label100register" for="first_name">First Name</label>
						<input type="text" id="first_name" name="first_name" maxlength="20" class="input100register">
						
					</div>
					
					<div class="wrap-input100">
						<label class="label100register">Last Name</label>
						<input type="type="text" id="last_name" name="last_name" maxlength="20" class="input100register">
					</div>
					
					<div class="wrap-input100 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label class="label100register"><font color="red">*</font>Username</label>
						<input type="text" id="username" name="username" maxlength="20" class="input100register"><span id="username_check" class="test"></span>
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>   
					
					<div class="wrap-input100 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
						<label class="label100register"><font color="red">*</font>Email</label>
						<input type="text" id="email" name="email" class="input100register"><span id="email_check" class="test"></span>
						<span class="help-block"><?php echo $email_err; ?></span>
					</div> 
					
					<div class="wrap-input100 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label class="label100register"><font color="red">*</font>Password</label>
						<input type="password" id="password" name="password" class="input100register">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="wrap-input100 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<label class="label100register"><font color="red">*</font>Confirm Password</label>
						<input type="password" id="passworda" name="passworda" class="input100register">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
					</div>
					<div class="wrap-button100">
						<input type="submit" name="register" class="btn btn-success" value="Submit">
					</div>
					<p>Already have an account? <a href="login.php">Login here</a>.</p>
				</div>
			</form>
			</div>
		</div>
	</div>		
</body>
</html>
