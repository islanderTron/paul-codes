<?php
    // makes a database connection
    $username = 'jnp5028';
    $password = 'root';

    try
    {
        $conn = new PDO('mysql:host=localhost;dbname=jnp5028', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo 'There was an internal connection error with the server.<br/>
              Please contact the administrator at <a href="mailto:jnp5028@rit.edu">jnp5028@rit.edu</a>.';
    }
    
?>