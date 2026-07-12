<?php
session_start();
include "db.php";
$user_id=$_SESSION['user_id'];
$duty_id=$_POST['duty_id'];
$status=$_POST['attendance_status'];
$selfie=$_FILES['selfie']['name'];
move_uploaded_file(
$_FILES['selfie']['tmp_name'],
"attendance-selfies/".$selfie);
$duty=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM duties
WHERE id='$duty_id'")
);
date_default_timezone_set("Asia/Karachi");
$current_time=date("H:i:s");
$timing=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM shift_timings
WHERE shift_name='".$duty['shift']."'")
);
$shift_start=$timing['start_time'];
$shift_end=$timing['end_time'];
if($current_time<$shift_start||$current_time>$shift_end){
echo "<script>
alert('Attendance Time Closed')
window.location='Attendance.php';
</script>";
exit();
}
$check=mysqli_query($conn,
"SELECT * FROM attendance
WHERE duty_id='$duty_id'
AND user_id='$user_id'");
if(mysqli_num_rows($check)>0){
echo "<script>
alert('Attendance Already Marked');
window.location='Attendance.php';
</script>";
exit();
}
mysqli_query($conn,
"INSERT INTO attendance(
duty_id,
user_id,
center,
duty_date,
shift,
attendance_status,
selfie,
attendance_time
)
VALUES(
'$duty_id',
'$user_id',
'".$duty['center']."',
'".$duty['duty_date']."',
'".$duty['shift']."',
'$status',
'$selfie',
NOW()
)");
echo "<script>
alert('Attendance Marked');
window.location='Attendance.php';
</script>";
if(!empty($_POST['selfie_data'])){
$image=$_POST['selfie_data'];
$image=str_replace(
'data:image/png;base64,','',$image);
$image=str_replace(' ','+',$image);
$fileName=time().".png";
file_put_contents("attendance-selfies/".$fileName,base64_decode($image)
);
}
?>