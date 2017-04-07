<?php 
    include('header.php');
    include('connection.php');
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="page-header">
                <h1>Administrative Inventory Panel</h1>
                <!-- Add Button trigger modal -->
                <button class="btn btn-success" type="button" id="addButton" data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Item</button>
                <!-- Add Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="addModalLabel">Add Item</h4>
                      </div>
                      <form action="adminexe.php" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea class="form-control" id="inputDescription" placeholder="Description" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputPrice">Price</label>
                                    <input type="text" class="form-control" id="inputPrice" placeholder="Price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="inputQuantity">Quantity</label>
                                    <input type="number" class="form-control" id="inputQuantity" placeholder="Quantity" name="quantity">
                                </div>
                                <div class="form-group">
                                    <label for="inputSalePrice">Sale Price</label>
                                    <input type="text" class="form-control" id="inputSalePrice" placeholder="Sale Price" name="salePrice">
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Image Upload</label><br/>
                                    <fieldset class="file-fieldset">
                                        <span class="btn btn-default btn-file">
                                            <span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Browse <input name="image" type="file" id="inputImage"/><br/>
                                        </span>
                                        <span style="margin-left:8px;">No file chosen</span>
                                    </fieldset>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary" id="saveButton" name="saveChanges">Save Changes</button>
                          </div>
                     </form>
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.end Add Modal -->
            <?php
                $query = $conn->prepare('SELECT * FROM product');
                $query->execute();
                $data = $query;

                if(!$data)
                {
                    echo'No data in table';
                }
                else
                {
                    echo '<div id="thumbnail-container" class="col-sm-4 col-lg-12 col-md-4">
                <div class="row" id="refresh">';
                    foreach($data as $row)
                    {
                        $image = $row['Image_Name'];
                        $product = $row['Product_Name'];
                        $description = $row['Description'];
                        $price = $row['Price'];
                        $quantity = $row['Quantity'];
                        $salePrice = $row['Sale_Price'];
                        
                        //echo $row['Product_Name'];
//                        echo "<img src='productImages/$image' width='150' height='150'/>";
//                        echo'<br/>';
                        echo '<div class="col-sm-4 col-lg-3 col-md-4">
                        <div class="thumbnail">';
                            echo "<img src='productImages/$image'/>";
                        echo'
                            <div class="caption">
                                <h4 class="pull-right"product="'.$product.'" price="'.$price.'">$'.$price.'</h4>
                                <h4><a href="#"product="'.$product.'" product="'.$product.'" >'.$product.'</a>
                                </h4>
                                <p>'.$description.'</p>
                            </div>
                            <div class="adminOptions">
                                <!-- Edit Button trigger modal -->
                                <button class="btn btn-primary editButton" type="button" id="editButton"product="'.$product.'" data-toggle="modal" data-target="#editModal"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</button>
                                <!-- Edit Modal -->
                               
                                <!-- Delete Button trigger modal -->
                                <button class="btn btn-danger deleteButton" type="button" id="deleteButton" product="'.$product.'" data-toggle="modal" data-target=".delete-modal-sm"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete</button>
                            </div>
                        </div>
                    </div><!--/.thumbnail-container-->';
                    }
                    echo '</div></div>';
                    
                }
            ?>
            

                    


        </div>
        <!-- /.row -->
        
    </div>
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                  <div class="modal-dialog edit">
                                    
                                  </div>
                                </div>
<!-- Delete Modal -->
                                <div class="modal fade delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                                        </div>
                                          <div class="modal-body">
                                            Are you sure you want to delete this item?
                                          </div>
                                        <div class="modal-footer center-x answer">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Yes</button>
                                            <button class="btn btn-default" type="button" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
    <!-- /.container -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() 
    {
        //function to pop out the edit form when the user click edit button
       $('.editButton').click(function()
       {
           var product="";
           var url='editForm.php?';
           product = $(this).attr('product');
           if(product.match(/\s/g))
           {
              var arr = product.split(' ');
               var arr = product.split(' ');
                var temp = "";
                for(var i=0; i<arr.length; i++)
                {
                    temp = temp + (arr[i] + '+');
                    //alert(arr[i]);
                }
                
                //remove the '+' at the end of the string
                product = temp.substring(0,temp.length-1);
           }
          // alert(product);
           url = url + 'Product_Name='+product+' ';
           
           //ajax getting the data from editform.php?productname
           $.get(url,function(data)
            {
                $('.edit').load(url+'.editDisplay');
           });
          
       
       });
        
        //function to pop out the delete modal when the user click delete button
        $('.deleteButton').click(function()
        {
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
            
            $('.answer button').click(function(){
                
                 //ajax deleting the data from delete.php?
                var answer = $(this).text();
                if(answer=='Yes')
                {
                    $.get(url,function(data)
                    {
                        $('#refresh').load("admin.php #refresh");
                        $('#refresh').fadeIn('slow');
                       
                    });
                }
                /*$.get(url,function(data)
                {
                    alert(url);
                    $('.refresh').load('admin.php .refresh');
                });*/
                
            });
           
        });
        
        //the user click save edit
       $(".edit").on("submit",function(e)
       { 
          var inputImage = $("#inputImage");
          var fd = new FormData(document.getElementById("editForm"));
          alert(fd);
           fd.append("image",inputImage);
           e.preventDefault();
           $.ajax({
                type:"POST",
                url:'update.php', //I will put project id here as well
                data:fd,
                processData:false,
                contentType:false,
                success:function(smsg)
                {
                   //update the number of items the user has in their shopping cart
                    $.get('admin.php',function(data){
                    $('#refresh').load("admin.php #refresh");
                       $('#editModal').modal('hide');
                    });
                }
            });
           
           
       });
    });
</script>

<?php 
    include('footer.php');
?>