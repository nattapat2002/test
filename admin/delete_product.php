<?php
include '../db/connect.php';
include '../include/alert.php';
include '../include/header.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code_product = $_POST['code_product'];

    $sql = "DELETE FROM product WHERE code_product = '$code_product'";

    if ($conn->query($sql) === TRUE) {
        echo $success1;
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
