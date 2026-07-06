<?php
if(session_status()===PHP_SESSION_NONE){
session_start();
}
if(!isset($_SESSION['role'])){
return;
}
if($_SESSION['role']=="admin"){
?>
<div class="navbar">
<span class="logo">PU Proctors Diary</span>
<a href="A-Dashboard.php">Dashboard</a>
<a href="Registeration-Request.php">Reg-Requests</a>
<a href="A-manage centers.php">Center</a>
<a href="A-leave request.php">Request</a>
<a href="A-Manage Duties.php">Duties</a>
<a href="A-attendance.php">Attendance</a>
<a href="A-payments.php">Payments</a>
<a href="A-view reports.php">Reports</a>
<span class="right">
Logged in as admin |<a href="logout.php" class="logout-link">Logout</a>
</span>
</div>
<?php
}
elseif($_SESSION['role']=="invigilator"){
?>
<div class="navbar">
<span class="logo">PU Proctors Diary</span>
<a href="I-Dashboard.php">Dashboard</a>
<a href="leave request.php">Leave Request</a>
<a href="My duty.php">Duties</a>
<a href="Attendance.php">Attendance</a>
<a href="Payments.php">Payments</a>
<span class="right">Logged in as Invigilator |<a href="logout.php" class="logout-link">Logout</a>
</span>
</div>
<?php
}
elseif($_SESSION['role']=="superintendent"){
?>
<div class="navbar">
<span class="logo">PU Proctors Diary</span>
<a href="S-Dashboad.php">Dashboard</a>
<a href="leave request.php">Leave Request</a>
<a href="My duty.php">Duties</a>
<a href="Attendance.php">Attendance</a>
<a href="Payments.php">Payments</a>
<a href="Reports.php">Reports</a>
<span class="right">Logged in as Superintendent |<a href="logout.php" class="logout-link">Logout</a>
</span>
</div>
<?php
}
?>