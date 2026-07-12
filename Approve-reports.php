<?php
include "db.php";
$id=$_GET['id'];
mysqli_query($conn,
"UPDATE reports
SET status='Approved'
WHERE id='$id'");
header(
"Location:A-view reports.php"
);
?>