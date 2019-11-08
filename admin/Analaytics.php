<?php
header('Content-Type:application/json');
require_once './connection.php';

$sql = "select * from products order by id ";
$statement = $conn->prepare($sql);
$result = $statement->execute();
if ($result) {
    foreach ($statement as $value) {
        $data[] = $value;
    }
}
print json_encode($data);



