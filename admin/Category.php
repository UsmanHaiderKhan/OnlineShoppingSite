    <?php
        session_start();
        include "./header.php";
    if ($_SESSION['admin'] == "") {
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
     if (isset($_POST['submit']))
     {
         $category=$_POST['category'];
         $sql="insert into category(name)values ('$category')";
         $statement=$conn->prepare($sql);
         $result=$statement->execute();
         if ($result)
         {
             echo "Category Added SuccessFully";

         }
         else{

             echo  "Some Thing Going Wrong";
         }
     }
    ?>
    <link rel="stylesheet" href="assets/css/form.css">

    <div class="grid_10">
        <div class="box round first">
            <h2> Add Product Category</h2>
            <form method="post" action="" name="product_form" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="text" name="category" placeholder="Category Name">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn-success"> Add Product</button>
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

