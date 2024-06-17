<?php
include ("../include/headerAdmin.php");
include ("../include/sidebarAdmin.php");
include('../db/connect.php');

$query = "SELECT facebook, email, phone FROM contact WHERE id = 1";
$result = mysqli_query($conn, $query);
$contact = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $facebook = $_POST['facebook'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง (ต้องเป็นตัวเลข 10 หลัก)";
    }

    if (empty($errors)) {
        $query = "UPDATE contact SET facebook = ?, email = ?, phone = ? WHERE id = 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $facebook, $email, $phone);
        mysqli_stmt_execute($stmt);

        echo "ข้อมูลถูกอัปเดตเรียบร้อยแล้ว!";
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>

<body>
    <h1>แก้ไขข้อมูลติดต่อ</h1>
    <form method="POST" action="">
        <label for="facebook">Facebook:</label>
        <input type="text" id="facebook" name="facebook" value="<?php echo htmlspecialchars($contact['facebook']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>"><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" pattern="[0-9]{10}" title="กรุณากรอกตัวเลข 10 หลักเท่านั้น"><br>

        <div id="phone-error" class="box-alert" style="display: none;">
            ไม่สามารถกรอกเบอร์โทรศัพท์เกิน 10 หลักได้
        </div>

        <input type="submit" value="บันทึก">
    </form>

    <style>
        .box-alert {
            color: white;
            background-color: red;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(event) {
                var phoneInput = document.getElementById('phone');
                var phoneError = document.getElementById('phone-error');

                if (phoneInput.value.length > 10) {
                    phoneError.style.display = 'block'; // แสดงข้อความแจ้งเตือน
                    event.preventDefault(); // ยกเลิกการส่งฟอร์ม
                }
            });
        });
    </script>
</body>
</html>
