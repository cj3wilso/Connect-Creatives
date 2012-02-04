<?php
/* 
CHECK THIS LINK TO LEARN ABOUT THIS CONTACT FORM:
http://www.raymondselda.com/php-contact-form-with-jquery-validation/
*/

$mailer = mysql_query("select *
from cc_users u 
where u.ID = '$id'")or die(mysql_error());

//If the form is submitted
if(isset($_POST['message'])) {
	
	$emailTo = $_POST['message'];
	$emailFrom =  $mailer['email'];
	$name = $mailer['first_name'].' '.$mailer['last_name'];
	
	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = $emailTo; //Put your own email address here
		$body = "Name: $name  \n\nSubject: $subject";
		$headers = 'From: $name <'.$emailFrom.'>' . "\r\n" . 'Reply-To: ' . $emailFrom;

		if (mail($emailTo, $subject, $body, $headers) ) {
		   $emailSent = true;
		} else {
		   $emailSent = false;
		}
	}
}
?>