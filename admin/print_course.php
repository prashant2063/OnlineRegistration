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
		$sql=mysqli_query($con,"select courseCode, courseName, department, semester, lecture, tutorial, practical, credit from course where courseCode='$data[2]';");
		//$cnt=1;
		$row=mysqli_fetch_array($sql);?>
		<table style="margin-bottom:20px;border:solid black 1px;">
			<tr>
				<th>Session</th>
				<td style="text-align:left"><?php echo $data[0];?></td>
			</tr>
		</table>
			
			<table>
				<tr class="details">
					<th>Course Code</th>
					<td style="text-align:left"><?php echo $row['courseCode'];?></td>
				</tr>
				<tr class="details">
					<th>Course Name</th>
					<td style="text-align:left"><?php echo $row['courseName'];?></td>
				</tr>
				<tr class="details">
					<th>Department</th>
					<td style="text-align:left"><?php echo $row['department'];?></td>
				</tr>
				<tr class="details">
					<th>Semester</th>
					<td style="text-align:left"><?php echo $row['semester'];?></td>
				</tr>
			</table>
			<br>
			<table style="border:solid 1px;">	
				<tr class="heading" style="border:solid 1px;";>
					<th style="border:solid 1px;text-align:center">Lecture</th>
					<th style="border:solid 1px;text-align:center">Tutorial</th>
					<th style="border:solid 1px;text-align:center">Practical</th>
					<th style="border:solid 1px;text-align:center">Credit</th>
				</tr>
				<tr class="details">
					<td style="border:solid 1px;text-align:center"><?php echo $row['lecture'];?></td>
					<td style="border:solid 1px;text-align:center"><?php echo $row['tutorial'];?></td>
					<td style="border:solid 1px;text-align:center"><?php echo $row['practical'];?></td>
					<td style="border:solid 1px;text-align:center"><?php echo $row['credit'];?></td>
				</tr>
			</table>
		<br>
		<br>		
		
		<div class="panel panel-default">
			<div class="panel-heading">
				Students Enrolled
			</div>
			<div class="panel-body">
				<div class="table-responsive table-bordered">
					<table class="table" >
						<tr>
							<th>#</th>
							<th>Roll No</th>
							<th>Name</th>
							<th>CGPA</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Enroll Date</th>
						</tr>
						<?php
							$cnt=1;
							$sql=mysqli_query($con,"select students.studentRegNo, students.studentName, students.cgpa, students.studentMobile, students.studentEmail, courseenroll.enrollDate from courseenroll join students on courseenroll.studentRegNo=students.studentRegNo where courseenroll.courseCode='$data[2]' and courseenroll.applyfor='$data[1]' and courseenroll.session='$data[0]';");
							while($row=mysqli_fetch_array($sql)){?>
								<tr>
									<td style="overflow-wrap: break-word;"><?php echo $cnt?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['studentRegNo'];?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['studentName'];?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['cgpa'];?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['studentMobile'];?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['studentEmail'];?></td>
									<td style="overflow-wrap: break-word;"><?php echo $row['enrollDate'];?></td>
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