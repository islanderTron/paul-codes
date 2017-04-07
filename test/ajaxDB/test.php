<?php include 'getuser.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>AJAX & JSON</title>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="json.js"></script>
</head>
<body>
	<form>
		<select name='option' onchange='showProducts(this.value)' id='select'>
			<option value="">Select a product:</option>
			<?php option($dbh) ?>
		</select>
		<p><input type="text" id="left-label name" class='name' name='name'></p>
		<p><textarea type="text" id="middle-label desc" name='descr' rows="20"></textarea></p>
		<p><input type="text" id="middle-label price" name='price'></p>
		<p><input type="text" id="middle-label qty" name='qty'></p>
		<input type="text" id="middle-label sale" name='sale'>
	</form>
</body>
</html>

<?php include "json.php"; ?>