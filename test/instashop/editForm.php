<?php
    include('LIB_project1.php');
    include('connection.php');

    $product = $_GET['Product_Name'];//TODO
    //echo $product;
    $image = "";
       
        $description = "";
        $quantity = "";
        $salePrice ="" ;
     echo $product;
    $data = select($conn, 'Product_Name', 'product', $product,':product','*');
    if(!$data)
    {
        echo ' no data';
    }
    
    foreach($data as $row)
    {
        $image = $row['Image_Name'];
        $product = $row['Product_Name'];
        $description = $row['Description'];
        $price = $row['Price'];
        $quantity = $row['Quantity'];
        $salePrice = $row['Sale_Price'];
        
        echo 'Description is: '.$description;
        
    }
?>

<div class="modal-content editDisplay">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="editModalLabel">Edit Item</h4>
  </div>
  <form class="editForm" id="editForm" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="Product_Name" placeholder="Name" value="<?php echo $product ?>">
                <input type="hidden" class="form-control" id="inputName" name="oldProduct" value="<?php echo $product ?>">
    
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea class="form-control" id="inputDescription" name="Description" placeholder="Description"><?php echo $description ?></textarea>
            </div>
            <div class="form-group">
                <label for="inputPrice">Price</label>
                <input type="text" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $price ?>">
            </div>
            <div class="form-group">
                <label for="inputQuantity">Quantity</label>
                <input type="number" class="form-control" id="inputQuantity" name="Quantity" placeholder="Quantity" value="<?php echo $quantity ?>">
            </div>
            <div class="form-group">
                <label for="inputSalePrice">Sale Price</label>
                <input type="text" class="form-control" id="inputSalePrice" name="Sale_Price" placeholder="Sale Price" value="<?php echo $salePrice ?>">
            </div>
            <div class="form-group">
                <label for="inputImage">Image Upload</label><br>
                <fieldset class="file-fieldset">
                    <span class="btn btn-default btn-file">
                        <span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Browse Browse <input name="image" type="file" id="inputImage"/><br>
                    </span>
                    <input type="hidden" name="prevPicture" id="inputImage" value="<?php $image ?>"/>
                    <span style="margin-left:8px;" value=""><?php echo $image ?></span>
                    
                </fieldset>
            </div>
      </div>
      <div class="modal-footer ">
        <button type="submit" class="btn btn-primary saveButton" id="saveButton" name="update">Save Changes</button>
      </div>
 </form>
</div>