<?php
	if (empty($_POST['name3']) && strlen($_POST['name3']) == 0 || empty($_POST['email3']) && strlen($_POST['email3']) == 0 || empty($_POST['message3']) && strlen($_POST['message3']) == 0)
	{
		return false;
	}
	
	$name3 = $_POST['name3'];
	$email3 = $_POST['email3'];
	$message3 = $_POST['message3'];
	$optin3 = $_POST['optin3'];
	
	// Create Message	
	$to = 'receiver@yoursite.com';
	$email_subject = "Message from a Blocs website.";
	$email_body = "You have received a new message. \n\nName3: $name3 \nEmail3: $email3 \nMessage3: $message3 \nOptin3: $optin3 \n";
	$headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n";	
	$headers .= "From: contact@yoursite.com\r\n";
	$headers .= "Reply-To: $email3";

	// Post Message
	if (function_exists('mail'))
	{
		$result = mail($to,$email_subject,$email_body,$headers);
	}
	else // Mail() Disabled
	{
		$error = array("message" => "The php mail() function is not available on this server.");
	    header('Content-Type: application/json');
	    http_response_code(500);
	    echo json_encode($error);
	}	
?>