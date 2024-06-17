<?php

use function PHPSTORM_META\type;

include '../db/connect.php';
include '../include/alert.php';
include '../include/headerAdmin.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_product = $_POST['name_product'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $code_product = $_POST['code_product'];
    $type = $_POST ['type'];
    $service = isset($_POST['service']) ? $_POST['service'] : 1;

    $check_sql = "SELECT * FROM product WHERE code_product = '$code_product'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        echo "รหัสสินค้า \"$code_product\" มีอยู่แล้วในระบบ";
        exit(); 
    }
    

    $target_dir = "../Uploads/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
    $pic = $target_file;

    $sql = "INSERT INTO product (name_product, details, price, pic, color, code_product ,service , type)
    VALUES ('$name_product', '$details', '$price', '$pic', '$color','$code_product','$service',' $type')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '../admin/product1.php';
                    });
                });
              </script>";
    } else {
        echo "มีข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
}

$conn->close();
?>


