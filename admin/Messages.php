<?php
require_once "./connection.php";
require_once "header.php";

?>
<?php require_once "./Sidebar.php"; ?>
<div class="col-md-9">

    <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
            <tr class="bg-dark text-center text-white">
                <th>UserName</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>


            <?php
            $sql = "select * from contact";
            $statement = $conn->prepare($sql);
            $result = $statement->execute();
            if ($result) {
                foreach ($statement as $value) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $value['username']; ?></td>
                        <td><a href="mailto:<?php echo $value['email']; ?>"><?php echo $value['email']; ?></a></td>
                        <td><?php echo $value['message']; ?></td>
                        <td><a class="btn btn-danger" href="DeleteMessage.php?id<?php echo $value['id']; ?>"><span
                                        class="fa fa-trash"></span></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>

</div>
