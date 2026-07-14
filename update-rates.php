<?php
include "db.php";
$inv=$_POST['inv_rate'];
$sup=$_POST['sup_rate'];
mysqli_query($conn,
"UPDATE payment_rates
SET invigilator_rate='$inv',
superintendent_rate='$sup'
WHERE id=1");
header(
"Location:A-payments.php"
);
?>