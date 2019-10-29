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

<?php require_once "topbar.php"; ?>


    <div class="overlay">
        <div id="twitch">
            <div>SALE SALE <span>50% OFF</span></div>
            <div>BUY YOUR<span>DESIRED</span></div>
            <div>GET THE<span>OFF SALE</span></div>
            <div>THIS SUMMER<span>FOR YOU</span></div>
            <div>COLLECTION<span>AFFORDABLE</span></div>
            <div>FOR WINTER<span>FLAT 50%</span></div>
            <div>ARSLAN AMMER<span>80% OFF</span></div>
            <div>JACKETS<span>FOR MENS</span></div>
        </div>
    </div>


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
<?php require_once "gallery.php"?>
<?php require_once "footer.php"; ?>