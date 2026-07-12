<?php

include "db.php";

$id=$_GET['id'];

mysqli_query($conn,

"UPDATE leave_requests

SET status='Approved'

WHERE id='$id'");

header("Location:A-leave request.php");

exit();

?>