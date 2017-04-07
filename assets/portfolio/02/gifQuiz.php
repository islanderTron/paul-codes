<?php

	$title = "GIF Quiz";

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

?>



<script type="text/javascript">

	var ans = new Array();

	var userAns = new Array();

	var score = 0;

	

	// Answers to the Questions

	ans[1] = "d";

	ans[2] = "b";

	ans[3] = "c";

	ans[4] = "c";

	ans[5] = "d";

	

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

                    <h2>GIF Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) Which company introduced GIF?</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="q1" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="q1">Microsoft </label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="q1">Adpbe </label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" value="c" onClick ="Engine(1, this.value)"/>

                            <label for="q1">Cubby Inc. </label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" value="d" onClick ="Engine(1, this.value)"/>

                            <label for="q1">Compuserve </label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) What is the name of the GIF version that allows people to create compressed animations using timed delay?</span>

                        <br/><br/>

                        <input type="radio" name="q2" id="q2" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="q2">100a </label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="q2">87a </label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" value="c" onClick ="Engine(2, this.value)"/>

                            <label for="q2">4000c </label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" value="d" onClick ="Engine(2, this.value)"/>

                            <label for="q2">88a </label>

                        <br/><br/>

                        

                        <!-- Question 3 -->

                        <span>3) WhatGimp is the solo program for which operation system?</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="q3" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="q3">Solaris</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3"  value="b" onClick ="Engine(3, this.value)"/>

                            <label for="q3">Mac </label>

                        <br/><br/>

                        

                        <input type="radio" name="q3"  value="c" onClick ="Engine(3, this.value)"/>

                            <label for="q3">Linux </label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" value="d" onClick ="Engine(3, this.value)"/>

                            <label for="q3">Eagle </label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) What are some of the programs that can open .GIF files?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="q4" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="q4">Photoshop and Elements 12 </label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Windows Photo Viewer and Elements 12 </label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="c" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Adobe Photoshop CC, Elements 12, Corel PaintShop Pro X5, and Microsoft Window Photo Viewer</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" value="d" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Adobe Photoshop CC and Adobe Illustrator</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) When was GIF introduced? </span>

                        <br/><br/>

                        <input type="radio" name="q5" id="q5" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="q5">1974 </label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="q5">1999 </label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="q5">2005 </label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" value="d" onClick ="Engine(5, this.value)"/>

                            <label for="q5">1987 </label>

                        <br/><br/>

                                                

                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>

					</form>

				</div>  <!-- End of the Conent -->

        	</div>  <!-- End of the Wrapper -->

		</div>

		

<?php

	include ("assets/inc/footer.inc.php");

?>