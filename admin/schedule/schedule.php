<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

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
        <title>Schedule | Admin</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      
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

                                <!-- Page Heading 
                                <h1 class="h3 mb-4 text-gray-800"></h1>
                                -->
                                <div class="row">
                                    <div class="col-lg-3">
                                        <a href="a_schedule.php" class="btn btn-info btn-icon-split mb-4">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Add New Schedule</span>
                                        </a>
                                    </div>
                                    <!-- <div class="col-lg-5 offset-lg-4">
                                </div> -->
                                </div>

                                <!-- Data Table Shift-->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">DataTables Schedule</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Employee Name</th>
                                                        <th style="width: 15%">Total Working Hrs</th>
                                                        <th>Date Range</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>

                                                <?php
                                                    $x = 1;
                                                    $query = "SELECT schedules.*, SUM(schedules.bill) as bill, employee.name, employee.last_name FROM schedules LEFT JOIN employee ON schedules.employee_id = employee.id GROUP BY schedules.employee_id, schedules.week";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>

                                                    <tr>
                                                        <td class="align-middle"><?=$x++?></td>
                                                        <td class="align-middle"><?=$row['name']." ".$row['last_name']?></td>
                                                        <td style="width: 15%"><?=$row['bill']." hrs"?></td>
                                                        <td class="align-middle"><?=date("M/d/Y", strtotime($row['week']));?> - <?=date("M/d/Y", strtotime($row['week']. ' +5 day'));?></td>
                                                        <td class="align-middle text-center">
                                                        <a href="e_schedule.php?eschedule&emp_id=<?=$row['employee_id']?>&week=<?=$row['week']?>&name=<?=$row['name']." ".$row['last_name']?>" class="btn btn-primary btn-circle">
                                                                <span class="icon text-white" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </span>
                                                            </a> |
                                                        <a href="../../ajaxadmin/ajaxadmin.php?deleteSched&emp_id=<?=$row['employee_id']?>&week=<?=$row['week']?>" class="btn btn-danger btn-circle" title="Delete" onclick="return confirm('Deleted Department. Still want to delete?')"><i class="fas fa-trash-alt"> </i></a>
    
                                                        </td>
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

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../../plugins/jszip/jszip.min.js"></script>
        <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


        <script>
            $(function () {

                $("#dataTable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                
            });
        </script>

    </body>


<?php } else {
  
  header("location: index.php");
 
}?>