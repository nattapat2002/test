<?php
    $success = '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "อัพเดตข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = "../admin/product1.php";
        });
    });
</script>';

$success1 = '<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        position: "top-center",
        icon: "success",
        title: "ลบสำเร็จ",
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = "../admin/product1.php";
    });
});
</script>';









$successmaill3 = '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "ส่งเมลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = "../showActivity3.php";
        });
    });
</script>';

?>

<?php
    $successfull = '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "อัพเดตข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        })
    });
</script>';
