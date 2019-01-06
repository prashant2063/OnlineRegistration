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
	?>
	<div class="col-md-12">
						<h1 class="page-head-line"><?php echo $data[2];?>  </h1>
	</div>
		<?php
		$sql=mysqli_query($con,"select courseCode, courseName, department, semester, lecture, tutorial, practical, credit from course where courseCode='$data[2]';");
		//$cnt=1;
		$row=mysqli_fetch_array($sql);?>
		<table style="margin-bottom:20px;border:solid black 1px;">
			<tr>
				<th>Session</th>
				<td style="text-align:left"><?php echo $data[0];?></td>
			</tr>
		</table>
			
			<br>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				Students Enrolled
			</div>
			<div class="panel-body">
				<div class="table-responsive table-bordered">
					<table class="table" >
						<thead>
							<tr>
								<th>#</th>
								<th>Roll No</th>
								<th>Courses Enrolled</th>
								<th>Semester</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql=mysqli_query($con,"select studentRegNo, courseCode, semester from courseenroll where department='$data[2]' and applyfor='$data[1]' and session='$data[0]' order by semester, studentRegNo, courseCode;");
							$row=mysqli_fetch_array($sql);
							$current_student=$row['studentRegNo'];
							//$current_session=$row['session'];
							$current_semester=$row['semester'];
							$courseArray=array($row['courseCode']);
							$cnt=1;
							while($row=mysqli_fetch_array($sql)){
								if($current_student==$row['studentRegNo'] AND $current_semester==$row['semester']) {
										array_push($courseArray,$row['courseCode']);
									}
								else{
						?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php echo $current_student;?></td>
											<td><?php echo implode(',', $courseArray);?></td>
											<td><?php echo $current_semester;?></td>
										</tr>
									<?php
										$cnt++;
										$current_student=$row['studentRegNo'];
										//$current_session=$row['session'];
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
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
			
			
	   

	  <button class="btn btn-primary hideit" onClick="window.print();"><i class="fa fa-print "></i> Print</button> 
	</div>
	</body>
	</html>
<?php } ?>