<?php
include "db.php";
if(isset($_POST['token'])){
$token=$_POST['token'];
$new_password=$_POST['new_password'];
$confirm_password=
$_POST['confirm_password'];
if($new_password!=$confirm_password){
echo "<script>
alert('Passwords do not match');
window.history.back();
</script>";
exit();
}
$query=mysqli_query($conn,
"SELECT * FROM users
WHERE reset_token='$token'");
if(mysqli_num_rows($query)>0){
mysqli_query($conn,
"UPDATE users
SET password='$new_password',
reset_token=NULL,
token_expiry=NULL
WHERE reset_token='$token'");
echo "<script>
alert('Password Updated');
window.location='login.php';
</script>";
}
else{
echo "Invalid Token";
 }
}
?>