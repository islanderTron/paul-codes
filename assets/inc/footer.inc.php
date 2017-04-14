    <footer class='copyright'>
        <p>Copyright &copy; <?php echo date('Y') ?> Paul Uncangco </p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
        });
        alert('hello world');
        console.log('update from FTP client!');
        console.log('hello world via GIT!');
        console.log('GRRRR');
        console.log('FTP');
        console.log('lalala');
<<<<<<< HEAD
        alert('hello world');
        
=======
>>>>>>> bd70e65d7c04a749053f0ef716a3e3bee2f16c65
    </script>

    <!-- Contact Valdiation -->
    <script type="text/javascript" src="assets/js/contactValidation.js"></script>

    <!-- Animated Scroll -->
    <script type="text/javascript" src="assets/js/animatescroll.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.fittext.js"></script>
    <script src="assets/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/js/creative.js"></script>

</body>
</html>