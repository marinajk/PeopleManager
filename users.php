<?php
require("db.php");
session_start();
$msg='';
if(!isset($_POST['property'])&& isset($_POST['submit']))
{
    $msg="Please select the user type";

}
else 
{
    
   isset($_POST['property']);
   if(isset($_POST['submit']))
   {
       
    
    $option = $_POST['property'];
      
       switch ($option)
        {
           
           case 1:
           {
           $query="select uid,fn,ln,mobno,id from registration";  
           $msg=" List of All Users";
               break;
           }
           case 2:
           {
           $query="select uid,fn,ln,mobno,id from registration where ut='Admin'"; 
          $msg="List of Admins";
               break;
           }
           case 3:
           {
           $query="select uid,fn,ln,mobno,id from registration where ut='Manager'"; 
         $msg="List of Managers";
               break;
           }
          case 4:
          {
          $query="select uid,fn,ln,mobno,id from registration where ut='Employee'"; 
          $msg="List of Employees";
          break;
          }
        }
}
}



if(isset($_POST['delete']))
{
    $hidden=$_POST['hidden'];
    if(filter_has_var(INPUT_POST,'delete'))
    {
$query="delete from registration where uid='$hidden'";

$result=mysqli_query($conn, $query);

if($result)
{
header("refresh:1;url=users.php");
$msg="Deleted";
}
else
 $msg="Not deleted";
    }
}



if(isset($_POST['update']))
{
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $id=$_POST['emailid'];
    $hidden=$_POST['hidden'];

    if(filter_has_var(INPUT_POST,'update'))
    {
    $query="update registration set fn='$first',ln='$last',mobno='$mobile',id='$id', filled='Filled' where uid='$hidden'";

    $result=mysqli_query($conn, $query);

if($result)
{
    $msg="Updated ".$first;
}
else
$msg="Not updated";
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
    <title>Users List</title>

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
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        
                        <li>
                            <a href="admin.php">
                                <i class="fas fa-chart-bar"></i>Home</a>
                        </li>
                        
                        <li>
                            <a href="adduser.php">
                                <i class="far fa-check-square"></i>Add User</a>
                        </li>
                        <li>
                            <a href="assign.php">
                                <i class="fas fa-users"></i>Update Assignment</a>
                        </li>
                        
                        
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="admin.php">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                    <li>
                            <a href="admin.php">
                                <i class="zmdi zmdi-home"></i>Home</a>
                        </li>
                        
                        <li>
                            <a href="adduser.php">
                                <i class="zmdi zmdi-accounts-add"></i>Add User</a>
                        </li>
                        <li>
                            <a href="assign.php">
                                <i class="fas fa-users"></i>Update Assignment</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for managers &amp; employees..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-account"></i>
                                        <span class="quantity"><?php $query="select * from Registration where ut='Admin'";
                                                $result=mysqli_query($conn, $query);
                                                $count = mysqli_num_rows($result);
                                                echo $count; ?></span>
                                        
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-accounts"></i>
                                        <span class="quantity"><?php $query="select * from Registration where ut='Manager'";
                                                $result=mysqli_query($conn, $query);
                                                $count = mysqli_num_rows($result);
                                                echo $count; ?></span>
                                          </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-accounts-add"></i>
                                        <span class="quantity"><?php $query="select * from Registration where ut='Employee'";
                                                $result=mysqli_query($conn, $query);
                                                $count = mysqli_num_rows($result);
                                                echo $count; ?></span>
                                                </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                        <img src='ProfilePictures/<?php echo $_SESSION['img'];?>' alt="profile" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                    <img src='ProfilePictures/<?php echo $_SESSION['img'];?>' alt="profile" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['emailid']?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="myaccount.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                               </div>
                                          
                                            <div class="account-dropdown__footer">
                                                <a href="login.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                                <!-- DATA TABLE -->
                                
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <form method=post action=users.php>
                                            
                                            <select class="js-select2" name="property" id="usertype"  >
                                            
                                                <option value="1" selected="selected">All Users</option>
                                                <option value="2">Admins</option>
                                                <option value="3">Managers</option>
                                                <option value="4">Employees</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-success" value="Confirm">
</form>
                                    </div>
                                   
                                </div>
                             <?php if($msg!=''): ?>
                             <?php echo $msg;?> <?php endif; ?>
                           

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                    
                                    <h3 class="title-5 m-b-35"></h3>
                                        <thead>
                                            <tr>
                                                
                                                    
                                               
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Mobile Number</th>
                                                <th>Email Address</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr-shadow">
                                            <?php
   isset($_POST['property']);
   if(isset($_POST['submit']))
   {
       
    
    $option = $_POST['property'];
      
       switch ($option)
        {
           
           case 1:
           {
           $query="select uid,fn,ln,mobno,id from registration";  
           $msg=" List of All Users";
               break;
           }
           case 2:
           {
           $query="select uid,fn,ln,mobno,id from registration where ut='Admin'"; 
          $msg="List of Admins";
               break;
           }
           case 3:
           {
           $query="select uid,fn,ln,mobno,id from registration where ut='Manager'"; 
         $msg="List of Managers";
               break;
           }
          case 4:
          {
          $query="select uid,fn,ln,mobno,id from registration where ut='Employee'"; 
          $msg="List of Employees";
          break;
          }
        }
   $result=mysqli_query($conn,$query);
   
  
   if($result-> num_rows>0)
   {
   while($row=mysqli_fetch_array($result))
   {
       echo "<form action=users.php method=post>";
   
       echo "<tr>";
       echo "<td>"."<input type=text name=firstname value=".$row['fn']."> </td>";
       echo "<td>"."<input type=text name=lastname value=".$row['ln']."> </td>";
       echo "<td>"."<input type=text name=mobilenumber value=".$row['mobno']."> </td>";
       echo "<td>"."<input type=text name=emailid value=".$row['id']."> </td>";
      
       echo "<td>"."<input type=hidden name=hidden value=".$row['uid']."> </td>";

       echo "<td>"."<div class=table-data-feature><button name=update class=item data-toggle=tooltip data-placement=top title=Edit><i class='zmdi zmdi-edit'></i> </button>
       <button name=delete class=item data-toggle=tooltip data-placement=top title=Delete><i class='zmdi zmdi-delete'></i></button></div></td></tr>";
       
       echo "</form>";
   }

   echo "</table>";
   }}

   else{
       $msg="No records available";
   }

       ?>
       
                                                
                                                
                                                 
                                               
                                               
                                           
                                </div>
                                <!-- END DATA TABLE -->
                            

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
