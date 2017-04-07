<?php
    if(!empty($_POST)){

        // Define the variables
        $errors = array();

        if(empty($_POST["first"])){
            $errors[] = "Type your username";
            echo "<span style=color:'red';>".$_POST["name"]."</span>";
        }
        if(empty($_POST["message"])){
            $errors[] = "Type something in text area";
        }
    }
?>