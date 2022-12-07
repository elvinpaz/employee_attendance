<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Employee"){

    $id = $_SESSION['emp_id'];

    


?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
      
        <link rel='shortcut icon' type='image/x-icon' href='../../assets/img/logocvsu.png'/>
        <title>Users | Admin</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
      
        <!-- Page level plugins -->
    </head>

    <body>
        <!-- Page Wrapper -->
        <div id="wrapper" style="overflow: hidden">

            <?php include '../includes/sidenav.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <?php include '../includes/topnav.php'; ?>

                    <!-- Main Content -->
                    <div id="content">
            
                       
                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

                            <a href="dashboard/dashbord.php" class="btn btn-secondary btn-icon-split mb-4">
                                <span class="icon text-white">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="text">Back</span>
                            </a>
                            <div class="col-lg-5 p-0">
                                <form action="../../ajaxemp/ajaxemp.php?submitEditPass" method="POST" >
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="e_id" value="<?= $e_id; ?>">
                                            <?php
                            
                                                if (isset($_GET['usermsg'])){

                                                    $erromsg="";

                                                    if($_GET['usermsg'] == 'Invalid Password!'){

                                                        $erromsg = $_GET['usermsg'];

                                                        
                                                    ?>
                                                        
                                                        <div class="alert alert-danger" style="margin-top: 20px;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                            <?php echo $erromsg;?>
                                                        </div><br>
                                                        
                                                    <?php                       
                                                            
                                                    } else if($_GET['usermsg'] == 'Password not match!'){
                                                    ?>
                                                        
                                                        <div class="alert alert-danger" style="margin-top: 20px;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                            <?php echo "Password not match!";?>
                                                        </div><br>
                                                        
                                                    <?php 
                                                    } else {

                                                    ?>
                                                        
                                                        <div class="alert alert-success" style="margin-top: 20px;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                            <?php echo "Password changed successfully!";?>
                                                        </div><br>
                                                        
                                                    <?php 

                                                    }
                                                }
                                            ?>
                                            <div class="form-group row">
                                                <label for="u_password" class="col-form-label col-lg-4">Current Password</label>
                                                <div class="col p-0">
                                                    <input type="password" class="form-control col-lg"  name="curpass" id="curpass">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_password" class="col-form-label col-lg-4">New Password</label>
                                                <div class="col p-0">
                                                    <input type="password" class="form-control col-lg"  name="newpass" id="newpass">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_password" class="col-form-label col-lg-4">Confirm Password</label>
                                                <div class="col p-0">
                                                    <input type="password" class="form-control col-lg"  name="conpass" id="conpass">
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                                
                                                <span class="text">submit</span>
                                            </button>

                                            <input type="hidden" name="id" value="<?=$id?>">
                                        </div>
                                    </div><br><br><br><br><br><br><br><br>
                                </form>
                            </div>
                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                
                <?php include '../includes/footer.php'; ?>
                

            </div>
            <!-- End of Content Wrapper -->

            

        </div>
        <!-- End of Page Wrapper -->

        <?php include '../includes/modal.php'; ?>

        <!-- Bootstrap core JavaScript-->
        <script src="../../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../assets/js/sb-admin-2.min.js"></script>

    </body>


<?php } else {
  
  header("location: ../../index.php");
 
}?>