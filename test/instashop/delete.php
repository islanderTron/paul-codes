<?php
    ob_start();
    include('LIB_project1.php');
    include('connection.php');

    $refferURL = $_SERVER["HTTP_REFERER"];
    $path= basename($refferURL);
    $productName = $_GET['Product_Name'];


//attempting to delete a product from the cart
if($path=='cart.php')
{
    delete($conn, 'cart', $productName, 'Product_Name', ':product');

}


//attempting to delete from the product cart
else
{
     $result = delete($conn, 'product', $productName, 'Product_Name', ':product');
    
}

?>