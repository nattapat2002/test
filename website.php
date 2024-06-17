<?php include 'headerAdmin.php';?>
<?php include 'include/navbar.php';?>
<?php include 'include/alert.php';?>



<style>
.product-container {
    display: flex;
    flex-wrap: wrap;
}

.product-buttons {
    text-align: left;
}

.product-box {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    width: calc(20% - 30px);
    text-align: left;
    transition: transform 0.2s ease-in-out;
}

.product-box:hover {
    transform: scale(1.05);
}

.product-box img {
    max-width: 100%;
    height: auto;
}

.carousel-item img {
    width: 800px;
    height: 500px;
    object-fit: cover;
}

.carousel {
    max-width: 800px;
    margin: auto;
}

@media (max-width: 1024px) {
    .product-box {
        width: calc(50% - 30px);
        /* Two per row */
    }
}

@media (max-width: 768px) {
    .product-box {
        width: calc(50% - 30px);
        /* Two per row */
    }
}

@media (max-width: 576px) {
    .product-box {
        width: calc(100% - 30px);
        /* One per row */
    }
}
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <header>

            </header>




            <!-- slideHomePage -->
            <section class="page-section mt-4 mb-4" id="homepage">
                <div class="card-body">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/img/slide1.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/szn.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="assets/img/1.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>

                </div>
            </section>




            <!-- Product All -->
            <hr class="page-section mt-4 mb-4" id="product">
            <h3 class="text-center mt-5 mb-5">สินค้าทั้งหมด</h3>
            <hr class="diviver" />
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn btn bg-gradient-info  filter-button" data-filter="all">ทั้งหมด</button>
                            <button class="btn btn bg-gradient-info  filter-button" data-filter="มู่ลี่">มูลี่</button>
                            <button class="btn btn bg-gradient-info  filter-button" data-filter="กระถาง">กระถาง</button>
                            <button class="btn btn bg-gradient-info  filter-button" data-filter="ม่านม้วน">ม่าน</button>
                        </div>



                        <div class="col-md-2">
                            <h6>
                                <li class="fas fa-cart-plus fa-lg mr-2"></li> สินค้าทั้งหมด:
                            </h6>
                        </div>

                    </div>
                </div>
            </div>

            <?php
include 'db/connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, name_product, details, price, pic, color, code_product, type FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {            
    echo "<div class='product-container' >";
    while ($row = $result->fetch_assoc()) {
        $details = strlen($row["details"]) > 100 ? substr($row["details"], 0, 100) . "..." : $row["details"];

        echo "<div class='card product-box' style='cursor: pointer;' data-toggle='modal' data-target='#productModal" . $row["product_id"] . "'>";
        echo "<div class='product-details' >";
        echo "<table>";
        echo "<tr>";
        echo "<td><img src='Uploads/" . $row["pic"] . "' alt='" . $row["name_product"] . "'><br>";
        echo "<b>ชื่อ:</b> " . $row["name_product"] . "<br>";
        echo "<b>รายละเอียด:</b> " . $details . "<br>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
         echo "<div class='product-buttons ml-2 mb-1'>";
        echo " <b style ='color:red'>฿ " . $row["price"] . "</b>";
        echo "</div>";
        echo "</div>";
        

        // Modal for each product
        echo "<div class='modal fade' id='productModal" . $row["product_id"] . "' tabindex='-1' role='dialog' aria-labelledby='productModalLabel" . $row["product_id"] . "' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='productModalLabel" . $row["product_id"] . "'>" . $row["name_product"] . "</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <img src='Uploads/" . $row["pic"] . "' alt='" . $row["name_product"] . "' style='max-width: 100%;'><br><br>
                            <b>ประเภท</b> " . $row["type"] . "<br>
                            <b>รหัสสินค้า:</b> " . $row["code_product"] . "<br>
                            <b>ชื่อ:</b> " . $row["name_product"] . "<br>
                            <b>รายละเอียด:</b> " . $row["details"] . "<br>
                            <b>สี:</b> " . $row["color"] . "<br>
                            <b>ราคา:</b> ฿ " . $row["price"] . "<br>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        </div>
                    </div>
                </div>
              </div>";

        echo "<div class='modal fade' id='productModal" . $row["product_id"] . "' tabindex='-1' role='dialog' aria-labelledby='productModalLabel" . $row["product_id"] . "' aria-hidden='true'>
                <div class='modal-dialog modal-lg' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='productModalLabel" . $row["product_id"] . "'>" . $row["name_product"] . "</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <div class='text-center'>
                                <img src='Uploads/" . $row["pic"] . "' alt='" . $row["name_product"] . "' class='img-fluid rounded'>
                            </div>
                            <div class='mt-3'>
                                <strong>Name:</strong> " . $row["type"] . "<br>
                                <strong>Name:</strong> " . $row["name_product"] . "<br>
                                <strong>Details:</strong> " . $row["details"] . "<br>
                                <strong>Price:</strong> " . $row["price"] . " ฿<br>
                                <strong>Color:</strong> " . $row["color"] . "<br>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
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
        </section>




        <section id="contact">
            <h3 class="text-center"> ติดต่อเรา</h3>
            <hr class="divider" />
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class='fa-brands fa-facebook'></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Facebook</b></span>
                            <?php
                            include 'db/connect.php';

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

                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class='fa-solid fa-phone'></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Phone</b></span>
                            <?php
                            include 'db/connect.php';

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
                </div>


                <div class="col-md-4">
                    <div class="info-box"> 
                        <span class="info-box-icon bg-danger text-light"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Email</b></span>
                            <?php
                            include 'db/connect.php';

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
                </div>

            
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-green text-light"><i class="fa-brands fa-line"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Line</b></span>
                            <?php
                            include 'db/connect.php';

                            $sql = "SELECT line FROM contact";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<h5>  " . htmlspecialchars($row['line']) . "  </h5>";
                                }
                            } else {
                                echo "<p>No line found</p>";
                            }

                            $conn->close();
                            ?>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>


            </div>

            <h3 class="text-center mt-4 mb-4">ตำเหน่งที่ตั้ง</h3>
            <hr class="divider" />
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d830.9120841805254!2d98.37088835052823!3d7.841962850284303!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30502f8abd6e1595%3A0xa15aa56e4b3337d7!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4i-C4suC4l-C5jOC5gOC4i-C4meC5iOC4suC4geC4o-C4uOC5iuC4myDguIjguLPguIHguLHguJQgLyBTT1VUSCBaQUlOQSBHUk9VUCBDTy4sTFRELg!5e0!3m2!1sth!2sth!4v1718086954653!5m2!1sth!2sth"
                        width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            </sectio>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>