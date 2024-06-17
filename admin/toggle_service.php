<?php
include '../db/connect.php'; // include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $service = $_POST['service'];

    // Toggle service: if current service is 1, set to 0; if current service is 0, set to 1
    $newServiceStatus = $service == 1 ? 0 : 1;

    $sql = "UPDATE product SET service='$newServiceStatus' WHERE product_id='$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating service status: " . $conn->error;
    }

    $conn->close();
}
?>
