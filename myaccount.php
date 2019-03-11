<?php
require("db.php");
session_start();
$email=$_SESSION['emailid'];
$msg='';


if(isset($_POST['update']))
{
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $mobile=$_POST['mobilenumber'];
    $id=$_POST['emailid'];
    $hidden=$_POST['hidden'];
    

  $target="ProfilePictures/".basename($_FILES['image']['name']);
$image=$_FILES['image']['name'];

  
}
    if(filter_has_var(INPUT_POST,'update'))
    {
    $query="update registration set fn='$first',ln='$last',mobno='$mobile',id='$id', filled='Filled', img='$image' where uid='$hidden'";

    $result=mysqli_query($conn, $query);
if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
{
    $msg="Image uploaded successfully";
}
else
{
    $msg="There was a problem uploading image";
}
if($result)
{
    $msg="Updated account details";
}
else
$msg="Not updated";
    
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
    <title>My Account</title>

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
                        <div class="btn-danger"> <?php if($msg!=''): ?>
                            <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
                            </div>
                        <?php
                                            $query="select uid,fn,ln,mobno,id,img from registration where id='$email'";
                                            $result=mysqli_query($conn, $query);
                                            $count = mysqli_num_rows($result);
                                            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                            if($count==1)
                                            {
                                            ?>
                                            <h3 class="text-center title-2">My Account Details</h3>
                            <form action="myaccount.php" enctype="multipart/form-data" method="post">
                            
                                
                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">First Name</label>
                                                <input id="cc-pament" name="firstname" type="text" value="<?php echo $row['fn']?>" class="form-control" aria-required="true" aria-invalid="false" >
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Last Name</label>
                                                <input id="cc-name" name="lastname" type="text" value="<?php echo $row['ln']?>" class="form-control" data-val="true" data-val-required="Please enter the name on card"
                                                    autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Mobile Number</label>
                                                <input id="cc-number" name="mobilenumber" type="tel" class="form-control" value="<?php echo $row['mobno']?>" data-val="true"
                                                    data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                                    autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div>
                                            <input type=hidden name=hidden value="<?php echo $row['uid'];?>" >
                                                
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Email Address</label>
                                                        <input id="cc-exp" name="emailid" type="tel" class="form-control" value="<?php echo $row['id']?>" data-val="true" data-val-required="Please enter the card expiration"
                                                            data-val-cc-exp="Please enter a valid month and year" 
                                                            autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                        </div>
                                                        <div class=" form-group">
                                               
                                                    <label for="file-input" class=" form-control-label">Upload Profile Picture</label>
                                              
                                                <div class="col-12 col-md-9">
                                            
                                                    <input type="file" name="image" class="form-control-file">
                                                    <br>
                                                    <img src='ProfilePictures/<?php echo $row['img'];?>' alt='ProfilePictures/"<?php echo $row['img'];?>"'>
                                                </div
                                            </div>
                                            <br>
                                            <div>
                                                <button id="payment-button" type="submit" name="update"class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-edit fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Update Details</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                            </form>
                            <?php } ?>
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