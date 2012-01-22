<?php 
 // Connects to your Database 

 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

		$check = mysql_query("SELECT cc_projects.* FROM cc_user_projects, cc_projects WHERE cc_user_projects.user_id = '$id' AND cc_user_projects.project_id = cc_projects.ID ORDER BY cc_projects.pubdate DESC")or die(mysql_error());
		include '_inc/header.php'; 
?>
<h2>My Projects</h2>

<form id="register" action="" method="post">
<?php		
		while($check2 = mysql_fetch_array( $check )){
			$draft = '';
			if ($check2['status'] == "draft"){
				$draft = 'style="background-color:#CCC"';
			}
			
?>

  <fieldset <?php echo $draft; ?>>
    <legend><a href="project.php?id=<?php echo $check2['project_token']; ?>&type=own"><?php echo $check2['title']; ?></a><br><?php echo $check2['byline']; ?></legend>
    <ol>
      <li>
		<?php echo $check2['content']; ?><br>
        Location: <?php echo $check2['city']; ?>, <?php echo $check2['province']; ?>, <?php echo $check2['country']; ?><br>
        Status: <?php echo $check2['status']; ?><br>
        </li>
    </ol>
  </fieldset>

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