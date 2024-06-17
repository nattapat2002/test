<?php
session_start();
include_once 'connect.php';
include '../include/header.php';
include '../include/alert.php';

if (isset($_SESSION['userid'])) {
    $member_id = $_SESSION['userid'];

    $file = isset($_POST['file']) ? $_POST['file'] : '';
    $title = $_POST["title"];
    $ativity = $_POST["ativity"];
    $agency = $_POST["agency"];
    $sdate = $_POST["Sdate"];
    $edate = $_POST["Edate"];
    $time = $_POST["time"];
    $Etime = $_POST["Etime"];
    $location = $_POST["location"];
    $reason = $_POST["reason"];
    $other = $_POST["other"];
    $commentTime = $_POST["commentTime"];
    $record_date = $_POST["record_date"];
    $totalDays = $_POST["totalDays"];


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['delete'])) {
        $activity_id_to_delete = $_POST['delete'];

        $sql_delete = "DELETE FROM activity1 WHERE activity_id = '$activity_id_to_delete'";
        $result_delete = mysqli_query($conn, $sql_delete);

        if($result_delete) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "ลบข้อมูลสำเร็จ",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = window.history.back();
                    });
                });
            </script>';
            exit;
        } else {
            $_SESSION['error'] = "ไม่สามารถลบข้อมูลได้";
        }
    }


    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = array(
            'png', 'PNG', 'jpeg', 'JPEG', 
            'jpg', 'JPG', 'pdf', 'PDF', 
            'docx', 'DOCX', 'xlsx', 'XLSX', 
            'gif', 'GIF', 'txt', 'TXT', 
        );
        if (!in_array($fileType, $allowedExtensions)) {
            die('Error: รองรับเฉพาะไฟล์ประเภท: PNG, JPEG, JPG, PDF, JFIF, DOCX, XLSX');
        }
        $uploadDir = "../Uploads/fileActivity1/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if ($file['size'] > 0) {
            $sql = "INSERT INTO activity1 (member_id) VALUES ('$member_id')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $activity_id = mysqli_insert_id($conn);

                $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName =  'ID' .  $activity_id . '_' . 'activity1.' . $fileType;

                $uploadFile = $uploadDir . $newFileName;
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    $confirm = "รออนุมัติ";
        
                    $sql = "UPDATE activity1 SET file = '$newFileName', title = '$title', ativity = '$ativity', agency = '$agency', Sdate = '$sdate', Edate = '$edate', time = '$time', Etime = '$Etime', commentTime = '$commentTime', location = '$location', reason = '$reason', other = '$other', confirm = '$confirm', record_date = '$record_date', totalDays = '$totalDays' WHERE activity_id = '$activity_id'";
        
                    $result = mysqli_query($conn, $sql);
        
                    if ($result) {
                        echo $success;
                    } else {
                        $_SESSION['error'] = "ไม่สามารถอัปเดตข้อมูลกิจกรรมได้";
                    }
                } else {
                    echo 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                }
            } else {
                echo 'เกิดข้อผิดพลาดในการสร้างกิจกรรม';
            }
        } else {
            echo 'ไม่มีไฟล์ที่อัปโหลด';
        }
    } else {
        echo 'ไม่มีไฟล์ที่อัปโหลด';
    }

    mysqli_close($conn);
} else {
    echo 'ไม่พบ member_id ในเซสชัน';
}
?>
