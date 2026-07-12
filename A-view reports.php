<?php

session_start();

include "db.php";

$sql="SELECT reports.*,
users.name

FROM reports

JOIN users

ON reports.user_id=users.id

ORDER BY reports.id DESC";

$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>

<html>

<head>

<title>View Reports</title>

<link rel="stylesheet" href="Style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<div class="table-box">

<h1>
Superintendent Reports
(Admin Review)
</h1>

<table>

<tr>

<th>#</th>

<th>Superintendent</th>

<th>Duty</th>

<th>Center</th>

<th>File</th>

<th>Uploaded</th>

<th>Status</th>

<th>Review</th>

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
<?php echo $row['duty']; ?>
</td>
<td>
<?php echo $row['center']; ?>
</td>

<td>

<a

href="reports/<?php echo $row['report_file']; ?>"

target="_blank">

View File

</a>

</td>

<td>
<?php echo $row['uploaded_at']; ?>
</td>

<td>
<?php echo $row['status']; ?>
</td>

<td>

<a

class="approve-btn"

href="Approve-report.php?id=<?php echo $row['id']; ?>">

Approve

</a>

<a

class="reject-btn"

href="Reject-report.php?id=<?php echo $row['id']; ?>">

Reject

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>