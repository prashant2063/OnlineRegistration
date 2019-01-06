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
		<style>
        .receipt_photu {
          border: 1px solid #ddd;
          border-radius: 4px;
          padding: 5px;
          width: 35px;
        }
        .receipt_photu:hover {
          box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
		</style>
	</head>
<body>
<!--?php
	echo $_GET['select_one'];
	echo $_GET['select_two'];?-->
	<?php
		$enrollment_type=$_GET['enrollment_type'];
		//echo $enrollment_type;
		$select_one=$_GET['select_one'];
		$select_two=$_GET['select_two'];
		if($select_one=="student_wise"){
			//echo "student wise";
			//echo $select_two;
			$sql=mysqli_query($con,"select studentRegNo, courseenroll.courseCode, courseenroll.courseName, lecture, tutorial, practical, credit, session, courseenroll.semester from courseenroll left join course on courseenroll.courseCode=course.courseCode where studentRegNo='$select_two' and applyfor='$enrollment_type' order by session,semester;");
			if(mysqli_num_rows($sql) > 0){
				$row=mysqli_fetch_array($sql);
				$current_session=$row['session'];
				$current_semester=$row['semester'];
				$cnt=1;
				echo "Semester: ".$current_semester;	echo "Session: ".$current_session;

				
		?>

				<table class="table">
				<thead>		
					
				</thead>
				<tbody>
					<thead>
						<tr>
						<th>#</th>
						<th>Course Code</th>
						<th>Course Name</th>
						<th>Lecture</th>
						<th>Tutorial</th>
						<th>Practical</th>
						<th>Credit</th>
					</tr>
					</thead>
				<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['courseCode'];?></td>
							<td><?php echo $row['courseName'];?></td>
							<td><?php echo $row['lecture'];?></td>
							<td><?php echo $row['tutorial'];?></td>
							<td><?php echo $row['practical'];?></td>
							<td><?php echo $row['credit'];?></td>
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
							<td><?php echo $row['lecture'];?></td>
							<td><?php echo $row['tutorial'];?></td>
							<td><?php echo $row['practical'];?></td>
							<td><?php echo $row['credit'];?></td>
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
							<th>Lecture</th>
							<th>Tutorial</th>
							<th>Practical</th>
							<th>Credit</th>
						</tr>
				</thead>
				<tbody>
					<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $row['courseCode'];?></td>
							<td><?php echo $row['courseName'];?></td>
							<td><?php echo $row['lecture'];?></td>
							<td><?php echo $row['tutorial'];?></td>
							<td><?php echo $row['practical'];?></td>
							<td><?php echo $row['credit'];?></td>
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
		}
		if($select_one=="course_wise"){
			//echo "course wise";
			$sql=mysqli_query($con,"select studentRegNo from courseenroll where courseCode='$select_two' and applyfor='$enrollment_type' order by studentRegNo;");
			if(mysqli_num_rows($sql) > 0){
	?>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Registered Students</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						$cnt=1;
						while($row=mysqli_fetch_array($sql)){
							//echo $cnt;
					?>
							<tr>
								<td><?php echo $cnt;?></td>
								<td><?php echo htmlentities($row['studentRegNo']);?></td>
							</tr>
						<?php
						$cnt++;
						}?>
				</tbody>
			</table>

		<?php
			}
			else{
				echo "No Records Found";
			}
		}
		if($select_one=="department_wise"){
			//echo "department wise";
			//table comes here
			$sql=mysqli_query($con,"select studentRegNo, courseCode, semester,session from courseenroll where department='$select_two' and applyfor='$enrollment_type' order by studentRegNo,session,semester,courseCode;");
			if(mysqli_num_rows($sql) > 0){
			?>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Registration Number</th>
						<th>Courses Enrolled</th>
						<th>Semester</th>
						<th>Session</th>
					</tr>
				</thead>
				<tbody>
						<?php		
						$cnt=1;
						$row=mysqli_fetch_array($sql);
						$courseArray=array($row['courseCode']);
						$current_student=$row['studentRegNo'];
						$current_session=$row['session'];
						$current_semester=$row['semester'];
						//echo implode(',', $courseArray);
						//echo $current_student;
						//echo $current_session;
						while($row=mysqli_fetch_array($sql)){
							if($current_student==$row['studentRegNo'] AND $current_session==$row['session'] AND $current_semester==$row['semester']) {
								array_push($courseArray,$row['courseCode']);
							}
							else{
						?>
								<tr>
									<td><?php echo $cnt;?></td>
									<td><?php echo $current_student;?></td>
									<td><?php echo implode(',', $courseArray);?></td>
									<td><?php echo $current_semester;?></td>
									<td><?php echo $current_session;?></td>
								</tr>
						<?php
								$cnt++;
								$current_student=$row['studentRegNo'];
								$current_session=$row['session'];
								$current_semester=$row['semester'];
								$courseArray=array($row['courseCode']);
							}
						}
						?>
						<tr>
							<td><?php echo $cnt;?></td>
							<td><?php echo $current_student;?></td>
							<td><?php echo implode(',', $courseArray);?></td>
							<td><?php echo $current_semester;?></td>
							<td><?php echo $current_session;?></td>
						</tr>
				</tbody>
			</table>
			
		
		<?php
			}
			else{
				echo "No Records Found";
			}
		}
		?>
	
	
	<script src="assets/js/bootstrap.js"></script>
</body>
</html>