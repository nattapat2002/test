<?php
session_start();

?>
<?php include '../include/header.php'; ?>

<body>
    <?php if (isset($_SESSION['success'])) : ?>
        <script>
            var successMessage = "<?php echo $_SESSION['success']; ?>";
            alert(successMessage);
        </script>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <script>
            var successMessage = "<?php echo $_SESSION['error']; ?>";
            alert(successMessage);
        </script>
    <?php endif; ?>




        
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box">
                <div class="logo text-center mb-4">
                <img src="../assets/img/54.png" width="300" height="130" alt="southzaina">
                     <!-- <h2>เข้าสู่ระบบ</h2> -->
                </div>
                <form method="post" action="../db/login.php">
                            <div class="input group">
                                <input type="text" class="form-control custom-form" name="email" id="email" placeholder="อีเมล" required>
                            </div>
                            <div class="mb-3 mt-2">
                                <input type="password" class="form-control custom-form" name="password" id="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <div class="mb-2 text-center">
                            <?php

                            if(isset($_SESSION['login_error']) && $_SESSION['login_error']) {
                                echo '<div class="alert btn btn-danger mb-2 text" role="alert" style="width: 100%; padding: 5px;">อีเมล หรือ รหัสผ่าน ไม่ถูกต้อง!!</div>';

                                unset($_SESSION['login_error']);
                            }
                            ?>
                            </div>
                            <div class="mb-2 text-center">
                                <input type="submit" class="btn btn-primary  custom-btn " value="ลงชื่อเข้าใช้"><br>
                            </div>
                        </form>
                        <form method="post" action="register.php">
                            <div class="mb-3 text-center">
                                <input type="submit" class="btn btn-warning  custom-btn" value="สมัครสมาชิก" formaction="register.php">
                            </div>
                        </form>
                        <a href="../website.php" class="text-center " style="font-size: small;"><<<เข้าสู่หน้าเว็บไซต์</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
    session_destroy();
}

?>