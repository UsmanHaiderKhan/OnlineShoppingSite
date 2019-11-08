<?php
session_start();
require_once './connection.php';
include "./header.php"
?>
<?php include "./Sidebar.php" ?>
<div class="col-md-9">
    <h2></h2>
    <div class="row" id="dashcards">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-user fa-lg"></i>
                    <h5>Total Users</h5>

                </div>
                <?php
                $query = "SELECT count(*) FROM  users";
                $result = $conn->prepare($query);
                $result->execute();
                $userCount = $result->fetchColumn();
                if ($userCount > 0) { ?>
                    <h4 class="text-center count-position"><?php echo($userCount); ?></h4>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-product-hunt fa-lg"></i>
                    <h5>Total Products</h5>

                </div>
                <?php
                $query = "SELECT count(*) FROM  products";
                $result = $conn->prepare($query);
                $result->execute();
                $productCount = $result->fetchColumn();
                if ($userCount > 0) { ?>
                    <h4 class="text-center count-position"><?php echo($productCount); ?></h4>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                    <h5>Total Orders</h5>
                </div>
                <?php
                $query = "SELECT count(*) FROM  checkout ";
                $result = $conn->prepare($query);
                $result->execute();
                $userCount = $result->fetchColumn();
                if ($userCount > 0) { ?>
                    <h4 class="text-center count-position"><?php echo($userCount); ?></h4>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                    <h5>Complete Orders</h5>
                </div>
                <?php
                $query = "SELECT count(*) FROM  checkout where order_status='ON'";
                $result = $conn->prepare($query);
                $result->execute();
                $userCount = $result->fetchColumn();
                if ($userCount > 0) { ?>
                    <h4 class="text-center count-position"><?php echo($userCount); ?></h4>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                    <h5>Pending Orders</h5>
                </div>
                <?php
                $query = "SELECT count(*) FROM  checkout where order_status='OFF'";
                $result = $conn->prepare($query);
                $result->execute();
                $userCount = $result->fetchColumn();
                if ($userCount > 0) { ?>
                    <h4 class="text-center count-position"><?php echo($userCount); ?></h4>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card shadow p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="fa fa-comments fa-lg"></i>
                    <h5>Messages</h5>
                </div>
                <?php
                $query = "SELECT count(*) FROM  contact ";
                $result = $conn->prepare($query);
                $result->execute();
                $messageCount = $result->fetchColumn();
                if ($messageCount > 0) { ?>
                    <h4 class="text-center count-position"><?php
                        echo($messageCount);
                        ?></h4>
                    <?php
                } else {
                    ?>
                    <h4 class="text-center count-position">0</h4>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <?php

            $sql = "select * from products order by id ";
            $statement = $conn->prepare($sql);
            $result = $statement->execute();
            if ($result) {
                foreach ($statement as $value) {
                    $dataPoints[] = $value;
                }
            }
            $dataPoints = array(
                array("y" => $value['id'], "label" => "No of Products"),
            );
            ?>
            <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
            <script>
                window.onload = function () {

                    var chart1 = new CanvasJS.Chart("chartContainer1", {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: "Daily Posted Products"
                        },
                        axisY: {
                            title: "Number of Products"
                        },
                        data: [{
                            type: "bar",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart1.render();

                }
            </script>
        </div>
        <div class="col-md-6">
            <?php
            $query = "SELECT count(*) FROM  checkout";
            $result = $conn->prepare($query);
            $result->execute();
            $userCount = $result->fetchColumn();
            if ($result) {
                $dataPoints1 = array(
                    array("y" => $userCount, "label" => "No of Orders"),
                );
            }
            ?>
            <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
            <script>
                window.onload = function () {

                    var chart2 = new CanvasJS.Chart("chartContainer2", {
                        title: {
                            text: "Number Of Order"
                        },
                        axisY: {
                            title: "Number Of Order in a Week"
                        },
                        data: [{
                            type: "doughnut",
                            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart2.render();

                }
            </script>
        </div>
    </div>

    <div class="mb-5"></div>
</div>
<script src="./assets/js/vendor/canvas.min.js"></script>'
<script src="./assets/js/script.js"></script>
<?php
include "footer.php";
?>

