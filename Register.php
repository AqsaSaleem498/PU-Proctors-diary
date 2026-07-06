<?php
include "db.php";
$error="";
if(isset($_POST['register'])){
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$role=$_POST['role'];
$qualification=$_POST['qualification'];
$center=$_POST['center_preference'];
$password=$_POST['password'];
$cv=$_FILES['cv']['name'];
/* CHECK EMAIL */
$check=mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'");
if(mysqli_num_rows($check)>0){
$error="Email already exists";
}
else{
move_uploaded_file(
$_FILES['cv']['tmp_name'],
"uploads/".$cv
);
$sql="INSERT INTO users
(name,email,phone,role,
qualification,
center_preference,
cv,password,status)
VALUES
('$name','$email','$phone',
'$role','$qualification',
'$center','$cv',
'$password','pending')";
mysqli_query($conn,$sql);
echo "<script>
alert('Registration request sent');
window.location='login.php';
</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="Style.css">
<script src="Javascript.js"></script>
</head>
<body>
<div class="page-center">
<div class="form-box">
<h1>Register</h1>
<?php
if($error!="")
{
echo "<p class='error'>$error</p>";
}
?>
<form method="POST" enctype="multipart/form-data"onsubmit="return validateRegister()">
<input type="text" id="name" name="name" placeholder="Full Name"
required>
<input type="email" id="email" name="email" placeholder="Email"
required>
<input type="text" id="phone" name="phone" placeholder="Phone"
required>
<select name="role" required>
<option value="">
Select Role
</option>
<option value="invigilator">Invigilator</option>
<option value="superintendent">Superintendent</option>
</select>
<input type="text" name="qualification" placeholder="Qualification"
required>
<input type="text" name="center_preference" placeholder="Center Preference" required>
<label>Upload CV</label>
<input type="file" name="cv" required>
<input type="password" id="password" name="password" placeholder="Password" required>
<button type="submit" name="register">Register</button>
</form>
<p>
Already registered?
<a href="Login.php">
Login
</a>
</p>
</div>
</div>
</body>
</html>