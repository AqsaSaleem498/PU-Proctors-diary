<?php
include "db.php";
$id=$_GET['id'];
mysqli_query($conn,
"UPDATE reports
SET status='Rejected'
WHERE id='$id'");
header(
"Location:A-view reports.php"
);
?>