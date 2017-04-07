<?php include 'header.inc.php'; ?>
<?php include "LIB_project1.php"; ?>
	<div class="row">
		<?php check_product($dbh);?>
	</div>
	<div class="row">
		<h3><b>Sales</b></h3>
		<?php sale_display($dbh);?>
	</div>
	<div class="row">
		<h3><b>Catalog</b></h3>
		<?php catalog_display($dbh);?>
	</div>
<?php include 'footer.inc.php'; ?>