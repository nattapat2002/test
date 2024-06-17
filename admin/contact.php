<?php
    include '../include/headerAdmin.php';
    include '../include/sidebarAdmin.php';
    include '../checkstatus/status.php';
    include('../db/connect.php');
    checkAdminStatus();
?>
<?php
     $query = "SELECT facebook, email, phone , line FROM contact WHERE id = 1";
     $result = mysqli_query($conn, $query);
     $contact = mysqli_fetch_assoc($result);
     
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
         $facebook = $_POST['facebook'];
         $email = $_POST['email'];
         $phone = $_POST['phone'];
         $line =  $_POST['line'];
     
         $errors = [];
     
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
         }
     
         if (!preg_match('/^[0-9]{9,10}$/', $phone)) {
            $errors[] = "รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง (ต้องเป็นตัวเลข 9 หรือ 10 หลัก)";
        }
        
         if (empty($errors)) {
            $query = "UPDATE contact SET facebook = ?, email = ?, phone = ?, line = ? WHERE id = 1";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssss', $facebook, $email, $phone, $line);
            mysqli_stmt_execute($stmt);
            
    
         } else {
             foreach ($errors as $error) {
                 echo "<p>$error</p>";
             }
         }
     }
     ?>
<!-- Page content-->
<div class="container-fluid">
    <div class="card w-100 mt-1 ">
        <div class="card-body">
            <div class="row">
                <h1 class="text-center mt-2 mb-4"><i class="fa-regular fa-pen-to-square"></i> แก้ไขข้อมูลติดต่อ</h1>
                <div class="col-md-4">

                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class='fa-brands fa-facebook'></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Facebook</b></span>
                            <?php
                            include '../db/connect.php';

                            $sql = "SELECT facebook FROM contact";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<h5> Name: " . htmlspecialchars($row['facebook']) . "  </h5>";
                                }
                            } else {
                                echo "<p>No Facebook accounts found</p>";
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class='fa-solid fa-phone'></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Phone</b></span>
                            <?php
                            include '../db/connect.php';

                            $sql = "SELECT phone FROM contact";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<h5> Tel: " . htmlspecialchars($row['phone']) . "  </h5>";
                                }
                            } else {
                                echo "<p>No Tel. phone found</p>";
                            }

                            $conn->close();
                            ?>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-danger text-light"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Email</b></span>
                            <?php
                            include '../db/connect.php';

                            $sql = "SELECT email FROM contact";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<h5>  " . htmlspecialchars($row['email']) . "  </h5>";
                                }
                            } else {
                                echo "<p>No email adddress found</p>";
                            }

                            $conn->close();
                            ?>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <div class="info-box">
                        <span class="info-box-icon bg-green text-light"><i class="fa-brands fa-line"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Line</b></span>
                            <?php
                            include '../db/connect.php';

                            $sql = "SELECT line FROM contact";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<h5>  " . htmlspecialchars($row['line']) . "  </h5>";
                                }
                            } else {
                                echo "<p>No line adddress found</p>";
                            }

                            $conn->close();
                            ?>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                </div>
                <div class="col-md-8">
                    <form method="POST" action="">
                        <label for="facebook">Facebook:</label>
                        <input class="form-control" type="text" id="facebook" name="facebook"
                            value="<?php echo htmlspecialchars($contact['facebook']); ?>"><br>

                        <label for="phone">Phone:</label>
                        <input class="form-control" type="text" id="phone" name="phone"
                            value="<?php echo htmlspecialchars($contact['phone']); ?>" pattern="[0-9]{10}"
                            title="กรุณากรอกตัวเลข 10 หลักเท่านั้น"><br>

                        <label for="email">Email:</label>
                        <input class="form-control" type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($contact['email']); ?>"><br>

                        <label for="line">Line:</label>
                        <input class="form-control" type="line" id="line" name="line"
                            value="<?php echo htmlspecialchars($contact['line']); ?>"><br>

                        <div class="box-alert">
                            <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (empty($errors)) {
                                echo '<div class="alert alert-success">ข้อมูลถูกอัปเดตเรียบร้อยแล้ว!</div>';
                            } else {
                                foreach ($errors as $error) {
                                    echo "<p>$error</p>";
                                }
                            }
                        }
                        ?>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-outline-primary btn custom-button-width" value="บันทึก">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const alertBox = document.querySelector('.box-alert');

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($errors)) {
                echo "alertBox.innerHTML = '<div class=\"alert alert-success\">ข้อมูลถูกอัปเดตเรียบร้อยแล้ว!</div>';";
                echo "setTimeout(function() { alertBox.innerHTML = ''; }, 3000);";
            } else {
                foreach ($errors as $error) {
                    echo "alertBox.innerHTML += '<p>$error</p>';";
                }
            }
        }
        ?>
});
</script>


<?php
    include '../include/footer.php';
    footer();
    include('../include/js.php');
?>
</body>

</html>