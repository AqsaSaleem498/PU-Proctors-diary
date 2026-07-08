<?php
session_start();
include "db.php";
include "Mail-Send.php";
if($_SESSION['role']!="admin"){
header("Location:Login.php");
exit();
}
/* DELETE DUTY */
if(isset($_POST['delete'])){
$duty_id=$_POST['duty_id'];
mysqli_query($conn,
"DELETE FROM duties
WHERE id='$duty_id'");
echo "<script>
alert('Duty Deleted Successfully');
window.location='A-manage duties.php';
</script>";
exit();
}
/* ASSIGN DUTY */
if(isset($_POST['assign'])){
$user_id=$_POST['user_id'];
$role=$_POST['role'];
$duty_date=$_POST['duty_date'];
$shift=$_POST['shift'];
$center=$_POST['center'];
$department=$_POST['department'];
/* SAVE DUTY */
mysqli_query($conn,
"INSERT INTO duties
(user_id,role,duty_date,shift,center,department,status)
VALUES('$user_id','$role','$duty_date','$shift','$center','$department',
'Assigned')");
/* SAVE NOTIFICATION */
$message="New Duty Assigned";
mysqli_query($conn,
"INSERT INTO notifications
(user_id,message)
VALUES
('$user_id','$message')");
/* GET USER DETAILS */
$user=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM users
WHERE id='$user_id'")
);
/* SEND EMAIL */
sendMail(
$user['email'],
"Duty Assigned",
"Dear ".$user['name'].",
A new duty has been assigned to you.
Please login to PU Proctors Diary and check My Duties.
Thank You"
/* ALERT */
);
echo "<script>
alert('Duty Assigned Successfully');
window.location='A-manage duties.php';
</script>";
}
/* USERS LIST */
$users=mysqli_query($conn,
"SELECT * FROM users
WHERE status='approved'
AND role!='admin'");
/* DUTIES LIST */
$duties=mysqli_query($conn,
"SELECT d.*,u.name
FROM duties d
JOIN users u
ON d.user_id=u.id");
/* count LIST */
$stats=mysqli_query($conn,
"SELECT center,department,
SUM(CASE
WHEN role='invigilator'
THEN 1 ELSE 0 END)
AS total_invigilators,
SUM(CASE
WHEN role='superintendent'
THEN 1 ELSE 0 END)
AS total_superintendents,
COUNT(*) AS total_teachers
FROM duties
GROUP BY center,department");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Duties</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<h1>Manage Duties</h1>
<form method="POST" onsubmit="return validateDuty()">
<select name="role" required>
<option value="">Select Role</option>
<option value="invigilator">Invigilator</option>
<option value="superintendent">Superintendent</option>
</select>
<select name="user_id" required>
<option value="">Select User</option>
<?php
while($user=mysqli_fetch_assoc($users)){
?>
<option value="<?php echo $user['id']; ?>">
<?php echo $user['name']; ?>
</option>
<?php } ?>
</select>
<input type="date" name="duty_date" required>
<select name="shift">
<option>Morning</option>
<option>Evening</option>
</select>
<input type="text" name="center" placeholder="Center" required>
<input type="text" name="department" placeholder="Department"
required>
<button type="submit" name="assign">Assign</button>
</form>
<table border="1">
<tr>
<th>#</th>
<th>User</th>
<th>Role</th>
<th>Date</th>
<th>Shift</th>
<th>Center</th>
<th>Department</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($duties)){
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['role']; ?></td>
<td><?php echo $row['duty_date']; ?></td>
<td><?php echo $row['shift']; ?></td>
<td><?php echo $row['center']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<form method="POST">
<input type="hidden" name="duty_id" value="<?php echo $row['id']; ?>">
<button type="submit" name="delete">Delete</button>
</form>
</td>
</tr>
<?php } ?>
</table>
<h2>Center & Department Wise Staff Count</h2>
<table border="1">
<tr>
<th>Center</th>
<th>Department</th>
<th>Invigilators</th>
<th>Superintendents</th>
<th>Total Teachers</th>
</tr>
<?php
while($row=mysqli_fetch_assoc($stats)){
?>
<tr>
<td><?php echo $row['center']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['total_invigilators']; ?></td>
<td><?php echo $row['total_superintendents']; ?></td>
<td><?php echo $row['total_teachers']; ?></td>
</tr>
<?php } ?>
</table>
<script src="Javascript.js"></script>
</body>
</html>