<?php

session_start();
require '../../connection/connect.php';


// if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    if (isset($_GET['edesignation'])) {
        $id = $_GET['id'];
    
        $query = "SELECT * FROM position WHERE position_id='".$id."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['position_name'];
                $code = $row['position_code'];
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
        <title>Designation | Admin</title>
      
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
                            <h1 class="h3 mb-4 text-gray-800"><strong>Position</strong></h1>

                            <a href="designation.php" class="btn btn-secondary btn-icon-split mb-4">
                            <span class="icon text-white">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="text">Back</span>
                            </a>

                            <form action="../../ajaxadmin/ajaxadmin.php?submitEditDesignation" method="POST" class="col-lg-5  p-0">
                                <div class="card">
                                    <h5 class="card-header">Designation Master Data</h5>
                                    <div class="card-body">
                                    <h5 class="card-title">Edit Designation</h5>
                                    <p class="card-text">Form to edit department in system</p>
                                    
                                        <div class="form-group">
                                        <label  class="col-form-label-lg">Designation Name</label>
                                        <input type="text" required class="form-control form-control-lg" name="name" id="name" value="<?=$name ?>">
                                        </div>
                                        <div class="form-group">
                                        <label class="col-form-label-lg">Designation Code</label>
                                        <input type="text" required class="form-control form-control-lg" name="code" id="code" value="<?=$code?>">
                                        </div>

                                        <input type="hidden" name="id" value="<?=$id?>">

                                        <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                            <span class="icon text-white">
                                                <i class="fas fa-plus-circle"></i>
                                            </span>
                                            <span class="text">Add to system</span>
                                        </button>
                                </div>
                            </form>

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