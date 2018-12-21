
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Course Enroll</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course Enroll </h1>
                    </div>
                </div>
					<div class="row">
						<div class="col-md-3">
							<div class="thumbnail">
							<?php $sql=mysqli_query($con,"select * from students where StudentRegNo='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>
<div class="form-group">
    <label for="studentPhoto"></label>
   <?php if($row['studentPhoto']==""){ ?>
   <center><img src="studentphoto/noimage.png" width="200" height="200"></center><?php } else {?>
   <center><img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200"></center>
   <?php } ?>
  </div>

							</div>
						</div>
						
					
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Course Enroll
                        </div>

<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
						
                       <form action="availaible-course.php" name="dept" method="post" enctype="multipart/form-data">

	<div class="form-group">
    <label for="Applyfor">Apply for  </label>
    <select class="form-control" name="applyfor" required="required">
   <option value="">Select Apply for</option>   
   <?php 
$sql=mysqli_query($con,"select * from applyfor");
while($row1=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row1['applyfor']);?>"><?php echo htmlentities($row1['applyfor']);?></option>
<?php } ?>

    </select> 
  </div> 

  <div class="form-group">
    <label for="studentname">Student Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>" readonly />
  </div>

 <div class="form-group">
    <label for="studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['studentRegNo']);?>"  placeholder="Student Reg no" readonly />
    
  </div>

  <div class="form-group">
    <label for="uploadPhoto">Upload Fee Receipt  </label>
    <input type="file" class="form-control" id="photo" name="receipt"  value="<?php echo htmlentities($row['receipt'])?>" />
  </div>
   
  
 <?php } ?>

<div class="form-group">
    <label for="Session">Session  </label>
    <select class="form-control" name="session" required="required">
   <option value="">Select Session</option>   
   <?php 
$sql=mysqli_query($con,"select * from session");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['session']);?>"><?php echo htmlentities($row['session']);?></option>
<?php } ?>

    </select> 
  </div> 



<div class="form-group">
    <label for="Department">Department  </label>
    <select class="form-control" name="department" required="required">
   <option value="">Select Depertment</option>   
   <?php 
$sql=mysqli_query($con,"select * from department");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['department']);?>"><?php echo htmlentities($row['department']);?></option>
<?php } ?>

    </select> 
  </div> 
  
  
<div class="form-group">
    <label for="Semester">Semester  </label>
    <select class="form-control" name="semester" required="required">
   <option value="">Select Semester</option>   
   <?php 
$sql=mysqli_query($con,"select * from semester");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['semester']);?>"><?php echo htmlentities($row['semester']);?></option>
<?php } ?>

    </select> 
  </div>






 <button type="submit" name="submit" id="submit" class="btn btn-default">SUBMIT</button>
 </form>
                            </div>
                            </div>
                    </div>
                  
                

            </div>





        </div>
    </div>
	</div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	
	</body>
</html>
<?php  ?>
