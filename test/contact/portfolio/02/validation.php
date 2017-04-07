<?php
		// Validation
	if(!empty($_POST)) {

		// Attributes
		$errors = array();

		// First Name Validation
		if(empty($_POST["firstname"])) {
			$errors[] = "first name";
		}

		// Last Name Validation
		if(empty($_POST["lastname"])) {
			$errors[] = " last name";
		}

		// Email Validation
		if(empty($_POST["email"])) {
			$errors[] = "e-mail address";
			$to = $_POST["email"];			// Mail Attribute - to
		}

		// Message Validation
		if(empty($_POST["feedback"])) {
			$errors[] = "feedback";
		}

		// Mail it
		if(empty($errors)) {
			// Mail 
			$subject = "Thank you for giving us your comment!";

			$message = "Hello " . $_POST['firstname'] . ",\n";
			$message .= "Thank you for posting your feedback!\n\n"	;
			$message .= "Your comment says:\n";
			$message .= $_POST['comment'] . ",\n";
			$message .= "\nSincerely,\n";
			$message .= "ImaginationZ Creators\n";

			// Additional Headers
			$headers .= "From: pxy9548@rit.edu" . "\r\n";
			$headers .= "Cc: " . $_POST["email"] . "\r\n";

			// Mail it
			if(mail("pxy9548@rit.edu", $subject, $message, $headers)) {
      		  $feedback = "Feedback successfully submitted.  Thanks!";
      		}
     		else {
      		  $feedback = "Sorry, There was an error submitting your form.";
      		}
		}
	}
?>