<?php
    $to = "pju2173@rit.edu"; 
    $from = $_REQUEST['email']; 
    $name = $_REQUEST['name'];

    $headers = "From: $from"; 
    
    $subject = "You have a message sent from your site"; 
    
    $fields = array(); 
    $fields{"name"} = "name"; 
    $fields{"email"} = "email";
    $fields{"text"} = "message";
    
    $body = "Here is what was sent:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }
    
    $send = mail($to, $subject, $body, $headers);
?>