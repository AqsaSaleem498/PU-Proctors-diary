<?php

session_start();

include "db.php";

$user_id=$_SESSION['user_id'];

if(isset($_POST['submit_leave'])){

$start_date=$_POST['start_date'];

$end_date=$_POST['end_date'];

$reason=$_POST['reason'];

mysqli_query($conn,

"INSERT INTO leave_requests
(user_id,start_date,end_date,reason)

VALUES
('$user_id',
'$start_date',
'$end_date',
'$reason')");

echo "<script>

alert('Leave Request Submitted');

window.location='Leave Request.php';

</script>";

}

$history=mysqli_query($conn,

"SELECT * FROM leave_requests

WHERE user_id='$user_id'

ORDER BY id DESC");

?>
<!DOCTYPE html>

<html>

<head>

<title>Leave Request</title>

<link rel="stylesheet"
href="Style.css">

</head>

<body>
<?php include "navbar.php"; ?>
<h1>Leave Request</h1>

<div class="leave-box">

<form method="POST"
onsubmit="return validateLeave()">

<div class="row">

<div>

<label>Start Date</label>

<input type="date"
name="start_date"
required>

</div>

<div>

<label>End Date</label>

<input type="date"
name="end_date"
required>

</div>

</div>

<label>Reason</label>

<textarea
name="reason"
required></textarea>

<button
type="submit"
name="submit_leave">

Submit Request

</button>

</form>

</div>

<h2>Your Leave History</h2>

<table>

<tr>

<th>#</th>

<th>Reason</th>

<th>From</th>

<th>To</th>

<th>Status</th>

</tr>

<?php

$count=1;

while($row=mysqli_fetch_assoc($history)){

?>

<tr>

<td><?php echo $count++; ?></td>

<td><?php echo $row['reason']; ?></td>

<td><?php echo $row['start_date']; ?></td>

<td><?php echo $row['end_date']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>
</body>
</html>