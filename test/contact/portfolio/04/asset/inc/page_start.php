<?php
	// Include any PHP function libraries or classes
	require("/home5/chrisfio/public_html/admin/_a_mysql_chrisfiorito.php");

	if($db){
		// Database connection
		$link = mysqli_connect($chrisfio_mysql_h, $chrisfio_mysql_u, $chrisfio_mysql_p, "chrisfio_pju_rit");

		// Valid connection
		if(!$link){
			echo " connection error: " . mysqli_connect();
			die();	// Exit
		}
	}
?>