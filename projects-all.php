<?php 
 // Connects to your Database 

 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

		$check = mysql_query("SELECT *, cc_projects.ID AS projects_id FROM cc_user_projects, cc_projects, cc_users WHERE cc_projects.status = 'publish' AND DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= cc_projects.pubdate AND cc_user_projects.project_id = cc_projects.ID AND cc_user_projects.user_id = cc_users.ID AND cc_user_projects.user_id != '$id' AND cc_user_projects.type = 'own' ORDER BY cc_projects.pubdate DESC")or die(mysql_error());


if (isset($_POST['add'])) { 
	$added = date(c);
	$insert = mysql_query("INSERT INTO cc_user_projects (user_id, project_id, type, added) VALUES ('$id', '".$_POST['add']."', 'wait', '$added')");
	$insert2 = mysql_query($insert);
}

include '_inc/header.php'; 
?>
<h2>Find a Project</h2>

<form id="register" action="" method="post">
<?php		
		while($check2 = mysql_fetch_array( $check )){
?>


  <fieldset>
    <legend><a href="project.php?id=<?php echo $check2['project_token']; ?>&type=own"><?php echo $check2['title']; ?></a><br><?php echo $check2['byline']; ?></legend>
    <ol>
      <li>
		<?php echo $check2['content']; ?><br>
        Location: <?php echo $check2['city']; ?>, <?php echo $check2['province']; ?>, <?php echo $check2['country']; ?><br>
        Status: <?php echo $check2['status']; ?><br>
        Owner: <a href="peer.php?id=<?php echo $check2['token']; ?>"><?php echo $check2['first_name'].' '.$check2['last_name']; ?></a><br />
        Job Title: <?php echo $check2['job_title']; ?><br />
       <?php  
	   echo $check2['user_id']; 
	   echo $id; 
	   if ($id == $check2['user_id']){
	   }
	   ?>
        <?php
		if ($id != $check2['user_id']){
		?>
        <button name="add" type="submit" value="<?php echo $check2['projects_id']; ?>">Add</button>
        <?php
		}
		?>
        </li>
    </ol>
  </fieldset>
</a>
<br>
<?php		
		}
			
?>
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