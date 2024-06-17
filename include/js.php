<?php
    include 'header.php';
    if (!isset($_SESSION['userstatus'])) {
        echo "<html><head><title>Not Logged In</title></head><body>";
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Error404',
                  text: 'กรุณาเข้าสู่ระบบ',
                  showConfirmButton: false, // Remove the OK button
                  footer: '<a href=\"../db/login-index.php  \" class=\"btn btn-primary\">เข้าสู่ระบบ</a>'
                });
              </script>";
        echo "</body></html>";
        exit();
    }
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show all products initially
        $(".product-box").show();

        $(".filter-button").click(function() {
            // Remove 'active' class from all filter buttons
            $(".filter-button").removeClass("active");
            
            // Add 'active' class to the clicked filter button
            $(this).addClass("active");

            var filterValue = $(this).attr('data-filter');

            // Hide all product boxes first
            $(".product-box").hide();

            // Show products based on the selected filter
            if (filterValue === 'all') {
                $(".product-box").show(); // Show all products
            } else {
                $(".product-box").each(function() {
                    var productType = $(this).find('.type').text().trim();

                    if (productType === filterValue) {
                        $(this).show(); // Show products matching the filter
                    }
                });
            }
        });
    });
</script>




<script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>



