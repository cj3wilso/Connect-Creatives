<?php 
include '_inc/mysqlconnect.php';
//checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 

 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 

		$check = mysql_query("select *
from cc_user_projects m, cc_users u, cc_projects p
where m.user_id = u.id
and m.project_id = p.id
and m.type = 'wait'
and m.project_id in
(
SELECT project_id 
FROM cc_user_projects 
WHERE user_id = '$id'
and type = 'own'
)")or die(mysql_error());
include '_inc/project-approve.php';
include '_inc/mail.php';
include '_inc/header.php'; 
?>
<h2>Approve these contributors?</h2>

<div id="register" action="" method="post">
<?php		
		while($check2 = mysql_fetch_array( $check )){			
?>

<div class="dialog-form" title="Contact <?php echo $check2['first_name']; ?>">
	<form id="contact" action="" method="post">
	<fieldset>
        <textarea name="subject"></textarea>
	</fieldset>
    <button name="message" type="submit" value="<?php echo $check2['email']; ?>">Submit</button>
	</form>
</div>
  
  <fieldset>
    <legend><a href="project.php?id=<?php echo $check2['project_token']; ?>&type=own"><?php echo $check2['title']; ?></a><br><?php echo $check2['byline']; ?></legend>
    <ol>
      <li>
        Interested Peers: <br />
		Name: <?php echo $check2['first_name']; ?> <?php echo $check2['last_name']; ?><br />
        <button id="message">Send Message</button> 
        <form id="approve" action="" method="post">
          <input name="user" type="hidden" value="<?php echo $check2['user_id']; ?>" />
          <input name="project" type="hidden" value="<?php echo $check2['project_id']; ?>" />
        <button id="approve" type="submit" name="approve">Approve</button> <button id="dismiss" type="submit" name="dismiss">Dismiss</button>
          </form>
        </li>
    </ol>
  </fieldset>

<br>
<?php		
		}
			
?>
</div>
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