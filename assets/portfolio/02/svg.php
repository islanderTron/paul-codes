<?php
	$title="SVG";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>
		<div id="rightColumn">
		    <div id="wrapper">
	            <div id="content">
	            	<div id="leftContent">
	                <!-- Insert image here -->
	                    <img src="assets/Media/Image_Files/svg_icon1.png" alt="SVG Icon">
	                </div>
	                
	                 <h2>SVG</h2>
					<p>Scalable Vector Graphics, SVG, are developed by the World Wide Web Consortium (W3C). SVG is used as a vector standard format for the Web.  SVG supports interactivity and animation. It also uses a markup language called XML, Extensible Markup Language, to describe graphics and images. It allows the users to write the codes on HTML (HyperText Markup Language that creates web pages) to create images without drawing them.</p>
					<p>
						SVG is ideal for the web developers who wants to create the images using XML on HTML.
						Internet Explorer, Mozilla Firefox, Google Chrome, Safari, and Opera support the markup
						rendering. The latest version is 1.1. SVG 2 is in the development.
					</p>
					<p>
						SVG can be created by using Inkscape, Adobe Illustrator, or CorelDRAW.
					</p>
					<strong>The example of SVG codes that create an image of a circle:</strong><br/>
					<div class="code_example">
						&lt;svg width="50" height="50"&gt;<br/>
						&emsp;&lt;circle cx=”25” cy=”25” r=”20” stroke=”black” stroke-width=”1” fill=”green”&gt;<br/>
						&lt;/svg&gt;&shy;
					</div>
					<strong>Actual SVG image:</strong><br/>
					<svg width="50" height="50">
						<circle cx="25" cy="25" r="20" stroke="black" stroke-width="1" fill="green"/>
					</svg>
	            </div>  <!-- End of the Conent -->
	        </div>  <!-- End of the Wrapper -->
       </div>
<?php
	include ("assets/inc/footer.inc.php");
?>