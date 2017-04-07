<?php

	$title="About";

	$db = true;

	include ("assets/inc/header.inc.php");

	// include ("assets/inc/navigation.inc.php");

	include ("db_start.php");

	include("validation.php");

	

	function sanitize($link, $data) {

    $data = trim($data);

    $data = htmlentities($data);

    

    $data = mysqli_real_escape_string($link, $data);

    return $data;

  }



	// Form processing

	if (!empty( $_POST ) ) {

		$name = sanitize($link, $_POST['firstname']);

		$email = sanitize($link, $_POST['email']);

		$feedback = sanitize($link, $_POST['feedback']);



		// INSERT INTO (TABLE) SET (VARIABLE) .....

		$query = "INSERT INTO feedback

					SET Name = '" . $name . "',

					Email = '" . $email . "',

					Feedback = '" . $feedback . "'";



		$result = mysqli_query($link, $query);



		$num_rows = mysqli_affected_rows($link);



		if ($result && $num_rows > 0) {

			$msg = "Thank you for giving feedback!" ;

		}

	} // End of the !EMPTY($_POST)

?>

		<div id="rightColumn">

	        <div id="wrapper">

	            <div id="content">

	                <div id="contact-form">

	                    <!-- Insert contents here -->

	                     <p>ImaginationZ Team would like to know your feedback on our website.

	                     	Your feedback is greatly apprecipated because they will help us to improve

	                     	our website.

	                     	

	                     	Below is you fill out the feedback form and we will e-mail you if you have any

	                     	questions or concerns!

	                     	

	                 		We will reply to your e-mail within two business days.</p>

	                

 		 				

	                     <form id="contactform" method="post" action="contact.php">

	                        <span>First Name: </span>

	                        <input type="text" name="firstname" placeholder="Type First Name"/>

	                        <br/>

	

	                        <span>Last Name: </span>

	                        <input type="text" name="lastname" placeholder="Type Last Name"/>

	                        <br/>

	

	                        <span>Email:  </span>

	                        <input type="text" name="email" placeholder="Type E-mail"/>

	                        <br/>



	                        <div style="padding-left: 155px">

	                            <textarea rows="10" cols="30" name="feedback" placeholder="Message here"></textarea>

	                        </div>

							<span></span>

	                        <input type="submit" value="Submit">

	                        <input type="reset" value= "Reset">

	                    </form>

	                </div>



	            	<h2>Feedback:</h2>

	            	

<?php

	// GET THE FEEDBACK FROM THE DATABASE

	  

	  // Build the query string

	  $query = "SELECT *

				FROM feedback";

	            

	  // Send the query to the database

	  $result = mysqli_query($link, $query);

	  

	  // Figure out how many rows we got

	  $num_rows = mysqli_affected_rows($link);

	  

	 // echo "affected row:  $num_rows";

	  

	  if ($result && $num_rows > 0) {

	    

	    // Interate through the rows

	while ($row = mysqli_fetch_assoc($result)) {

	  echo "<strong>" . $row [ Name ] . "</strong>:  " .

	  		"<em>" . $row [ Feedback ] . "</em><br/>";

	    }

	  }

?>



	             </div>

	        </div>  <!-- End of the Wrapper -->

       </div>

<?php

    include("assets/inc/footer.inc.php");

?>