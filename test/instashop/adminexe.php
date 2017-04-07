<?php
ob_start();
include('connection.php');
include('LIB_project1.php');

if(isset($_POST['saveChanges']))
{
    //This is the directory where images will be saved
    $target = "productImages";
    //$target = $target . basename($_FILES['image']['name']);
     $imageName= $_FILES['image']['name']; //TODO
    
    $image_temp = $_FILES['image']['tmp_name'];
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $salePrice = $_POST['salePrice'];
    $category="";
    
    //check if the product is already in the database
    $data = select($conn, 'Product_Name', 'product', $name,':product','*');
    
    //put the product under their correct category
    if($salePrice=='0')
    {
        $category = 'catalog';
    }
    else
    {
       $category ='sale';
    }
    
    //the data is not existed int he table
    if(!$data)
    {
         $result = insertProduct($conn, 'product', $name, $description, $price, $quantity, $imageName, $salePrice,
                      ':productName', ':description', ':price', ':quantity', ':imageName', ':salePrice',
                      'Product_Name', 'Description', 'Price', 'Quantity', 'Image_Name','Sale_Price',$category,':category','category');
        
        echo'<br/>';
        
        var_dump($result);
    
        //add the image to the directory
        $target = $target.'/'.$imageName;
        move_uploaded_file($image_temp,$target);  
       header('location:admin.php');
    }
    else{
        echo 'Error!!!'; //TODO
    }
   
}

?>