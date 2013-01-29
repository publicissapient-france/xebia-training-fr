<?php
/**
*
*	Update Your Mail & Custom Messages
*
*/


// Your Mail Address
$your_mail = 'yourmail@address.com';

// Error Message
$custom_error =  'Oh Boy! something went wrong with submission, could you PLS. try again or use my listed mail address <span>' . $your_mail . '</span>'; // everything between span is colored green for emphasis 

// Success Message
$custom_success = 'Thank You! Your email was successfully sent we\'ll be in touch with you soon.';



/*----------------------------------------YDCOZA----------------------------------------*/
/*		PLS. Don't edit beyond this point unless you know what you're doing  */
/*--------------------------------------------------------------------------------------*/


//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {

		$emailTo = $your_mail;

		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}

if(isset($hasError)) { //If errors are found 

	echo '<h3 class="error">' . $custom_error . '</h3>';

} if(isset($emailSent) && $emailSent == true) { //If email is sent successfully

	echo '<h3 class="success">' . $custom_success . '</h3>';

} 