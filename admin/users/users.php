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

                            <!-- Page Heading 
                            <h1 class="h3 mb-4 text-gray-800"></h1>
                            -->

                            <!-- Data Table designation-->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>EmpID</th>
                                                    <th>Employee Name</th>
                                                    <th>Dept.ID</th>
                                                    <th>Position</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                        
                                            <?php
                                                
                                                $x = 1;
                                                $query = "SELECT employee.name, employee.last_name, employee.id as employee_id, user_role.name as position, user.id, user.email, user.status, user.role, user.has_account, department.id as dept_code
                                                                FROM employee 
                                                                    LEFT JOIN user_role ON employee.position_id = user_role.id 
                                                                    LEFT JOIN department ON employee.department_id = department.dept_id 
                                                                    LEFT JOIN user ON employee.id = user.employee_id";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $is_disabled = "disabled";
                                            ?>

                                                <tbody>
                                                    <tr>
                                                        <td class=" align-middle"><?=$x++?></td>
                                                        <td class=" align-middle"><?=$row['employee_id']?></td>
                                                        <td class=" align-middle"><?=$row['name']." ".$row['last_name']?></td>
                                                        <td class=" align-middle"><?=$row['dept_code']?></td>
                                                        <td class=" align-middle"><?=$row['role']?></td>
                                                        <td class=" align-middle text-center">
                                                                <?php if ($row['has_account'] == 0){?>
                                                                    

                                                                    <a href="a_users.php?ausers&empid=<?=$row['employee_id']?>" class="btn btn-info">Create Account</a>
                                                                    
                                                                    
                                                                <?php } elseif($row['has_account'] == 1){?>
    
                                                                        <?=$row['email']?>
    
                                                                <?php }?>      
                                                        </td>
                                                        <td class=" text-center align-middle">

                                                                <?php if ($row['has_account'] == 0){?>
                                                                    

                                                                        <a href=""  class="btn btn-primary btn-circle disabled">
                                                                            <span class="icon text-white" title="Edit">
                                                                                <i class="fas fa-edit"></i>
                                                                            </span>
                                                                        </a>
                                                                        |
                                                                        <a href=""  class="btn btn-danger btn-circle disabled" title="Delete" onclick="return confirm('Deleted Department. Still want to delete?')"><i class="fas fa-trash-alt"> </i></a>
                                                                    
                                                                    
                                                                    
                                                                <?php } elseif($row['has_account'] == 1){?>
    
                                                                    <?php if ($row['status'] == 0){?>
                                                                
                                                                        <a href="../../ajaxadmin/ajaxadmin.php?restoreDeleteUser&id=<?=$row['id']?>" class="btn btn-danger btn-circle" title="Undo" onclick="return confirm('Restore Department. Still want to restore?')">
                                                                            <i class="fa fa-undo"> </i>
                                                                        </a>


                                                                        <?php } elseif($row['status'] == 1){?>

                                                                        <a href="e_users.php?eusers&id=<?=$row['id']?>"  class="btn btn-primary btn-circle">
                                                                            <span class="icon text-white" title="Edit">
                                                                                <i class="fas fa-edit"></i>
                                                                            </span>
                                                                        </a>
                                                                        |
                                                                        <a href="../../ajaxadmin/ajaxadmin.php?deleteuser&id=<?=$row['id']?>"  class="btn btn-danger btn-circle" title="Delete" onclick="return confirm('Deleted Department. Still want to delete?')"><i class="fas fa-trash-alt"> </i></a>

                                                                    <?php }?> 
    
                                                                <?php }?>

                                                        </td>
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

                        <!-- modal for new Section  -->
                        <div class="modal fade" id="modal-insert" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog-centered modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Section</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="../../ajaxadmin/ajaxadmin.php?insertNewUser" method="POST">
                                    <div class="modal-body" id="adduser">
                                    </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                            <span class="icon text-white">
                                                <i class="fas fa-plus-circle"></i>
                                            </span>
                                            <span class="text">Add to system</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

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

        <script>
            $(document).on('click', '.adduser', function(){  
                var user_id = $(this).attr("id");  
                $.ajax({  
                    url:"../../ajaxadmin/ajaxadmin.php?adduser",  
                    method:"post",  
                    data:{"user_id":user_id},  
                    success:function(data){  
                            $('#adduser').html(data);  
                            $('#modal-insert').modal("show");  
                    }  
                });  
            });
        </script>

    </body>

</html>

<?php } else {
  
  header("location: index.php");
 
}?>