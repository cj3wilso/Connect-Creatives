<?php 
 // Connects to your Database 
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 


 //checks cookies to make sure they are logged in 
 if(isset($_COOKIE['ID_my_site'])) 
 { 
 	$id = $_COOKIE['ID_my_site']; 
 	$pass = $_COOKIE['Key_my_site']; 
 	$check = mysql_query("SELECT * FROM cc_users WHERE ID = '$id'")or die(mysql_error()); 
 	
	while($info = mysql_fetch_array( $check )) 	 
 		{ 
 		$username = $check['username'];

 //if the cookie has the wrong password, they are taken to the login page 
 		if ($pass != $info['password']) 
 			{ 			
			header("Location: login.php"); 
 			} 

 //otherwise they are shown the page 
 	else 
 			{ 

include '_inc/header.php'; 
?>

<h2>Home</h2>
<form id="register">
  <fieldset>
    <legend>Replies</legend>
    <ol>
      <li>
        <p><em>September 23, 2011 at 8:21am</em><br>
          "Hi my name is Mike and I could do what you'd want for this project. Take a look at my portfolio: <a href="http://www.designessence.ca/">http://www.designessence.ca/</a>. You can call me at 555-555-5555. Looking forward to hearing from you!" <br>
          From <a href="profile.php?user=mike32">Mike Isgard</a> for your project <a href="project.php?id=349895609">New banner needed for homepage</a>. <a href="reply.php?id=43983049839048">Reply</a></p>
        <p><em>September 21, 2011 at 1:22pm</em><br>
          "I'm interested, would like to hear more, reply back." <br>
          From <a href="profile.php?user=suz45">Suzie Bard</a> for your project <a href="project.php?id=349895609">New banner needed for homepage</a>. <a href="reply.php?id=546945659809845">Reply</a></p>
        <p><em>September 15, 2011 at 11:15pm</em><br>
          "Your offer is interesting. I'd like to discuss the details further with you. Can we set a time to Skype?" <br>
          From <a href="profile.php?user=89dkcj">Charles Fred</a> for Charles' project <a href="project.php?id=56767566576">Development of new form</a>. <a href="reply.php?id=98789797898463523">Reply</a></p>
        <p><a href="#">All Replies</a></p>
      </li>
    </ol>
  </fieldset>
  <fieldset>
    <legend>Latest Projects</legend>
    <ol>
      <li>
        <p><i>New banner needed for homepage</i><br>
          Integer mattis nisl id magna aliquam consectetur. Aliquam in pharetra mauris. In sodales tempor velit nec congue. Integer id nibh est, eget vehicula quam. Morbi arcu lectus, dignissim at pulvinar id, mollis a orci. Praesent varius nibh sit amet metus mollis pulvinar.</p>
        <p><i>Another project</i><br>
          Mauris accumsan dignissim nisl a tempus. In porttitor vulputate risus, a condimentum erat semper fermentum. Morbi laoreet orci et nibh rhoncus malesuada.</p>
        <p><a href="#">All Projects</a></p>
      </li>
    </ol>
  </fieldset>
</form>
</body></html><?php
 			} 
 		} 
 		} 
 else 
 //if the cookie does not exist, they are taken to the login screen 
 {			 
 header("Location: login.php"); 
 } 
 ?>