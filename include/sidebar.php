<div class="border-end bg-white" id="sidebar-wrapper">
<div class="sidebar-heading border-bottom bg-light fw-bold text-center">
    <a href="dashboard.php" class="text-decoration-none text-dark">
        <img src="../img/eHRLA1.png" style="width: auto; max-height: 30px; vertical-align: middle;" alt="">
    </a>
</div>

    <div class="sidebar-heading border-bottom bg-light text-left">
        <?php
        session_start();
        ob_start();

        if (isset($_SESSION['user'])) {
            echo '<i class="fas fa-user"></i> ' . $_SESSION['user'] . ' ';
        } else {
            echo '<a href="../index.php"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>';
        }
        ?>
        <?php if ($_SESSION['userstatus'] !== 'user') : ?>
            <i class="fas fa-sync-alt" style="float: right;" onclick="goToDashboard('<?php echo $_SESSION['userstatus']; ?>')"></i>
        <?php endif; ?>



    </div>

    <nav class="list-group list-group-flush">
      
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link ">
              <i class="fa-solid fa-house-chimney"></i>
              <p>
               หน้าหลัก
              
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="type.php" class="nav-link">
            <i class="fa-solid fa-list"></i>
              <p>
                ประเภทกิจกรรม
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="activity1.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                กิจกรรมที่1
   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="activity2.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                กิจกรรมที่2
   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="activity3.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                กิจกรรมที่3
   
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="history.php" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
              <p>
                ประวัติการขอเข้าร่วม

              </p>
            </a>
          </li>

          
         
         
          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p id="logoutButton1" >logout</p>
            </a>
          </li>
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>


</div>

<!-- Page content wrapper-->
<div id="page-content-wrapper">
    <!-- Top navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <button class="btn btn-muted" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <button class="btn btn-danger " id="logoutButton">Logout</button>
        </div>
    </nav>


    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '../index.php';
        });
    </script>
    <script>
        document.getElementById('logoutButton1').addEventListener('click', function() {
            window.location.href = '../index.php';
        });
    </script>
    <script>
        var currentUrl = window.location.href;
        var menuLinks = document.querySelectorAll('.list-group-item');
        menuLinks.forEach(function(link) {
            if (link.href === currentUrl) {
                link.classList.add('active');
            }
        });
    </script>

    <script>
        function goToDashboard(userstatus) {
            switch (userstatus) {
                case 'admin':
                    window.location.href = "../admin/dashboard.php";
                    break;
                default:
                    console.log("User status not recognized");
                    break;
            }
        }
    </script>

    <?php
    include('../include/js.php');
    ?>