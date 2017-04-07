<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	
	<!-- https://gist.github.com/ajtroxell/6731408 -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>

</head>
<body>

  <form class="contact" id="contact" method='POST'>
      <p class="name">
        <input name="name" type="text" class="validate feedback-input" placeholder="Name" id="name" />
      </p>

      <p class="email">
        <input name="email" type="text" class="validate[required,custom[email]] feedback-input" id="email" placeholder="Email" />
      </p>

      <p class="text">
        <textarea name="text" class="validate[required,length[6,300]] feedback-input" id="comment" placeholder="Message"></textarea>
      </p>

      <div class="submit">
        <input type="submit" value="Submit" id="button-blue" name="submit" />
        <div class="ease"></div>
      </div>
  </form>

  <script type="text/javascript" src="function.answercheck.js"></script>
  <script type="text/javascript" src="validate.js"></script>
</body>
</html>