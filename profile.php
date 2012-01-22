<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 


 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 
 	$id = $_COOKIE['ID_my_site']; 

 	 	$check = mysql_query("SELECT cc_profile.*, cc_users.first_name, cc_users.last_name, cc_users.job_title FROM cc_profile, cc_users WHERE cc_profile.user_id = '$id'")or die(mysql_error());
		$info = mysql_fetch_array($check);
				
		 //Gives error if user doesn't exist
 		$check2 = mysql_num_rows($check);


 		if ($info == 0) {
 			header("Location: profile-edit.php"); 
 		}
		
		include '_inc/header.php'; 
?>

<h2>Your Profile</h2>
<form id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name"">
  <fieldset>
    <legend>My Profile</legend>
    <ol>
      <li> <?php 
		if ($info['profile_pic'] == NULL || $info['profile_pic'] == ""){
			echo '<img src="http://www.connectcreatives.com/_users/default.png" align="right">';
		}else{
			echo '<img src="'.$info['profile_pic'].'" border="0" align="right" />';
		}
		?> 
		Name: <?php echo $info['first_name']; ?> <?php echo $info['last_name']; ?><br>
        Job Title: <?php echo $info['job_title']; ?><br>
        Address: <?php echo $info['city']; ?>, <?php echo $info['province']; ?>, <?php echo $info['country']; ?><br>
        Phone: <?php echo $info['phone']; ?><br>
        Overview: <?php echo $info['overview']; ?><br>
        Skills: <?php echo $info['skills']; ?><br>
        Portfolio: <?php echo $info['portfolio']; ?>
        </li>
    </ol>
  </fieldset>
</form>
<p><a href="profile-edit.php">Edit Profile</a></p>
</body>
</html>
<?php

 	} elseif (isset($_COOKIE['ID_my_site']) && !$info){
include '_inc/header.php'; 
		?>

<h2>Your profile hasn't been created yet.</h2>
<p><a href="profile-edit.php">Create Profile</a></p>
</body>
</html>
<?php
	} else  {	
	 //if the cookie does not exist, they are taken to the login screen 
	 header("Location: login.php"); 
 }
 ?>