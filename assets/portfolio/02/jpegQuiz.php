<?php

	$title = "JEPG Quiz";

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

	ans[3] = "c";

	ans[4] = "d";

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

                    <h2>JPEG Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) What are the pros of JPEG image format?</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="action" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="action">Photography action, instant printing, fast download, and the preservation of integrity photos </label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="abilityEdit" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="abilityEdit">The ability to edit without corrupting the files</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="noneBrowswer" value="c" onClick ="Engine(1, this.value)"/>

                            <label for="noneBrowswer">None of the browsers support JPEG</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="suitable" value="d" onClick ="Engine(1, this.value)"/>

                            <label for="suitable">It is suitable for web designs</label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) Is JPEG the right image format for web design? </span>

                        <br/><br/>

                        <input type="radio" name="q2" id="true1" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="true1">True </label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="false1" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="false1">False </label>

                        <br/><br/>

                        

                        <!-- Question 3 -->

                        <span>3) Is JPEG images compression good when it does approximations?</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="true2" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="true2">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" id="false2" value="b" onClick ="Engine(3, this.value)"/>

                            <label for="false2">False </label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) With low quality image, will download be fast?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="true3" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="true3">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="false3" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="false3">False</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) Which colors are not strongly recommended for website design?</span>

                        <br/><br/>

                        <input type="radio" name="q5" id="q5" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="q5">Gray</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="blackWhite" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="blackWhite">Black and White</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="white" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="white">White</label>

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