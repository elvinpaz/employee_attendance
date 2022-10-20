
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
        <title>Employee | Admin</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Toastr -->
        <link rel="stylesheet" href="../../assets/plugins/toastr/toastr.min.css">
      
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
                            <div class="row">
                                <div class="col-lg-3">
                                    <a href="a_employee.php" class="btn btn-info btn-icon-split mb-4">
                                        <span class="icon text-white-600">
                                        <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Add New Employee</span>
                                    </a>
                                </div>
                                <!-- <div class="col-lg-5 offset-lg-4">
                                </div> -->
                            </div>

                            <!-- Data Table employee-->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DataTables Employee</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Image</th>
                                                    <th>DOB</th>
                                                    <th>Hire Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                $x = 1;
                                                $query = "SELECT * FROM employee";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                        
                                                <tbody>
                                                    <tr>
                                                        <td class=" align-middle"><?=$x++?></td>
                                                        <td class=" align-middle"><?=$row['id']?></td>
                                                        <td class=" align-middle"><?=$row['name']." ".$row['last_name']?></td>
                                                        <td class=" align-middle"><?=$row['gender']?></td>
                                                        <td class=" text-center"><img src="../../upload/<?=$row['image']?>" style="width: 55px; height:55px" class="img-rounded"></td>
                                                        <td class=" align-middle"><?=$row['birth_date']?></td>
                                                        <td class=" align-middle"><?=$row['hire_date']?></td>
                                                        <td class="align-middle text-center">

                                                            <?php if ($row['is_active'] == 0){?>
                                                                
                                                                <a href="../../ajaxadmin/ajaxadmin.php?restoreDeleteEmployee&id=<?=$row['id']?>" class="btn btn-danger btn-circle" title="Undo" onclick="return confirm('Restore Department. Still want to restore?')">
                                                                    <i class="fa fa-undo"> </i>
                                                                </a>
                                                            
                                                            
                                                            <?php } elseif($row['is_active'] == 1){?>

                                                                <a href="e_employee.php?eemployee&id=<?=$row['id']?>" class="btn btn-primary btn-circle">
                                                                    <span class="icon text-white" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </span>
                                                                </a>
                                                                |
                                                                <a href="../../ajaxadmin/ajaxadmin.php?deleteEmployee&id=<?=$row['id']?>" class="btn btn-danger btn-circle" title="Delete" onclick="return confirm('Deleted Department. Still want to delete?')"><i class="fas fa-trash-alt"> </i></a>

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

        <!-- Toastr -->
        <script src="../../assets/plugins/toastr/toastr.min.js"></script>

    </body>


<?php } else {
  
  header("location: index.php");
 
}?>


<?php

if (isset($_GET['employeerrorr'])){

  $erromsg="";

  if($_GET['employeerrorr'] == 'E-mail already exist.'){

      $erromsg = $_GET['employeerrorr'];
      
?>

    <script>
        $(document).ready(function () {
        toastr.error('<?php echo $erromsg;?>')
        });
    </script>
     
<?php
          
  }else{

    $erromsg = $_GET['employeerrorr'];

?>

    <script>
        $(document).ready(function () {
        toastr.success('<?php echo $erromsg;?>')
        });
    </script>
        
<?php

  } 
}

?>