<?php
    $title="Quizzes";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>
		<div id="rightColumn">
		    <div id="wrapper">
	            <div id="content">
	            	<h1>Quizzes</h1>
	            	<div class="rasterTQ">
						<p><strong>Raster</strong></p>
						<ul>
							<li><a href="jpegQuiz.php">JPEG</a></li>
							<li><a href="pngQuiz.php">PNG</a></li>
							<li><a href="gifQuiz.php">GIF</a></li>
							<li><a href="tiffQuiz.php">TIFF</a></li>
							<li><a href="bitmapQuiz.php">BMP</a></li>
						</ul>
					</div>
					<div class="vectorTQ">
						<p><strong>Vector</strong></p>
						<ul>
							<li><a href="aiQuiz.php">AI</a></li>
							<li><a href="svgQuiz.php">SVG</a></li>
							<li><a href="pdfQuiz.php">PDF</a></li>
							<li><a href="epsQuiz.php">EPS</a></li>
						</ul>
					</div>
	            </div>  <!-- End of the Conent -->
	        </div>  <!-- End of the Wrapper -->
        </div>

<?php
	include ("assets/inc/footer.inc.php");
?>