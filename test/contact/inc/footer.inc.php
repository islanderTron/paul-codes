    <footer class='copyright'>
        <p>Copyright &copy; <?php echo date('Y') ?> Paul Uncangco </p>
    </footer>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".form").submit(function(event){
                validateForm();
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    data: $(".form").serialize(),
                    url: "contact.php",
                    success:function(data){
                        console.log('success' + data);
                    }
                });
            });
            // $('.form').submit(function (event) {
            //     validateForm();
            //     event.preventDefault();
            //     // $(".form")[0].reset();
            //     // return false;
            // });
            // $.ajax({
            //     type:"POST",
            //     url:"contact.php",
            //     success: function() {
            //         $('#contact :input').attr('disabled', 'disabled');
            //         $('#contact').fadeTo( "slow", 0.15, function() {
            //             $(this).find(':input').attr('disabled', 'disabled');
            //             $(this).find('label').css('cursor','default');
            //             $('#success').fadeIn();
            //         });
            //     }
            // });
        });
    </script>

    <!-- Contact Valdiation -->
    <script type="text/javascript" src="js/contactValidation.js"></script>

    <!-- Animated Scroll -->
    <script type="text/javascript" src="js/animatescroll.js"></script>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

</body>
</html>