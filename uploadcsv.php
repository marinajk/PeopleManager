<?php
require("db.php");
session_start();

$msg='';

if(isset($_POST['update']))
{
    if($_FILES['csvfile']['name'])
    {
        $filename=explode('.',$_FILES['csvfile']['name']);
        if($filename[1]=='csv')
        {
       
        $handle=fopen($_FILES['csvfile']['tmp_name'],"r");
            while($cont=fgetcsv($handle))
            {
            $fn=mysqli_real_escape_string($conn,$cont[0]);
            $ln=mysqli_real_escape_string($conn,$cont[1]);
            $mobno=mysqli_real_escape_string($conn,$cont[2]);
            $id=mysqli_real_escape_string($conn,$cont[3]);
            $pwd=mysqli_real_escape_string($conn,$cont[4]);
            $ut=mysqli_real_escape_string($conn,$cont[5]);
            $filled=mysqli_real_escape_string($conn,$cont[6]);

            $query="insert into Registration(fn,ln,mobno,id,pwd,ut,filled) values('$fn','$ln','$mobno','$id','$pwd','$ut','$filled');";
            mysqli_query($conn,$query);
            }
        fclose($handle);
        $msg="Users added";
        $class="btn-success";
        }
        else
        {
            $msg="Upload unsuccessful";
            $class="btn-danger";
        }
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
    <title>Add users using CSV file</title>

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
                            <a href="admin.php">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                        <?php echo "<div class=".$class.">"; if($msg!=''): ?>
                            <div class="alert"> <?php echo $msg;?> </div><?php endif; ?>
                            </div>
                        
                                            <h3 class="text-center title-2">Add users using CSV file</h3>
                            <form action="uploadcsv.php" enctype="multipart/form-data" method="post">
                            
                                
                            
                                                        <div class=" form-group">
                                               
                                                   <br><br>
                                                <div class="col-12 col-md-9">
                                            
                                                    <input type="file" name="csvfile" required="required" class="form-control-file">
                                                    <br>
                                                   
                                             
                                            </div>
                                            <br>
                                            <div>
                                                <button id="payment-button" type="submit" name="update" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-edit fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Upload CSV</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>

                                            </div>                                       
                                         </form>
                           
                       
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