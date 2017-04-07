<?php

    $title = "PDF Quiz";

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

?>



<script type="text/javascript">

	var ans = new Array();

	var userAns = new Array();

	var score = 0;

	

	// Answers to the Questions

	ans[1] = "b";

	ans[2] = "a";

	ans[3] = "a";

	ans[4] = "a";

	ans[5] = "a";

	

	// Function to match question and answer

	function Engine(question, answer) {

		userAns[question] = answer;

	}

	

	// Check for the validation and print results

	function getScore() {

		var answerText = "";

		

		for(i = 1; i <= 5; i++) {

			if(ans[i] != userAns[i]) {

				answerText = answerText + i + ". " + "The correct answer is " + ans[i] + "\n";

			}

			else {

				score++;		// Answer is correct

			}

		}	

		var totalScore = (score / 5) * 100;

		answerText = answerText + "\nYour total score is " + totalScore + "%";

		

		alert(answerText);

	}



</script>



		<div id="rightColumn">

		    <div id="wrapper">

	            <div id="content">

                    <h2>PDF Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) Microsoft developed PDF</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="True1" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="True1">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="False1" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="False1">False</label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) Postscript influenced PDF.</span>

                        <br/><br/>

                        <input type="radio" name="q2" id="True2" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="True2">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="False2" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="False2">False</label>

                        <br/><br/>

                        

                        <!-- Question 3 -->

                        <span>3) PDF is good idea to use as a paged media on the web.</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="True3" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="True3">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" id="False3" value="b" onClick ="Engine(3, this.value)"/>

                            <label for="False3">False</label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) Which format is PDF?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="vector" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="vector">Vector</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="raster" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="raster">Raster</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="imageFile" value="c" onClick ="Engine(4, this.value)"/>

                            <label for="imageFile">Image File</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="jpegQ" value="d" onClick ="Engine(4, this.value)"/>

                            <label for="jpegQ">JPEG</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) What is PDF?</span>

                        <br/><br/>

                        <input type="radio" name="q5" id="protableDF" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="protableDF">Portable Document Format</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="poorDC" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="poorDC">Poor Document File</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="protableDFolder" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="protableDFolder">Portable Document Folder</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="none" value="d" onClick ="Engine(5, this.value)"/>

                            <label for="none">None</label>

                        <br/><br/>

                                                

                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>

					</form>

				</div>  <!-- End of the Conent -->

        	</div>  <!-- End of the Wrapper -->

		</div>

		

<?php

	include ("assets/inc/footer.inc.php");

?>