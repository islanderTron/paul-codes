<?php
    include 'connection.php';

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
?>
