<?php
session_start();
include "db.php";
$payment_rates=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM payment_rates LIMIT 1")
);
$inv_rate=$payment_rates['invigilator_rate'] ?? 500;
$sup_rate=$payment_rates['superintendent_rate'] ?? 700;
$result=mysqli_query($conn,
"SELECT
users.id,
users.name,
users.role,
attendance.center,
COUNT(attendance.id) AS total_duties,
MAX(payments.status) AS status
FROM attendance
JOIN users
ON attendance.user_id=users.id
LEFT JOIN payments
ON users.id=payments.user_id
AND attendance.center=payments.center
AND payments.session_year=YEAR(CURDATE())
WHERE attendance.attendance_status='Verified'
GROUP BY users.id,attendance.center");
?>
<!DOCTYPE html>
<html>
<head>
<title>Payments</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<h2>Payment Rates</h2>
<form action="Update-rates.php" method="POST">
<label>Invigilator Rate</label>
<input type="number"name="inv_rate"value="<?php echo $inv_rate; ?>">
<br>
<label>Superintendent Rate</label>
<input type="number"name="sup_rate"value="<?php echo $sup_rate; ?>">
<button type="submit">Update Rates</button>
</form>
<h2>Payments</h2>
<table>
<tr>
<th>#</th>
<th>User</th>
<th>Role</th>
<th>Duties</th>
<th>Rate</th>
<th>Total Amount</th>
<th>Action</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($result)){
$check=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT status
FROM payments
WHERE user_id='".$row['id']."'
AND center='".$row['center']."'
AND session_year=YEAR(CURDATE())
LIMIT 1")
);
if($row['role']=="invigilator"){
$rate=$inv_rate;
}
else{
$rate=$sup_rate;
}
$amount=$row['total_duties']*$rate;
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['role']; ?></td>
<td><?php echo $row['total_duties']; ?></td>
<td><?php echo $rate; ?></td>
<td><?php echo $amount; ?></td><td>
<?php
if(isset($check['status']) && $check['status']=="Paid"){
echo "<span style='color:green;font-weight:bold;'>Paid</span>";
}
else{
?>
<a href="Pay-user.php?user_id=<?php echo $row['id']; ?>&center=<?php echo urlencode($row['center']); ?>&duties=<?php echo $row['total_duties']; ?>&rate=<?php echo $rate; ?>&amount=<?php echo $amount; ?>">Pay</a>
<?php
}
?>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>