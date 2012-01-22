<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //Checks if there is a login cookie
 if(isset($_COOKIE['ID_my_site']))
 { 
 	$id = $_COOKIE['ID_my_site']; 
 }


 //if the login form is submitted 
 if (isset($_POST['submit'])) { // if form has been submitted

 	// makes sure they filled it in
 	if(!$_POST['email']) {
 		die('You need to enter your email address.');
 	}

 	// checks it against the database
 	if (!get_magic_quotes_gpc()) {
 		$_POST['email'] = addslashes($_POST['email']);
 	}

 	$check = mysql_query("SELECT * FROM cc_users WHERE email = '".$_POST['email']."'")or die(mysql_error());

 //Gives error if user doesn't exist
 $check2 = mysql_num_rows($check);
 if ($check2 == 0) {
 		die('Email does not exist, <a href="forgot.php">try again</a> or <a href="index.php">click here to register</a>.');
 				}

 while($info = mysql_fetch_array( $check )) 	
 {
 $_POST['email'] = stripslashes($_POST['email']); 
 
 function generate_random_letters($length) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(rand(ord('a'), ord('z')));
  }
  return $random;
}
 $password = generate_random_letters(6);
 $encript = md5($password);
 
 	//send email
	$emailTo = $_POST['email']; //Who are we sending email to?
	$subject = "Password retrieval for Connect Creatives";
	$body = "Your new password is: $password \n\nGo to http://www.connectcreatives.com/login.php?redirect=reset.php to login.";
	$headers = 'From: Connect Creatives <'.$emailTo.'>' . "\r\n" . 'Reply-To: info@connectcreatives.com';
	mail($emailTo, $subject, $body, $headers);
	$emailSent = true;
	
	//reset password
	$reset = mysql_query("update cc_users set password='$encript' where email = '".$_POST['email']."';");
 	$reset2 = mysql_query($reset);

 //then let them know an email has been sent to them 
 echo "Check your email. Your password has been sent to you!";
 } 
 } 
 else 
{	 

 // if they are not logged in 
 ?>

<!DOCTYPE html>
<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset=utf-8 />
<title>Connect Creatives - Where Toronto's Web Professionals Collaborate on Projects</title>
<link rel=stylesheet href=_css/style.css type=text/css>
</head>
<body>
<h1>Connect Creatives</h1>
<form id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <legend>Forgot your password?</legend>
    <ol>
      <li>
        <label for=email>Enter your email</label>
        <input type="text" name="email" placeholder="email" maxlength="60" required autofocus>
      </li>
    </ol>
  </fieldset>
  <fieldset>
    <input type="submit" name="submit" value="Retrieve Password">
  </fieldset>
  <fieldset>
    <a href="login.php">Login</a> or <a href="index.php">Sign up</a>
  </fieldset>
</form>
</body>
</html>
<?php 
 } 
 ?>