<?php

  // Include any PHP function libraries or classes

  include "/Volumes/Students/students/course/deaf_power/db_conn.php";

  

  if ($db) {

    // Intialize the database connection

    $link = mysqli_connect ($db_host, $db_user, $db_pass, $db_name);

  

    // Verify that we have a valid connection

    if (!$link) {

      echo "Connection Error: " . mysqli_connect_error();

      die();

    }

  }

?>