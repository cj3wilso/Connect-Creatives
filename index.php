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

 
 //This code runs if the form has been submitted
 if (isset($_POST['submit'])) { 

	 //This makes sure they did not leave any fields blank
	 if (!$_POST['email'] | !$_POST['pass'] | !$_POST['pass2'] ) {
			die('You did not complete all of the required fields.');
	 }

 	// checks if the email is in use
 	if (!get_magic_quotes_gpc()) {
 		$_POST['email'] = addslashes($_POST['email']);
 	}

 	$usercheck = $_POST['email'];
 	$check = mysql_query("SELECT email FROM cc_users WHERE email = '$email'")or die(mysql_error());
 	$check2 = mysql_num_rows($check);

 	//if the name exists it gives an error
	if ($check2 != 0) {
 		die('Sorry, the email '.$_POST['email'].' is already in use.'.$check2);
 	}

 	// this makes sure both passwords entered match

 	if ($_POST['pass'] != $_POST['pass2']) {
 		die('Your passwords did not match.');
 	}

 	// here we encrypt the password and add slashes if needed
 	$_POST['pass'] = md5($_POST['pass']);
 	if (!get_magic_quotes_gpc()) {
 		$_POST['pass'] = addslashes($_POST['pass']);
 		$_POST['email'] = addslashes($_POST['email']);
 	}

 	// now we insert it into the database
	$registered = date(c);
	$reg_ip = $_SERVER['REMOTE_ADDR'];
	$user_token = uniqid();
 	$insert = "INSERT INTO cc_users (job_title, first_name, last_name, email, password, registered, reg_ip, token, online) VALUES ('".$_POST['job_title']."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '".$_POST['pass']."', '$registered', '$reg_ip', '$user_token', 1)";
	$add_member = mysql_query($insert);

 	// add a cookie 
	$cookie = mysql_query("select last_insert_id()"); 
	$cookie = mysql_result($cookie, 0);
	setcookie(ID_my_site, $cookie, $hour);
	setcookie(Key_my_site, $_POST['pass'], $hour);

	header("Location: home.php");
 } 

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
<form id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name"">
  <fieldset>
    <legend>Start a project, register today it's FREE!</legend>
    <ol>
      <li>
        <label for=email>Job Title</label>
        <input type="text" name="job_title" placeholder="Job Title" maxlength="60" required autofocus>
      </li>
      <li>
        <label for=email>First Name</label>
        <input type="text" name="first_name" placeholder="First Name" maxlength="60" required autofocus>
      </li>
      <li>
        <label for=email>Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name" maxlength="60" required autofocus>
      </li>
      <li>
        <label for=email>Email</label>
        <input type="text" name="email" placeholder="Email" maxlength="60" required autofocus>
      </li>
      <li>
        <label for=password>Password</label>
        <input id=password name="pass" type="password" placeholder="Password" maxlength="10" required>
      </li>
      <li>
        <label for=confirmpassword>Confirm Password</label>
        <input id=confirmpassword name="pass2" type="password" placeholder="Confirm Password" maxlength="10" required>
      </li>
    </ol>
  </fieldset>
  <fieldset>
    <input type="submit" name="submit" value="Register">
  </fieldset>
</form>
<p>-OR-</p>
<p><a href="login.php">Login Here</a></p>
</body>
</html>