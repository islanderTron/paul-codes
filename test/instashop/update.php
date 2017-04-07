<?php

include('connection.php');
include('LIB_project1.php');

$productName = $_POST['Product_Name'];
$productDescription = $_POST['Description'];
$price = $_POST['Price'];
$quantity = $_POST['Quantity'];
$salePrice = $_POST['Sale_Price'];
$oldImage = $_POST['prevPicture'];
$oldProduct = $_POST['oldProduct'];

$imageName= $_FILES['image']['name']; //TODO
echo ' The image is '.$imageName;
$image_temp = $_FILES['image']['tmp_name'];
echo 'Product name is: '.$productName;

//$productName = 'Dodo Square';
//$productDescription = 'Flower on a Bee. Such Beauty!';
//$price = 9;
//$quantity = 8;
//$salePrice = 230;
//$newImage = '038.jpg';
//$oldProduct = 'Times Square';

//working under the assumption that the image already exist in the database
$targetDirectory = 'productImages';
$files = scandir($targetDirectory,1);
//code passed
for($i=0; $i<sizeof($files); $i++)
{
        if($oldImage==$files[$i])
        {
            unlink('productImages/'.$oldImage);
        }
}

$target = "productImages";

//add the image to the directory
$target = $target.'/'.$imageName;
move_uploaded_file($image_temp,$target);  

updateProduct($conn,'product',':productName', ':productDescription', ':price', ':quantity', ':imageName', ':salePrice',                          'Product_Name', 'Description', 'Price', 'Quantity', 'Image_Name', 'Sale_Price', $productName, $productDescription, $price, $quantity,$imageName, $salePrice, $oldProduct, ':oldProduct');
//header('location:admin.php');



?>