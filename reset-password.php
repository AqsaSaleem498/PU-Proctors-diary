<?php
include "db.php";
if(!isset($_GET['token'])){
die("Invalid Token");
}
$token=$_GET['token'];
$query=mysqli_query($conn,
"SELECT * FROM users
WHERE reset_token='$token'");
if(mysqli_num_rows($query)==0){
die("Invalid Token");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<div class="page-center">
<div class="form-box">
<h2>Reset Password</h2>
<form action="update-password.php" method="POST">
<input type="hidden" name="token" value="<?php echo $token; ?>">
<input type="password" name="new_password" placeholder="New Password" required>
<input type="password" name="confirm_password"placeholder="Confirm Password" required>
<button type="submit">Update Password</button>
</form>
</div>
</div>
</body>
</html>