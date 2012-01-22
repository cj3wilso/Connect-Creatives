<?php

$string = $_SERVER['HTTP_USER_AGENT'];
$string .= 'SHIFLETT';

//$meek = md5($string);

//echo uniqid();
echo date(c);
?>
<!DOCTYPE html>

<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset=utf-8 />
<title>Connect Creatives - Where Toronto's Web Professionals Collaborate on Projects</title>
<link rel=stylesheet href=_css/style.css type=text/css>
<script type="text/javascript" src="_scripts/ajaxupload.js"></script>
</head>

<body>
<h1>Connect Creatives</h1>
<p><a href="home.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="profile.php">Back to Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="logout.php">Logout</a></p>
<form action="_scripts/ajaxupload.php" id="register" method="post" name="unobtrusive" id="unobtrusive" enctype="multipart/form-data">
<input type="hidden" name="maxSize" value="9999999999" />
<input type="hidden" name="maxW" value="200" />
<input type="hidden" name="fullPath" value="http://connectcreatives.com/_uploads/profile/" />
<input type="hidden" name="relPath" value="../_uploads/profile/" />
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
			echo '<img src="http://www.connectcreatives.com/_uploads/profile/default-big.gif">';
		}else{
			echo '<img src="'.$info['profile_pic'].'" border="0" />';
		}
		?>
        </div>
        <input type="file" name="filename" id="filename" value="filename" onchange="ajaxUpload(this.form,'_scripts/ajaxupload.php?filename=filename&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://connectcreatives.com/_uploads/profile/&amp;relPath=../_uploads/profile/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'_images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'_images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" />
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
        <label for=firstname>First name</label>
        <input type="text" name="first_name" value="<?php echo $info['first_name']; ?>"  maxlength="60" required>
      </li>
      <li>
        <label for=lastname>Last name</label>
        <input type="text" name="last_name" value="<?php echo $info['last_name']; ?>" maxlength="60" required>
      </li>
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
        <label for=jobtitle>Job Title</label>
        <input type="text" name="job_title" value="<?php echo $info['job_title']; ?>" maxlength="60" required>
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
 
 ?>