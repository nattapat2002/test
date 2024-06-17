<?php
session_start();
include_once 'connect.php';
include '../include/header.php';
include '../include/alert.php';

if (isset($_SESSION['userid'])) {
    $member_id = $_SESSION['userid'];

    $file = isset($_POST['file']) ? $_POST['file'] : '';
    $type = $_POST['type'];
    $typeOther = $_POST['typeOther'];
    $title = $_POST['title'];
    $agency = $_POST['agency'];
    $travel = $_POST['travel'];
    $Sdate = $_POST['Sdate'];
    $Edate = $_POST['Edate'];
    $time = $_POST['time'];
    $Etime = $_POST['Etime'];
    $commentTime = $_POST['commentTime'];
    $StartDateTrip = $_POST['StartDateTrip'];
    $EndDateTrip = $_POST['EndDateTrip'];
    $location = $_POST['location'];
    $confirm = "รออนุมัติ";
    $record_date = $_POST["record_date"];
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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
        $uploadDir = "../Uploads/fileActivity3/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        if ($file['size'] > 0) {
            $sql = "INSERT INTO activity3 (member_id,file, type, typeOther, title, agency, travel, Sdate, Edate, time, Etime, commentTime, StartDateTrip, EndDateTrip, location, confirm, record_date) 
                    VALUES ('$member_id','$uploadDir', '$type', '$typeOther', '$title', '$agency', '$travel', '$Sdate', '$Edate', '$time', '$Etime', '$commentTime', '$StartDateTrip', '$EndDateTrip', '$location','$confirm', '$record_date')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $activity_id = mysqli_insert_id($conn);
    
                $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName =  'ID' .  $activity_id . '_activity3.' . $fileType;
    
                $uploadFile = $uploadDir . $newFileName;
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {

                    $sql = "UPDATE activity3 SET file = '$newFileName', type = '$type', typeOther = '$typeOther', title = '$title', agency = '$agency', travel = '$travel', Sdate = '$Sdate', Edate = '$Edate', time = '$time', Etime = '$Etime', commentTime = '$commentTime', StartDateTrip = '$StartDateTrip', EndDateTrip = '$EndDateTrip', location = '$location', confirm = '$confirm', record_date = '$record_date' WHERE activity_id = '$activity_id'";
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        echo $success;
                    } else {
                        echo 'เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล';
                    }
                } else {
                    echo 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
                }
            } else {
                echo 'เกิดข้อผิดพลาดในการบันทึกข้อมูลกิจกรรม';
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
