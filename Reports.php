<?php

session_start();

include "db.php";

$user_id=$_SESSION['user_id'];

if(isset($_POST['upload'])){

$date=$_POST['report_date'];

$shift=$_POST['shift'];

$course=$_POST['course'];

$file=$_FILES['report']['name'];

$tmp=$_FILES['report']['tmp_name'];

move_uploaded_file(

$tmp,

"reports/".$file

);

mysqli_query($conn,

"INSERT INTO reports(

user_id,
report_date,
shift,
course,
report_file

)

VALUES(

'$user_id',
'$date',
'$shift',
'$course',
'$file'

)");

echo "<script>

alert('Report Uploaded Successfully');

window.location='Reports.php';

</script>";

}

$result=mysqli_query($conn,

"SELECT *

FROM reports

WHERE user_id='$user_id'

ORDER BY id DESC");

?>
<!DOCTYPE html>

<html>

<head>

<title>
Upload Reports
</title>

<link rel="stylesheet" href="Style.css">
<script src="Javascript.js"></script>

</head>

<body>

<?php include "navbar.php"; ?>

<div class="table-box">

<h1>
Upload Reports
</h1>

<form

method="POST"

enctype="multipart/form-data"

onsubmit="return validateReport()">


<input

type="date"

name="report_date"

required>

<select

name="shift"

required>

<option>
Morning
</option>

<option>
Evening
</option>

</select>

<input

type="text"

name="course"

placeholder="Course Name"

required>

<input

type="file"

name="report"

required>

<button

type="submit"

name="upload">

Upload Report

</button>

</form>

<br>

<table>

<tr>

<th>#</th>

<th>Date</th>

<th>Shift</th>

<th>Course</th>

<th>Report</th>

<th>Status</th>

</tr>
<?php

$count=1;

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td>
<?php echo $count++; ?>
</td>

<td>
<?php echo $row['report_date']; ?>
</td>

<td>
<?php echo $row['shift']; ?>
</td>

<td>
<?php echo $row['course']; ?>
</td>

<td>

<a

href="reports/<?php echo $row['report_file']; ?>"

target="_blank">

View Report

</a>

</td>

<td>
<?php echo $row['status']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>