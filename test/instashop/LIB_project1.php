<?php
	/*
		This is a general function that is use to perform any kind of select from database.
		
			$connection --> the PDO database connection
			$nameExistInTable --> this is the actual name that exist in the table. This is after the Where clause
			$table --> the table to select from
			$data --> the data that you want to search for
			$bindVariable --> this is use in the prepare as :=$bindVariable statement and as :$bindVariable in the bindParam statement.. must be assigned in the form of :foo
			$whatToSelect--> this is like * or a particular column
		
	*/
	function select(PDO $connection, $nameExistInTable, $table, $data,$bindVariable,$whatToSelect)
	{
		
		//prepare statement
        $sql = 'SELECT'.$whatToSelect.' From '.$table.' WHERE '.$nameExistInTable.' = ' .$bindVariable. ' ';
		$smtp = $connection->prepare($sql);
        //echo $bindVariable;
		$smtp->bindParam($bindVariable,$data);
		$smtp->execute();
		$result = $smtp->fetchAll();
		
		return $result;
			
	}//end of function to perform select.

    //functon to insert the data into db
    /*
		This is a function to insert data into registration table
	*/
	
	function insertRegistration(PDO $connection,$table, $email,$password,$type,$status,$bindEmail,$bindPassword,
                                $bindType,$bindStatus,$emailColumn,$passwordColumn,$typeColumn,$statusColumn)
	{
		$result=false;
		
		$sql ='INSERT INTO '.$table.'('.$emailColumn.','.$passwordColumn.','.$typeColumn.','.$statusColumn.')';
		$valuesBind = 'VALUES('.$bindEmail.','.$bindPassword.','.$bindType.','.$bindStatus.')';
        $sql = $sql.$valuesBind;
		
		$smtp = $connection->prepare($sql);
		$smtp ->bindParam($bindEmail,$email);
		$smtp ->bindParam($bindPassword,$password);
		$smtp ->bindParam($bindType,$type);
		$smtp ->bindParam($bindStatus,$status);
		
		if($smtp->execute() )
		{
			$result = true;
		}
		
	    return $result;
			
	}

/*
 * This is a function to insert data into the cart
 * 
 */

function insertCart(PDO $connection, $table, $productName, $productDescription, $price, $quantity, $salePrice, $user, 
                    $bindProductName, $bindProductDescription, $bindPrice, $bindQuantity, $bindSalePrice, $bindUser, $productNameColumn, $productDescriptionColumn, $priceColumn, $quantityColumn, $salePriceColumn, $userColumn)
{
    $result = false;
    
    $sql = 'INSERT INTO '.$table.
            '('.$productNameColumn.','.$productDescriptionColumn.','.$priceColumn.','.$quantityColumn.','.$salePriceColumn.','.$userColumn.')';
    $valuesBind = 'VALUES('.$bindProductName.','.$bindProductDescription.','.$bindPrice.','.$bindQuantity.','.$bindSalePrice.','.$bindUser.')';
    $sql = $sql.$valuesBind;
    
    $smtp = $connection->prepare($sql);
    $smtp -> bindParam($bindProductName, $productName);
    $smtp -> bindParam($bindProductDescription, $productDescription);
    $smtp -> bindParam($bindPrice, $price);
    $smtp -> bindParam($bindQuantity, $quantity);
    $smtp -> bindParam($bindSalePrice, $salePrice);
    $smtp ->bindParam($bindUser, $user);
    
    if($smtp->execute() )
    {
        $result = true;
    }
    
    return $result;
    
}

/*
 * This is a function to perform update on table
 */
function updateCart(PDO $connection,$table,$whatToUpdate,$data,$bindUpdate,$user,$bindUser,$tableColumnToUpdate,$product)
{
    $result = false;
    
    $sql = 'UPDATE '.$table.' SET '.$whatToUpdate.' = '.$bindUpdate.' WHERE '.$tableColumnToUpdate.' = '.$bindUser.' AND Product_Name =:product';
    
    $smtp = $connection->prepare($sql);
    $smtp -> bindParam($bindUpdate,$data);
    $smtp -> bindParam($bindUser,$user);
    $smtp->bindParam(':product',$product);
    
    if($smtp->execute() )
    {
        $result = true;
    }
    
    return $result;
    
}


/*
 * This is a function to insert new/edit product
 * 
 */
function insertProduct(PDO $connection, $table, $productName, $productDescription, $price, $quantity, $imageName, $salePrice,
                      $bindProductName, $bindProductDescription, $bindPrice, $bindQuantity, $bindImageName, $bindSalePrice,
                      $productNameColumn, $productDescriptionColumn, $priceColumn, $quantityColumn, $imageNameColumn, $salePriceColumn,
                       $category,$bindcategory,$categoryColumn)
{
    $result = false;
    
    $sql = 'INSERT INTO '.$table.'('.$productNameColumn.','.$productDescriptionColumn.','.$priceColumn.','.$quantityColumn.','.$imageNameColumn.','.$salePriceColumn.','.$categoryColumn.')';
    $valuesBind = 'VALUES ('.$bindProductName.','.$bindProductDescription.','.$bindPrice.','.$bindQuantity.','.$bindImageName.','.$bindSalePrice.','.$bindcategory.')';
    $sql = $sql.$valuesBind;
    
    $smtp = $connection->prepare($sql);
    $smtp -> bindParam($bindProductName, $productName);
    $smtp -> bindParam($bindProductDescription, $productDescription);
    $smtp -> bindParam($bindPrice, $price);
    $smtp -> bindParam($bindQuantity, $quantity);
    $smtp -> bindParam($bindImageName, $imageName);
    $smtp -> bindParam($bindSalePrice, $salePrice);
    $smtp -> bindParam($bindcategory, $category);
    
    if($smtp->execute() )
    {
        $result = true;
    }
    
    return $result;
    
}

/*
 * This is a generalized function to delete
 * 
 */
function delete(PDO $connection, $table, $whatToDelete, $nameExistInTable, $bind)
{
    $result = false;
    
    $sql = 'DELETE FROM ' . $table . ' WHERE ' . $nameExistInTable . ' = ' . $bind;
    $smtp = $connection->prepare($sql);
    $smtp -> bindParam($bind, $whatToDelete);
    
    if($smtp->execute() )
    {
        $result = true;
    }
    
    return $result;
}

/*
 * This is a function to update Product
 * 
 */
function updateProduct(PDO $connection,$table,$bindProductName, $bindProductDescription, $bindPrice, $bindQuantity, $bindImageName, $bindSalePrice,                        $productNameColumn, $productDescriptionColumn, $priceColumn, $quantityColumn, $imageNameColumn, $salePriceColumn,                                    $productName, $productDescription, $price, $quantity, $imageName, $salePrice, $oldProduct, $bindOldProduct)
{
    $result = false;
    
    $sql = 'UPDATE ' . $table . ' SET ' . $productNameColumn . ' = ' . $bindProductName . ',' . $productDescriptionColumn . ' = ' .                            $bindProductDescription . ',' . $priceColumn . ' = ' . $bindPrice . ',' . $quantityColumn . ' = ' . 
           $bindQuantity . ',' . $salePriceColumn . ' = ' . $bindSalePrice . ',' . $imageNameColumn . ' = ' . $bindImageName . ' WHERE ' .                      $productNameColumn . ' = ' . $bindOldProduct;
    
    $smtp = $connection->prepare($sql);
    $smtp -> bindParam($bindProductName, $productName);
    $smtp -> bindParam($bindProductDescription, $productDescription);
    $smtp -> bindParam($bindPrice, $price);
    $smtp -> bindParam($bindQuantity, $quantity);
    $smtp -> bindParam($bindImageName, $imageName);
    $smtp -> bindParam($bindSalePrice, $salePrice);
    $smtp -> bindParam($bindOldProduct, $oldProduct);
    
    if($smtp->execute() )
    {
        $result = true;
    }
    
    return $result;
}

   
   /*******************************************************
   * FUNCTION TO CREATE UNIQUE ACTIVATION CODES
   * Credit to Kemoy Campbell for this code.
   ********************************************************/
   function createRandomActivationCode()
   {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabdefghijklmnopqrstuvwxyz@#$&!,.?~-_*0123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$uniqueCode = '' ;
		while ($i <= 30) 
		{

        $num = rand() % 40;

        $tmp = substr($chars, $num, 1);

        $uniqueCode = $uniqueCode . $tmp;

        $i++;

		}
    return $uniqueCode;
   }//end of function
   
   
?>