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
SET status='approved',
approved_at=NOW()
WHERE id='$id'");
sendMail(
$user['email'],
"Registration Approved",
"Dear User,
Your registration request has been approved.
You can now login to PU Proctors Diary.
Thank You."
);
header("Location:Registeration-Request.php");
?>