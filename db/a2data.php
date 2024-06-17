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
    $namework = $_POST["namework"];
    $researchcode = $_POST["ResearchCode"];
    $Job = $_POST["Job"];
    $agency = $_POST["agency"];
    $reason = $_POST["reason"];
    $Sdate = $_POST["Sdate"];
    $Edate = $_POST["Edate"];
    $time = $_POST["time"];
    $etime = $_POST["Etime"];
    $commentTime = $_POST["commentTime"];
    $StartDateTrip = $_POST["StartDateTrip"];
    $EndDateTrip = $_POST["EndDateTrip"];
    $dayoff = $_POST["dayoff"];
    $location = $_POST["location"];
    $aPayment = $_POST["apayment"];
    $expenses = $_POST["expenses"];
    $record_date = $_POST["record_date"];
    $totalDays =$_POST['totalDays'];
    $confirm = "รออนุมัติ";

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
        $uploadDir = "../Uploads/fileActivity2/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if ($file['size'] > 0) {
            $sql = "INSERT INTO activity2 (member_id,file,title,ativity,namework,ResearchCode,Job,agency,reason,Sdate,Edate,time,Etime,commentTime,StartDateTrip,EndDateTrip,dayoff,location,apayment,expenses,confirm,record_date,totalDays) 
            VALUES ('$member_id','$uploadDir','$title','$ativity','$namework','$researchcode','$Job','$agency','$reason','$Sdate','$Edate','$time','$etime','$commentTime','$StartDateTrip','$EndDateTrip','$dayoff','$location','$aPayment','$expenses','$confirm','$record_date','$totalDays')";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                $activity_id = mysqli_insert_id($conn);

                $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFileName =  'ID' .  $activity_id . '_' . 'activity2.' . $fileType;

                $uploadFile = $uploadDir . $newFileName;
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        
                    $sql = "UPDATE activity2 SET file = '$newFileName', title = '$title', ativity = '$ativity', namework = '$namework', ResearchCode = '$researchcode', Job = '$Job', agency = '$agency', reason = '$reason', Sdate = '$Sdate', Edate = '$Edate', time = '$time', Etime = '$etime', commentTime = '$commentTime', StartDateTrip = '$StartDateTrip', EndDateTrip = '$EndDateTrip', dayoff = '$dayoff', location = '$location', apayment = '$aPayment', expenses = '$expenses', record_date = '$record_date' WHERE activity_id = '$activity_id'";
        
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
