<?php

    $title = "EPS Quiz";

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

	ans[3] = "b";

	ans[4] = "c";

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

                    <h2>EPS Quiz</h2>

                    <form id="quiz" method ="post" action="#">

                        <!-- Question 1 -->

                        <span>1) Which language is EPS using?</span>

                        <br/><br/>

                        <input type="radio" name="q1" id="prescript" value="a" onClick ="Engine(1, this.value)"/>

                        	<label for="prescript">PreScript</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="java" value="b" onClick ="Engine(1, this.value)"/>

                            <label for="java">Java</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" id="q1" value="c" onClick ="Engine(1, this.value)"/>

                            <label for="q1">C</label>

                        <br/><br/>

                        

                        <input type="radio" name="q1" value="d" onClick ="Engine(1, this.value)"/>

                            <label for="q1">PostScript</label>

                        <br/><br/>

						

						<!-- Question 2 -->

                        <span>2) Adobe Illustrator is only program that can use EPS format.</span>

                        <br/><br/>

                        <input type="radio" name="q2" id="true1" value="a" onClick ="Engine(2, this.value)"/>

                        	<label for="true1">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q2" id="false1" value="b" onClick ="Engine(2, this.value)"/>

                            <label for="false1">False</label>

                        <br/><br/>

                        

                        <!-- Question 3 -->

                        <span>3) EPS is developed by Apple.</span>

                        <br/><br/>

                        <input type="radio" name="q3" id="true2" value="a" onClick ="Engine(3, this.value)"/>

                        	<label for="true2">True</label>

                        <br/><br/>

                        

                        <input type="radio" name="q3" id="false2" value="b" onClick ="Engine(3, this.value)"/>

                            <label for="false2">False</label>

                        <br/><br/>

                        

                        <!-- Question 4 -->

                        <span>4) Which format is belong to for EPS?</span>

                        <br/><br/>

                        <input type="radio" name="q4" id="raster" value="a" onClick ="Engine(4, this.value)"/>

                        	<label for="raster">Raster</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="js" value="b" onClick ="Engine(4, this.value)"/>

                            <label for="js">JavaScript</label>

                        <br/><br/>



                        <input type="radio" name="q4" id="q4" value="c" onClick ="Engine(4, this.value)"/>

                            <label for="q4">Vector</label>

                        <br/><br/>

                        

                        <input type="radio" name="q4" id="none" value="d" onClick ="Engine(4, this.value)"/>

                            <label for="none">None</label>

                        <br/><br/>

                        

                        <!-- Question 5 -->

                        <span>5) What is EPS?</span>

                        <br/><br/>

                        <input type="radio" name="q5" id="ePostScript" value="a" onClick ="Engine(5, this.value)"/>

                        	<label for="ePostScript">Encapsulated PostScript</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="enhancedPS" value="b" onClick ="Engine(5, this.value)"/>

                            <label for="enhancedPS">Enhanced PostScript</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="ePreScript" value="c" onClick ="Engine(5, this.value)"/>

                            <label for="ePreScript">Enhanced PreScript,</label>

                        <br/><br/>

                        

                        <input type="radio" name="q5" id="encapsulatedPreS" value="d" onClick ="Engine(5, this.value)"/>

                            <label for="encapsulatedPreS">Encapsulated PreScript</label>

                        <br/><br/>

                                                

                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>

					</form>

				</div>  <!-- End of the Conent -->

        	</div>  <!-- End of the Wrapper -->

		</div>

		

<?php

	include ("assets/inc/footer.inc.php");

?>