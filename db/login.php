<?php 
session_start();

if (isset($_POST['email'])) {
    include('connect.php');
    include('../include/header.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordenc = md5($password);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = true; 
        header("Location: ../index.php");
        exit();
    }

    $query = "SELECT member_id, email, password, fname, lname, phone, userstatus FROM member
              WHERE email = '$email' AND password = '$passwordenc'
            ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['member_id'];
            $_SESSION['user'] = $row['fname'] . ' ' . $row['lname'];
            $_SESSION['userstatus'] = $row['userstatus'];

            if ($_SESSION['userstatus'] == 'admin') {
                header("Location: ../admin/dashboard.php");
                exit();
            }

            if ($_SESSION['userstatus'] == 'user') {
                header("Location: ../website.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";

            echo '<script>window.location.href = "../db/logout.php";</script>';
            exit();
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: ../db/logout.php");
    exit();
}
?>
