<?php 

 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 



//Checks if there is a login cookie
 if(isset($_COOKIE['ID_my_site'], $_COOKIE['Key_my_site']))
 {
 $id = $_COOKIE['ID_my_site'];

 //if there is, if there isn't, directs you to register
	$check = mysql_query("SELECT cc_profile.*, cc_users.email FROM cc_profile, cc_users WHERE user_id = '$id'")or die(mysql_error());
	$info = mysql_fetch_array( $check );
 }else{
	 header("Location: index.php");
 }


 //This code runs if the form has been submitted
 if (isset($_POST['submit'])) { 

 // now we insert it into the database
	$idtest = mysql_query("SELECT 'user_id' FROM cc_profile WHERE user_id = '$id';");
	if (mysql_fetch_array( $idtest ) == ""){
		$profile = "no";
	}else{
		$profile = "yes";
	}

	if ($profile == "yes"){
		$prorecord = mysql_query("update cc_profile set first_name='$_POST[first_name]', last_name='$_POST[last_name]',  overview='$_POST[overview]', portfolio='$_POST[portfolio]', job_title='$_POST[job_title]', skills='$_POST[skills]', phone='$_POST[phone]', city='$_POST[city]', province='$_POST[province]', country='$_POST[country]' where user_id = '$id';");
	}else{
			$prorecord = mysql_query("INSERT INTO cc_profile (user_id, first_name, last_name, overview, portfolio, job_title, skills, phone, city, province, country) VALUES ('$id','$_POST[first_name]','$_POST[last_name]','$_POST[overview]','$_POST[portfolio]','$_POST[job_title]','$_POST[skills]','$_POST[phone]','$_POST[city]','$_POST[province]','$_POST[country]') ;");
	}		

	$add_profile = mysql_query($prorecord);
	header("Location: profile.php"); 
 } 
 else 
 {	
 include '_inc/header.php'; 
 ?>

<script type="text/javascript" src="_scripts/ajaxupload.js"></script>

<form action="_scripts/ajaxupload.php" id="register" method="post" name="unobtrusive" id="unobtrusive" enctype="multipart/form-data">
<input type="hidden" name="maxSize" value="9999999999" />
<input type="hidden" name="maxW" value="200" />
<input type="hidden" name="fullPath" value="http://connectcreatives.com/_users/<?php echo $info['email']; ?>/" />
<input type="hidden" name="relPath" value="../_users/<?php echo $info['email']; ?>/" />
<input type="hidden" name="colorR" value="255" />
<input type="hidden" name="colorG" value="255" />
<input type="hidden" name="colorB" value="255" />
<input type="hidden" name="maxH" value="300" />
<input type="hidden" name="filename" value="filename" />
<fieldset>
  <legend>Profile picture</legend>
  <ol>
      <li>
        <div id="upload_area"> 
        <?php 
		if ($info['profile_pic'] == ""){
			echo '<img src="http://www.connectcreatives.com/_users/'.$info['email'].'/default-big.gif">';
		}else{
			echo '<img src="'.$info['profile_pic'].'" border="0" />';
		}
		?>
        </div>
        <input type="file" name="filename" id="filename" value="filename" onchange="ajaxUpload(this.form,'_scripts/ajaxupload.php?filename=filename&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://connectcreatives.com/_users/<?php echo $info['email']; ?>/&amp;relPath=../_users/<?php echo $info['email']; ?>/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'_images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'_images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
        <noscript><input type="submit" name="submit" value="Upload Image" /></noscript>
      </li>
   </ol>
</fieldset>
</form>

<form name="profile" id="register" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
  <fieldset>
    <legend>My Profile</legend>
    <ol>
      <li>
        <label for=jobtitle>Overview</label>
        <br>
        <textarea rows="7" name="overview" style="width:97%;"><?php echo $info['overview']; ?></textarea>
      </li>
      <li>
        <label for=jobtitle>Portfolio URL</label>
        <input type="text" name="portfolio" value="<?php echo $info['portfolio']; ?>" maxlength="60" required>
      </li>
      <li>
        <label for=jobtitle>Skills</label>
        <input type="text" name="skills" value="<?php echo $info['skills']; ?>" maxlength="60" required>
      </li>
    </ol>
  </fieldset>
  <fieldset>
    <legend>Contact Information</legend>
    <ol>
      <li>
        <label for=phone>Phone</label>
        <input type="text" name="phone" maxlength="60" value="<?php echo $info['phone']; ?>">
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
    <input type="submit" name="submit" value="Update">
  </fieldset>
</form>

<p><a href="profile.php">Back to Profile</a></p>


  <!--   <fieldset>
    <legend>My Websites</legend>
    <ol>
      <li>
        <label for=blog>Blog</label>
        <input type="text" name="p8" maxlength="60" value="">
      </li>
      <li>
        <label for=portfolio>Portfolio</label>
        <input type="text" name="p9" maxlength="60" value="">
      </li>
      <li>
        <label for=website>Website</label>
        <input type="text" name="p10" maxlength="60" value="">
      </li>
    </ol>
  </fieldset>
 <fieldset>
    <legend>Social bookmarks</legend>
    <ol>
      <li>
        <label for=linkedin>LinkedIn</label>
        <input type="text" name="p11" maxlength="60" value="">
      </li>
      <li>
        <label for=twitter>Twitter ID</label>
        <input type="text" name="p12" maxlength="60" value="">
      </li>
      <li>
        <label for=facebook>Facebook</label>
        <input type="text" name="p13" maxlength="60" value="">
      </li>
    </ol>
  </fieldset>-->

</body>
</html>
<?php
 }
 ?>