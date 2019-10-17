<?php
require_once "../admin/connection.php";
session_start();
if (isset($_POST["submit"])) {
    if (isset($_SESSION['Shopping_Cart'])) {
        $item_array_id = array_column($_SESSION["Shopping_Cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["Shopping_Cart"]);
            $item_array = array(
                'item_id' => $_GET['id'],
                'item_img' => $_GET['pro_image'],
                'item_name' => $_POST['hidden_name'],
                'item_price' => $_POST['hidden_price'],
                'item_qty' => $_POST['pro_qty']
            );
            $_SESSION['Shopping_Cart'][$count] = $item_array;
        } else {
            echo '<script> alert("Items Already Added"); </script>';
            echo '<script>Window.location="shoppingcart.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id' => $_GET['id'],
            'item_img' => $_GET['pro_image'],
            'item_name' => $_POST['hidden_name'],
            'item_price' => $_POST['hidden_price'],
            'item_qty' => $_POST['pro_qty']

        );
        $_SESSION['Shopping_Cart'][0] = $item_array;
    }
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        foreach ($_SESSION['Shopping_Cart'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                unset($_SESSION['Shopping_Cart'][$keys]);
                echo '<script> alert("Item Has Been Removed"); </script>';
                echo '<script> window.location="ShoppingCart.php"; </script>';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>SHOPPING | CART</title>
</head>
<body>
<div class="container">
    <div class="row">
        <?php
        $sql = "select * from product limit 0,6";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();
        if ($result) {
            foreach ($statement as $keys => $value) {
                ?>
                <div class="col-md-4 p-4">
                    <form action="shoppingcart.php?action=add&id=<?php echo $value["id"]; ?>" enctype="multipart/form-data" method="post">
                        <div class="card">
                            <img src="../admin/<?php echo $value['product_image']; ?>" name="pro_img" class="w-100" height="270"
                                 alt="">
                            <div class="card-body">
                                <h2><?php echo $value["product_name"]; ?></h2>
                                <strong><?php echo $value["product_price"]; ?></strong>
                                <label for="qty">Quantity</label>
                                <input type="text" value="<?php echo $value["product_qty"]; ?>" name="pro_qty" readonly>
                                <p>
                                    <?php
                                    echo $value['description'];
                                    ?>
                                </p>
                                <input type="hidden" name="hidden_name" value="<?php echo $value["product_name"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $value["product_price"]; ?>">
                                <button class="btn btn-outline-success" type="submit" name="submit">Add Cart</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed">
            <tr class="bg-dark text-white">
                <td>Item Image</td>
                <td>Item Name</td>
                <td>Item Quantity</td>
                <td>Item Price</td>
                <td>Total</td>
                <td>Action</td>
            </tr>
            <?php
            if (!empty($_SESSION["Shopping_Cart"])) {
                $total = 0;
                foreach ($_SESSION["Shopping_Cart"] as $keys => $value) {
                    ?>
                    <tr>
                        <td><img src="../admin/<?php echo  $value["pro_image"];?>" style="with:80px;height: 80px;border-radius: 50%;" alt=""> </td>
                        <td> <?php echo $value["item_name"] ?> </td>
                        <td> <?php echo $value["item_qty"] ?> </td>
                        <td> <?php echo $value["item_price"] ?> Rs-/</td>
                        <td> <?php echo number_format($value["item_price"] * $value["item_qty"], 2); ?> Rs-/</td>
                        <td><a href="shoppingcart.php?action=delete&id=<?php echo $value["item_id"]; ?>"> <span
                                        class="btn btn-danger">Remove</span> </a></td>
                    </tr>
                    <?php
                    $total = $total + ($value["item_price"] * $value["item_qty"]);
                }
                ?>

                <tr>
                    <td colspan="4" align="right">Grand Total</td>
                    <td align="right"> <?php echo number_format($total, 2); ?> Rs-/</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
    if (isset($_POST['checkout1'])) {
        echo '<script>alert("OK");</script>';
        foreach ($_SESSION["Shopping_Cart"] as $keys => $value) {
//            $image=$value["pro_image"];



            $name = $value["item_name"];
            $price = $value["item_price"];
            $qty = $value["item_qty"];
            $total = $value["item_price"] * $value["item_qty"];
            $roundedTotal = number_format($total);

            $fname=$_FILES['pro_image']['name'];
            $r1=rand(1111,9999);
            $r2=rand(1111,9999);
            $r3=$r1.$r2;
            $r3=md5($r3);
            $dst="./checkout_img/".$r3.$fname;
            $dst_image="checkout_img/".$r3.$fname;

            move_uploaded_file($_FILES['pro_image']['tmp_name'],$dst);

            $productInfo = "insert into checkout(pro_name,pro_price,pro_qty,pro_image,pro_total) 
                          VALUES ('$name','$price','$qty','$dst_image','$roundedTotal')";
            $statement = $conn->prepare($productInfo);
            $result = $statement->execute();
            if ($result) {
                echo "Order Hsa Been Submit SuccessFully";
                echo '<script type="text/javascript">location.href ="checkout.html";</script>';
            } else {
                echo "Check Out Not Possible For U...!";
            }
        }
    }
    ?>
    <form action="shoppingcart.php" method="post" enctype="multipart/form-data">

        <button class="btn btn-success" type="submit" name="checkout1"> Check Out</button>

    </form>

</div>

<div class="mb-5"></div>
</body>
</html>
