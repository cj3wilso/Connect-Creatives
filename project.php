<?php 
 // Connects to your Database 

 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysql_query("SELECT * FROM cc_projects, cc_users, cc_user_projects WHERE project_token = '$_GET[id]' AND cc_user_projects.project_id = cc_projects.ID AND cc_user_projects.user_id = cc_users.ID")or die(mysql_error());
		$info = mysql_fetch_array($check);
		
		include '_inc/header.php'; 
?>

<h2>Project Detail</h2>
<form id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name"">
  <fieldset>
    <legend><?php echo $info['title']; ?><br><?php echo $info['byline']; ?></legend>
    <ol>
      <li>
		<?php echo $info['content']; ?><br>
        Location: <?php echo $info['city']; ?>, <?php echo $info['province']; ?>, <?php echo $info['country']; ?><br>
        Status: <?php echo $info['status']; ?><br>
        <?php if ($_GET[type] != "own"){ ?>
        Owner: <?php echo $info['username']; ?>
        <?php } ?>
        </li>
    </ol>
  </fieldset>
</form>
<!--<p><a href="project-edit.php">Edit Project</a></p>-->
</body>
</html>
<?php

 	} elseif (isset($_COOKIE['ID_my_site']) && !$info){
		include '_inc/header.php'; 

		?>

<h2>Project not found.</h2>
<p><a href="project-new.php">Create Project</a></p>
</body>
</html>
<?php
	} else  {	
	 //if the cookie does not exist, they are taken to the login screen 
	 header("Location: login.php"); 
 }
 ?>