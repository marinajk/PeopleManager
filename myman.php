<?php
require("db.php");
session_start();

$email=$_SESSION['emailid'];
$pass=$_SESSION['password'];

$query="select * from Registration where id='$email' and pwd='$pass'";
$result=mysqli_query($conn, $query);

$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($count==1)
    {
        $_SESSION['uid']=$row['uid'];
        $_SESSION['usertype']=$row['ut'];
        $_SESSION['firstname']=$row['fn'];
        $_SESSION['lastname']=$row['ln'];
        $_SESSION['mobilenumber']=$row['mobno'];
        $_SESSION['filled']=$row['filled'];
        $_SESSION['mid']=$row['mid'];

    }

$mid=$_SESSION['mid'];
    $query="select uid,fn,ln,mobno,id,img from registration where uid='$mid'";
   $result=mysqli_query($conn, $query);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
   if($count==1)
   {
       $_SESSION['mid']=$row['uid'];
     $_SESSION['mimg']=$row['img'];
       $_SESSION['mfirstname']=$row['fn'];
       $_SESSION['mlastname']=$row['ln'];
       $_SESSION['mmobilenumber']=$row['mobno'];
        $_SESSION['memailid']=$row['id'];

   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Manager</title>

    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

<!-- Vendor CSS-->
<link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
<link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
<link href="vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
<link href="vendor/slick/slick.css" rel="stylesheet" media="all">
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
<link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">


    <link href="css/theme.css" rel="stylesheet" media="all">
</head>
<body style="text-align:center;">

            <div class="header__logo">
                        <a href="employee.php">
                            <img src="images/icon/logo.png"  height="80px" width="300px" alt="CoolAdmin" />
                        </a>
            </div>
            
            <br>

            <div class="col-md-4" style="text-align:center;">
                <div class="card" style="position:absolute; text-align:center;left:600px; width:fit-content;">
                                    <div class="card-header">
                                        <i class="fa fa-user"></i>
                                        <strong class="card-title">My Manager's Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <div class="image img-cir img-120" style="margin-left:30px;">
                        <img src='ProfilePictures/<?php echo $_SESSION['mimg'];?>' alt="John Doe" />
                    </div>
                                             <h5 class="text-sm-center mt-2 mb-1"><?php echo $_SESSION['mfirstname']." ".$_SESSION['mlastname'];?></h5>
                                            <div class="location text-sm-center">
                                                <i class="fa fa-map-marker"></i> <?php echo $_SESSION['memailid'];?></div>
                                                <i class="fa fa-map-marker"></i> <?php echo $_SESSION['mmobilenumber'];?></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
</body>
</html>