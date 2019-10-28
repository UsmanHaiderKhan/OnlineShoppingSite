<?php include "../admin/connection.php" ?>
<?php include "header.php" ?>
<?php
if (isset($_POST['submit'])) {
    echo "Cookie";
    $d = 0;
    if (is_array($_COOKIE['item'])) {

        foreach ($_COOKIE['item'] as $name => $value) {
            $d = $d + 1;
        }

        $d = $d + 1;
    } else {
        $d = $d + 1;
    }
    $id = $_GET['id'];

    $cartQuery = "select * from product where id='$id'";
    $statement = $conn->prepare($cartQuery);
    $result = $statement->execute();
    if ($result) {
        foreach ($statement as $values) {
            $name = $values['product_name'];
            $price = $values['product_price'];
            $img = $values['product_image'];
            $qty = "2";
            $total = $qty * $price;
        }
        if (is_array($_COOKIE['item'])) {
            foreach ($_COOKIE['item'] as $name => $value11) {
                $value11 = explode("__", $value);
                $found = 0;
                if ($img == $value11[2]) {
                    $found = $found + 1;
                    $qty = $value11[3] + 1;
                    $pro_qty = 0;
                    $check = "select * from product where product_image='$img'";
                    $statement = $conn->prepare($cartQuery);
                    $result = $statement->execute();
                    if ($result) {
                        foreach ($statement as $qty_check) {
                            $pro_qty = $qty_check['product_qty'];
                        }
                        if ($pro_qty < $qty) {
                            ?>
                            <script>
                                alert("This Quantity is not Available")
                            </script>
                            <?php

                        } else {
                            $total = $value[1] + $qty;
                            setcookie("item[$name]", img . "__" . $name . "__" . $price . "__" . $total, time() + 1800);
                        }
                    }
                }
            }
            if ($found == 0) {
                $pro_qty;
                $check = "select * from product where product_image='$img'";
                $statement = $conn->prepare($cartQuery);
                $result = $statement->execute();
                if ($result) {
                    foreach ($statement as $qty_check) {
                        $pro_qty = $qty_check['product_qty'];
                    }
                    if ($pro_qty < $qty) {
                        ?>
                        <script>
                            alert("This Quantity is not Available")
                        </script>
                        <?php
                    } else {
                        setcookie("item[$d]", $img . "__" . $name . "__" . $price . "__" . $total, time() + 1800);
                    }
                }
            }
        }
    }
}
?>

<!-- content -->
<div id="content">
    <div class="shop-main container">
        <div class="row">
            <?php include "sidebarmenu.php"; ?>

            <div class="col-md-9">
                <div class="shop-content">
                    <div class="toolbar">
                        <div class="sort-select">
                            <label>Sort by</label>
                            <select class="selectBox">
                                <option>Default Sorting</option>
                                <option>Price</option>
                                <option>High To Low</option>
                                <option>Low To High</option>
                            </select>
                        </div>
                        <div class="sort-select">
                            <label>Show</label>
                            <select class="selectBox">
                                <option>12</option>
                                <option>16</option>
                                <option>20</option>
                            </select>
                        </div>
                        <div class="lg-panel htabs">
                            <span>View</span>
                            <a id="list" class="list-btn active" href="shop-list.html"><i class="fa fa-th-list"></i></a>
                            <a href="shop-grid.html" id="grid" class="grid-btn"><i class="fa fa-th"></i></a>
                        </div>
                    </div>

                    <?php
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                        if ($page == 0 || $page < 1) {
                            $showPostFrom = 0;
                        } else {
                            $showPostFrom = ($page * 6) - 6;
                        }
                        // $query="select * from product";
                        $query = "select * from product order by id desc limit $showPostFrom,6";
                    } else {
                        $query = "select * from product order by id desc limit 0,6";
                    }

                    $statement = $conn->prepare($query);
                    $result = $statement->execute();
                    if ($result) {
                        foreach ($statement as $values) {
                            ?>
                            <div class="shop-list">
                                <div class="grid-item2 mb30">
                                    <form action="#" method="post" name="card-from" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="arrival-overlay col-md-4">
                                                <img src="../admin/<?php echo $values['product_image']; ?>" height="257"
                                                     alt="">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-content">
                                                    <h1><?php echo $values['product_name']; ?></h1>
                                                    <div class="list-midrow">
                                                        <ul>
                                                            <li>
                                                                <span class="low-price"><?php echo $values['product_price']; ?>Rs-/</span>
                                                            </li>
                                                            <li class="reviews"><a href="#">21 Rewiew(s)</a> / <a
                                                                        href="#">Add a Review</a></li>
                                                        </ul>
                                                        <div>
                                                            <p>Available in Stock : <strong
                                                                        class="qty"> <?php echo $values['product_qty']; ?></strong>
                                                            </p>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <p class="list-desc"><?php echo $values['description']; ?></p>
                                                    <div class="list-downrow">
                                                        <button type="submit" value="?id=<?php echo $values['id']; ?>"
                                                                name="submit" class="medium-button button-red add-cart">
                                                            Add to Cart
                                                        </button>
                                                        <ul>
                                                            <li><a href="#" class="wishlist"><i class="fa fa-heart"></i>
                                                                    Add to Wishlist</a></li>
                                                            <li><a href="#" class="compare"><i
                                                                            class="fa fa-retweet"></i>Add to Compare</a>
                                                            </li>
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>
                    <!-- Pagination -->
                    <div class="shop-pag">
                        <p class="pag-p">Items <span>1 to 12</span> of 78 Total</p>
                        <div class="right-pag">
                            <div class="sort-select">
                                <label>Show</label>
                                <select class="selectBox">
                                    <option>12</option>
                                    <option>24</option>
                                    <option>36</option>
                                </select>
                            </div>
                            <div class="pagenation clearfix">
                                <!-- <ul>
                                   <li class="active"><a href="#">1</a></li>
                                   <li><a href="#">2</a></li>
                                   <li><a href="#">3</a></li>
                                   <li><a href="#">4</a></li>
                                   <li><a href="#">5</a></li>
                                   <li><a href="#">&gt;</a></li>
                               </ul> -->
                                <nav class="mt-4">
                                    <ul class="pagination floatleft pagination-md ">
                                        <?php
                                        if (isset($page)) {
                                            if ($page > 1) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="index.php?page=<?php echo $page - 1; ?>">&laquo;</a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $paginationQuery = " select count(*) from product";
                                        $statement = $conn->prepare($paginationQuery);
                                        $result = $statement->execute();
                                        $rowPagination = $statement->fetchColumn();
                                        $postPerPage = $rowPagination / 6;
                                        $postPerPage = ceil($postPerPage);
                                        for ($i = 1; $i < $postPerPage; $i++) {
                                            if (isset($page)) {

                                                if ($i == $page) {
                                                    ?>
                                                    <li class="page-item active">
                                                        <a class="page-link"
                                                           href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php } else {
                                                    ?>
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                           href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>

                                        <?php
                                        if (isset($page)) {
                                            if ($page + 1 <= $postPerPage) {
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="index.php?page=<?php echo $page + 1; ?>">&raquo;</a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End shopmain -->
        <div class="partners">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners1.png" alt=""></a>
                    </div>
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners2.png" alt=""></a>
                    </div>
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners3.png" alt=""></a>
                    </div>
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners4.png" alt=""></a>
                    </div>
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners5.png" alt=""></a>
                    </div>
                    <div class="col-sm-2">
                        <a href="#"><img src="upload/partners6.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
                                                   