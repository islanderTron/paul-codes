<?php
	$title="PNG Quiz";
	include ("assets/inc/header.inc.php");
	// include ("assets/inc/navigation.inc.php");
?>

<script type="text/javascript">
	var ans = new Array();
	var userAns = new Array();
	var score = 0;
	
	// Answers to the Questions
	ans[1] = "b";
	ans[2] = "c";
	ans[3] = "a";
	ans[4] = "a";
	ans[5] = "c";
	
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
                    <h2>PNG Quiz</h2>
                    <form id="quiz" method ="post" action="#">
                        <!-- Question 1 -->
                        <span>1) PNG is a format that is a _______ bitmap. </span>
                        <br/><br/>
                        <input type="radio" name="q1" id="lossy" value="a" onClick ="Engine(1, this.value)"/>
                        	<label for="lossy">Lossy </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="lossless" value="b" onClick ="Engine(1, this.value)"/>
                            <label for="lossless">Lossless </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="popular" value="c" onClick ="Engine(1, this.value)"/>
                            <label for="popular">Popular </label>
                        <br/><br/>
                        
                        <input type="radio" name="q1" id="pixels" value="d" onClick ="Engine(1, this.value)"/>
                            <label for="pixels">Pixels </label>
                        <br/><br/>
						
						<!-- Question 2 -->
                        <span>2) What are the three different styles PNG have?</span>
                        <br/><br/>
                        <input type="radio" name="q2" id="oneGrayscale" value="a" onClick ="Engine(2, this.value)"/>
                        	<label for="oneGrayscale">One is grayscale color images and two are white color images </label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" id="pinkRed" value="b" onClick ="Engine(2, this.value)"/>
                            <label for="pinkRed">Two are pink and red color images and one is black color images</label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" id="colorImage" value="c" onClick ="Engine(2, this.value)"/>
                            <label for="colorImage">One of it is for indexed color images and the other two are for grayscale or true color images </label>
                        <br/><br/>
                        
                        <input type="radio" name="q2" id="colorTwoGrayscale" value="d" onClick ="Engine(2, this.value)"/>
                            <label for="colorTwoGrayscale">One of it is for various color images and the other two are for grayscale or true color images </label>
                        <br/><br/>
                        
                        <!-- Question 3 -->
                        <span>3) Why was PNG developed?</span>
                        <br/><br/>
                        <input type="radio" name="q3" id="gifQ" value="a" onClick ="Engine(3, this.value)"/>
                        	<label for="gifQ">To handle some of the GIF format shortcomings and allow storage of greater color depth images along with other important images </label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" id="downloadFaster" value="b" onClick ="Engine(3, this.value)"/>
                            <label for="downloadFaster">To download faster </label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" id="avoidStorage" value="c" onClick ="Engine(3, this.value)"/>
                            <label for="avoidStorage">To avoid storage from overloading </label>
                        <br/><br/>
                        
                        <input type="radio" name="q3" id="optionStore" value="d" onClick ="Engine(3, this.value)"/>
                            <label for="optionStore">Allows the option of storing colors </label>
                        <br/><br/>
                        
                        <!-- Question 4 -->
                        <span>4) By which developer(s) initiated the PNG format?</span>
                        <br/><br/>
                        <input type="radio" name="q4" id="jacobZAbra" value="a" onClick ="Engine(4, this.value)"/>
                        	<label for="jacobZAbra">Jacob Ziv and Abraham Lempel </label>
                        <br/><br/>
                        
                        <input type="radio" name="q4" id="billGateAlbert" value="b" onClick ="Engine(4, this.value)"/>
                            <label for="billGateAlbert">Bill Gates and Albert Einstein </label>
                        <br/><br/>
                        
                        <input type="radio" name="q4" id="robertSw" value="c" onClick ="Engine(4, this.value)"/>
                            <label for="robertSw">Robert Swirsky </label>
                        <br/><br/>
                        
                        <input type="radio" name="q4" id="sWil" value="d" onClick ="Engine(4, this.value)"/>
                            <label for="sWil">Steven Wilhite </label>
                        <br/><br/>
                        
                        <!-- Question 5 -->
                        <span>5) Which browsers supports PNG?</span>
                        <br/><br/>
                        <input type="radio" name="q5" id="chrome" value="a" onClick ="Engine(5, this.value)"/>
                        	<label for="chrome">Chrome</label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" id="ie" value="b" onClick ="Engine(5, this.value)"/>
                            <label for="ie">Internet Explorer</label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" id="all" value="c" onClick ="Engine(5, this.value)"/>
                            <label for="all">Opera, Safari, Chrome, Internet Explorer, Firefox</label>
                        <br/><br/>
                        
                        <input type="radio" name="q5" id="none" value="d" onClick ="Engine(5, this.value)"/>
                            <label for="none">None of above</label>
                        <br/><br/>
                                                
                    	<input type="submit" id="submit" value="Get Results" onclick="getScore();"/>
					</form>
				</div>  <!-- End of the Conent -->
        	</div>  <!-- End of the Wrapper -->
		</div>
		
<?php
	include ("assets/inc/footer.inc.php");
?>