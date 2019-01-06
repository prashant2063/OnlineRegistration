<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if(strlen($_SESSION['alogin'])==0){   
	header('location:index.php');
}
else{

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!--title>Course Enrollment Print</title-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:18px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:10px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:30px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
	@media print{
		.hideit {
			display :  none;
		}
	}
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
	
		
	
    </style>
</head>

<body>
    <div class="invoice-box">
	<div style="margin-bottom:20px;">
		<div class="navbar navbar-inverse set-radius-zero" style="display:block;">
			<div class="container">
				<div class="navbar-header" style="display:block;">
						<img style="width: 70%; padding: 10px 0" src="studentphoto/newlogo.png" style="display:block;"> 
				</div>
			</div>
		</div>
	</div>
		<?php
		$str=$_GET['id'];
		$data=explode('|',$str);
		$sql=mysqli_query($con,"select courseenroll.department, students.studentName, students.studentPhoto, students.guardianName, students.studentMobile, students.studentEmail, students.cgpa, students.correspondenceAddress,students.permanentAddress, students.creationDate from courseenroll join students on students.StudentRegNo=courseenroll.StudentRegno where courseenroll.studentRegNo='$data[3]' limit 1;");
		//$cnt=1;
		$row=mysqli_fetch_array($sql);?>
		<table style="margin-bottom:20px;border:solid black 1px;">
			<tr>
				<th>Semester</th>
				<td style="text-align:left"><?php echo $data[0];?></td>
				<th>Session</th>
				<td style="text-align:left"><?php echo $data[1];?></td>
			</tr>
		</table>
		<div style="float:right;padding-right:10px;">
			<?php if($row['studentPhoto']==""){ ?>
				<img src="../studentphoto/noimage.png" width="200" height="200" ><?php } else {?>
				<img src="../studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200">
			<?php } ?>
		</div>
		<div style="width:70%;">
			<table>
				<tr class="details">
					<th>Roll Number</th>
					<td style="text-align:left"><?php echo $data[3];?></td>
				</tr>
				<tr class="details">
					<th>Name</th>
					<td style="text-align:left"><?php echo $row['studentName'];?></td>
				</tr>
				<tr class="details">
					<th>Father/Guardian Name</th>
					<td style="text-align:left"><?php echo $row['guardianName'];?></td>
				</tr>
				<tr class="details">
					<th>CGPA</th>
					<td style="text-align:left"><?php echo $row['cgpa'];?></td>
				</tr>
				<tr class="details">
					<th>Department</th>
					<td style="text-align:left"><?php echo $row['department'];?></td>
				</tr>
				<tr class="details">
					<th>Phone</th>
					<td style="text-align:left"><?php echo $row['studentMobile'];?></td>
				</tr>
				<tr class="details">
					<th>Email</th>
					<td style="text-align:left"><?php echo $row['studentEmail'];?></td>
				</tr>
			</table>
		</div>
		<br>
		<div style="width:100%;">
			<div style="width:48%;float:right;">
				<table>
					<tr class="heading"><td>Permanent Address</td></tr>
					<tr class="details"><td><?php echo $row['permanentAddress'];?></td></tr>
				</table>
			</div>
			<div style="width:48%;">
				<table>
					<tr class="heading"><td>Correespondance Address</td></tr>
					<tr class="details"><td><?php echo $row['correspondenceAddress'];?></td></tr>
				</table>
			</div>
		</div>
		<br>
		
		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				Courses Enrolled
			</div>
			<div class="panel-body">
				<div class="table-responsive table-bordered">
					<table class="table">
						<tr>
							<th>#</th>
							<th>Course Code</th>
							<th>Course Name</th>
							<th>Leture</th>
							<th>Tutorial</th>
							<th>Practical</th>
							<th>Credit</th>
						</tr>
						<?php
							$cnt=1;
							$sql=mysqli_query($con,"select courseenroll.courseCode, courseenroll.courseName, course.lecture, course.tutorial, course.practical, course.credit from courseenroll join course on courseenroll.courseCode=course.courseCode where courseenroll.studentRegNo='$data[3]' and courseenroll.semester='$data[0]' and courseenroll.session='$data[1]' and courseenroll.applyfor='$data[2]';");
							while($row=mysqli_fetch_array($sql)){?>
								<tr>
									<td><?php echo $cnt?></td>
									<td><?php echo $row['courseCode'];?></td>
									<td><?php echo $row['courseName'];?></td>
									<td><?php echo $row['lecture'];?></td>
									<td><?php echo $row['tutorial'];?></td>
									<td><?php echo $row['practical'];?></td>
									<td><?php echo $row['credit'];?></td>
								</tr>						
							<?php
								$cnt++;
							}
						?>
					</table>
				</div>
			</div>
		</div>
			
			
	   

	  <button class="btn btn-primary hideit" onClick="window.print();"><i class="fa fa-print "></i> Print</button> 
	</div>
	</body>
	</html>
<?php } ?>