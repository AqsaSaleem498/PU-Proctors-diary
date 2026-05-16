<?php
include "auth.php";

/* user mil gaya */
$user_id = $user['id'];

$sql = "SELECT * FROM duties WHERE user_id=$user_id";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
echo $row['center']." - ".$row['date']." - ".$row['shift']."<br>";
}
?>