<?php
    header("Expires: on, 01 Jan 1970 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    include('header.php');
?>

<!-- Source: http://bootsnipp.com/snippets/featured/responsive-shopping-cart -->

<style type="text/css">

.table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px){
    table#cart tbody td .form-control{
		width:20%;
		display: inline !important;
	}
	.actions .btn{
		width:36%;
		margin:1.5em 0;
	}
	
	.actions .btn-info{
		float:left;
	}
	.actions .btn-danger{
		float:right;
	}
	
	table#cart thead { display: none; }
	table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
	table#cart tbody tr td:first-child { background: #333; color: #fff; }
	table#cart tbody td:before {
		content: attr(data-th); font-weight: bold;
		display: inline-block; width: 8rem;
	}
	
	table#cart tfoot td{display:block; }
	table#cart tfoot td .btn{display:block;}
    
}
</style>

<div class="container wrapper reload">
	<table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <!--create a php loop here-->
            <?php
               // $user = $_SESSION['user'];
                $user = $_SESSION['user'];
                $data = select($conn, 'user', 'cart', $user,':username','*'); 
                $total = 0;

                // if no data in cart
                if(!$data)
                {
                    echo 'You don\'t have any products in your cart.';
                }
                else //put data in cart
                {
                    
                    
                    foreach($data as $row)
                    {
                        $subTotal = 0;
                        //assign everything to a variable
                        $product = $row['Product_Name'];
                        $description = $row['Description'];
                        $price = $row['Price'];
                        $quantity = $row['Quantity'];
                        $salePrice = $row['Sale_Price'];
                        $subTotal = $quantity * $price;
                        $total+=$subTotal;
                        
                        echo '<tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <h4 class="nomargin">'.$product.'</h4>
                                            <p>'.$description.'</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">'.$price.'</td>
                                <td data-th="Quantity" class="text-center">'.$quantity.'</td>
                                <td data-th="Subtotal" class="text-center">'.$subTotal.'</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm pull-right deleteButton" product="'.$product.'"><i class="fa fa-trash-o"></i></button>								
                                </td>
                             </tr>';
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total 1.99</strong></td>
            </tr>
            <tr class="check">
                <td><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong><?php echo "Total:$ ".$total; ?></strong></td>
                <td><button type="button" class="checkout btn btn-success btn-block" data-toggle="modal" data-target=".thank-you-modal">Checkout</button></td>
            </tr>
        </tfoot>
    </table>
    <div class="push"></div><!--push footer to bottom-->
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>-->

<div class="modal fade thank-you-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="padding:10px;">
      Thank you for shopping with InstaShop!<br/>Redirecting you to the home page in <span id="spnSeconds" style="color:#3f729b;font-weight:bold;"></span> seconds...
    </div>
  </div>
</div>

<!-- Redirects to the homepage after checkout -->
<script type="text/javascript">
    var count = 10;
    $('.checkout').click( function(){
    var countdown = setInterval(function(){
    $("#spnSeconds").html(count);
    if (count == 0) {
      clearInterval(countdown);
      window.open('index.php', "_self");
    }
    count--;
  }, 1000);
    });
</script>

<!--delete/concatenate product string if more than white spaces-->
<script>
        $('.deleteButton').click(function(){
            var product = "";
            var url = "delete.php?";
            product = $(this).attr("product");
            if(product.match(/\s/g))
            {
                var arr = product.split(' ');
                var temp = "";
                for(var i=0; i<arr.length; i++)
                {
                    temp = temp + (arr[i] + '+');
                    //alert(arr[i]);
                }
                
                //remove the '+' at the end of the string
                product = temp.substring(0,temp.length-1);
                
               
               // product = arr[0] + '+' + arr[1];
            }
            url = url + 'Product_Name=' + product + ' ';
            $.get(url,function(data)
                        $('.reload').load("cart.php .reload");
                       
            });
            
        });
    
    
</script>
<?php
    include('footer.php')
?>