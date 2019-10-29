<?php
session_start();
require_once '../admin/connection.php';
require_once './function.php';
?>
    <?php
           if (isset($_POST["delete"]))
           {
               if ($_GET['action']=='delete')
               {
                   foreach ($_SESSION['cart'] as $key => $value)
                   {
                       if ($value['productid']==$_GET['id'])
                       {
                          unset($_SESSION['cart'][$key]);
                          echo "<script> alert('Product Has Been Removed'); </script>";
                       }
                   }
               }
           }
    ?>


<?php
require_once "topbar.php";
?>
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-lg-7">
            <div class="shopping-cart">
                <h4 class="my-5">My Product Cart</h4>
                <hr>
                <?php
                $total=0;
                if (isset($_SESSION['cart'])) {
                    $productid = array_column($_SESSION['cart'], "productid");
                    $sql = "select * from product";
                    $statement = $conn->prepare($sql);
                    $result = $statement->execute();
                    if ($result) {
                        foreach ($statement as $value) {
                            foreach ($productid as $id) {
                                if ($value['id'] == $id) {
                                    cartProduct($value["product_image"], $value['product_name'], $value["product_price"],$value["id"]);
                                   $total=$total+ (int)$value['product_price'];
                                }
                            }
                        }
                    }
                }
                else {
                    echo "<h5> Cart is Empty...! </h5>";
                }
                ?>

                <div>
                    <a href="checkout.php" name="checkout" class="btn btn-outline-success btn-block text-uppercase">Go to CheckOut</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 border round bg-white  mt-5 h-25">
            <div class="mt-5">
                <h6>Price Details</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if (isset($_SESSION["cart"]))
                        {
                            $count=count($_SESSION['cart']);
                            echo "<h6>Price ($count items)</h6>";
                        }else{
                            echo  "<h6>Price (0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                           <h6><?php echo  $total;?>Rs-/</h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>
                            <?php
                            echo  $total;
                            ?>Rs-/
                        </h6>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "footer.php"?>