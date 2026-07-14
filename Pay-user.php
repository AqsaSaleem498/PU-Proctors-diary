<?php
include "db.php";
include "Mail-send.php";
$user_id=$_GET['user_id'];
$duties=$_GET['duties'];
$rate=$_GET['rate'];
$amount=$_GET['amount'];

/* GET DUTY CENTER */
$center=$_GET['center'];
$session_year=date("Y");

/* CHECK PAYMENT */
$check=mysqli_query($conn,
"SELECT * FROM payments
WHERE user_id='$user_id'
AND center='$center'
AND session_year='$session_year'");
if(mysqli_num_rows($check)>0){
echo "<script>
alert('Payment Already Paid');
window.location='A-payments.php';
</script>";
exit();
}
/* SAVE PAYMENT */
mysqli_query($conn,
"INSERT INTO payments(
user_id,
center,
session_year,
total_duties,
rate_per_duty,
total_amount,
status,
payment_date)
VALUES(
'$user_id',
'$center',
'$session_year',
'$duties',
'$rate',
'$amount',
'Paid',
CURDATE()
)");

/* GET USER */
$user=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT name,email
FROM users
WHERE id='$user_id'")
);
$name=$user['name'];
$email=$user['email'];

/* SAVE NOTIFICATION */
$message="Your payment has been completed.";
mysqli_query($conn,
"INSERT INTO notifications(user_id,message)
VALUES('$user_id','$message')");

/* SEND EMAIL */
sendMail(
$email,
"Payment Completed",
"Dear ".$name.",
Your payment has been marked as <b>PAID</b>.<br><br>
Center: ".$center."
Amount: Rs. ".$amount."
Thank You."
);
header("Location:A-payments.php");
exit();
?>