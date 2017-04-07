<?php
    ob_start();
    session_start();
    include('LIB_project1.php');
    include('connection.php');
    
$user = $_SESSION['user'];
    
$data = select($conn, 'user', 'cart', $user,':user','*');

foreach($data as $row)
{
    $productName = $row['Product_Name'];
    
    delete($conn, 'cart', $productName, 'Product_Name', ':product');
}

echo' Thank you for shopping with us we appreciate you all';

?>