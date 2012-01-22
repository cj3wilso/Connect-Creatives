<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

//Checks if there is a login cookie
if(isset($_COOKIE['ID_my_site']))
//if there is, it logs you in and directes you to the home page
{ 
	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site'];
 	$check = mysql_query("SELECT * FROM cc_users WHERE ID = '$id'")or die(mysql_error());
 	while($info = mysql_fetch_array( $check )) 	
 	{
 		if ($pass != $info['password']) 
 		{
 		}else{
 			header("Location: home.php");
 		}
 	}
}

//if the login form is submitted 
if (isset($_POST['submit'])) { // if form has been submitted
 	// makes sure they filled it in
	if(!$_POST['email'] | !$_POST['pass']) {
 		die('You did not fill in a required field.');
 	}
 	// checks it against the database
 	if (!get_magic_quotes_gpc()) {
 		$_POST['email'] = addslashes($_POST['email']);
 	}
 	$check = mysql_query("SELECT * FROM cc_users WHERE email = '".$_POST['email']."'")or die(mysql_error());

 	//Gives error if user doesn't exist
	$check2 = mysql_num_rows($check);
	if ($check2 == 0) {
 		die('That user does not exist in our database. <a href="index.php">Click Here to Register</a>');
 	}

 	while($info = mysql_fetch_array( $check )) 	
 	{
		$myID = $info['ID'];
		$_POST['pass'] = stripslashes($_POST['pass']);
		$info['password'] = stripslashes($info['password']);
		$_POST['pass'] = md5($_POST['pass']);
	
	
		//gives error if the password is wrong
		if ($_POST['pass'] != $info['password']) {
			die('Incorrect password, please try again.');
		}else{ 
			// if login is ok then we add a cookie 
			$_POST['email'] = stripslashes($_POST['email']); 
			if ($_POST['remember'] == 'yes'){
				$logtime = time() + (30 * 24 * 60 * 60);
			}else{
				$logtime = time() + 3600;
			}
			setcookie(ID_my_site, $myID, $logtime); 
			setcookie(Key_my_site, $_POST['pass'], $logtime);	 
	
			//set online status
			$online = mysql_query("update cc_users set online=1 where email = '".$_POST['email']."';");
			$online2 = mysql_query($online);
	
			//then redirect them to the members area 
			if ($_POST['redirect']=="reset.php"){
				header("Location: reset.php");
			}else{
				header("Location: home.php"); 
			}
		} 
 	} 
}else{	 
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
<input type="hidden" name="redirect" value="<?php echo $_GET["redirect"] ?>">
  <fieldset>
    <legend>Login</legend>
    <ol>
      <li>
        <label for=email>Email</label>
        <input type="text" name="email" placeholder="email" maxlength="60" required autofocus>
      </li>
      <li>
        <label for=password>Password</label>
        <input id=password name=pass type=password placeholder="password" maxlength="20" required>
      </li>
    </ol>
    <input type="checkbox" name="remember" value="yes" /> Keep me logged in
  </fieldset>
  <fieldset>
    <input type="submit" name="submit" value="Login">
    <a href="forgot.php">Forgot password?</a>
  </fieldset>
  <fieldset>
    Need an account? <a href="index.php">Sign up</a>
  </fieldset>
</form>
</body>
</html>
<?php 
 } 
 ?>