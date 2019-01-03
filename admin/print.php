<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Course Enrollment Print</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:18px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:10px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:30px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
<?php
//$cid=intval($_GET['id']);
$sql=mysqli_query($con,"select courseenroll.courseName, courseenroll.courseCode, courseenroll.session, courseenroll.department, courseenroll.enrollDate, courseenroll.semester, students.studentName, students.studentPhoto, students.cgpa, students.studentRegNo, students.creationDate from courseenroll join students on students.StudentRegNo=courseenroll.StudentRegNo where courseenroll.courseCode='CSS-111';");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{?>


        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                  <?php if($row['studentPhoto']==""){ ?>
   <img src="../studentphoto/noimage.png" width="200" height="200"><?php } else {?>
   <img src="../studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200">
   <?php } ?>
                            </td>
                            
                            <td>
                               <b> Reg No: </b><?php echo htmlentities($row['studentRegNo']);?><br>
                               <b> Student Name: </b>  <?php echo htmlentities($row['studentName']);?><br>
                               <b> Student Reg Date:</b> <?php echo htmlentities($row['creationDate']);?><br>
                                <b> Student Course Enroll Date:</b> <?php echo htmlentities($row['enrollDate']);?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
      
            <tr class="heading">
                <td>
                   Course Details
                </td>
                
                <td>
                   
                </td>
            </tr>
            
            <tr class="details">
                <td>
                  Course Code
                </td>
                
                <td>
                  <?php echo htmlentities($row['courseCode']);?>
                </td>
            </tr>

            <tr class="details">
                <td>
                  Course Name
                </td>
                
                <td>
                  <?php echo htmlentities($row['courseName']);?>
                </td>
            </tr>


            <tr class="details">
                <td>
                  Course Credit
                </td>
                
                <td>
                  <?php echo "cunit";?>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                   Other Details
                </td>
                
                <td>
                   
                </td>
            </tr>
            
            <tr class="item">
                <td>
                     Session
                </td>
                
                <td>
                    <?php echo htmlentities($row['session']);?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                   Department
                </td>
                
                <td>
                   <?php echo htmlentities($row['department']);?>
                </td>
            </tr>
 


           
                
               
            </tr>
            
            <tr class="item last">
                <td>
                   Semester
                </td>
                
                <td>
                     <?php echo htmlentities($row['semester']);?>
                </td>
            </tr>
            
         
        </table>
        <?php } ?>
    </div>
</body>
</html>
<?php } ?>