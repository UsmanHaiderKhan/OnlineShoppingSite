<?php
require_once 'connection.php';

    $id = $_GET['id'];
    $delete = "delete from checkout where id='$id'";
    $statement = $conn->prepare($delete);
    $result = $statement->execute();
    if ($result) {
        echo "<script>alert('Order Has Been Deleted SuccessFully');</script>";
        echo "<script>window.location='Orders.php';</script>";
    } else {
        echo "<script>alert('Some Thing Wrong');</script>";
    }


