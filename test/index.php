<?php
//    if(!empty($_POST)){
//        $message = "Name: " . $_POST['name'];
//        $header = "From: pju2173@rit.edu <pju2173@rit.edu>";
//        $header .= "Cc:".$_POST["email"];
//        if(mail("pju2173@rit.edu", "Your Order Confirmation",$message, $header)){
//            $feedback = "Successfully submitted";
//        }
//        else{
//            $feedback = "Sorry, there was an error submitting your form";
//        }
//    }

    if(!empty($_POST)){
        if(isset($_POST['submit'])){
            $sto = "pju2173@rit.edu";
            $from = $_POST['email'];
            $name = $_POST['name'];
            $subject = "Form Submission";
            $message = $name . " test";

            $header = "From: " . $from;
            mail($to, $subject, $message, $header);
            $feedback = "Successfully submitted";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <?php
        echo $feedback;
    ?>
    <form action="index.php" method="post">
        <p>Name:</p>
        <input name="name">
        
        <p>Email:</p>
        <input name="email">
        
        <p>Message:</p>
        <textarea name="message"></textarea>
        
        <input type="submit" name='submit' value="Submit" id="button-blue" />
    </form>
</body>
</html>