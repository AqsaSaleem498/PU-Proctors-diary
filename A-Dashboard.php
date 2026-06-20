<?php
session_start();
include "db.php";
/* ADMIN ACCESS */
if(!isset($_SESSION['role']) ||
$_SESSION['role']!="admin"){
header("Location:Login.php");
exit();
}
/* TOTAL USERS */
$user_query=mysqli_query($conn,
"SELECT COUNT(*) AS total_users FROM users");
$user_data=mysqli_fetch_assoc($user_query);

/* TOTAL DUTIES */
$duty_query=mysqli_query($conn,
"SELECT COUNT(*) AS total_duties FROM duties");
$duty_data=mysqli_fetch_assoc($duty_query);

/* REPORTS */
$report_query=mysqli_query($conn,
"SELECT COUNT(*) AS total_reports FROM reports");
$report_data=mysqli_fetch_assoc($report_query);

/* PAYMENTS */
$payment_query=mysqli_query($conn,
"SELECT COUNT(*) AS total_payments FROM payments");
$payment_data=mysqli_fetch_assoc($payment_query);

/* REGISTRATION REQUESTS */
$request_query=mysqli_query($conn,
"SELECT COUNT(*) AS total_requests
FROM users
WHERE status='pending'");
$request_data=mysqli_fetch_assoc($request_query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<!-- PAGE TITLE -->
<h1 class="dashboard-title">Admin Dashboard</h1>
<!-- TOP BOXES -->
<div class="dashboard-grid">
<div class="box blue">
<h3>Assign Duties</h3>
</div>
<div class="box green">
<h3>Verify Attendance</h3>
</div>
<div class="box cyan">
<h3>View Reports</h3>
</div>
<div class="box yellow">
<h3>Payments</h3>
</div>
</div>
<!-- STATS -->
<div class="dashboard-grid">
<div class="box blue">
<h2>
<?php
echo $user_data['total_users'];
?>
</h2>
<p>Total Users</p>
</div>
<div class="box green">
<h2>
<?php
echo $duty_data['total_duties'];
?>
</h2>
<p>Total Duties</p>
</div>
<div class="box cyan">
<h2>
<?php
echo $report_data['total_reports'];
?>
</h2>
<p>Reports Uploaded</p>
</div>
<div class="box yellow">
<h2>
<?php
echo $payment_data['total_payments'];
?>
</h2>
<p>Payments Made</p>
</div>
</div>
<!-- ANALYTICS -->
<h2 class="section-title">Analytics & Reporting</h2>
<div class="dashboard-grid">
<div class="small-box">
<h3>Attendance Rate</h3>
</div>
<div class="small-box">
<h3>Report Submission Rate</h3>
</div>
<div class="small-box">
<h3>Total Amount Paid</h3>
</div>
<div class="small-box">
<h3>
<?php
echo $request_data['total_requests'];
?>
</h3>
<h3>Total Registration Requests</h3>
</div>
</div>
<script src="Javascript.js"></script>
</body>
</html>