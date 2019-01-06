<?php
			include('includes/config.php');
			error_reporting(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<!--title>Enroll History</title-->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<link href="assets/css/font-awesome.css" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />
	</head>
	<body>
		<div class="form-group" id="select_two">
		<?php
			$choice=$_GET['select_one'];
			echo "<select class='form-group' id='select_two_dd' onChange='get_table()'>";
			echo "<option>";	echo "--SELECT VALUE--"; 	echo "</option>";
			if($choice=="student_wise"){
				$query=mysqli_query($con,"select studentRegNo from students;");
				//echo "<select id='select_two' onChange='get_table()'>";
				//echo "<option>";	echo "--SELECT VALUE--"; 	echo "</option>";
					while($row=mysqli_fetch_array($query)){
						echo "<option value='$row[studentRegNo]'>";	echo $row['studentRegNo']; 	echo "</option>";
					}
				//echo "</select>";
			}
			else if($choice=="course_wise"){
				$query=mysqli_query($con,"select courseCode from course;");
				//echo "<select id='select_two' onChange='get_table()'>";
				//echo "<option>";	echo "--SELECT VALUE--"; 	echo "</option>";
					while($row=mysqli_fetch_array($query)){
						echo "<option value='$row[courseCode]'>";	echo $row['courseCode']; 	echo "</option>";
					}
				//echo "</select>";
			}
			else if($choice=="department_wise"){
				$query=mysqli_query($con,"select department from department;");
				//echo "<select id='select_two' onChange='get_table()'>";
				//echo "<option>";	echo "--SELECT VALUE--"; 	echo "</option>";
					while($row=mysqli_fetch_array($query)){
						echo "<option value='$row[department]'>";	echo $row['department']; 	echo "</option>";
					}
				//echo "</select>";
			}
			else{
				echo "<option>";	echo "--SELECT VALUE--"; 	echo "</option>";
			}
			echo "</select>";
		?>
	<script src="assets/js/bootstrap.js"></script>
	</body>

</html>