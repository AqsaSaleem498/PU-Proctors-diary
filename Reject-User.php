<?php
include "db.php";
include "Mail-Send.php";
$id=$_GET['id'];
$user=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM users
WHERE id='$id'")
);
mysqli_query($conn,
"UPDATE users
SET status='rejected'
WHERE id='$id'");
sendMail(
$user['email'],
"Registration Rejected"
"Dear User,
Unfortunately your registration request has been rejected.
Thank You."
);
header("Location:Registration-Request.php");
?>