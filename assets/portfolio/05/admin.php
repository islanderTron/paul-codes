<?php include "header.inc.php"; ?>
<?php include "LIB_project1.php"; ?>
<?php include "getID.php"; ?>
	<form method='post' enctype="multipart/form-data" action="admin.php">
		<div class="row">
			<div class="small-10 columns">
			<?php
				$name = $_POST['name'];
				$desc_product = $_POST['descr'];
				$price = $_POST['price'];
				$quantity = $_POST['qty'];
				$sale = $_POST['sale'];
				$pwd = $_POST['pwd'];
				$prod_id = $_POST['option'];

				upload($dbh, $prod_id, $name, $desc_product, $price, $quantity, $sale);
				delete_admin($dbh, $prod_id, $pwd);
			?>
	    </div>
			<div class="small-1 columns">
		      <label for="left-label" class="text-left middle">Select an item:</label>
	    </div>
	    <div class="small-3 columns">
			<label id='option'>
				<select name="option" onchange="showProducts(this.value)" id='select'>
					<option value="">Select an item</option>
					<?php option($dbh); ?>
				</select>
			</label>
	    </div>
	    <div class="small-4 columns">
	    	<input id="checkbox1" class="middle" type="checkbox" name="checkbox" onclick="newProduct()"><label for="checkbox1">New Product</label>
	    </div>
		</div>
		<div class="row">
			<div class="small-1 columns">
	      <label for="left-label" class="text-left middle">Name:</label>
	    </div>
	    <div class="small-3 columns">
	      <input type="text" id="left-label name" class='name' name='name' <?php //name($dbh, $_POST['option']); //$_POST['name']; ?> >
	    </div>
		</div>
	  	<div class="row">
	  		<div class="small-1 columns">
		    	<label for="left-label" class="text-left middle">Choose a file to upload: (Only JPG & PNG):</label>
	  		</div>
	  		<div class="small-3 columns">
	  			<input id='filetoupload' type="file" name='fileToUpload'>
	  		</div>
		</div>
		<div class="row">
			<div class="small-1 columns">
		      <label for="middle-label" class="text-right middle">Description:</label>
		    </div>
		    <div class="small-3 columns">
		      <textarea type="text" id="middle-label desc" name='descr' rows="8"><?php //description($dbh, $_POST['option']); $_POST['descr'] ?></textarea>
		    </div>
		</div>
		<div class="row">
		    <div class="small-1 columns">
		      <label for="middle-label" class="text-right middle">Price</label>
		    </div>
		    <div class="small-3 columns">
		      <input type="text" id="middle-label price" name='price' <?php //price($dbh, $_POST['option']); ?>>
		    </div>
		</div>
		<div class="row">
		    <div class="small-1 columns">
		      <label for="middle-label" class="text-right middle">Quantity:</label>
		    </div>
		    <div class="small-3 columns">
		      <input type="text" id="middle-label qty" name='qty' <?php //quantity($dbh, $_POST['option']); ?>>
		    </div>
		</div>
		<div class="row">
		    <div class="small-1 columns">
		      <label for="middle-label" class="text-right middle">Sale</label>
		    </div>
		    <div class="small-3 columns">
		      <input type="text" id="middle-label sale" name='sale' <?php //sale($dbh, $_POST['option']); ?>>
		    </div>
		</div>
		<div class="row">
		    <div class="small-1 columns">
		      <label for="middle-label" class="text-right middle">Password:</label>
		    </div>
		    <div class="small-3 columns">
		      <input type="password" id="middle-label" name='pwd'>
		    </div>
		</div>
		<div class="row">
			<input class="success button" type="submit" name='submit' value="Insert">
			<input class="button" type="reset" name='submit' value="Reset">
			<input id="deleteButton" class="alert button" type="submit" name='delete' value="Delete">
		</div>
	</form>
<?php include 'footer.inc.php'; ?>
