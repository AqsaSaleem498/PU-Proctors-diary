<?php
session_start();
include "db.php";
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['name'];
/* TOTAL DUTIES */
$duty_query=mysqli_query($conn,
"SELECT * FROM duties
WHERE user_id='$user_id'");
?>
<!DOCTYPE html>
<html>
<head>
<title>
Superintendent Dashboard
</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="dashboard-container">
<h2>Superintendent-Dashboard</h2>
<div id="welcomeMessage">Welcome Back,
<?php cho $_SESSION['name'] ?? 'User'; ?>
</div>
<div class="table-box">
<h2 class="heading">Your Assigned Duties</h2>
<table>
<tr>
<th>Date</th>
<th>Shift</th>
<th>Center</th>
<th>Room No</th>
<th>Status</th>
</tr>
<?php
while($row=mysqli_fetch_assoc($duty_query)){
?>
<tr>
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
<?php
echo isset($row['room_no'])
? $row['room_no']
: 'Not Assigned';
?>
</td>
<td>
<?php echo $row['status']; ?>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<script src="Javascript.js"></script>
</body>
</html>