<?php
	$title="SVG Tutorial";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>
		<div id="rightColumn">
		    <div id="wrapper">
	            <div id="content">
	                   <div id="rightContent">
	                        <!-- Insert contents here -->
	                        <h1>SVG Tutorial</h1>
	                    </div>  <!-- End of the Right Content -->
	                    
						<p><strong>1.</strong> Open the text editor and set up HTML5 template like in the code. </p>
    					<div class="code_example">
    						&lt;!doctype html&gt;<br/>
    						&lt;html lang ="en"&gt;<br/>
    						&lt;head&gt;<br/>
    						&emsp; &lt;meta charset="utf-8"&gt;<br/>
    						&emsp; &lt;title = "SVG Page"&gt;<br/>
    						&lt;/head&gt;<br/>
    						
    						&lt;body&gt;<br/>

							&lt;/body&gt;
						</div>

	                    <p><strong>2.</strong> Add SVG tag in the body. </p>
	                    <div class="code_example">
							&lt;body&gt;<br/>
							&emsp; &lt;svg&gt;<br/>
							<br/>
							&emsp; &lt;/svg&gt;<br/>
							&lt;/body&gt;
						</div>
	                    
	                    <p><strong>3.</strong> Add polygon tag in SVG tag. Add the ‘points’ attributes. </p>
	                    <div class="code_example">
							&lt;body&gt;<br/>
							&emsp; &lt;svg&gt;<br/>
							&emsp; &emsp; &lt;polygon points="" /&gt;<br/>
							&emsp; &lt;/svg&gt;<br/>
							&lt;/body&gt;
						</div>
						
						<p><strong>4.</strong> Fill in the points in the ordered pair x,y that will trace in the order and the first point will also be the last point. </p>
	                    <div class="code_example">
							&lt;body&gt;<br/>
							&emsp; &lt;svg&gt;<br/>
							&emsp; &emsp; &lt;polygon points="3, 3 100,110, 200,300 400, 50" /&gt;<br/>
							&emsp; &lt;/svg&gt;<br/>
							&lt;/body&gt;
						</div>
						
						<img src="assets/Media/tutorial/SVG/1.jpg" alt="Black">
						
						<p><strong>5.</strong> The default fill color is black. Add the inline style attribute ‘fill’. You can enter any code or name of color you desire. </p>
	                    <div class="code_example">
							&lt;body&gt;<br/>
							&emsp; &lt;svg&gt;<br/>
							&emsp; &emsp; &lt;polygon points="3, 3 100,110, 200,300 400, 50"<br/>
							&emsp; &emsp; &emsp; style="fill: blue;"/&gt;<br/>
							&emsp; &lt;/svg&gt;<br/>
							&lt;/body&gt;
						</div>
						
						<img src="assets/Media/tutorial/SVG/2.jpg" alt="Blue">
	            </div>  <!-- End of the Conent -->
	        </div>  <!-- End of the Wrapper -->
       </div>
<?php
	include ("assets/inc/footer.inc.php");
?>