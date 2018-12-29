<?php
	session_start();
	error_reporting(0);
	include("includes/config.php");
	if(isset($_POST['submit'])){
		$regno=$_POST['regno'];
		$password=md5($_POST['password']);
		$query=mysqli_query($con,"SELECT * FROM students WHERE StudentRegno='$regno' and password='$password'");
		$num=mysqli_fetch_array($query);
		if($num>0){

            $_SESSION['start']=time();
            $_SESSION['expire']=$_SESSION['start']+(60);
			$extra="my-profile.php";
			$_SESSION['login']=$_POST['regno'];
			$_SESSION['id']=$num['studentRegno'];
			$_SESSION['sname']=$num['studentName'];
			
			if (!empty($_SERVER["HTTP_CLIENT_IP"])){
				$ip = $_SERVER["HTTP_CLIENT_IP"];
			}
			elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
				$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			else{
				$ip = $_SERVER["REMOTE_ADDR"];
			}
			echo $ip;
			
			//$uip=$_SERVER['REMOTE_ADDR'];
			$status=1;
			$log=mysqli_query($con,"insert into userlog(studentRegno,userip,status) values('".$_SESSION['login']."','$ip','$status')");
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}
		else{
			$_SESSION['errmsg']="Invalid Reg no or Password";
			$extra="index.php";
			$host  = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Student Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
            </div>
            <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
            <!--div class="row"-->
			
			<form name="admin" method="post">
            
                <div class="col-md-6">
                    <label>Enter Reg no : </label>
						<input type="text" name="regno" class="form-control"  />
                        <label>Enter Password :  </label>
                        <input type="password" name="password" class="form-control"  />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
                </div>
            </form>
            <div class="col-md-6">
                <div class="alert alert-info">
                    This is Major Project-1 (CSD-419) based on Online Student Registration and this is made by Anvesh Anand(15MI552), Gautam Poddar(15MI532), Raj Rahi(15MI530), Prashant Gupta(15MI542) and Pramod Singh(15MI547) Under the guidance of Dr.Siddhartha Chauhan of CSE Department, NIT HAMIRPUR. 
                    <br />
                    <strong> Platforms Used are given below :</strong>
                    <ul>
                        <li>
                            Apache Server
                        </li>
						<li>
							PHP
                        </li>
                        <li>
                            Java Script
                        </li>
                        <li>
                            HTML
                        </li>
                    </ul>               
                </div>
            </div>

			<!--/div-->
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
