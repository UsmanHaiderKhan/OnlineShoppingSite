<?php
header('Content-Type:application/json');
require_once './connection.php';

$sql = "select order_status from checkouk";
$statement = $conn->prepare($sql);
$result = $statement->execute();
if ($result) {
    foreach ($statement as $values) {
        $orderCom[] = $values;
    }
}
print json_encode($orderCom);
