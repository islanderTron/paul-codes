<?php
    ob_start();
    session_start();
    include('LIB_project1.php');
    include('connection.php');
    
    if(isset($_POST['signin']))
    {
        
        //assigning the user's inputs to a database
        $userId = $_POST['userid'];
        $password = $_POST['passwordinput'];
        
        //use the select function to obtain all information about a particular user from the database
        $data = select($conn, 'email', 'user', $userId,':emailAddress','*');
        
        foreach($data as $row)
        {
            //assigned the generated database information about a user to a variable
            $dbuser = $row['email'];
            $dbpass = $row['password'];
            $dbtype = $row['type'];
            $dbstatus = $row['status'];
            
        }
       
        
        echo $userId;
        echo $dbuser;
        //check to ensure that the user input information matches the one on the database
        if($userId == $dbuser && $password == $dbpass)
        {
            //check if the user is admin
            if($dbtype=='admin')
            {
                $_SESSION['type'] = $dbtype;
                $_SESSION['user'] = $dbuser;
                header('location:admin.php');
                
            }//end of setting the default redirect page for the admin after logged in successfully
            
            else
            {
                //check if the user already activated their account
                if($dbstatus=="activated")
                {
                    $_SESSION['type'] = $dbtype;
                    $_SESSION['user'] = $dbuser;
                    header('location:index.php');
                    
                }//end of if user already activate account
                
                //the user never activated their accound. IE their account is pending activation
                else
                {
                    $_SESSION['user'] = $dbuser;
                    $_SESSION['type'] = $dbtype;
                    $_SESSION['status'] = 'yetToConfirm';
                    header('location:activation.php');       
                }
                
            }//end of if not admin
           
        }//end of if login credientals match database
        
        else
        {
            echo 'Invalid username or password';
        }
    }

    // if user confirms sign up
    if(isset($_POST['confirmsignup']))
    {
        $email = $_POST['Email'];
        $password = $_POST['password'];
        $type = 'user';
        $status = 'yetToConfirm';
        
        $result = insertRegistration($conn,'user', $email,$password,$type,$status,':emailAddress',':userPassword',':userType',
                           ':userStatus','email','password','type','status');
        
        //insert was successful
        if($result==true)
        {
            $_SESSION['status'] = $status;
            header('location:activate.php');
            
        }

    }

?>