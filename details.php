<?php
require("db.php");
session_start();

if(isset($_POST['submit'])){
    
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $_SESSION['firstname'] = $first;
    $_SESSION['lastname'] = $last;
    $_SESSION['mobilenumber'] = $mobile;

}

$msg='';
if(filter_has_var(INPUT_POST,'submit'))
{
   
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    
    $email=  $_SESSION['emailid'] ;
 
    if(!empty($first) && !empty($last) && !empty($mobile))
    {
        
        if(!preg_match("/^[a-zA-Z ]*$/",$first))
    {
        $msg= "First Name is NOT valid";
    }
    
     else if(!preg_match("/^[a-zA-Z ]*$/",$last))
    {
        $msg= "Last Name is NOT valid";
    }
   
    else if(filter_var($mobile,FILTER_VALIDATE_INT) === false && !preg_match("/^\d{10}$/",$mobile) && strlen($mobile)>10 || strlen($mobile)<10 )
    {
        $msg= "Mobile Number is NOT valid";
    }
    else{
        try{
            $query="update Registration set fn='$first',ln='$last',mobno='$mobile',filled='Filled' where id='$email'";
            
            $result=mysqli_query($conn, $query);
            $query="select * from registration where id='$email'";
            $result=mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

          
                if($result)
                {
                    $_SESSION['usertype']=$row['ut'];

                    
                    $utype=$_SESSION['usertype'];
                    $msg=$utype."Account Details Updated";
                   
                    
                    $_SESSION['firstname'] = $first;
                    $_SESSION['lastname'] = $last;
                    $_SESSION['mobilenumber'] = $mobile;

                    if($utype=="Admin")
                    {
                    header("Location:admin.php");
                    }
                    else if($utype=="Manager")
                    {
                        header("Location:manager.php");
                    }
                    else if($utype=="Employee")
                    {
                        header("Location:employee.php");
                    }
                
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        
        }    
    }
}
    else
    {
        $msg="Please fill in all the fields";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Details Form</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            
                            <form action="" method="post">
                            <div class="btn-danger"> <?php if($msg!=''): ?>
                            <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
                            </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="au-input au-input--full" type="text" name="firstname" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="au-input au-input--full" type="text" name="lastname" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="au-input au-input--full" type="phone" name="mobilenumber" placeholder="Mobile Number">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->