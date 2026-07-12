<?php
include "db.php";
$id=$_POST['attendance_id'];
$status=$_POST['status'];
mysqli_query($conn,
"UPDATE attendance
SET attendance_status='$status'
WHERE id='$id'");
header(
"Location:A-attendance.php"
);
?>