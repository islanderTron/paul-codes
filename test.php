<?php 
	// session_start();    
	// echo $ip = $_SERVER['HTTP_REFERER'];
	$wm = array("Jennifer Lopez", "Halle Berry", "Eliza Coupe", "Alison Brie", "Shay Mitchell", "Gillian Jacobs", "Nicole Scheriznger", "Maria Sharapova", "Paul Abul");

?>
<!-- <a href="http://localhost:8080/perfectgift-lab/testing.php">perfectgift</a> -->

<!-- <a href="https://www.perfectgift.us/ojolie/">perfectgift</a> -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
<style type="text/css">
	/* 
	 * Reference: https://codepen.io/CreativeJuiz/pen/Hizkh
	 * Help understand the detail how to transform the photo using CSS and image file
	*/
	.part{
		width: 30%;
		float: left;
	}
	.diamond, .dia {
	  margin: 0 auto;
	  transform-origin: 50% 50%;
	  overflow: hidden;
	  width: 300px;
	  height: 300px;
	}
	.diamond {
	  transform: rotate(45deg) translateY(-25px) translateX(-25px);
	}
	.diamond .dia {
	  width: 380px;
	  height: 380px;
	  transform: rotate(-45deg);
	}
	.diamond img {
	  width: 100%;
	  height: auto;
	}

</style>
</head>
<body>
	<div class="part">
	    <div class="diamond">
	      <div class="dia">
	        <img src="81_large kopia.png">
	      </div>
	    </div>
	</div>
	<div class="part">
	    <div class="diamond">
	      <div class="dia">
	        <img src="81_large kopia.png">
	      </div>
	    </div>
	</div>
	<div class="part">
	    <div class="diamond">
	      <div class="dia">
	        <img src="81_large kopia.png">
	      </div>
	    </div>
	</div>
	<!-- <img src="81_large kopia.png"> -->
	<!-- <div class="cutCorner"> -->
<!-- 	<div>
		<p>The main idea is to have 4 gradients that each occupy a quarter of the element's area (one for the bottom left, one for the bottom, on of the top right and one for the top left). Then you set the background to 4 linear gradients with the same color stops (in this case we wanted the corner size to be 10px*, so it was transparent <strong>until</strong> 10px and then the color we want <strong>from</strong> 10px) except the corners that are 45deg, 135deg, 225deg and 315deg respectively.</p>
    	<p><small>*Actually not exactly 10px, it's the length of the hypotenuse of an isosceles right-angled triangle, which is around 14px</small></p>
    </div> -->

	<!-- </div> -->
	<?php 
		foreach($wm as $value){
			if($value == "Halle Berry" || $value == "Maria Sharapova"){
	?>
			<!-- <p style="float:right;"> <?php print $value; ?></p> -->
	<?php
			}else{
	?>
			<!-- <p> <?php print $value; ?></p> -->
	<?php
			}
		}
	?>

</body>
</html>
