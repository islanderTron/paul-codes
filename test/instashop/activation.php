<?php 
    include('header.php');
	include('LIB_project1.php');
	include('connection.php');
	
	$code = createRandomActivationCode();
?>






<div class="container wrapper">
    <div class="row">
         <div class="panel panel-default">
          <div class="panel-heading">Activation Code</div>
          <div class="panel-body">
            <p>Please enter the activation code given to you below:</p>
            <input class="form-control" type="text" name="activationCode" placeholder="Activation Code"><br/>
            <button class="btn btn-primary" type="submit">Activate</button>
          </div>
        </div>
    </div>
    <div class="push"></div>
</div>

<?php 
    include('footer.php');
?>