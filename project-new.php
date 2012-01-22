<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 

//Checks if there is a login cookie
 if(isset($_COOKIE['ID_my_site'], $_COOKIE['Key_my_site']))
 {
 	$id = $_COOKIE['ID_my_site'];
 }else{
	header("Location: index.php");
 }

 //This code runs if the form has been submitted
 if (isset($_POST['cancel'])) { 
 	header("Location: home.php");
 }
 //This code runs if the form has been submitted
 if (isset ($_POST['publish']) || isset ($_POST['draft'])) { 
	if (isset ($_POST['publish'])){
		$status = "publish";
	}else{
		$status = "draft";
	}
	$project_token = uniqid();
	$date = date(c);
	$cc_query = mysql_query("INSERT INTO cc_projects (project_token, title, byline, content, status, pubdate, modified, city, province, country) VALUES ('$project_token','$_POST[title]','$_POST[byline]','$_POST[content]','$status','$date','0','$_POST[city]','$_POST[province]','$_POST[country]') ;");
	$add_record = mysql_query($cc_query);
	$check = mysql_query("SELECT ID FROM cc_projects WHERE project_token = '$project_token'"); 
	$check2 = mysql_fetch_array( $check );
	$project_id = $check2['ID'];
	$cc_query2 = mysql_query("INSERT INTO cc_user_projects (user_id, project_id, type) VALUES ('$id','$project_id','own') ;");
	$add_record2 = mysql_query($cc_query2);
	
	header("Location: project.php?id=$project_token");
 } 
 else 
 {	
 include '_inc/header.php'; 
 ?>

<h2>Create a New Project</h2>

<form name="project-new" id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
  <fieldset>
    <legend>New Project</legend>
    <ol>
      <li>
        <label for=firstname>Title</label>
        <input type="text" name="title" value=""  maxlength="60" required>
      </li>
      <li>
        <label for=lastname>Byline</label>
        <input type="text" name="byline" value="" maxlength="60" required>
      </li>
      <li>
        <label for=jobtitle>Description</label>
        <br>
        <textarea rows="7" name="content" style="width:97%;"></textarea>
      </li>
      <li>
        <label for=city>City</label>
        <input type="text" name="city" value="<?php echo $info['city']; ?>" maxlength="60" required>
      </li>
      <li>
        <label for=city>Province</label>
        <input type="text" name="province" value="<?php echo $info['province']; ?>" maxlength="60" required>
      </li>
      <li>
        <label for=country>Country</label>
        <?php include '_inc/country-list.php'; ?>
      </li>
    </ol>
  </fieldset>
  <fieldset>
	<div align="right"><input type="submit" name="draft" value="Save as Draft"> <input type="submit" name="publish" value="Publish"></div>
  </fieldset>
</form>
<p><a href="projects-mine.php">Back to Projects</a></p>
</body>
</html>
<?php
 }
 ?>