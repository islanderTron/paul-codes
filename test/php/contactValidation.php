<?php
	if(!empty($_POST)){

		$errors = array();
		if(empty($_POST["name"])){
			$errors[] = "Name";
		}

		if(empty($_POST["email"])){
			$errors[] .= "Email";
		}
 		else{
            $email = $_POST["email"];
            if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
                $errors[] .="Must use \"@\" and/or \".\" ";
            }
        }

		if(empty($_POST["text"])){
			$errors[] .= "Comment";
		}

		if(empty($errors)){
			$message = "Name: " .$_POST["name"] . "\r\n";
			$message .= "Your email:" . " " .$_POST["email"] . "\r\n";
			$message .= "Message: " . $_POST["text"] . "\r\n";

			$header = $_POST["email"] . "\r\n";
			$header .= "Cc: " . $_POST["email"] . "\r\n";

			if(mail("pju2173@rit.edu", "Respond From User", $message)){
				$feedback = "Successfully submitted!";
			}
			else{
				$feedback = "Sorry, there is error submitting in form";
			}
			
		}
	}
?>