<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";

$now=time();
  if($now > $_SESSION['expire']){

  	date_default_timezone_set('Asia/Kolkata');
	$ldate = date( 'Y-m-d h:i:s', time () );
	$status=0;
	mysqli_query($con,"UPDATE userlog  SET logout = '$ldate', status='$status' WHERE studentRegno = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
    session_destroy();
    $extra="sessionexpire.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
  }
  
date_default_timezone_set('Asia/Kolkata');
$ldate = date( 'Y-m-d h:i:s', time () );
$status=0;
mysqli_query($con,"UPDATE userlog  SET logout = '$ldate', status='$status' WHERE studentRegno = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
