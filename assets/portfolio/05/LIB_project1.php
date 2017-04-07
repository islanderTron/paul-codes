<?php
	include 'connection.php';
    ob_start();

	// Index page
	/*
		A user selects an item from sale or catalog, the item will decrease its quantity in products and then will insert temporary id in cart.
	*/
	function check_product(PDO $dbh){
		if(isset($_GET["add_cart"])){
			$id = $_GET["add_cart"];

			$check_product = "UPDATE products SET quantity = quantity - 1 WHERE prod_id = ? AND quantity > 0";
			$stmt = $dbh->prepare($check_product);
			$result = $stmt->bindParam(1, $id);
			if($result){
				$stmt->execute();
				$insert_product_query = "INSERT INTO cart(cart_id) VALUES (?)";
				$stmt = $dbh->prepare($insert_product_query);
				$stmt->bindParam(1, $id);
				$stmt->execute();
			}
			echo "<div class='callout success'><h5>Updated</h5></div>";
		}
	}

	/*
		This function will display all the sale items with picture, name, description, price sale, and quantit(ies)
	*/
	function sale_display(PDO $dbh){
		$stmt = $dbh->prepare("SELECT * FROM products WHERE sale_price != 0.00");
		$stmt->execute();
		$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($stmt->rowCount() > 0){
			$image = $row['img'];
			foreach($arr as $row){
				$id = $row['prod_id'];
				$name = $row['name'];
				$desc = $row['desc_product'];
				$image = $row['img'];
				$price_sale= $row['sale_price'];
				$price= $row['price'];
				$quantity = $row['quantity'];
				$bigString .= "
				<div class='block'>
					<div class='img'>
						<img  src='uploads/$image'/>
					</div>
					<div class='content'>
						<h4><span>$name</span></h4>
						<p><span>$desc</span></p>
						<p><span>Price: \$$price_sale (Original Price:</span> <span class='line-through'>\$$price)</span></p>
						<p><span>Quantity: $quantity</span></p>";
				if($quantity == 0){
					$bigString .= "<p>SOLD OUT!<p></div></div>";
				}else{
					$bigString .= "<a class='button cart_button' href='index.php?add_cart=$name'>Add Cart</a></div></div>";
				}
			}
			echo $bigString;
		}
	}

	/*
		This function will display all the items with picture, name, description, price sale, and quantit(ies)
	*/
	function catalog_display(PDO $dbh){
		$stmt = $dbh->prepare("SELECT * FROM products WHERE sale_price = 0.00");
		$stmt->execute();
		$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($stmt->rowCount() > 0){
			$image = $row['img'];
			foreach($arr as $row){
				$id = $row['prod_id'];
				$name = $row['name'];
				$desc = $row['desc_product'];
				$image = $row['img'];
				$price= $row['price'];
				$quantity = $row['quantity'];
				$bigString .= "
				<div class='block'>
					<div class='img'>
						<img  src='uploads/$image'/>
					</div>
					<div class='content'>
						<h3><span>$name</span></h3>
						<p><span>$desc</span></p>
						<p><span>Price: \$$price</span></p>
						<p><span>Quantity: $quantity</span></p>";
				if($quantity == 0){
					$bigString .= "<p>SOLD OUT!<p></div></div>";
				}else{
					$bigString .= "<a class='button cart_button' href='index.php?add_cart=$name'>Add Cart</a></div></div>";
				}
					"</div>
				</div>";
			}
			echo $bigString;
		}
	}

	// Cart page
	/*
		Display the total quantit(ies) that a user selected item(s) next to Cart in navigation
	*/
	function totalQunatity(PDO $dbh){
		$query = "SELECT DISTINCT COUNT(cart_id) as count FROM cart";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$total = "0";
			foreach($stmt as $row){
				$total = "{$row['count']}";
			}
			echo $total;
		}
	}
	/*
		Display the total cost
	*/
	function totalCost(PDO $dbh){
		$query = "SELECT DISTINCT SUM(p.price) as totalCost FROM products p INNER JOIN cart c ON p.prod_id = c.cart_id WHERE p.sale_price = 0";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$totalPrice = "0";
			$totalSale= "0";
			foreach($stmt as $row){
				$totalPrice = "{$row['totalCost']}";
				$query_sale = "SELECT DISTINCT SUM(p.sale_price) as totalSale FROM products p INNER JOIN cart c ON p.prod_id = c.cart_id WHERE p.sale_price > 0";
				$sstmt = $dbh->prepare($query_sale);
				$sstmt->execute();
				foreach($sstmt as $col){
					$totalSale = "{$col['totalSale']}";
				}
            }
			$total=$totalPrice + $totalSale;
			echo "Total: $". $total;
		}
	}

	function display_cart(PDO $dbh){
		$result="";
		$query = "SELECT DISTINCT p.prod_id, p.name, p.price, p.desc_product FROM products p INNER JOIN cart c ON c.cart_id = p.prod_id";
		$stmt = $dbh->prepare($query);
		$stmt->execute();

		$string = "";
		if($stmt->rowCount() > 0){
			foreach($stmt as $row){
				$string  .= "<h4>{$row["name"]}</h4>
				<p>{$row['desc_product']}</p>";

				// Price
				$query_price = "SELECT DISTINCT price, sale_price FROM products p WHERE prod_id = ?";
				$price_stmt = $dbh->prepare($query_price);
				$price_stmt->bindParam(1, $row['prod_id']);
				$price_stmt->execute();
				foreach($price_stmt as $col){
					if( "{$col['sale_price']}" != 0){
						$string .= "<p>Price: \${$col['sale_price']}</p>";
					}else{
						$string .= "<p>Price: \${$col['price']}</p>";
					}
//                    echo "{$col['price']}";
				}

				// Quantities
				$query_cart = "SELECT DISTINCT COUNT(c.cart_id) as count from cart c INNER JOIN products p ON p.prod_id = c.cart_id WHERE p.prod_id = ?";
				$sstmt = $dbh->prepare($query_cart);
				$result = $sstmt->bindParam(1, $row['prod_id']);
				if($result){
					$sstmt->execute();
					foreach($sstmt as $col){
						$string .= "<p>Quantity: {$col['count']}</p>";
					}
				}
			}
			echo $string;
		}else{
			echo "<p style='text-align:center;'>There is nothing in cart.</p>";
		}
	}

	function delete_cart(PDO $dbh){
		if(isset($_POST["remove"])){
			$query = "TRUNCATE TABLE cart";
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() == 0){
				echo "<div class='callout alert '><h5>Deleted</h5></div>";
			}
		}
	}

	// Admin page
	function delete_admin(PDO $dbh, $prod_id, $pwd){
		if(isset($_POST['delete'])){
			if($pwd == "admin"){
				$query = "DELETE FROM products WHERE prod_id = ?";
				$stmt = $dbh->prepare($query);
				$stmt->bindParam(1, $prod_id);
				$stmt->execute();
				echo "<div class='callout alert '><h5>Deleted</h5></div>";
			}else{
				echo "<p>Your password is incorrected</p>";
			}
		}
	}

	function option(PDO $dbh){
		$string = "";
		$query = "SELECT prod_id, name FROM products";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($stmt->rowCount() > 0){
			foreach($arr as $row){
				$string .= "<option value='{$row['prod_id']}'>{$row['name']}</option>";
			}
			echo $string;
		}
	}

	//$dbh, $prod_id, $name, $desc_product, $price, $quantity, $sale
	function upload(PDO $dbh, $id, $name, $desc_product, $price, $quantity, $sale){
		if(isset($_POST['submit'])){
			if($_POST['pwd'] == "admin"){
				if(isset($_POST['checkbox'])){
					insertImage($dbh, $name, $desc_product, $price, $quantity, $sale);
				}
				else{
					updateProduct($dbh, $id, $name, $desc_product, $price, $quantity, $sale);
				}
			}else{
				echo "password error";
			}
		}
	}

	function updateProduct($dbh, $id, $name, $desc_product, $price, $quantity, $sale){
		if( !empty($name) && !empty($desc_product) && !empty($price) && !empty($quantity) && empty($image)){
			$query = "UPDATE products SET name = :name, desc_product = :desc_product, price = :price, quantity = :quantity, sale_price = :sale_price WHERE prod_id = :prod_id";
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(":name",$name);
			$stmt->bindParam(":desc_product",$desc_product);
			$stmt->bindParam(":price",$price);
			$stmt->bindParam(":quantity",$quantity);
			$stmt->bindParam(":sale_price",$sale);
			$result = $stmt->bindParam(":prod_id",$id);
			if($result){
				$stmt->execute();
				echo "<div class='callout secondary'><h5>Updated</h5></div>";
			}else{
				echo "BUZZZ!";
			}
		}
	}

	function insertImage($dbh, $name, $desc_product, $price, $quantity, $sale){
		$image = $_FILES["fileToUpload"]["name"];
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		// Credit by Ahmend Alzubaidi from www.stackoverflow.com
		// Check if image file is real image
		if($check !== false) {
			$uploadOk = 1;
			if($_FILES['fileToUpload']['size'] > 5000){
				// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$stmt = $dbh->prepare("INSERT INTO products(img, name, price, desc_product, quantity,sale_price) VALUES (?,?,?,?,?,?)");
						$result  = $stmt->bindParam(1, $image);
						$result .= $stmt->bindParam(2, $name);
						$result .= $stmt->bindParam(3, $price);
						$result .= $stmt->bindParam(4, $desc_product);
						$result .= $stmt->bindParam(5, $quantity);
						$result .= $stmt->bindParam(6, $sale);
						$stmt->execute();
						echo "<div class='callout secondary'><h5>Inserted</h5></div>";
					}
				// }else{
				// 	echo "<p>Sorry, we only accept JPG, JPEG, PNG, and GIF.</p>";
				// }
			}else{
				echo "<p>Sorry, your image is too large</p>";
			}
		} else {
			echo "<p>File is not an image.</p>";
		}
	}
?>
