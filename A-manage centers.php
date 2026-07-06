<?php
session_start();
include "db.php";
/* ADD CENTER */
if(isset($_POST['add_center'])){
$code=$_POST['center_code'];
$name=$_POST['center_name'];
$city=$_POST['city'];
$address=$_POST['address'];
$contact=$_POST['contact_person'];
$phone=$_POST['phone'];
$capacity=$_POST['capacity'];
$sql="INSERT INTO centers
(center_code,center_name,city,address,contact_person,phone,capacity)
VALUES
('$code','$name','$city','$address','$contact','$phone','$capacity')";
mysqli_query($conn,$sql);
header("Location:A-manage centers.php");
}
/* SEARCH CENTER */
$search="";
if(isset($_GET['search'])){
$search=$_GET['search'];
$query="SELECT * FROM centers
WHERE center_name LIKE '%$search%'
OR city LIKE '%$search%'
OR center_code LIKE '%$search%'";
}
else{
$query="SELECT * FROM centers";
}
$result=mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Centers</title>
<link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<div class="table-box">
<h1 class="dashboard-title">Manage Centers</h1>
<form method="GET">
<input
type="text" name="search" placeholder="Search by name, city or code"
class="search-input">
<button class="add-btn">Search
</button>
</form>
<h2 class="section-title">Add New Center</h2>
<form method="POST" class="center-form">
<input type="text" name="center_code" placeholder="Center Code" required>
<input type="text" name="center_name" placeholder="Center Name" required>
<input type="text" name="city" placeholder="City" required>
<input type="text" name="address" placeholder="Address" required>
<input type="text" name="contact_person" placeholder="Contact Person"
required>
<input type="text" name="phone" placeholder="Phone" required>
<input type="number" name="capacity" placeholder="Capacity" required>
<button type="submit" name="add_center" class="add-btn">Add Center     </button>
</form>
<table>
<tr>
<th>#</th>
<th>Code</th>
<th>Name</th>
<th>City</th>
<th>Address</th>
<th>Contact</th>
<th>Phone</th>
<th>Capacity</th>
</tr>
<?php
$count=1;
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo $row['center_code']; ?></td>
<td><?php echo $row['center_name']; ?></td>
<td><?php echo $row['city']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['contact_person']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['capacity']; ?></td>
</tr>
<?php
$count++;
}
?>
</table>
</div>
<script src="Javascript.js"></script>
</body>
</html>