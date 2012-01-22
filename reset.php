<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

//Checks if there is a login cookie
 if(isset($_COOKIE['ID_my_site'], $_COOKIE['Key_my_site']))
 {
 	$id = $_COOKIE['ID_my_site'];
 	//if there is, if there isn't, directs you to register
	$check = mysql_query("SELECT * FROM cc_profile WHERE user_id = '$id'")or die(mysql_error());
	$info = mysql_fetch_array( $check );
 }else{
	 header("Location: index.php");
 }


//This code runs if the form has been submitted
if (isset($_POST['submit'])) { 
	//This makes sure they did not leave any fields blank
	 if (!$_POST['old'] | !$_POST['pass'] | !$_POST['pass2'] ) {
			die('You did not complete all of the required fields.');
	 }
	// this makes sure both passwords entered match
 	if ($_POST['pass'] != $_POST['pass2']) {
 		die('Your passwords did not match.');
 	}
	$encriptold = md5($_POST['old']);
	if (!get_magic_quotes_gpc()) {
 		$encriptold = addslashes($encriptold);
 	}
 	$check = mysql_query("SELECT * FROM cc_users WHERE password = '$encriptold'")or die(mysql_error());
 
 	//Gives error if password doesn't exist
 	$check2 = mysql_num_rows($check);
 	if ($check2 == 0) {
 		die('Password does not exist, <a href="reset.php">try again</a> or get your <a href="forgot.php">password emailed to you</a>.');
 	}
			
 	while($info = mysql_fetch_array( $check )) 	
 	{	
		$encriptnew = md5($_POST['pass']);
		if (!get_magic_quotes_gpc()) {
			$encriptnew = addslashes($encriptnew);
		}
		//reset password
		$reset = mysql_query("update cc_users set password='$encriptnew' where email = '".$info['email']."';");
		$reset2 = mysql_query($reset);
		setcookie(Key_my_site, $encriptnew, time() + 3600);
		header("Location: home.php"); 
	}
} else {	
 include '_inc/header.php'; 
 ?>

<form id="register" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <legend>Reset your password</legend>
    <ol>
      <li>
        <label for=password>Old Password</label>
        <input id=password name="old" type="password" placeholder="Old password" maxlength="10" required>
      </li>
      <li>
        <label for=password>Password</label>
        <input id=password name="pass" type="password" placeholder="New password" maxlength="10" required>
      </li>
      <li>
        <label for=confirmpassword>Confirm Password</label>
        <input id=confirmpassword name="pass2" type="password" placeholder="Confirm new password" maxlength="10" required>
      </li>
    </ol>
  </fieldset>
  <fieldset>
    <input type="submit" name="submit" value="Reset Password">
  </fieldset>
</form>
</body>
</html>
<?php 
 } 
 ?>