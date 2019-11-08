<?php
require_once "./connection.php";
require_once "header.php";

?>
<?php require_once "./Sidebar.php"; ?>
<div class="col-md-9 ">
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr class="bg-dark text-white text-center">
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>qty</th>
                <th>total</th>
                <th>User</th>
                <th>order_Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="card-text-center">
            <?php
            $sql = "select * from checkout where order_status='OFF'";
            $statement = $conn->prepare($sql);
            $result = $statement->execute();
            if ($result) {
                foreach ($statement as $value) {
                    ?>
                    <tr class="text-center">
                        <td><img src="./<?php echo $value['pro_image'] ?>" width="70" height="70" alt=""></td>
                        <td><?php echo $value['pro_name']; ?></td>
                        <td><?php echo $value['pro_price']; ?></td>
                        <td><?php echo $value['pro_qty']; ?></td>
                        <td><?php echo $value['pro_total']; ?></td>

                        <td><?php echo $value['user_id']; ?></td>
                        <td><a href="complete.php?id=<?php echo $value['id']; ?>" class="btn btn-success">Pending
                                order</a></td>
                        <td><a href="./DeletePendingOrder.php?id=<?php echo $value['id']; ?>" name="delete"
                               class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                    </tr>
                    <?php
                }
            }
            ?>

            </tbody>
        </table>
    </div>
</div>


