<?php
	session_start();
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
		<?php
			$enrollment_type=$_GET['enrollment_type'];
			//echo $enrollment_type;
			$sql=mysqli_query($con,"select studentRegNo, courseenroll.courseCode, courseenroll.courseName, lecture, tutorial, practical, credit, session, courseenroll.semester from courseenroll left join course on courseenroll.courseCode=course.courseCode where studentRegNo='$select_two' and applyfor='$enrollment_type' order by session,semester;");
			if(mysqli_num_rows($sql) > 0){$row=mysqli_fetch_array($sql);
				$current_session=$row['session'];
				$current_semester=$row['semester'];
				$cnt=1;
				echo "Semester: ".$current_semester;	echo "Session: ".$current_session;
		?>
				<?php ?>
				<table class="table">
				<thead>		
					<tr>
						<th>#</th>
						<th>Course Code</th>
						<th>Course Name</th>
					</tr>
				</thead>
				<tbody>
				<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['courseCode'];?></td>
							<td><?php echo $row['courseName'];?></td>
				</tr>
		<?php
				$cnt++;
				while($row=mysqli_fetch_array($sql)){
					if($current_session==$row['session'] AND $current_semester==$row['semester']){
		?>
						<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['courseCode'];?></td>
							<td><?php echo $row['courseName'];?></td>
						</tr>			
		<?php
					}
					else{
		?>
				</tbody>
				</table>
		<?php 
						$cnt=1;
						$current_session=$row['session'];
						$current_semester=$row['semester'];
						echo "Semester: ".$current_semester;	
						echo "Session: ".$current_session;
		?>
				<table class="table">
				<thead>
						<tr>
							<th>#</th>
							<th>Course Code</th>
							<th>Course Name</th>
						</tr>
				</thead>
				<tbody>
					<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['courseCode'];?></td>
							<td><?php echo $row['courseName'];?></td>
					</tr>			
		<?php
					}
					$cnt++;
				}
		?>
				</tbody>
				</table>
	<?php
			}
			else{
				echo "No Records Found";
			}
		?>
	</body>
</html>