<?php
require("db.php");
session_start();


if(isset($_POST['submit'])){
    
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
    $_SESSION['emailid'] = $email;
    $_SESSION['password'] = $pass;

}
$msg='';
if(filter_has_var(INPUT_POST,'submit'))
{
    $email=$_POST['emailid'];
    $pass=$_POST['password'];
   

    if(!empty($email) && !empty($pass) )
    {
         if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
        {
            $class="btn-danger";
            $msg="Please use a valid E-mail ID";
        }
        
        else 
        {
            
        $query="select * from Registration where id='$email' and pwd='$pass'";
        $result=mysqli_query($conn, $query);
        
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         if($count==1)
            {
    
               $filled=$row['filled'];

               $_SESSION['filled'] = $filled;
               if(!empty($_POST["remember"]))
               {
                   setcookie("emailid",$_POST["member_login"],time()+(10*365*24*60*60));
                   setcookie("password",$_POST["member_password"],time()+(10*365*24*60*60));
               }
             
               if($filled==NULL)
                {
                        header("Location:details.php");
                }   
                else
                {
                    $_SESSION['usertype']=$row['ut'];
                    $utype=$_SESSION['usertype'];
                    
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
            else
            {
                $class="btn-danger";
                $msg="Invalid Email ID or Password";
        
            }
        }
    }
    else
    {
        $class="btn-danger";
        $msg="Please fill in all the fields";
 
    }

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
    <title>Login</title>

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
                            <?php echo "<div class=".$class.">"; if($msg!=''): ?>
                            <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
                            </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="emailid" placeholder="Email Address" value="<?php if(isset($_COOKIE["member_login"])){ echo $_COOKIE["member_login"];}?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])){ echo $_COOKIE["member_password"];}?>">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">sign in</button>
                                
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