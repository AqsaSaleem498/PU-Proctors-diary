<?php
session_start();
include "db.php";
if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM users
WHERE email='$email'
AND password='$password'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
$user = mysqli_fetch_assoc($result);
if($user['status']!="approved"){
echo "<script>
alert('Wait for admin approval');
</script>";
}
else{
$_SESSION['user_id']=$user['id'];
$_SESSION['role']=$user['role'];
if($user['role']=="admin"){
header("Location:A-Dashboard.php");
}
else if($user['role']=="invigilator"){
header("Location:I-dashboard.php");
}
else{
header("Location:S-dashboard.php");
}
exit();
}
}
else{
echo "<script>
alert('Invalid Email or Password');
</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet"
href="Style.css">
<script src="Javascript.js"></script>
</head>
<body>
<div class="page-center">
<div class="form-box">
<h1>Login</h1>
<form method="POST"
onsubmit="return validateLogin()">
<input type="email"
id="email" name="email" placeholder="Email" required>
<input type="password" id="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>
<a href="Forgot-Password.php">
Forgot Password?
</a>
<p>
New user?
<a href="Register.php">
Register here
</a>
</p>
</div>
</div>
</body>
</html>