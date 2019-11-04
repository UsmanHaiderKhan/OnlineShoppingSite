<?php
session_start();
include "./header.php";

if ($_SESSION['admin'] == "") {
    ?>
    <script>
        window.location = "admin_login.php";
    </script>
    <?php
}
?>

<?php require_once "./connection.php" ?>

<?php
if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $qty = trim($_POST['qty']);

    $fname = $_FILES['image']['name'];
    $r1 = rand(1111, 9999);
    $r2 = rand(1111, 9999);
    $r3 = $r1 . $r2;
    $r3 = md5($r3);
    $dst = "./product_image/" . $r3 . $fname;
    $dst_image = "product_image/" . $r3 . $fname;

    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
    $category_name = $_POST['category'];
    echo $category_name;
    $description = trim($_POST['description']);
    $sql = "insert into products(product_name,product_price,product_qty,product_category,product_image,description)
          VALUES('$name','$price','$qty','$category_name','$dst_image','$description')";
    $statement = $conn->prepare($sql);
    $result = $statement->execute();
    if ($result) {
        echo "Data Inserted SuccessFully";
    } else {
        echo "Some Thing Going Wrong";
    }

}
?>

<?php include "./Sidebar.php" ?>
<div class="col-md-9">
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
                <?php
                $category = "select * from category";
                $statement = $conn->prepare($category);
                $result = $statement->execute();
                if ($result) {
                    foreach ($statement as $value) {
                        $category = $value["name"];
                        ?>
                        <option> <?php echo $category; ?></option>
                        <?php
                    }
                } else {
                    echo "Some thing Going Wrong";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
                <textarea id="my-textarea" class="form-control" name="description" rows="7"
                          placeholder="Product Description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success btn-block"> Add Product</button>
        </div>
    </form>
</div>
<?php
include "footer.php";
?>

