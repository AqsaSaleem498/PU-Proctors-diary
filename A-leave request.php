<?php

session_start();

include "db.php";

$result=mysqli_query($conn,

"SELECT leave_requests.*,
users.name,
users.role

FROM leave_requests

JOIN users

ON leave_requests.user_id=
users.id

ORDER BY leave_requests.id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Leave Requests</title>

<link rel="stylesheet"
href="Style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<div class="table-box">

<h1>

Manage Leave Requests

</h1>

<table>

<tr>

<th>#</th>

<th>User</th>

<th>Role</th>

<th>From</th>

<th>To</th>

<th>Reason</th>

<th>Status</th>

<th>Action</th>

</tr>

<?php

$count=1;

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $count++; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['role']; ?></td>

<td><?php echo $row['start_date']; ?></td>

<td><?php echo $row['end_date']; ?></td>

<td><?php echo $row['reason']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<?php

if($row['status']=="Pending"){

?>

<a class="approve-btn"

href="Approve-leave.php?id=<?php echo $row['id']; ?>">

Approve

</a>

<a class="reject-btn"

href="Reject-leave.php?id=<?php echo $row['id']; ?>">

Reject

</a>

<?php

}

else{

echo $row['status'];

}

?>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>