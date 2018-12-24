<?php
	session_start();
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:index.php');
	}
	else{
		$id=intval($_GET['id']);
		date_default_timezone_set('Asia/Kolkata');// change according timezone
		$currentTime = date( 'Y-m-d h:i:s', time () );
		if(isset($_POST['submit'])){
			$coursecode=$_POST['coursecode'];
			$coursename=$_POST['coursename'];
			$lecture =$_POST ['lecture'];
			$tutorial=$_POST ['tutorial'];
			$practical=$_POST ['practical'];
			$credit=$_POST['credit'];
			$seatlimit=$_POST['seatlimit'];
			$department=$_POST['department'];
			$semester=$_POST['semester'];
			$courseType=$_POST ['courseType'];
			$chk=mysqli_query($con,"select * from course where courseCode='$coursecode' and courseName='$coursename' and department='$department' and semester='$semester' and courseType='$courseType'");
			$num=mysqli_fetch_array($chk);
			if(!$num){
				$ret=mysqli_query($con,"update course set courseCode='$coursecode',courseName='$coursename',lecture='$lecture',tutorial='$tutorial',practical='$practical',credit='$credit',noofseats='$seatlimit',department='$department',semester='$semester',courseType='$courseType',creationDate='$currentTime' where id='$id'");
				if($ret){
					$_SESSION['msg']="Course Updated Successfully !!";
				}
				else{
					$_SESSION['msg']="Error : Course not Updated";
				}
			}
			else{
				$_SESSION['msg']="Course not updated. Already exists";
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Course</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
                        <h1 class="page-head-line">Course  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
					<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Course 
                        </div>



                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select * from course where id='$id'");
//$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<p><b>Last Updated at</b> :<?php echo htmlentities($row['creationDate']);?></p>
   <div class="form-group">
    <label for="coursecode">Course Code  </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo htmlentities($row['courseCode']);?>" required />
  </div>

 <div class="form-group">
    <label for="coursename">Course Name  </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" value="<?php echo htmlentities($row['courseName']);?>" required />
  </div>

<div class="form-group">
    <label for="lecture">Lecture  </label>
    <input type="text" class="form-control" id="lecture" name="lecture" placeholder="Lecture" value="<?php echo htmlentities($row['lecture']);?>" required />
  </div>

<div class="form-group">
    <label for="tutorial">Tutorial  </label>
    <input type="text" class="form-control" id="tutorial" name="tutorial" placeholder="Tutorial" value="<?php echo htmlentities($row['tutorial']);?>" required />
  </div>  

<div class="form-group">
    <label for="practical">Practical  </label>
    <input type="text" class="form-control" id="practical" name="practical" placeholder="Practical" value="<?php echo htmlentities($row['practical']);?>" required />
	</div>

<div class="form-group">
    <label for="credit">Credit  </label>
    <input type="text" class="form-control" id="credit" name="credit" placeholder="Credit" value="<?php echo htmlentities($row['credit']);?>" required />
  </div>
	
<div class="form-group">
    <label for="courseType">Course Type   </label>
    <select class="form-control" name="courseType" required="required">
	<option value="">Select Course Type</option>
	<option value="Compulsory" <?php if($row['courseType']=="Compulsory") {?>selected="selected"<?php } ?>>Compulsory</option>
	<option value="Elective" <?php if($row['courseType']=="Elective") {?>selected="selected"<?php } ?>>Elective</option>
	</select>
  </div>  	
	
<div class="form-group">
    <label for="seatlimit">Seat limit  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" value="<?php echo htmlentities($row['noofseats']);?>" required />
  </div>  
  
<div class="form-group">
    <label for="department">Department</label>
    <select class="form-control" name="department" required="required">  
   <?php 
$sql=mysqli_query($con,"select * from department");
while($curr=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($curr['department']);?>"<?php if($curr['department']==$row['department']){?>selected="selected"<?php } ?>><?php echo htmlentities($curr['department']);?></option>
<?php } ?>

    </select> 
  </div>  
  
<div class="form-group">
    <label for="semester">Semester</label>
    <select class="form-control" name="semester" required="required"> 
   <?php 
$sql=mysqli_query($con,"select * from semester");
while($curr=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($curr['semester']);?>" <?php if($curr['semester']==$row['semester']){?>selected="selected"<?php } ?>><?php echo htmlentities($curr['semester']);?></option>
<?php } ?>

    </select> 
  </div>

<?php } ?>
 <button type="submit" name="submit" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</button>
</form>
                            </div>
                            </div>
                    </div>
                  
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
