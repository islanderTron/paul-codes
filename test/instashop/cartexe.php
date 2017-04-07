<?php
ob_start();
session_start();
$user = $_SESSION['user'];
include('connection.php');
include('LIB_project1.php');
    
# cartexe.php will perform all actions on cart.php

// add Item to Cart
if(isset($_POST['addItemToCart']))
{
    // initialize index.php variables
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = 0;
    $salePrice = 0;//TODO for now 
    
    //query
    $data = select($conn, 'user', 'cart', $user,':username','*');
    
    //the user has never added any items to the cart before.
    if(!$data)
    {
        $quantity = 1;
        insertCart($conn, 'cart', $productName, $description, $price, $quantity, $salePrice, $user, 
                    ':product', ':description', ':price', ':quantity', ':saleprice', 
                   ':user', 'Product_Name', 'Description', 'Price', 'Quantity', 
                   'Sale_Price', 'user');
    }
    //there is an information in the database regard this user
    else
    {
         $flag = false;
        
        //loop through and see if the user has add this product before
         foreach($data as $row)
        {
            //the user has previous order this product
             if($row['Product_Name']==$productName)
             {
                 //new quantity
                 $quantity = $row['Quantity'] + 1;
                 //update the product quantity
                 $result = updateCart($conn,'cart','Quantity',$quantity,':quantity',$user,':user','user',$productName);
                 $flag = true;
             }
        }
        
        //the user does exist in the cart database but is ordering a new product 
        if(!$flag)
        {
            echo ' THis is not executed';
            $quantity = 1;
            insertCart($conn, 'cart', $productName, $description, $price, $quantity, $salePrice, $user, 
                    ':product', ':description', ':price', ':quantity', ':saleprice', 
                   ':user', 'Product_Name', 'Description', 'Price', 'Quantity', 
                   'Sale_Price', 'user');       
        }
        
    }
   
   
       
}











    

//  
?>