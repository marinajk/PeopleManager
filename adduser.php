<?php
require("db.php");
isset($_POST['level']);
$msg='';
if(isset($_POST['submit'])){

    $option = $_POST['level'];
    switch ($option) {
        case 0:
        $ut="none";
         $msg="Please select a valid user type";     
            break;
        case 1:
            $ut="Admin";
            break;
        case 2:
            $ut="Manager";
            break;
       case 3:
       $ut="Employee";
       break;
    } 
}
if(isset($_POST['submit']))
{
    $man=$_POST['manager'];
    
   
            if(isset($_POST['manager']))
            {
                $query="select * from Registration where fn='$man'";
            $result=mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $mid=$row['uid'];
            }
            
            
        }
                

if(isset($_POST['submit'])){
    
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
}


if(filter_has_var(INPUT_POST,'submit'))
{
   
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    

    if( !empty($email) && !empty($pass) && !empty($cpass))
    {
        if($ut=="none")
        {
            $msg="Please select the user type";
        }
        else if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false)
        {
            $msg="Please use a valid E-mail ID";
        }
        else if($pass != $cpass)
        {
            $msg="Passwords don't match";
        }
        else 
        {
            if($ut=="Admin")
            {
                $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL)";
            }
            else if($ut=="Manager")
            {
            $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL)";
            }
            else if($ut=="Employee")
            {    
                $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled,mid) values(NULL,NULL,NULL,'$email','$pass','$ut',NULL,'$mid')";
            }   
            if(mysqli_query($conn, $query))
            {
                $msg= $ut." added successfully";
            }
        }
    }
    else
    {
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
    <title>Add User</title>

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
                            <select name="level" id="usertype" class="au-input au-input--full" onchange="return showManager();">
                            <option value="0">-----</option>
                            <option value="1">Admin</option>
                            <option value="2">Manager</option>
                            <option value="3">Employee</option>
                            </select>
                            </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="cpassword" placeholder="Confirm Password">
                                </div>
                                <div class="form-group" id="manager" style="visibility:hidden;">
                                <label>Manager</label>
                                <select name="manager"  class="au-input au-input--full">
                                <option value="0">-----</option>
                                    <?php
                                    $query="select uid,fn from registration where ut='Manager'";
                                    $result=mysqli_query($conn, $query);
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo "<option value=".$row['fn'].">".$row['fn']." </option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">register</button>
                                
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
    <script>
function showManager()
{
var selectBox=document.getElementById('usertype');
var userInput=selectBox.options[selectBox.selectedIndex].value;
if(userInput=='3')
{
    document.getElementById('manager').style.visibility='visible';
}
else{
    document.getElementById('manager').style.visibility='hidden';
}
return false;
}
</script>
</body>

</html>
<!-- end document-->