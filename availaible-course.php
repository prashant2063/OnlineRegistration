<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0) {   
	header('location:index.php');
}

$checklist=[];
$studentregno=$_POST['studentregno'];
$sesssion=$_POST['session'];
$department=$_POST['department'];
$applyfor=$_POST['applyfor'];
$semester=$_POST['semester'];
$receipt=$_FILES["receipt"]["name"];
$checked=$_POST['checklist'];

move_uploaded_file($_FILES['receipt']["tmp_name"],"receipt/".$_FILES["receipt"]["name"]);

if($ret) {
	$_SESSION['msg']="Enrolled Successfully";
}
else {
	$_SESSION['msg']="Error : Not Enroll";
}

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Available Courses</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
	
	<script src="assets/js/jquery-1.11.1.js"></script>
	<script src="assets/js/bootstrap.js"></script>
</head>

<body>
<?php include('includes/header.php');?>
<?php 
if($_SESSION['login']!="") {
	include('includes/menubar.php');
}
?>
 


<div class="panel panel-default">
                        <div class="panel-heading">
                            Enroll Course
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table" id="srbtable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Lecture</th>
											<th>Tutorial</th>
											<th>Practical</th>
											<th>Course Credit</th>
											<th>Select Course</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select courseCode, courseName, lecture, tutorial, practical, credit from course where department='$department' and semester='$semester';");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
											
                                            <td><?php echo htmlentities($row['courseCode']);?></td>
                                            <td><?php echo htmlentities($row['courseName']);?></td>
											<td><?php echo htmlentities($row['lecture']);?></td>
											<td><?php echo htmlentities($row['tutorial']);?></td>
											<td><?php echo htmlentities($row['practical']);?></td>
											<td><?php echo htmlentities($row['credit']);?></td>	
                                            <td><input class = "srbcheck" type= "checkbox" name = "checklist[]" value = "<?php echo htmlentities($row['courseCode']);?>"></td>
                                        </tr>
<?php 
$cnt++;
} ?>            
                                    </tbody>
                                </table>
                            </div>
							<button type="submit" onclick="enroll()" name="submit" id="submit" class="btn btn-default">Enroll</button>
						<p id="demo"></p>
						</div>
</div>

<script>

function enroll(){
	var idsArr = [];
	var needed_tag = document.getElementsByClassName("srbcheck");
	for (var i=0, max=needed_tag.length; i < max; i++) {
		if(needed_tag[i].checked===true) {
			idsArr.push(needed_tag[i].value);
		}
	}
	
	<?php
	echo "var js_studentregno = '" . $studentregno . "';";	
	echo "var js_session = '" . $sesssion . "';";	
	echo "var js_department = '" . $department . "';";
	echo "var js_applyfor = '" . $applyfor . "';";	
	echo "var js_semester = '" . $semester . "';";
	echo "var js_receipt = '" . $receipt . "';";
	?>
	//console.log(idsArr);
	//console.log(js_department);
	//console.log(js_receipt);
	//console.log(js_department);
	
	var myKeyVals = {
		'studentregno' :js_studentregno,
		'session':js_session,
		'department' :js_department,
		'applyfor':js_applyfor,
		'semester':js_semester,
		'receipt':js_receipt,
		'checklist':idsArr
	};
	
	// send a request
	var saveData = $.ajax({
		  type: 'POST',
		  url: "enrolled.php",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(resultData) { alert("Save Complete") }
	});
	saveData.error(function() { alert("Something went wrong"); });
}
</script>

<?php include('includes/footer.php');?>
    
	
	</body>
</html>