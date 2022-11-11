<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Employee"){

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

                            <h1 class="h3 mb-4 text-gray-800">Admin Posted Files</h1>

                            <div class="row justify-content-center mt-5">
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body" style="height:550px; overflow-y: scroll">
                                        <p style="text-align: center; font-size:20px;" class="mb-4">Files shared to you</p>

                                        <?php
                                            $x = 1;
                                            $query = "SELECT * FROM fileupload WHERE status = 0 AND employee_id = '".$_SESSION['emp_id']."' ORDER BY id DESC";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            
                                            <div class="callout callout-success">
                                                <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                    <i style="padding-top: 12px; padding-bottom: 10px; padding-left:20px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                    <div class="col-10" style="height: 75px;">
                                                        <a href="../../filesupload/admin/posted/<?php echo $row['filename'];?>" target="_blank">
                                                            <p class="col-12 filename" style="margin-left:-50px; margin-top: 9px; font-size: 15px; color:#28a745; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                                        </a>  
                                                        <p class="col-12 filesize" style="margin-left:-50px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                                    </div>
                                                    <div class="col-1">
                                                            <img src="../../assets/img/new.png" style="<?=$row['readnotif'] == 1 ? 'display: none;' : ''?>position: absolute; right: -526px; top: -25px; height:125px; width:125px; margin-right: 500px; margin-bottom: -10px;">
                                                    </div>
                                                    <p class="col-10" style="margin-top: -23px; margin-left: 5px; font-size: 15px;">Description: <?php echo $row['description'];?></p>
                                                    <p class="col-10" style="margin-top: -20px; margin-left: 5px; font-size: 15px;">Date Uploaded: <?php echo date("M j, Y", strtotime($row['date']))." at ".date("H:i:s a", strtotime($row['date']));?></p>
                                                </div>
                                            </div>

                                        <?php
                                                }
                                            }
                                        ?>

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

        <script type="text/javascript">
            updateList = function() {
                var input = document.getElementById('fileupload');
                var outputname = document.getElementById('filename');
                var outputsize = document.getElementById('filesize');
                var filename = input.files[0].name;
                var filesize = parseInt(input.files[0].size/1024);
                console.log(filesize);
                outputname.innerHTML = '<strong>'+filename+'</strong>';
                outputsize.innerHTML = '<strong>'+filesize+' KB</strong>';
                
                document.getElementById('filedisplay').style.display = '';
            }
        </script>

        <script>
            $(function () {

                $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false, "ordering":false,
                "buttons": ["print"],
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>

        <?php
            $query = "SELECT * FROM fileupload WHERE employee_id = '".$_SESSION['emp_id']."'";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE fileupload SET readnotif = 1 WHERE employee_id = '".$_SESSION['emp_id']."'";
                    mysqli_query($connection, $update);
                }
            }
        ?>

    </body>


<?php } else {
  
  header("location: ../../index.php");
 
}?>