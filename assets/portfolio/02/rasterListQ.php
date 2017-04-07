<?php
    $title = "Quizzes";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>
		<div id="rightColumn">
		    <div id="wrapper">
	            <div id="content">
	            	
	            	<h1>Raster</h1>
	            	<p>Select an image format file from raster in list:</p>
					<div class="link"><h2><strong><a href="jpegQuiz.php">JPEG</a></strong></h2></div>
					<div class="link"><h2><strong><a href="pngQuiz.php">PNG</a></strong></h2></div>
					<div class="link"><h2><strong><a href="gifQuiz.php">GIF</a></strong></h2></div>
					<div class="link"><h2><strong><a href="bitmapQuiz.php">BMP</a></strong></h2></div>
					<div class="link"><h2><strong><a href="tiffQuiz.php">TIFF</a></strong></h2></div>

	            </div>  <!-- End of the Conent -->
	        </div>  <!-- End of the Wrapper -->
       </div>
<?php
	include("assets/inc/footer.inc.php");
?>