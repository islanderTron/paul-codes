<?php 
    include('header.php'); // adds the header to the page


    //echo 'The session is: '. $_SESSION['user'];
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Welcome to InstaShop!</p>
                <div class="list-group">
                    <a href="#" id="catalogclass" class="list-group-item active catalog">Catalog<!--<span class="badge">15</span>--></a>
                    <a href="#" id="saleclass" class="list-group-item sale">Sales<!--<span class="badge">5</span>--></a>
                </div>
            </div>

            <div class="col-md-9 load" id="load">
                
            </div>

        </div>

    </div>
    <!-- /.container -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() 
    {
       // alert('yo');
       $('.load').load('catalog.php');
       $("#load").on("submit",function(e)
       {
           e.preventDefault();
           $.ajax({
                type:"POST",
                url:'cartexe.php', //I will put project id here as well
                data:$(".form input").serialize()+"&addItemToCart=",
                success:function(smsg)
                {
                   //update the number of items the user has in their shopping cart
                    $.get('header.php',function(data){
                        $('.cart').load('header.php .cart');
                        //alert('success');
                    });
                }
            });
           
           
       });
        
        //add catalog listener
        $('.catalog').click(function()
        {
            $('#saleclass').removeClass('active');
            $('#catalogclass').addClass('active');
            $('.load').load('catalog.php');
        });
        //add sale listener
        $('.sale').click(function()
        {
            $('#catalogclass').removeClass('active');
            $('#saleclass').addClass('active');
            $('.load').load('sale.php');
        });
    
    });
</script>

<?php 
    include('footer.php'); // adds the footer to the page
?>