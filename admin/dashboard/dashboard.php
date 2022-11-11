<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){




    // query for total products 
    $query = "SELECT COUNT(*) as department FROM department WHERE status=1 ";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $department = $row['department'];
        }
    }

    // query for total products 
    $query = "SELECT COUNT(*) as shift FROM schedules WHERE date = '".$daytoday."' AND status = 'REG'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $shift = $row['shift'];
        }
    }

    // query for total products 
    $query = "SELECT COUNT(*) as employee FROM employee WHERE is_active=1 AND employee.id != 25";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $employee = $row['employee'];
        }   
    }

    // query for total products 
    $query = "SELECT COUNT(*) as user FROM user WHERE status=1 AND employee_id != 25";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user = $row['user'];
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
        <title>CVSU | Dashboard</title>
      
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
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Departments</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong><?= number_format($department)?> Departments</strong></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Working Shifts</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong><?= number_format($shift)?> Shifts</strong></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Employees</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong><?= number_format($employee)?> Employees</strong></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong><?= number_format($user)?> Active Users</strong></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>

                            <!-- Content Row -->

                            <div class="row">

                            <div class="col-xl-4 col-lg-5">
                                <!-- Pie Chart -->
                                <div class="col p-0">
                                <div class="card shadow mb-4" style="height: 400px">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-rowz align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Departments' Employees</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">More Details:</div>
                                        <a class="dropdown-item" href="#">Department List</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body" style="max-height: 400px; overflow: scroll; overflow-x : hidden;">
                                    <table class="table">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                
                                                <th scope="col">Dept Code</th>
                                                <th scope="col">Employees</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                        <?php
                                            //$x = 1;
                                            $qty = "";
                                            $query = "SELECT department.*, COUNT(employee.id) as qty FROM department LEFT JOIN employee ON employee.department_id = department.dept_id WHERE department.status = 1 GROUP BY dept_id";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    if($row['id'] != ""){
                                                        $qty = $row['qty'];
                                                    }
                                        ?>
                                            <tr>
                                                
                                                <td><?=$row['id']?></td>
                                                <td><?=$qty?></td>
                                            </tr>

                                        <?php
                                                }
                                            }
                                        ?>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                                <!-- Pie Chart -->
                                <div class="col p-0">
                                <div class="card shadow mb-4" style="height: 400px">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Employees per Shift</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body" style="max-height: 400px; overflow: scroll; overflow-x : hidden;">
                                    <table class="table">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Employees</th>
                                            <th scope="col">Shift Start</th>
                                            <th scope="col">Shift End</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $x = 1;
                                            $query = "SELECT schedules.*, employee.name, employee.last_name FROM schedules LEFT JOIN employee ON schedules.employee_id = employee.id WHERE date = '".$daytoday."' AND status = 'REG'";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        
                                            <tr>
                                                <th scope="row"><?=$x++?></th>
                                                <td><?=$row['name']." ".$row['last_name']?></td>
                                                <td><?=date("h:i A",strtotime($row['name']))?></td>
                                                <td><?=date("h:i A",strtotime($row['end']))?></td>
                                            </tr>


                                        <?php
                                                }
                                            }
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                                <!-- Pie Chart -->
                                <div class="col p-0">
                                <div class="card shadow mb-4" style="height: 400px">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-rowz align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Recently Added Users</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">More Details:</div>
                                        <a class="dropdown-item" href="#">Users List</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body" style="max-height: 400px; overflow: scroll; overflow-x : hidden;">
                                    <table class="table">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th scope="col">Email</th>
                                            <th scope="col">Employee id</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $query = "SELECT email, employee_id FROM user WHERE status = 1 AND employee_id != 25 ORDER BY created_at DESC LIMIT 10";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            
                                                <tr>
                                                <td><?=$row['email']?></td>
                                                <td><?=$row['employee_id']?></td>
                                                </tr>

                                            <?php
                                                    }
                                                }
                                            ?>    

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
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