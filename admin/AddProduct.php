<?php 
session_start();
include "./header.php";

if ($_SESSION['admin'] == " ") {
    ?>
    <script>
    window.location="admin_login.php";
    </script>
    <?php
}
?>
<?php include "./Sidebar.php" ?>
<?php require_once "./connection.php"?>

<?php
     if (isset($_POST['submit'])) {
         
          $name=trim($_POST['name']);
          $price=trim($_POST['price']);
          $qty=trim($_POST['qty']);

          $fname=$_FILES['image']['name'];
          $r1=rand(1111,9999);
          $r2=rand(1111,9999);
          $r3=$r1.$r2;
          $r3=md5($r3);
          $dst="./product_image/".$r3.$fname;
          $dst_image="product_image/".$r3.$fname;
         
          move_uploaded_file($_FILES['image']['tmp_name'],$dst);

          
          $category=trim($_POST['category']);
          $description=trim($_POST['description']);
         $sql="insert into product (product_name,product_price,product_qty,product_image,product_category,description)
          VALUES('$name','$price','$qty','$dst_image','$category','$description')";
          $statement=$conn->prepare($sql);
          $result=$statement->execute();
          if ($result) {
              echo "Data Inserted SuccessFully";
          }else {
              echo "Some Thing Going Wrong";
          }


     }
?>
<link rel="stylesheet" href="./css/form.css">
      
        <div class="grid_10">
            <div class="box round first">
                <h2> Add Product</h2>
            <form method="post" action="" name="product_form" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Product Name">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="price" placeholder="Product Price">
                </div>

                <div class="form-group">
                    <input class="form-control" type="number" name="qty" placeholder="Product Quantity">
                </div>

                <div class="form-group">
                    <input class="form-control" type="file" name="image" placeholder="Product image">
                </div>

                <div class="form-group">
                  <select class="form-control" name="category">
                      <option> Jeans </option>
                      <option> Shirts </option>
                      <option> Shoes </option>
                      <option> Frock  </option>
                      <option> Pent Coat </option>
                  </select>
                </div>

                <div class="form-group">
                    <textarea id="my-textarea" class="text-control" name="description" rows="7" placeholder="Product Description"></textarea>
                </div>
              
              
                
                <div class="form-group">
                     <button type="submit" name="submit" class="btn-success"> Add Product </button>
                </div>
            </form>
            </div>

        </div>

        <div class="clear">
        </div>
</div>
   <?php 
   include "footer.php";
   ?>

