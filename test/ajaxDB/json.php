<?php
	$host = "localhost";
	$db = "paul_database";
	$user = "pju";
	$pwd = "Guam1993";

	try{
		$dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e){
    	echo 'Connection failed: ' . $e->getMessage();
    }

	$query = " SELECT * FROM products";	
	$stmt = $dbh->prepare($query);
	$stmt->execute();

	$emparray = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$emparray[] = $row;
	}
	print json_encode($emparray);
?>