<?php
	session_start();
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:index.php');
	}
	else{
		if(isset($_POST['submit'])){
			$applyfor=$_POST['applyfor'];
			$chk=mysqli_query($con,"select applyfor from applyfor where applyfor='$applyfor';");
			if(!mysqli_fetch_array($chk)){
				$ret=mysqli_query($con,"insert into applyfor(applyfor) values('$applyfor')");
				if($ret){
					$_SESSION['msg']="Applying for field Created Successfully !!";
				}
				else{
					$_SESSION['msg']="Error : Field not created";
				}
			}
			else{
				$_SESSION['msg']="Apply for field already exists";
			}
		}
		if(isset($_GET['del']))
		{
			mysqli_query($con,"delete from applyfor where id = '".$_GET['id']."'");
			$_SESSION['delmsg']="Field deleted!!!";
		}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Apply For</title>
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
                        <h1 class="page-head-line">Apply For </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
					<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Create New Field
                        </div>

                        <div class="panel-body">
                       <form name="applyfor" method="post">
   <div class="form-group">
    <label for="applyfor">New Field</label>
    <input type="text" class="form-control" id="applyfor" name="applyfor" placeholder="Apply For" />
  </div>
 <center><button type="submit" name="submit" class="btn btn-default">Submit</button></center>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
               
                <div class="col-md-12">
<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>               
			   <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage field
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Apply For</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from applyfor");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['applyfor']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                            <td>
  <a href="applyfor.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
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
