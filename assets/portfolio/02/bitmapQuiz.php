<?php

	$title = "BMP Quiz";

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

?>



<script type="text/javascript">

	var ans = new Array();

	var userAns = new Array();

	var score = 0;

	

	// Answers to the Questions

	ans[1] = "a";

	ans[2] = "a";

	ans[3] = "a";

	ans[4] = "a";

	ans[5] = "b";

	

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

                    <h2>Bitmap Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) Does bitmap generates beautiful images?</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="q1" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="q1">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="q1">False</label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) What will cause the image to do if it blows up?</span>

                        <br/><br/>

                        <input type="radio" name="q2" id="q2" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="q2">Produce a blurry and blocky image</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="q2">Increase the size quality</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2"  value="c" onClick ="Engine(2, this.value)"/>

                            <label for="q2">Erase the image completely</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" value="d" onClick ="Engine(2, this.value)"/>

                            <label for="q2">Increase the image colors</label>

                        <br/><br/>

                        

                        <!-- Question 3 -->

                        <span>3) How can an image have the ability to allow the user to edit, add, delete, or change the individual pixels colors?</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="q3" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="q3">By zooming in on it for the user to get their image preference</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" value="b" onClick ="Engine(3, this.value)"/>

                            <label for="q3">Resizing the image</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" value="c" onClick ="Engine(3, this.value)"/>

                            <label for="q3">Using a specific program that is compatible with bitmap only </label>

                        <br/><br/>

                        

                        <input type="radio" name="q3"  value="d" onClick ="Engine(3, this.value)"/>

                            <label for="q3">A and B</label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) What are the several reasons for bitmap?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="q4" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="q4">Logos, favicons</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Logos, favicons, and icons image</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="c" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Images</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="d" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Favicons</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) Where are bitmap images stored in?</span>

                        <br/><br/>

                        <input type="radio" name="q5" id="q5" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="q5">The picture itself</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="q5">A computerized form</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="q5">An editor program</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="d" onClick ="Engine(5, this.value)"/>

                            <label for="q5">A and C</label>

                        <br/><br/>

                                                

                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>

					</form>

				</div>  <!-- End of the Conent -->

        	</div>  <!-- End of the Wrapper -->

		</div>

		

<?php

	include ("assets/inc/footer.inc.php");

?>