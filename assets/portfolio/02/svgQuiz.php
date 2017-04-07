<?php
	$title="SVG Quiz";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>

<script type="text/javascript">
	var ans = new Array();
	var userAns = new Array();
	var score = 0;
	
	// Answers to the Questions
	ans[1] = "d";
	ans[2] = "a";
	ans[3] = "b";
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
                    <h2>SVG Quiz</h2>
                    <form id="quiz" method ="post" action="#">
                        <!-- Question 1 -->
                        <span>1) What language is SVG using?</span>
                        <br/><br/>
                        <input type="radio" name="q1" id="c" value="a" onClick ="Engine(1, this.value)"/>
                        	<label for="c">C</label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="java" value="b" onClick ="Engine(1, this.value)"/>
                            <label for="java">Java</label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="php" value="c" onClick ="Engine(1, this.value)"/>
                            <label for="php">PHP</label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="xml" value="d" onClick ="Engine(1, this.value)"/>
                            <label for="xml">XML</label>
                        <br/><br/>
						
						<!-- Question 2 -->
                        <span>2) Can SVG be created on any text editor?</span>
                        <br/><br/>
                        <input type="radio" name="q2" id="true" value="a" onClick ="Engine(2, this.value)"/>
                        	<label for="true">True </label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" id="false" value="b" onClick ="Engine(2, this.value)"/>
                            <label for="false">False </label>
                        <br/><br/>
                        
                        <!-- Question 3 -->
                        <span>3) SVG is the Raster format.</span>
                        <br/><br/>
                        <input type="radio" name="q3" id="true2" value="a" onClick ="Engine(3, this.value)"/>
                        	<label for="true2">True</label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" id="false2" value="b" onClick ="Engine(3, this.value)"/>
                            <label for="false2">False</label>
                        <br/><br/>
                        
                        <!-- Question 4 -->
                        <span>4) SVG stands for _________.</span>
                        <br/><br/>
                        <input type="radio" name="q4" id="superVG" value="a" onClick ="Engine(4, this.value)"/>
                        	<label for="superVG">Super Vector Graphics</label>
                        <br/><br/>
                        
                        <input type="radio" name="q4" id="scalableVG" value="b" onClick ="Engine(4, this.value)"/>
                            <label for="scalableVG">Scalable Vector Graphics</label>
                        <br/><br/>
                        
                        <input type="radio" name="q4" id="scannableVG" value="c" onClick ="Engine(4, this.value)"/>
                            <label for="scannableVG">Scannable Vector Graphics</label>
                        <br/><br/>
                        
                        <!-- Question 5 -->
                        <span>5) SVG can be animated.</span>
                        <br/><br/>
                        <input type="radio" name="q5" id="true3" value="a" onClick ="Engine(5, this.value)"/>
                        	<label for="true3">True</label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" id="false3" value="b" onClick ="Engine(5, this.value)"/>
                            <label for="false3">False </label>
                        <br/><br/>
                                                
                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>
					</form>
				</div>  <!-- End of the Conent -->
        	</div>  <!-- End of the Wrapper -->
		</div>

<?php
	include ("assets/inc/footer.inc.php");
?>