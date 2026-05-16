<?php
include "db.php";

$token = $_GET['token'];

$sql = "SELECT * FROM users WHERE token='$token'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
$user = mysqli_fetch_assoc($result);
return $user; // valid user
}
else{
echo "Unauthorized";
exit();
}
?>