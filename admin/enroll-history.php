<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
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
<?php if($_SESSION['alogin']!="")
{
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
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
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
<button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> </a>                                        


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
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
