<?php
header('Content-Type:application/json');
require_once './connection.php';

$sql = "select * from checkout order by id desc";
$statement = $conn->prepare($sql);
$result = $statement->execute();
if ($result) {
    foreach ($statement as $valuess) {
        $order[] = $valuess;
    }
}
print json_encode($order);
