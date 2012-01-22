<?php 

 // Connects to your Database
 mysql_connect("localhost", "chris285_cc", "57575757aA") or die(mysql_error()); 
 mysql_select_db("chris285_cc") or die(mysql_error()); 
 $id = $_COOKIE['ID_my_site'];
 
 //set offline status
 $online = mysql_query("update cc_users set online=0 where ID = '$id';");
 $online2 = mysql_query($online);
 
 $past = time() - 100; 

 //this makes the time in the past to destroy the cookie 
 setcookie(ID_my_site, gone, $past); 
 setcookie(Key_my_site, gone, $past); 

 header("Location: login.php"); 
 ?> 