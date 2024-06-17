<?php
include '../include/headerAdmin.php';
include '../include/sidebarAdmin.php';
include '../checkstatus/status.php';
include '../include/alert.php';
include '../db/connect.php';
checkAdminStatus();
?>

<!-- จำนวนสินค้า -->
<?php
    $sql = "SELECT COUNT(*) as total FROM Product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalProducts = $row['total'];
    } else {
        $totalProducts = 0;
    }
?>



<body>
    <div class="container-fluid mt-0">

        <header class="mt-2 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 ">
                            <button class="btn btn-app ">Show All</button>
                            <button class="btn btn-app ">มูลี่</button>
                            <button class="btn btn-app ">ม่านม้วน</button>
                            <button class="btn btn-app ">กระถาง</button>
                        </div>


                        <div class="col-md-2">
                            <h6>
                                <li class="fas fa-cart-plus fa-lg mr-2"></li> สินค้าทั้งหมด:
                                <?php echo $totalProducts; ?> รายการ</b>
                            </h6>
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                    <i class="fa-solid fa-plus"></i> เพิ่มสินค้า
                </button>
            </div>
            <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้าใหม่</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- ฟอร์มเพิ่มสินค้า -->
                            <form action="../db/addProduct.php" method="post" enctype="multipart/form-data">
                                <label for="pic">รูปภาพ:</label><br>
                                <input type="file" id="pic" name="pic" class="form-control"
                                    onchange="displaySelectedImage(this)">
                                <br>
                                <img id="selectedImage" src="#" alt="Selected Image"
                                    style="display: none; max-width: 200px; max-height: 200px;">

                                <div class="form-group">
                                    <label for="type">ประเภทสินค้า:</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">เลือกประเภทสินค้า</option>
                                        <option value="มู่ลี่">มูลี่</option>
                                        <option value="มู่ลี่">กระถาง</option>
                                        <!-- <option value="home_appliances">เครื่องใช้ไฟฟ้าในบ้าน</option>
                                        <option value="books">หนังสือ</option> -->

                                    </select>
                                </div>
                                <label for="type">ชื่อสินค้า:</label><br>
                                <input type="text" id="name_product" name="name_product" class="form-control">
                                <label for="code_product">รหัสสินค้า:</label><br>
                                <input type="text" id="code_product" name="code_product" class="form-control">
                                <label for="details">รายละเอียด:</label><br>
                                <textarea id="details" name="details" class="form-control"></textarea>
                                <label for="price">ราคา:</label><br>
                                <input type="number" id="price" name="price" class="form-control">

                                <label for="color">สี:</label><br>
                                <input type="text" id="color" name="color" class="form-control"><br>
                                <input type="submit" value="บันทึก" class="btn btn-primary ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <div clas="card">

            <?php
  

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['update_product'])) {
        //  อัพเดตสินค้าา
            $product_id = $_POST['product_id'];
            $name_product = $_POST['name_product'];
            $details = $_POST['details'];
            $price = $_POST['price'];
            $color = $_POST['color'];
            $type = $_POST['type'];
            $code_product = $_POST['code_product'];

            $pic = "";
            if ($_FILES["pic"]["name"] != "") {
                $target_dir = "../Uploads/";
                $target_file = $target_dir . basename($_FILES["pic"]["name"]);
                move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
                $pic = $target_file;
            }

            $sql = "UPDATE product SET name_product='$name_product', details='$details', price='$price', color='$color', code_product='$code_product', type='$type'";
            if ($pic != "") {
                $sql .= ", pic='$pic'";
            }
            $sql .= " WHERE product_id='$product_id'";

            if ($conn->query($sql) === TRUE) {
                echo $success;
            } else {
                echo "มีข้อผิดพลาดในการอัพเดตข้อมูล: " . $conn->error;
            }
        } else {
            $name_product = $_POST['name_product'];
            $details = $_POST['details'];
            $price = $_POST['price'];
            $color = $_POST['color'];
            $code_product = $_POST['code_product'];

            $target_dir = "../Uploads/";
            $target_file = $target_dir . basename($_FILES["pic"]["name"]);
            move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
            $pic = $target_file;

            $sql = "INSERT INTO product (name_product, details, price, pic, color,code_product)
            VALUES ('$name_product', '$details', '$price', '$pic', '$color' ,'$code_product')";

            if ($conn->query($sql) === TRUE) {
                echo $success;
            } else {
                echo "มีข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
            }
        }
    }

    $sql = "SELECT product_id, name_product, details, price, pic, color , code_product ,service, type FROM product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='product-container'>";
while ($row = $result->fetch_assoc()) {
    $details = strlen($row["details"]) > 100 ? substr($row["details"], 0, 100) . "..." : $row["details"];

     echo "<div class='card product-box'  >
         <div class='product-details' style='cursor: pointer;' data-toggle='modal' data-target='#productModal" . $row["product_id"] . "'>
             <img src='../Uploads/" . $row["pic"] . "' alt='" . $row["name_product"] . "'> <br><br>
             <b>ประเภท:</b>" .$row["type"]." <br>
             <b>ชื่อ:</b> " . $row["name_product"] . " <br>
             <b>รายละเอียด:</b> " . $details . " <br>
             <b>ราคา:</b> " . $row["price"] . " ฿ <br>
             <b>สี:</b> " . $row["color"] . " <br> 
         </div>
         <div class='product-buttons m-3'>
             <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#productModal" . $row["product_id"] . "'><i class='fa-solid fa-eye'></i> </button>
             <button type='button' class='btn btn-warning ml-2' data-toggle='modal' data-target='#editProductModal" . $row["product_id"] . "'><i class='fa-solid fa-pen-to-square'></i></button>
             <button type='button' class='btn btn-danger ml-2' data-toggle='modal' data-target='#deleteProductModal" . $row["product_id"] . "'><i class='fa-solid fa-trash'></i></button>";
             
             $service = $_POST['service'] ?? 0;

if ($service == 0) {
    echo "<button type='button' class='btn btn-secondary ml-2' onclick='makeCardOpaque(this)'><i class='fa-solid fa-ban'></i> </button>";
} elseif ($service == 1) {
    echo "<button type='button' class='btn btn-success ml-2' onclick='makeCardOpaque(this)'><i class='fa-solid fa-circle-check'></i> พร้อมให้บริการ </button>";
} else {
    echo "ค่า service ไม่ถูกต้อง";
}
echo "</div>
       </div>";

    //  รายละเอียดสินค้า
            echo "<div class='modal fade' id='productModal" . $row["product_id"] . "' tabindex='-1' role='dialog' aria-labelledby='productModalLabel" . $row["product_id"] . "' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='productModalLabel" . $row["product_id"] . "'>Product Details</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <img src='../Uploads/" . $row["pic"] . "' alt='" . $row["name_product"] . "' class='img-fluid'><br><br>
                                <strong>ประเภท: </strong> " . $row ["type"] ." <br>
                                <strong>Name:</strong> " . $row["name_product"] . "<br>
                                <strong>รหัสสินค้า:</strong> " . $row["code_product"] . "<br>
                                <strong>Details:</strong> " . $row["details"] . "<br>
                                <strong>Price:</strong> " . $row["price"] . " ฿<br>
                                <strong>Color:</strong> " . $row["color"] . "<br>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>
                  </div>";

                //   ลบสินค้า
            echo "<div class='modal fade' id='deleteProductModal" . $row["product_id"] . "' tabindex='-1' role='dialog' aria-labelledby='editProductModalLabel" . $row["product_id"] . "' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='editProductModalLabel" . $row["product_id"] . "'>ลบสินค้า: " . $row["name_product"] . "</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p>คุณแน่ใจหรือไม่ที่จะลบสินค้านี้: " . $row["name_product"] . "?</p>
                    </div>
                    <div class='modal-footer'>
                        <form action='delete_product.php' method='POST'>
                            <input type='hidden' name='code_product' value='" . $row["code_product"] . "'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>ยกเลิก</button>
                            <button type='submit' class='btn btn-danger'>ลบสินค้า</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

        // อัพเดต
            echo "<div class='modal fade' id='editProductModal" . $row["product_id"] . "' tabindex='-1' role='dialog' aria-labelledby='editProductModalLabel" . $row["product_id"] . "' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editProductModalLabel" . $row["product_id"] . "'>Edit Product</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form action='' method='post' enctype='multipart/form-data'>
                                    <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                                    <label for='pic'>รูปภาพ:</label>
                                    <input type='file' id='pic' name='pic' class='form-control'><br>
                                    <label for='type'>ประเภท:</label>
                                    <input type='text' id='type' name='type' class='form-control' value='" . $row["type"] . "'>
                                    <label for='name_product'>ชื่อสินค้า:</label>
                                    <input type='text' id='name_product' name='name_product' class='form-control' value='" . $row["name_product"] . "'>
                                     <label for='name_product'>รหัสสินค้า:</label>
                                    <input type='text' id='code_product' name='code_product' class='form-control' value='" . $row["code_product"] . "'>
                                    <label for='details'>รายละเอียด:</label>
                                    <textarea id='details' name='details' class='form-control'>" . $row["details"] . "</textarea>
                                    <label for='price'>ราคา:</label>
                                    <input type='number' id='price' name='price' class='form-control' value='" . $row["price"] . "'>
                                    <label for='color'>สี:</label>
                                    <input type='text' id='color' name='color' class='form-control' value='" . $row["color"] . "'><br>
                                    <input type='submit' name='update_product' value='บันทึก' class='btn btn-primary'>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>";
        }
        echo "</div>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>



        </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script>
    function makeCardOpaque(button) {
        var card = button.closest('.card');
        card.classList.toggle('opaque');
    }
    </script>
    <script>
    function displaySelectedImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('selectedImage').setAttribute('src', e.target.result);
                document.getElementById('selectedImage').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('selectedImage').setAttribute('src', '#');
            document.getElementById('selectedImage').style.display = 'none';
        }
    }
    </script>

    <?php
    include '../include/footer.php';
    footer();
    include  '../include/js.php'
    ?>
</body>

</html>