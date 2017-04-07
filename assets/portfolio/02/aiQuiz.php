<?php

    $title="Quizzes";

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

?>



<script type="text/javascript">

	var ans = new Array();

	var userAns = new Array();

	var score = 0;

	

	// Answers to the Questions

	ans[1] = "a";

	ans[2] = "b";

	ans[3] = "a";

	ans[4] = "b";

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

				answerText =  answerText + i + ". " + "The correct answer is " + ans[i] + "\n";

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

                    <h2>AI Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) Who is the developer of AI?</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="adobe" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="adobe">Adobe</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="microsoft" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="microsoft">Microsoft</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="apple" value="c" onClick ="Engine(1, this.value)"/>

                            <label for="apple">Apple </label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="google" value="d" onClick ="Engine(1, this.value)"/>

                            <label for="google">Google</label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) Which image format is AI?</span>

                        <br/><br/>

                        <input type="radio" name="q2" id="raster" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="raster">Raster</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="vector" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="vector">Vector </label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="jpegQ" value="d" onClick ="Engine(2, this.value)"/>

                            <label for="jpegQ">JPEG</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="none" value="d" onClick ="Engine(2, this.value)"/>

                            <label for="none">None</label>

                        <br/><br/>

                        <!-- Question 3 -->

                        <span>3) What is AI?</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="adobeIll" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="adobeIll">Adobe Illustrator</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" id="adobeImage" value="b" onClick ="Engine(3, this.value)"/>

                            <label for="adobeImage">Adobe Image</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" id="appleIll" value="c" onClick ="Engine(3, this.value)"/>

                            <label for="appleIll">Apple Illustrator</label>

                        <br/><br/>



                        <input type="radio" name="q3" id="appleImg" value="c" onClick ="Engine(3, this.value)"/>

                            <label for="appleImg">Apple Image</label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) Should a photograph save as AI extension?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="true" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="true">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="false" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="false">False</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) Which version of AI editor is the latest?</span>

                        <br/><br/>

                        <input type="radio" name="q5" id="CC" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="CC">CC</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="CS3" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="CS3">CS3</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="Apple" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="Apple">Apple </label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="7" value="d" onClick ="Engine(5, this.value)"/>

                            <label for="7">7</label>

                        <br/><br/>

                                                

                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>

					</form>

				</div>  <!-- End of the Conent -->

        	</div>  <!-- End of the Wrapper -->

		</div>

		

<?php

	include ("assets/inc/footer.inc.php");

?>