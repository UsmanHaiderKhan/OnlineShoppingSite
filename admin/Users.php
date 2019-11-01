<?php
require_once "header.php";
require_once "./connection.php";
require_once "./Sidebar.php";
?>

<div class="col-md-9">
    <div class="row">


        <?php
        $sql = "select * from users";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();
        if ($result) {
            foreach ($statement as $value) {
                ?>
                <div class="col-md-4 mt-4">
                    <div class="card shadow text-center">
                        <div>
                            <img src="./User_Images/<?php echo $value['user_image']; ?>" CLASS="card-img-top" alt="">
                        </div>
                        <div class="card-text  p-3" >
                            <h5><?php echo $value['username']; ?></h5>
                            <p><?php echo $value['email']; ?></p>
                            <p><?php echo $value['phoneNo']; ?></p>
                            <p>
                                <?php echo $value['fulladdress']; ?>
                            </p>
                        </div>
                    </div>
                </div>


                <?php
            }
        }
        ?>
    </div>
</div>