<?php
    include("asset/inc/commentValidation.php");
?>
<script type="text/javascript" src="asset/JS/form.js"></script>
    <div id="content"> 
        <img src="asset/Media/Pictures/mainActivitiesPicture.jpg" alt="Guam Map">
        <h1> Contact</h1>
        <form id="contact"
            method="post"
            action="testingphp.php"
            onSubmit="">

            <!---PHP Validation: Print error message here-->
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
    </div>