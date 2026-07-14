<?php
session_start();
include "db.php";
$user_id=$_SESSION['user_id'];
$result=mysqli_query($conn,
"SELECT payments.*,
users.role
FROM payments
JOIN users
ON payments.user_id=users.id
WHERE payments.user_id='$user_id'
ORDER BY payments.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>My Payment</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="table-box">
<h1>Payment Status</h1>
<table>
<tr>
<th>#</th>
<th>Role</th>
<th>Completed Duties</th>
<th>Per Duty Amount</th>
<th>Total Payment</th>
<th>Status</th>
<th>Payment Date</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php echo $row['role']; ?></td>
<td><?php echo $row['total_duties']; ?></td>
<td><?php echo $row['rate_per_duty']; ?></td>
<td><?php echo $row['total_amount']; ?></td>
<td><?php
if($row['status']=="Paid"){
echo "<span class='paid'>
Paid
</span>";
}
else{
echo "<span class='pending'>
Pending
</span>";
}
?>
</td>
<td>
<?php
if($row['payment_date']!=""){
echo $row['payment_date'];
}
else{
echo "-";
}
?>
</td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>