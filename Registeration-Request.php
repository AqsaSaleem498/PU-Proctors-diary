<?php
include "db.php";
$result=mysqli_query($conn,
"SELECT * FROM users
WHERE status='pending'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Requests</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?> 
<div class="table-box">
<h1>Registration Requests</h1>
<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>CV</th>
<th>Action</th>
</tr>
<?php
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td>
<?php echo $row['id']; ?>
</td>
<td>
<?php echo $row['name']; ?>
</td>
<td>
<?php echo $row['email']; ?>
</td>
<td>
<?php echo $row['role']; ?>
</td>
<td>
<a href="uploads/<?php echo $row['cv']; ?>">View CV</a>
</td>
<td>
<a href="Approve-User.php?id=<?php echo $row['id']; ?>">Approve</a>
<a href="Reject-User.php?id=<?php echo $row['id']; ?>">
Reject</a>
</td>
</tr>
<?php } ?>
</table>
</div>
<div class="table-box">
<hr>
<h2>Approved Users History</h2>
<?php
$approved=mysqli_query($conn,
"SELECT * FROM users
WHERE status='approved'
ORDER BY approved_at DESC");
?>
<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Approved Date</th>
</tr>
<?php
while($user=mysqli_fetch_assoc($approved)){
?>
<tr>
<td><?php echo $user['id']; ?></td>
<td><?php echo $user['name']; ?></td>
<td><?php echo $user['email']; ?></td>
<td><?php echo $user['role']; ?></td>
<td><?php echo $user['approved_at']; ?></td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>