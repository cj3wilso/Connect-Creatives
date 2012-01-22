<?php 
 // Connects to your Database 

 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

	$check = mysql_query("SELECT *, cc_users.ID AS peer_id FROM cc_users left join cc_profile ON (cc_users.ID = cc_profile.user_id) left join cc_user_friends ON (cc_users.ID = cc_user_friends.user_friend) ORDER BY cc_users.registered DESC")or die(mysql_error());

include '_inc/header.php';

if (isset($_POST['add'])) { 
	$added = date(c);
	$insert = mysql_query("INSERT INTO cc_user_friends (user_id, user_friend, added) VALUES ('$id', '".$_POST['add']."', '$added')");
	$insert2 = mysql_query($insert);
}
?>
<h2>Find a Peer</h2>

<form name="fav" id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
    <legend>Users</legend>
    <ol>
<?php		
		while($check2 = mysql_fetch_array( $check )){
			if($check2['peer_id'] != $id) {
?>
      <li>
		<?php 
		if ($check2['profile_pic'] == NULL || $check2['profile_pic'] == ""){
			echo '<img src="http://www.connectcreatives.com/_users/default.png" align="right">';
		}else{
			echo '<img src="'.$check2['profile_pic'].'" border="0" align="right" />';
		}
		?> 
        <a href="peer.php?id=<?php echo $check2['token']; ?>"><?php echo $check2['first_name'].' '.$check2['last_name']; ?></a><br />
        Job Title: <?php echo $check2['job_title']; ?><br />
        Portfolio: <a href="<?php echo $check2['portfolio']; ?>"><?php echo $check2['portfolio']; ?></a>
        <?php
		if ($check2['user_friend'] != $check2['peer_id']){
		?>
        <button name="add" type="submit" value="<?php echo $check2['peer_id']; ?>">Add friend</button>
        <?php
		}
		?>
        </li>
   
<?php		
			}
		}
			
?>
 </ol>
  </fieldset>
</form>
</body>
</html>
<?php

 	} elseif (isset($_COOKIE['ID_my_site']) && !$search2){
		include '_inc/header.php'; 

		?>

<h2>Projects not found.</h2>
<p><a href="project-new.php">Create New Project</a></p>
</body>
</html>
<?php
	} else  {	
	 //if the cookie does not exist, they are taken to the login screen 
	 header("Location: login.php"); 
 }
 ?>