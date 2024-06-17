<?php
function checkAdminStatus() {

    if (!isset($_SESSION['userstatus']) || $_SESSION['userstatus'] !== 'admin') {
        echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Error404',
              text: 'กรุณาเข้าสู่ระบบ',
              showConfirmButton: false,
              footer: '<a href=\"../db/login-index.php \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
            });
          </script>";
        exit();
    }
}


function checkmanagerStatus() {

  if (!isset($_SESSION['userstatus']) || $_SESSION['userstatus'] !== 'manager') {
      echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Error404',
            text: 'กรุณาเข้าสู่ระบบ',
            showConfirmButton: false,
            footer: '<a href=\"../db/login-index.php \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
          });
        </script>";
      exit();
  }
}

function checkCEOStatus() {

  if (!isset($_SESSION['userstatus']) || $_SESSION['userstatus'] !== 'ceo') {
      echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Error404',
            text: 'กรุณาเข้าสู่ระบบ',
            showConfirmButton: false,
            footer: '<a href=\"../db/login-index.php \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
          });
        </script>";
      exit();
  }
}

function checkuserStatus() {

  if (!isset($_SESSION['userstatus']) || $_SESSION['userstatus'] !== 'user' ) {
      echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Error404',
            text: 'กรุณาเข้าสู่ระบบ',
            showConfirmButton: false,
            footer: '<a href=\"../db/login-index.php \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
          });
        </script>";
      exit();
  }
}

function checkactivityStatus() {

  $allowed_statuses = array('user', 'admin', 'manager', 'ceo');

  if (!isset($_SESSION['userstatus']) || !in_array($_SESSION['userstatus'], $allowed_statuses)) {
      echo "<script>
          Swal.fire({
              icon: 'error',
              title: 'Error404',
              text: 'กรุณาเข้าสู่ระบบ',
              showConfirmButton: false,
              footer: '<a href=\"../db/login-index.php \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
          });
          </script>";
      exit();
  }
}

