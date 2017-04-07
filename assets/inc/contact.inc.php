<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading portfolio-box header-color">//Contact</h2>
                <p class="p-animate">Thank you for visiting my website. If you would like to contact me, please fill out the form below:</p>
                <p class="p-animate">Email(primary): <a href="mailto:pju93@hotmail.com">pju93@hotmail.com</a></p>
                <p class="p-animate">Phone: <span>512-377-1648</span></p>
            </div>
        </div>
    </div>
    <div class="container portfolio-box">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
              <div id="form-main">
                <div id="form-div">
                  <form class="form" id="form1" method='POST'>
                    <div id="error-msg" name="error-msg"></div>
                    <?php
                        if(count($errors) > 0 ){
                            echo "<b>Please follow the list below:</b>";
                            echo "<div style='color:red'>";
                            foreach ($errors as $error) {
                                echo $error."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <p class="name">
                      <input name="name" type="text" class="validate feedback-input" placeholder="Name" id="name" value="<?php echo $_POST["name"] ?>"/>
                    </p>
                    <p class="email">
                      <input name="email" type="text" class="validate[required,custom[email]] feedback-input" id="email" placeholder="Email" value="<?php echo $_POST["email"] ?>"/>
                    </p>
                    <p class="text">
                      <textarea name="text" class="validate[required,length[6,300]] feedback-input" id="comment" placeholder="Message" value="<?php echo $_POST["text"] ?>"></textarea>
                    </p>
                    <div class="submit">
                      <input type="submit" value="Submit" id="button-blue" />
                      <div class="ease"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>