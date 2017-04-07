<?php
	$title = "TIFF Quiz";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>

<script type="text/javascript">
	var ans = new Array();
	var userAns = new Array();
	var score = 0;
	
	// Answers to the Questions
	ans[1] = "c";
	ans[2] = "a";
	ans[3] = "b";
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
                    <h2>TIFF Quiz</h2>
                    <form id="quiz" method ="post" action="#">
                        <!-- Question 1 -->
                        <span>1) What does TIFF stand for?</span>
                        <br/><br/>
                        <input type="radio" name="q1" id="q1" value="a" onClick ="Engine(1, this.value)"/>
                        	<label for="q1">Tagged Images For Format </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" value="b" onClick ="Engine(1, this.value)"/>
                            <label for="q1">Tagged Image File Foundations </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" value="c" onClick ="Engine(1, this.value)"/>
                            <label for="q1">Tagged Image File Format </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" value="d" onClick ="Engine(1, this.value)"/>
                            <label for="q1">All of above </label>
                        <br/><br/>
						
						<!-- Question 2 -->
                        <span>2) What is TIFF specified for?</span>
                        <br/><br/>
                        <input type="radio" name="q2" id="q2" value="a" onClick ="Engine(2, this.value)"/>
                        	<label for="q2">Simple image geometry image  </label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" value="b" onClick ="Engine(2, this.value)"/>
                            <label for="q2">Computerized form </label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" value="c" onClick ="Engine(2, this.value)"/>
                            <label for="q2">Program form</label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" value="d" onClick ="Engine(2, this.value)"/>
                            <label for="q2">B and C </label>
                        <br/><br/>
                        
                        <!-- Question 3 -->
                        <span>3) What is one advantage TIFF is good for?</span>
                        <br/><br/>
                        <input type="radio" name="q3" id="q3" value="a" onClick ="Engine(3, this.value)"/>
                        	<label for="q3">Storing small images, medium quality images </label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" value="b" onClick ="Engine(3, this.value)"/>
                            <label for="q3">Storing large, high quality images</label>
                        <br/><br/>
                        
                        <input type="radio" name="q3"  value="c" onClick ="Engine(3, this.value)"/>
                            <label for="q3">A and B </label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" value="d" onClick ="Engine(3, this.value)"/>
                            <label for="q3">None of the above </label>
                        <br/><br/>
                        
                        <!-- Question 4 -->
                        <span>4) Is TIFF faster to download and easy to read? </span>
                        <br/><br/>
                        <input type="radio" name="q4" id="q4" value="a" onClick ="Engine(4, this.value)"/>
                        	<label for="q4">True </label>
                        <br/><br/>
                        
                        <input type="radio" name="q4"  value="b" onClick ="Engine(4, this.value)"/>
                            <label for="q4">False </label>
                        <br/><br/>
                        
                        <!-- Question 5 -->
                        <span>5) What is another advantage TIFF is good for?</span>
                        <br/><br/>
                        <input type="radio" name="q5" id="q5" value="a" onClick ="Engine(5, this.value)"/>
                        	<label for="q5">Graphic applications, image manipulation programs, desktop publishing, and many other applications </label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" value="b" onClick ="Engine(5, this.value)"/>
                            <label for="q5">Image manipulation programs </label>
                        <br/><br/>
                        
                        <input type="radio" name="q5"  value="c" onClick ="Engine(5, this.value)"/>
                            <label for="q5">Graphic applications </label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" value="d" onClick ="Engine(5, this.value)"/>
                            <label for="q5">B and C </label>
                        <br/><br/>
                                                
                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>
					</form>
				</div>  <!-- End of the Conent -->
        	</div>  <!-- End of the Wrapper -->
		</div>
		
<?php
	include ("assets/inc/footer.inc.php");
?>