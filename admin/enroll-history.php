<?php
	session_start();
	include('includes/config.php');
	error_reporting(0);
	if(strlen($_SESSION['alogin'])==0){   
		header('location:index.php');
	}
	else{
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Enroll History</title>
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
		<?php include('includes/header.php');?>
		<!-- LOGO HEADER END-->
		<?php if($_SESSION['alogin']!=""){
			include('includes/menubar.php');
		}
		?>
		<!-- MENU SECTION END-->
		<div class="content-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-head-line">Enroll History  </h1>
					</div>
				</div>
				<div class="row" >
					<div class="col-md-12">
						<!--    Bordered Table  -->
						<div class="panel panel-default">
							<div class="panel-heading">
							   Enroll History
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body",>
							<form>
								<div class="form-group">
									     <div class="col-sm-4">
									<select class="form-control" name="select_two" id="enrollment_type" required="required">
										<option value="regular">Regular</option>
										<option value="supplementary">Supplementary</option>
										<option value="improvement">Improvement</option>
									</select> 
									</div>
								</div>
								<div class="form-group">
									           <div class="col-sm-4">
									<select class="form-control" id="select_one" name="select_one" onChange="get_select_two()" required="required">
										<option value="">--SELECT FILTER--</option>
										<option value="student_wise">Student-Wise</option>
										<option value="course_wise">Course-Wise</option>
										<option value="department_wise">Department-Wise</option>
									</select> 
									</div>
								
								</div>
								<div class="form-group" id="select_two">
									           <div class="col-sm-4">
									<select class="form-control" name="select_two" required="required">
										<option value="">--SELECT VALUE--</option>
									</select> 
								
							</div>
								</div>
							</form>	
							</div>

								<div class="table-responsive table-bordered">
									<table class="table" id="my_table">
										<thead>
											<tr>
												<th>#</th>
												<th>Reg no </th>
												<th>Apply For </th>
												<th>Course Name </th>
												<th>Session </th>
												<th>Department </th>
												<th>Semester</th>
												<th>Receipt</th>
												<th>Enrollment Date</th>
												 
												 <!--th>Action</th-->
											</tr>
										</thead>
										<tbody>
											<?php
											$sql=mysqli_query($con,"select studentRegNo,applyfor,courseName,session,department,semester,enrollDate,receipt from courseenroll;");
											$cnt=1;
											while($row=mysqli_fetch_array($sql))
											{
											?>


											<tr>
												<td><?php echo $cnt;?></td>
												<td><?php echo htmlentities($row['studentRegNo']);?></td>
												<td><?php echo htmlentities($row['applyfor']);?></td>
												<td><?php echo htmlentities($row['courseName']);?></td>
												<td><?php echo htmlentities($row['session']);?></td>
												<td><?php echo htmlentities($row['department']);?></td>
												<td><?php echo htmlentities($row['semester']);?></td>
												<td>
													<a target="_blank" href="../receipt/<?php echo htmlentities($row['receipt']);?>">
														<img class="receipt_photu" src="../receipt/<?php echo htmlentities($row['receipt']);?>">
													</a>                                        
												</td>
												<td><?php echo htmlentities($row['enrollDate']);?></td>
												
												<!--td>
													<a href="print.php?id=<?php echo $row['cid']?>" target="_blank">
														<button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> 
													</a>                                        
												</td-->
											</tr>
											<?php 
											$cnt++;
											} ?>               
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--  End  Bordered Table  -->
					</div>
				</div>





			</div>
		</div>
		<!--a href="print.php"><button>Print</button></a-->
		<!-- CONTENT-WRAPPER SECTION END-->
		<?php include('includes/footer.php');?>
		<!-- FOOTER SECTION END-->
		<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
		<!-- CORE JQUERY SCRIPTS -->
		<script src="assets/js/jquery-1.11.1.js"></script>
		<script type="text/javascript">
			function get_select_two(){
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("GET","get_data.php?select_one="+document.getElementById("select_one").value,false);
				//alert(document.getElementById("select_one").value);
				xmlhttp.send(null);
				document.getElementById("select_two").innerHTML=xmlhttp.responseText;
				//alert(xmlhttp.responseText);
			}
			
			function get_table(){
				//alert(document.getElementById("select_two_dd").value);
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("GET","get_table_data.php?enrollment_type="+document.getElementById("enrollment_type").value+"&select_one="+document.getElementById("select_one").value+"&select_two="+document.getElementById("select_two_dd").value,false);
				//alert(document.getElementById("select_one").value);
				xmlhttp.send(null);
				document.getElementById("my_table").innerHTML=xmlhttp.responseText;
				//alert(xmlhttp.responseText);
			}
			
		</script>
		
		<!-- BOOTSTRAP SCRIPTS  -->
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>
<?php } ?>