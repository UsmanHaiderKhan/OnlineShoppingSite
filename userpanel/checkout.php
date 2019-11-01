<?php
session_start();
require_once "../admin/connection.php";
require_once "./function.php";

?>
<?php
if (isset($_POST['order'])) {
    if (!empty($_SESSION["cart"])) {
        $productid = array_column($_SESSION['cart'], "productid");
        $sql = "select * from products";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();
        $total= 0;
        foreach ($statement as $value) {
            foreach ($productid as $id) {
                if ($value['id'] == $id) {
                    $id=$value['id'];
                    $_SESSION['checkout_Id']=$id;
                    $name = $value["product_name"];
                    $price = $value['product_price'];
                    $total = $total + (int)$value['product_price'];
                    $_SESSION['pay']=$total;
                    $qty = count($_SESSION['cart']);
                    $image = $value["product_image"];


                    if (empty($_SESSION['admin']))
                    {

                        echo "<script> 
                             alert('Please Login to buy that Product');
                             window.location='../admin/admin_login.php';  
                            </script>";

                    }
                    if (empty($name) || empty($price) || empty($qty) || empty($total) || empty($image) ) {
                        echo "<script> alert('Some Required Data is Not Found'); </script>";
                    } else {
                        $user_id=$_SESSION['admin']['user_id'];

                        $sql = "insert into checkout(pro_name,pro_price,pro_qty,pro_image,pro_total,user_id) 
                                            values ('$name','$price','$qty','$image','$total','$user_id')";
                        $statement = $conn->prepare($sql);
                        $result = $statement->execute();
                        if ($result) {
                            echo "<script> alert('Your Order Has Been Submitted SuccessFully'); </script>";
                            unset($_SESSION['cart']);
                            echo "<script> window.location='PayPal.php'; </script>";
                        } else {
                            echo "<script> alert('Some Thing Going Wrong...!'); </script>";
                        }
                    }
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Checkout | Shopping Site</title>
</head>
<body>

<h2>Checkout Your Products</h2>

<form action="checkout.php" method="post" enctype="multipart/form-data">
    <button type="submit" class="btn btn-outline-primary" name="order">Order Now</button>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>