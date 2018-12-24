<?php
session_start();
include('includes/config.php');
error_reporting(0);


$studentregno=$_POST['studentregno'];
$sesssion=$_POST['session'];
$department=$_POST['department'];
$applyfor=$_POST['applyfor'];
$semester=$_POST['semester'];
$receipt=$_POST["receipt"];
$checked=$_POST['checklist'];


//$coursecode="srb_coursecode";
//$coursename="srb_coursename";
//$sql=mysqli_query($con,"insert into courseenroll (studentRegNo,session,department,semester,courseCode,courseName,receipt,applyFor) values ('$studentregno', '$sesssion', '$department', '$semester', '$coursecode', '$coursename','$receipt','$applyfor');");

	
	$ret=mysqli_query($con,"select courseCode, courseName from course where department='$department' and semester='$semester';");
	while($row=mysqli_fetch_array($ret))
	{
	
		//$value=$_POST['checklist[]'];
		$coursecode=htmlentities($row[courseCode]);
		$coursename=htmlentities($row[courseName]);
		foreach($checked as $value){
			if($value==$coursecode){
				$chk=mysqli_query($con,"select * from courseenroll where studentRegNo='$studentregno' and  session='$sesssion' and semester='$semester' and courseCode='$coursecode' and applyFor='$applyfor';");
				if(!mysqli_fetch_array($chk)){
					$sql=mysqli_query($con,"insert into courseenroll (studentRegNo,session,department,semester,courseCode,courseName,receipt,applyFor) values ('$studentregno', '$sesssion', '$department', '$semester', '$coursecode', '$coursename','$receipt','$applyfor');");
				}
			}
		}
		$cnt++;
	}
?>