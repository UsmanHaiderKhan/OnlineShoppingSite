<?php
require_once "header.php";
require_once "./connection.php";
require_once "./Sidebar.php";
?>

<div class="col-md-9 mt-4">
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr class="bg-dark text-white text-center">
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>qty</th>
            <th>total</th>
            <th>User</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody class="card-text-center">
        <?php
        $sql = "select * from checkout";
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
                    <td><a href="delete.php&action=delete">Delete</a></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
    </div>
</div>
</div>
</div>

