<?php
include '../include/headerAdmin.php';
include '../include/sidebarAdmin.php';
include '../checkstatus/status.php';
include '../include/js.php';
checkAdminStatus();
?>

    <style>
        .gallery {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-image img {
            width: 500px; /* ขนาดของรูปหลัก */
            height: auto;
            margin-bottom: 10px;
        }
        .thumbnail-container {
            display: flex;
            justify-content: center;
        }
        .thumbnail img {
            width: 100px; /* ขนาดของรูปเล็ก */
            height: auto;
            margin: 5px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .thumbnail img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="gallery">
        <div class="main-image">
            <img src="../assets/img/1.jpg" alt="Main Image">
        </div>
        <div class="thumbnail-container">
            <div class="thumbnail">
            <img src="../assets/img/1.jpg" alt="Main Image">
            </div>
            <div class="thumbnail">
            <img src="../assets/img/1.jpg" alt="Main Image">
            </div>
            <div class="thumbnail">
            <img src="../assets/img/1.jpg" alt="Main Image">
            </div>
            <div class="thumbnail">
            <img src="../assets/img/1.jpg" alt="Main Image">
            </div>
            <div class="thumbnail">
            <img src="../assets/img/1.jpg" alt="Main Image">
            </div>
        </div>
    </div>
</body>
</html>
