
require_once 'connection.php';

$id = $_GET['id'];
$sql = "update checkout set order_status='ON' where id='$id'";
$statement = $conn->prepare($sql);
$result = $statement->execute();
if ($result) {
    echo '<script>alert("Order Has Been Completed ");</script>';
echo '<script>window.location="CompletedOrders.php";</script>';

} else {
    echo 'Going Wrong With The Order';
}