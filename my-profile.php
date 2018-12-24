  <?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$studentname=$_POST['studentname'];
$photo=$_FILES["photo"]["name"];
$guardianname=$_POST['guardianname'];
$cgpa=$_POST['cgpa'];
$permanentaddress=$_POST['permanentaddress'];
$correspondenceaddress=$_POST['correspondenceaddress'];
move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
$ret=mysqli_query($con,"update students set studentPhoto='$photo', guardianName='$guardianname', permanentAddress='$permanentaddress', correspondenceAddress='$correspondenceaddress' where StudentRegNo='".$_SESSION['login']."'");
if($ret)
{
$_SESSION['msg']="Student Record updated Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Student Record not update";
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
    <title>Student Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<script>
  function copy(){
    if(ch.checked==true)
    {
      document.getElementById('permanentaddress').value=document.getElementById('correspondenceaddress').value;
    }
    else 
      document.getElementById('permanentaddress').value='';
  }
</script>

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
		<?php $sql=mysqli_query($con,"select studentName from students where StudentRegNo='".$_SESSION['login']."'"); 
		$row=mysqli_fetch_array($sql);?>
		<p style="font-size:30px;margin-bottom:0px;padding-bottom:0px;">
		<?php echo htmlentities($row['studentName']);?><p>
                        <h1 style="margin-top:0px;padding-top:0px;" class="page-head-line" ></h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"><div class="thumbnail">
							<?php $sql=mysqli_query($con,"select * from students where StudentRegno='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>
<div class="form-group">
    <center><label for="studentPhoto"></label></center>
   <?php if($row['studentPhoto']==""){ ?>
   <center><img src="studentphoto/noimage.png" width="200" height="200" ></center><?php } else {?>
   <center><img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200" ></center>
   <?php } ?>
  </div>

							</div>
							</div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Student Profile
                        </div>
<center><font color="green" align="right"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font></center>


                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="studentname">Student Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>" readonly />
  </div>

 <div class="form-group">
    <label for="studentregno">Student Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['studentRegNo']);?>"  placeholder="Student Reg no" readonly />
    
  </div>

  <div class="form-group">
    <label for="guardianname">Father/Guardian Name   </label>
    <input type="text" class="form-control" id="guardianname" name="guardianname" value="<?php echo htmlentities($row['guardianName']);?>"  placeholder="Father/Guardian Name"/>
    
  </div>

<div class="form-group">
    <label for="CGPA">CGPA  </label>
    <input type="text" class="form-control" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" readonly />
  </div>  

<div class="form-group">
    <label for="uploadPhoto">Upload New Photo  </label>
    <input type="file" class="form-control" id="photo" name="photo"  value="<?php echo htmlentities($row['studentPhoto']);?>"  />
  </div>

 <div class="form-group">
    <label for="correspondenceaddress">Correspondence Address</label>
    <input type="text" class="form-control" id="correspondenceaddress" name="correspondenceaddress" value="<?php echo htmlentities($row['correspondenceAddress']);?>"  placeholder="Correspondence Address"/>

  </div>


<div class="form-group">
    <label for="permanentaddress">Permanent Address</label>
      <div class="col-md-0">
      <input type="checkbox" name="checkbox" onclick="copy()" id="ch" fontsize="100%"/>  Same as Correspondence Address
      </div>
    <input type="text" class="form-control" id="permanentaddress" name="permanentaddress" value="<?php echo htmlentities($row['permanentAddress']);?>"  placeholder="Permanent Address" /> 
  </div>
  <?php } ?>
 <center><button type="submit" name="submit" id="submit" class="btn btn-default" >Update</button></center>
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
<?php } ?>
