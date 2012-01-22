<?php 
 // Connects to your Database 

 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysql_query("SELECT * FROM cc_users, cc_profile WHERE cc_users.token = '$_GET[id]' AND cc_users.ID = cc_profile.user_ID")or die(mysql_error());
		$info = mysql_fetch_array($check);
		
		include '_inc/header.php'; 
?>

<h2>User Detail</h2>
<form id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name"">
  <fieldset>
    <legend><?php echo $info['first_name'].' '.$info['last_name']; ?></legend>
    <ol>
      <li>
		
        <?php 
		if ($info['profile_pic'] == ""){
			echo '<img src="http://www.connectcreatives.com/uploads/profile/default-big.gif">';
		}else{
			echo '<img src="'.$info['profile_pic'].'" border="0" />';
		}
		?> 
        Job Title: <?php echo $info['job_title']; ?><br>
        Location: <?php echo $info['city']; ?>, <?php echo $info['province']; ?>, <?php echo $info['country']; ?><br>
        Phone: <?php echo $info['phone']; ?><br>
        Overview:<br />
		<?php echo $info['overview']; ?><br>
        Skills: <?php echo $info['skills']; ?><br>
        Portfolio: <a href="<?php echo $info['portfolio']; ?>"><?php echo $info['portfolio']; ?></a>
        </li>
    </ol>
  </fieldset>
</form>
</body>
</html>
<?php

 	} elseif (isset($_COOKIE['ID_my_site']) && !$info){
		include '_inc/header.php'; 

		?>

<h2>Person not found.</h2>
<p><a href="peers-all.php">Find a Peer</a></p>
</body>
</html>
<?php
	} else  {	
	 //if the cookie does not exist, they are taken to the login screen 
	 header("Location: login.php"); 
 }
 ?>