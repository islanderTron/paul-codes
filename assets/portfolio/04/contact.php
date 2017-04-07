<?php
    $title="About";
    $db = true;

    include("asset/inc/header.inc.php");
    include("asset/inc/page_start.php");
    include("asset/inc/commentValidation.php");

    function sanitize($link, $data){
        $data = trim($data);
        $data = htmlentities($data);

        $data = mysqli_real_escape_string($link, $data);
        return $data;
    }

    // Form processing
    if (!empty( $_POST ) ) {
        $first   = sanitize($link, $_POST['first']);
        $message = sanitize($link, $_POST['message']);

        // INSERT INTO (TABLE) SET (VARIABLE)
        $query = "INSERT INTO comment_page
                    SET first = '$first',
                        message = '$message'";
        $result = mysqli_query($link, $query);

        $num_rows = mysqli_affected_rows($link);
        if ( $result && $num_rows > 0 ) {
          $msg = "Thank you and have a nice day!";
        }
    }
?>
<script type="text/javascript">
	document.getElementById("About").style.backgroundColor="#95dce2";
</script>

<script type="text/javascript" src="asset/JS/form.js"></script>

    <div id="content"> 
        <img src="asset/Media/Pictures/mainActivitiesPicture.jpg" alt="Guam Map">
        <h1> Contact</h1>
		<form id="contact"
			method="post"
			action="contact.php"
			onSubmit="return formValidate();">
            <?php
                if(count( $errors) > 0){
                    echo "<div style='color:red;'><strong>Please follow the list below: </strong></div>";
                    // echo "<div style='color:red;'>";
                    foreach($errors as $error){
                        echo $error."<br/>";
                    }
                    // echo "</div>";
                }
            ?>
            <div id="error-msg"></div>

            <!--First Name REQUIRED-->
            <span id="first" name="name">Name:</span>
            <input type="text" id="firstName" name="first"
            maxlength="20" size="20"
            placeholder="Type Your Name"/>
            <br/>

            <span id="msg" name="msg">Message:</span>
            <textarea row="10" id="message" cols="30" name="message"
            placeholder="Type here"></textarea>
            <br/><br/>

            <input type="submit" value="Submit"/>
            <input type="reset" value="Reset"/>
		</form>
    <h2>Comment:</h2>
    <?php
      // GET THE COUNTRIES FROM THE DATABASE
    
      // Build the query string
      $query = "SELECT *
                FROM comment_page
                ORDER BY id DESC";
      
      // Send the query to the database
      $result = mysqli_query( $link, $query );
      
      // Figure out how many rows we got
      $num_rows = mysqli_affected_rows( $link );
      
      if ( $result && $num_rows > 0 ) {
        
        // Iterate through the rows
        while ( $row = mysqli_fetch_assoc( $result ) ) {
          echo   "<strong>".$row[first] . "</strong>: " .
                 "<em>" . $row[message] . "</em><br/>";
        }
      }
    ?>
    </div>  <!-- End Content -->
<?php
	include("asset/inc/footer.inc.php");
?>