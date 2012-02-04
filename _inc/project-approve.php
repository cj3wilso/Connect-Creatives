<?php

//Update to contributor status
if(isset($_POST['approve'])) {
	$approve = mysql_query("update cc_user_projects set type='contributor' where user_id = '".$_POST['user']."' and project_id = '".$_POST['project']."';");
	$approve2 = mysql_query($approve);
}
//Remove user from project waiting list
if(isset($_POST['dismiss'])) {
	$dismiss = mysql_query("DELETE FROM cc_user_projects WHERE user_id = '".$_POST['user']."' and project_id = '".$_POST['project']."';");
	$dismiss2 = mysql_query($dismiss);
}
?>