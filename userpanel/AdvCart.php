<?php
session_start();
require_once "function.php";
require_once "../admin/connection.php";

if (isset($_POST["add"])) {
  if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'productid');
        if (in_array($_POST['productid'], $item_array_id)) {
            echo '<script>alert("Product Already Added")</script>';
            echo '<script>window.location="AdvCart.php";</script>';
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array(
                "productid" => $_POST['productid']
            );
            $_SESSION['cart'][$count] = $item_array;

        }
  } else {
      $item_array = array(
          "productid" => $_POST['productid']
      );
      $_SESSION['cart'][0] = $item_array;

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
    <title>Shopping Cart</title>
    <style>

        img {
            background: lightblue;
            height: auto;
            max-width: 100%;
            background: radial-gradient(white 30%, lightblue 70%);
        }

        .fa-star {
            color: yellowgreen;
            padding: 3% 0;
        }
    </style>
</head>
<body class="m-0 p-0">
<?php require_once "topbar.php"; ?>
<div class="container">

        <div class="row text-center py-5">
            <?php
            $sql = "select * from product";
            $statement = $conn->prepare($sql);
            $result = $statement->execute();
            if ($result) {
                foreach ($statement as $value) {
                    component($value["product_name"], $value["product_price"], $value["product_image"], $value["id"]);
                }
            }
            ?>
        </div>
</div>
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