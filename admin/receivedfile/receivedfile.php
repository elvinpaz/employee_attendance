<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){


    $query = "SELECT COUNT(*) AS newpost FROM e_uploadfile WHERE status = 0 AND readnotif = 0";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            $empposts = $row['newpost'];
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
        <title>Department | Admin</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        

        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.css">
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


      
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

                            <h1 class="h3 mb-4 text-gray-800">Received Files</h1>

                            <!-- Data Table designation-->
                            <div class="card shadow mb-4" style="width: 70%; margin-left: auto; margin-right: auto;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List of employee who sent files</h6>
                                </div>
                                <div class="card-body " >
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0" >
                                            <thead>
                                                <tr>
                                                    <th class=" text-center">Image</th>
                                                    <th class=" text-center">Full Name</th>
                                                    <th class=" text-center">Department</th>
                                                    <th class=" text-center">Total Files</th>
                                                    <th class=" text-center">Actions</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                $x = 1;
                                                $query = "SELECT employee.id as id, CONCAT_WS(' ', employee.name, employee.last_name)AS fullname, employee.image, department.id AS department, COUNT(e_uploadfile.employee_id) AS totalfiles 
                                                    FROM `employee` LEFT JOIN `e_uploadfile` ON employee.id = e_uploadfile.employee_id LEFT JOIN `department` ON employee.department_id = department_id 
                                                    WHERE e_uploadfile.status = 0 AND e_uploadfile.employee_id != 25 GROUP BY e_uploadfile.employee_id";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                        
                                            <tbody>
                                                <tr>
                                                    <td class=" text-center"><img src="../../upload/<?=$row['image']?>" style="width: 55px; height:55px" class="img-rounded"></td>
                                                    <td class=" text-center" style="padding-top: 30px;"><?=$row['fullname']?></td>
                                                    <td class=" text-center" style="padding-top: 30px;"><?=$row['department']?></td>
                                                    <td class=" text-center" style="padding-top: 30px;"><?=$row['totalfiles']." "?><span class="badge badge-success" style="<?=$empposts == 0 ? 'display: none;' : ''?>"> NEW</span></td>
                                                    <td class=" text-center" style="padding-top: 30px;"><a href="javascript:void(0)"><button id="<?=$row['id']?>"class="btn btn-info viewfiles" >view submitted files</button></a></td>
                                                </tr>
                                            </tbody>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- modal for new Adviser  -->

                    <div class="modal fade" id="modal-view" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                
                                <form action="../../ajaxadmin/ajaxadmin.php?insertNewDesignation" method="POST">
                                    <div class="modal-body" id="viewfiles">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    </div>
                                </form>
                                
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- modal for new Adviser  -->

                
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


        <script>
            $(document).on('click', '.viewfiles', function(){  
                var id = $(this).attr("id");
                $.ajax({  
                    url:"../../ajaxadmin/ajaxadmin.php?viewfiles",  
                    method:"post",  
                    data:{"id":id},  
                    success:function(data){  
                            $('#viewfiles').html(data);  
                            $('#modal-view').modal("show");  
                    }  
                });  
            });
        </script>

    
    </body>


<?php } else {
  
  header("location: index.php");
 
}?>