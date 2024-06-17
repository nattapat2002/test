<?php
include '../include/headerAdmin.php';
include '../include/alert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to_email = $_POST['email'];
    $subject = "คำร้องขอเข้าร่วมกิจกรรม";
    $message = "
    <html>
    <head>
        <title>คำร้องขอเข้าร่วมกิจกรรม</title>
    </head>
    <body>
        <p>เรียนคุณผู้สมัคร</p>
        <p>คำร้องขอที่ได้ลงทะเบียน ได้รับการอนุมัติแล้ว</p>
        
    </body>
    </html>
    ";
    
    $headers = "From: 6350110023@psu.ac.th\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($to_email, $subject, $message, $headers)) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "ส่งอีเมลหาผู้สมัครสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                history.back();
            });
        });
    </script>';
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error404',
            text: 'ไม่สามารถส่งอีเมลล์หาผู้สมัครได้',
            showConfirmButton: true,
        }).then(function() {
            history.back();
        });
    </script>";
        exit();
    }
}
?>
