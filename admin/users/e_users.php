<?php

session_start();
require '../../connection/connect.php';


// if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    if (isset($_GET['ausers'])) {
        $id = $_GET['empid'];
    
        $query = "SELECT * FROM employee WHERE id='".$id."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $email=$row['email']; 

            }
        }
    
    }


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
        <div id="wrapper">

            <?php include '../includes/sidenav.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <?php include '../includes/topnav.php'; ?>

                    <!-- Main Content -->
                    <div id="content">
            
                       
                                <!-- Begin Page Content -->
                                <div class="container-fluid">

                                    <!-- Page Heading -->
                                    <h1 class="h3 mb-4 text-gray-800">Add User</h1>

                                    <a href="users.php" class="btn btn-secondary btn-icon-split mb-4">
                                        <span class="icon text-white">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                        <span class="text">Back</span>
                                    </a>
                                    <div class="col-lg-5 p-0">
                                        <form action="" method="POST">
                                            <div class="card">
                                                <h5 class="card-header">Users Master Data</h5>
                                                <div class="card-body">
                                                    <h5 class="card-title">Add New Users</h5>
                                                    <p class="card-text">Form to add new users to system</p>
                                                    <input type="hidden" name="e_id" value="<?= $e_id; ?>">
                                                    <div class="form-group row">
                                                        <label for="u_username" class="col-form-label col-lg-4">Username</label>
                                                        <div class="col p-0">
                                                            <input type="text" readonly class="form-control-plaintext col-lg" name="u_username" id="u_username" value="<?=$email?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="u_password" class="col-form-label col-lg-4">Password</label>
                                                        <div class="col p-0">
                                                            <input type="password" class="form-control col-lg" name="u_password" id="u_password">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                                        <span class="icon text-white">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </span>
                                                        <span class="text">Add to system</span>
                                                    </button>
                                                </div>
                                            </div>
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

</html>