<?php
session_start();
ob_start(); 
include ("include/headerAdmin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
       
        background-color: #f8f9fa;
        padding-top: 70px; /* Adjust this if your navbar height changes */
    }

    .navbar {
        background-color: #ffffff !important; /* Dark background for the navbar */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Slight shadow for depth */
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #1c1c1e !important; /* White color for the brand text */
    }

    .navbar-logo {
        width: 40px; /* Adjust the size of the logo */
        height: 40px;
        border-radius: 50%; /* Make the logo round */
        margin-right: 10px; /* Space between logo and text */
        color: #1c1c1e;
    }

    .navbar-nav .nav-item .nav-link {
        color: #1c1c1e !important; /* Dark color for nav links */
        padding: 0.5rem 1rem; /* Padding for links */
        transition: color 0.3s ease-in-out; /* Smooth color transition */
        font-weight: bold; /* Make menu items bold */
    }

    .navbar-nav .nav-item .nav-link:hover {
        color: #ffc107 !important; /* Change color on hover */
    }

    .navbar-toggler {
        border: none; /* Remove border from toggler */
        background-color: #ffc107; /* Yellow background for toggler */
    }

    .navbar-toggler .fas {
        color: #1c1c1e; /* Dark color for the icon */
    }

    .nav-item.active .nav-link {
        color: #ffc107 !important; /* Active link color */
    }
    

    @media (max-width: 991px) {
        .navbar-nav {
            background-color: #f8f9fa; /* Background for collapsed menu */
            padding: 1rem;
            width: 100%;
        }

        .navbar-nav .nav-item {
            margin-bottom: 0.5rem;
        }
    }
</style>

</head>
<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top" >South Zaina</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#homepage">หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="#product">สินค้า</a></li>
                <li class="nav-item"><a class="nav-link" href="#service">บริการ</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">ติดต่อ</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="db/logout.php">ออกจากระบบ</a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="db/login-index.php">เข้าสู่ระบบ</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="sidebar-heading text-center" 
     onclick="<?php echo (isset($_SESSION['userstatus']) && $_SESSION['userstatus'] === 'admin') ? "goToDashboard1('admin')" : "alertNotAvailable()"; ?>" 
     style="cursor: <?php echo (isset($_SESSION['userstatus']) && $_SESSION['userstatus'] === 'user') ? 'default' : 'pointer'; ?>;">
    <?php
    if (isset($_SESSION['user'])) {
        echo '<i class="fas fa-user"></i> ' . $_SESSION['user'] . ' ';
    }
    ?>
    <?php

    if (!isset($_SESSION['user'])) {
        echo 'กรุณาเข้าสู่ระบบ';
    }
    ?>
</div>




</nav>

<script>
function goToDashboard1(userstatus) {
    switch (userstatus) {
        case 'admin':
            window.location.href = "admin/dashboard.php";
            break;
        case 'user':
            // สามารถเพิ่มปฏิกิริยาเพิ่มเติมสำหรับผู้ใช้ทั่วไปที่ไม่ใช่ admin ได้ตามต้องการ
            console.log("You do not have permission to access this page.");
            break;
        default:
            console.log("User status not recognized");
            break;
    }
}
</script>





  