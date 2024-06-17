<?php 
    session_start();
    require_once "connect.php";

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('รูปแบบอีเมลไม่ถูกต้อง');</script>";
        } else {
            $user_check = "SELECT * FROM member WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check);
            $user = mysqli_fetch_assoc($result);

            if ($user['email'] === $email) {
                echo "<script>alert('ชื่อผู้ใช้มีอยู่แล้ว');</script>";
            } else {
                if (strlen($phone) !== 10 || !is_numeric($phone)) {
                    echo "<script>alert('เบอร์โทรต้องมี 10 ตัว');</script>";
                } else {
                    $passwordenc = md5($password);
                    $query = "INSERT INTO member (email, password, fname, lname , phone, userstatus)
                                VALUE ('$email', '$passwordenc', '$fname', '$lname', '$phone', 'user')";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
                        header("Location: login-index.php");
                    } else {
                        $_SESSION['error'] = "บางอย่างผิดพลาด";
                        header("Location:../index.php");
                    }
                }
            }
        }
    }
?>

<?php
    include '../include/header.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box">
                <div class="logo text-center mb-4">
                <img src="../assets/img/54.png" width="300" height="130" alt="southzaina">
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                
                    <div class="form-group mb-2">
                        <input type="text" style="width: 100%;" class="form-control" name="fname" id="fname" placeholder="ชื่อ" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" style="width: 100%;" class="form-control" name="lname" id="lname" placeholder="นามสกุล" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" style="width: 100%;" class="form-control" name="email" id="email" placeholder="อีเมล" required> 
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" style="width: 100%;" class="form-control" name="phone" id="phone" placeholder="หมายเลขโทรศัพท์" required> 
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" style="width: 100%;" name="password" id="password" placeholder="สร้างรหัสผ่าน" required> 
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-warning custom-btn" style="width: 30%;"  name="submit" value="สมัครสมาชิก">
                    </div>
                    <p class="text-center" style="font-size: 16px;">เป็นสมาชิกอยู่แล้ว? <a href="login-index.php" class="text" style="font-size: 16px;">เข้าสู่ระบบ</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>