<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../include/headerAdmin.php';
include '../include/sidebarAdmin.php';
include '../checkstatus/status.php';
checkAdminStatus();

?>
<div class="container-fluid">
    <div class="row mt-md-4 mt-sm-2">

        <div class="col-md-3 mb-3">
            <div class="text-white">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>Facebook Accounts</h5>

                        <?php
            include '../db/connect.php';

            $sql = "SELECT facebook FROM contact";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><h4>" . htmlspecialchars($row['facebook']) . "</h4></p>";
                }
            } else {
                echo "<p>No Facebook accounts found</p>";
            }

            $conn->close();
            ?>
                    </div>
                    <div class="icon">
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <a class="small-box-footer"><i class="fa-brands fa-facebook"></i></i></a>
                </div>
            </div>


            <div class="text-white">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h5>Phone</h5>

                        <?php
            include '../db/connect.php';

            $sql = "SELECT phone FROM contact";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><h4>" . htmlspecialchars($row['phone']) . "</h4></p>";
                }
            } else {
                echo "<p>No phone found</p>";
            }

            $conn->close();
            ?>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <a class="small-box-footer"><i class="fa-solid fa-phone"></i></a>
                </div>
            </div>



            <div class="text-white">
            <div class="small-box" style="background-color: #ff0000; color: #ffffff;">
                    <div class="inner">
                        <h5>email</h5>

                        <?php
            include '../db/connect.php';

            $sql = "SELECT email FROM contact";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><h4>" . htmlspecialchars($row['email']) . "</h4></p>";
                }
            } else {
                echo "<p>No email found</p>";
            }

            $conn->close();
            ?>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <a class="small-box-footer"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $userstatus = $_POST['userstatus'];

    include '../db/connect.php';

    $checkEmailQuery = "SELECT * FROM contact WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        $updateStatusQuery = "UPDATE member SET userstatus = '$userstatus' WHERE email = '$email'";

        if ($conn->query($updateStatusQuery) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'User status updated.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(){
                    window.location.href = 'contact.php';
                });
            </script>";
            exit();
        } else {
            echo "Error updating user status: " . $conn->error;
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Email not found.',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    }

    $conn->close();
}
?>


        <div class="col-md-9 ">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mt-4">
                        <ion-icon name="person-add-outline"></ion-icon>
                    </h2>
                    <div class="row mt-md-4 mt-sm-2">
                        <h2 class="text-center">Edit contact</h2>
                        <div class="col-md-10">

                            <form method="post" action="">
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="email" class="form-control" type="text" name="email"
                                            placeholder="Enter user email" required />

                                    </div>

                                </div>
                        </div>

                        <div class="col-md-2">
                            <select name="userstatus" id="status" class="form-control" style="width: 100%; ">
                                <option value="facebook">facebook</option>
                                <option value="phone">phone</option>
                                <option value="email">email</option>
                            </select>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn btn-primary"><i class="fa-regular fa-floppy-disk"></i>
                                บันทึก</button>
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
</div>
<?php
include '../include/footer.php';
footer();
include  '../include/js.php'
?>
</body>

</html>