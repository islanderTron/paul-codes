<?php

	$title="PNG Tutorial";

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

?>

		<div id="rightColumn">

		    <div id="wrapper">

	            <div id="content">

                    <div id="rightContent">

	                        <!-- Insert contents here -->

	                        <h1>PDF Tutorial</h1>

	                        <h3>You want to upload your PDF on your website so the users can see your PDF page online. PDF page is ideal for the career seeking oriented website and PDF makes your resume look neat.

							In our tutorial, we store both PDF and HTML files on the same folder.</h3>

	                    </div>  <!-- End of the Right Content -->

	                    

						<p><strong>1.</strong> On HTML page, add &lt;embed&gt; on where you desire. </p>

    					<div class="code_example">

    						&lt;body&gt;<br/>

							  &emsp; &lt;h1&gt;My Resume&lt;/h1&gt;<br/>

							  &emsp; &lt;p&gt;I am seeking a career. Please take a look at my resume.&lt;/p&gt;<br/>

							  &emsp; &lt;embed&gt;<br/>

							&lt;/body&gt;

						</div>



	                    

	                    <p><strong>2.</strong> Add src=”yourPDFfilename.PDF” in the embed tag. </p>

	                    <div class="code_example">

							&lt;embed src=”myresume.PDF”&gt;

						</div>

	                    

	                    <p><strong>3.</strong> Add width=”xx” and height=”yy”. It is optional. </p>

	                    <div class="code_example">

							&lt;embed src=”myresume.PDF” width="100" height="100"&gt;

						</div>

	            </div>  <!-- End of the Conent -->

	        </div>  <!-- End of the Wrapper -->

       </div>

<?php

	include ("assets/inc/footer.inc.php");

?>