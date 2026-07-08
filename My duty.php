<?php
session_start();
include "db.php";
$user_id=$_SESSION['user_id'];
$result=mysqli_query($conn,
"SELECT * FROM duties
WHERE user_id='$user_id'
ORDER BY duty_date ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>My Duties</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<h1> My Duties</h1>
<select id="statusFilter" onchange="filterDuty()">
<option value="All">All</option>
<option value="Assigned">Assigned</option>
<option value="Completed">Completed</option>
</select>
<table id="dutyTable">
<tr>
<th>#</th>
<th>Exam Date</th>
<th>Shift</th>
<th>Center</th>
<th>Department</th>
<th>Status</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php echo $row['duty_date']; ?></td>
<td><?php echo $row['shift']; ?></td>
<td><?php echo $row['center']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>
<script src="Javascript.js"></script>
</body>
</html>