<?php include 'header.inc.php'; ?>
<?php include "LIB_project1.php"; ?>
	<?php display_cart($dbh); ?>
	<hr>
	<?php totalCost($dbh); ?>
	<form action="cart.php" method="post" class="cartForm" >
		<input type="submit" class="button" name="remove" value="Empty">
	</form>
	<?php delete_cart($dbh); ?>
<?php include 'footer.inc.php'; ?>