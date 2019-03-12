<?php
include("includes/config.php");
error_reporting(0);
?>
<?php if($_SESSION['login']!="")
{?>
<header>
   
  
                <div class="container">
                    <strong>Welcome: </strong><?php echo htmlentities($_SESSION['sname']); ?>
                    &nbsp;&nbsp;
                    
                    <strong>Last Login: </strong><?php 
					$ret=mysqli_query($con,"SELECT  * from userlog where studentRegno='".$_SESSION['login']."' order by id desc limit 1,1");
                    $row=mysqli_fetch_array($ret);
                    echo $row['userip']; ?> at <?php echo $row['loginTime'];?>
                    <div style="float: right;">
                        <a style="color: #e6e6e6;" href="http://accounts.google.com" target="_blank">Webmail</a>
                        |
                        <a style="color: #e6e6e6;" href="http://nith.ac.in/td/index.html" target="_blank">Directory</a>
                        | Contact Us: 01972-254011
                    </div>
                </div>
          
        
    </header>
    <?php } ?>
    <!-- HEADER END-->
	
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
			<div class="navbar-header">
				<a href="http://www.nith.ac.in" style=" font-size: 40px;">
                   	<img style="width: 70%; padding: 10px 0" src="studentphoto/newlogo.png"> 
                </a>
			</div>
        </div>
    </div>
<!--
	<div style=" font-size: 50px; margin-top: 30px; color: #0;" class="text-center">
		<p>Online Registration</p>
	</div>	
	-->
