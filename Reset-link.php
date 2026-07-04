<?php
include "db.php";
include "Mail-Send.php";
$email=$_POST['email'];

/* CHECK EMAIL */
$check=mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'");

if(mysqli_num_rows($check)>0){
$token=md5(rand());
mysqli_query($conn,
"UPDATE users
SET reset_token='$token'
WHERE email='$email'");
sendMail(
$email,
"Password Reset",
"Click the link below:
http://localhost/PU-Proctors-diary/reset-password.php?token=$token"
);
/* EMAIL */
echo "<script>
alert('Reset Link Sent');
window.location='Login.php';
</script>";
}
else{
echo "<script>
alert('Email Not Found');
</script>";
}
?>