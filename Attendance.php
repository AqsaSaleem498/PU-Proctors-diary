<?php
session_start();
include "db.php";
$user_id=$_SESSION['user_id'];
$result=mysqli_query($conn,
"SELECT * FROM duties
WHERE user_id='$user_id'
AND status='Assigned'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Mark Attendance</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="table-box">
<h1>Mark Attendance</h1>

<form action="Attendance-save.php" method="POST">
<table>
<tr>
<th>Center</th>
<th>Date</th>
<th>Shift</th>
<th>Status</th>
<th>Attendance</th>
<th>Selfie</th>
<th>Action</th>
</tr>
<?php
while($row=mysqli_fetch_assoc($result)){
$attendance=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT attendance_status
FROM attendance
WHERE duty_id='".$row['id']."'
LIMIT 1")
);
?>
<tr>
<td>
<?php echo $row['center']; ?>
</td>
<td>
<?php echo $row['duty_date']; ?>
</td>
<td>
<?php echo $row['shift']; ?>
</td>
<td>
<?php
if($attendance){
echo $attendance['attendance_status'];
}
else{
echo "Pending";
}
?>
</td>
<td>
<select
name="attendance_status" id="attendance_status"
onchange="attendanceCheck()">
<option value="">Select</option>
<option value="Present">Present</option>
<option value="Absent">Absent</option>
</select>
</td>
<td>
<div id="camera-section" style="display:none;">
<video id="video" width="220" height="160" autoplay>
</video>
<br><br>
<button type="button" onclick="captureSelfie()">Capture Selfie
</button>
<canvas id="canvas" style="display:none;">
</canvas>
<input type="hidden" name="selfie_data" id="selfie_data">
</div>
</td>
<td>
<?php
if($attendance){
echo "<span style='color:blue;font-weight:bold;'>
Already Marked
</span>";
}
else{
?>
<input type="hidden"name="duty_id"value="<?php echo $row['id']; ?>">
<button type="submit">Mark Now</button>
<?php
}
?>
</td>
</tr>
<?php } ?>
</table>
</form>
</div>
<script src="Javascript.js"></script>
</body>
</html>