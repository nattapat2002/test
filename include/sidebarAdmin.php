<div class="border-end bg-white" id="sidebar-wrapper">
<div class="sidebar-heading border-bottom bg-light fw-bold text-center">
    <a href="dashboard.php" class="text-decoration-none text-dark">
        <img src="../assets/img/54.png" style="width: auto; max-height: 30px; vertical-align: middle;" alt="">
    </a>
</div>

<div class="sidebar-heading border-bottom bg-light text-left" onclick="goToDashboard()" style="cursor: pointer;">
    <?php
    session_start();
    ob_start();

    if (isset($_SESSION['user'])) {
        echo '<i class="fas fa-user"></i> ' . $_SESSION['user'] . ' ';
    } else {
        echo '<a href="../db/login-index.php"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>';
    }
    ?>
</div>
    <nav class="list-group list-group-flush">
    

    <div class="sidebar">
      
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
        <?php
        $current_file = $_SERVER["PHP_SELF"];

        if (strpos($current_file, "/admin/") !== false) {
            echo '
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
            <i class="fa-solid fa-house-chimney"></i>
              <p>
                หน้าหลัก
   
              </p>
            </a>
          </li>';
        }?>


          <li class="nav-item">
            <a href="test.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                ภาพสไลด์
   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="product1.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                product
   
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="contact.php" class="nav-link">
              <i class="nav-icon fas fa-lg fa-phone"></i>
              <p>
                contact
   
              </p>
            </a>
          </li>

          




      

          
         
         
          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p id="logoutButton">logout</p>
            </a>
          </li>
         
        </ul>
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
            <button class="btn btn-danger " id="logoutButton1">logout</button>
        </div>
    </nav>



    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            window.location.href = '../db/logout.php';
        });
    </script>
    <script>
        document.getElementById('logoutButton1').addEventListener('click', function() {
            window.location.href = '../db/logout.php';
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
        function goToDashboard() {
            window.location.href = "../website.php";
        }
    </script>



    <?php
    include('../include/js.php');
    ?>