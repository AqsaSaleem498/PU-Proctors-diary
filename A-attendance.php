<?php
session_start();
include "db.php";
$result=mysqli_query($conn,
"SELECT attendance.*,
users.name,
users.role
FROM attendance
JOIN users
ON attendance.user_id=users.id
ORDER BY attendance.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Verify Attendance</title>
<link rel="stylesheet"href="Style.css"></head>
<body>
<?php include "navbar.php"; ?>
<h1>Attendance Records</h1>
<table>
<tr>
<th>#</th>
<th>User</th>
<th>Role</th>
<th>Date</th>
<th>Shift</th>
<th>Center</th>
<th>Check In</th>
<th>Status</th>
<th>Selfie</th>
<th>Update</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td>
<?php echo $count++; ?>
</td>
<td>
<?php echo $row['name']; ?>
</td>
<td>
<?php echo $row['role']; ?>
</td>
<td>
<?php echo $row['duty_date']; ?>
</td>
<td>
<?php echo $row['shift']; ?>
</td>
<td>
<?php echo $row['center']; ?>
</td>
<td>
<?php echo $row['attendance_time']; ?>
</td>
<td>
<?php echo $row['attendance_status']; ?>
</td>
<td>
<img src="attendance-selfies/<?php echo $row['selfie']; ?>"width="80">
</td>
<td>
<form action="Update-attendance.php" method="POST">
<input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
<select name="status">
<option value="Verified">Verified</option>
<option value="Absent">Absent</option>
</select>
<button type="submit">Update</button>
</form>
</td>
</tr>
<?php } ?>
</table>
<script src="Javascript.js"></script>
</body>
</html>