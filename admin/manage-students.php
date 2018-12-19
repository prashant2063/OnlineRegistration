<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from students where studentRegNo = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Student record deleted !!";
      }

     if(isset($_GET['pass']))
      {
        $password="Test@123";
        $newpass=md5($password);
              mysqli_query($con,"update students set password='$newpass' where studentRegNo = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Password Reset. New Password is Test@123";
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
                        <h1 class="page-head-line">Manage Students  </h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Students
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Registration No </th>
                                            <th>Student Name </th>
                                             <th>Date of Registration</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select studentRegNo, studentName, creationDate from students");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['studentRegNo']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                            <td>
											<a href="manage-students.php?id=<?php echo $row['studentRegNo']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button></a>
											<a href="manage-students.php?id=<?php echo $row['studentRegNo']?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
											<button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
											</a>
                                            </td>
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
