<?php
    
    include('connection.php');
    include('LIB_project1.php');

    $data = select($conn, 'category', 'product', 'catalog',':catalog','*');

    if(!$data)
    {
       echo 'No data to display.';
    }
    else
    {
        foreach($data as $row)
        {
            //assign all the variables
            $image = $row['Image_Name'];
            $product = $row['Product_Name'];
            $description = $row['Description'];
            $price = $row['Price'];
            $quantity = $row['Quantity'];
            $salePrice = $row['Sale_Price'];
            

            
            echo "<div class='row' id='row'>
    <form class='form' method='post'>
        <div class='col-sm-4 col-lg-4 col-md-4'>
            <div class='thumbnail'>
               <img src='productImages/$image'/>
                 <div class='caption'>
                    <h4 class='pull-right'><?php $price ?></h4>
                    <input type='hidden' name='price' value='$price'/><h4 class='pull-right'>$$price</h4>
                    <h4 title='Item'>$product</h4>
                    <input type='hidden' name='productName' value=' $product'/>
                    <p>$description</p>
                    <input type='hidden' name='description' value='$description'/>
                </div>
                <div class='userOptions text-center'>
                    <!-- Cart Button -->
                    <button type='submit' name='addItemToCart' class='btn btn-primary' id='cartButton'><i class='fa fa-shopping-cart'></i>&nbsp;&nbsp;Add to Cart</button>
                </div>
            </div>
        </div>
    </form>
</div>";
        }
    }

?>