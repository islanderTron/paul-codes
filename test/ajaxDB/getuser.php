<?php
	$host = "localhost";
	$db = "paul_database";
	$user = "pju";
	$pwd = "Guam1993";

	ob_start();

	try{
		// Connected my database in GoDaddy
		$dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e){
    	echo 'Connection failed: ' . $e->getMessage();
    }

    if(isset($_GET['productID'])){
		$productID = intval($_GET['productID']);
		$query = "SELECT * FROM products WHERE prod_id = ?";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(1, $productID);
		$stmt->execute();
		$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$emparray = array();
		foreach($arr as $row){
			$emparray = $row;
			print json_encode($emparray);
		}
    }

    function phptojson(PDO $dbh){
		$query = " SELECT * FROM products";	
		$stmt = $dbh->prepare($query);
		$stmt->execute();

		$emparray = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$emparray[] = $row;
		}
		print json_encode($emparray);
    }

	function option(PDO $dbh){
		$string = "";
		$query = "SELECT prod_id, name FROM products";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		foreach($stmt as $row){
			$string .= "<option value='{$row['prod_id']}'>{$row['name']}</option>";
		}
		echo $string;
	}
?>