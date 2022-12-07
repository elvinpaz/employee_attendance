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
        <title>CVSU | Employee</title>
      
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

                            <h1 class="h3 mb-4 text-gray-800">Upload Files</h1>

                            <div class="row justify-content-center mt-5">
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="height:550px;">
                                            <form action="../../ajaxemp/ajaxemp.php?insertNewPostedFile" method="POST" enctype="multipart/form-data">
                                                <p style="text-align: center; font-size:20px;" class="mb-4">Upload Files Here</p>
                                                <p>Description:</p>
                                                <input required class="col-12" style="height:40px; margin-top: -50px" type="text" name="filedescription" id="filedescription">
                                                <div class="row" style="margin-bottom: 10px;">
                                                    <label class="col-2" type="button"  
                                                        style="margin-bottom: -2px; margin-left:10px; margin-top: 10px; width: 75px; height:75px; padding-top: 15px; padding-bottom: 15px; padding-left:15px; padding-right:15px;" 
                                                        for="fileupload"><i style="color:#154c79; font-size: 45px" class="fas fa-folder-open"></i>
                                                    </label>
                                                    <div class="col-8" style="height: 75px;">
                                                        <p class="col-12" style="margin-left:-10px; margin-top: 25px;">Choose file to post</p>
                                                        <p class="col-12" style="margin-left:-10px; margin-top: -18px; color:orange; font-size: 12px">you can only upload one file at a time. </p>
                                                    </div>
                                                    <input required type="file" name="fileupload" id="fileupload" style="margin-top: -15px; margin-left: -90px; opacity:0%; width: 100%; height:1px;" onchange="javascript:updateList()" oninvalid="this.setCustomValidity('Please choose a file')" oninput="this.setCustomValidity('')">
                                                </div>
                                                <p>Attached file:</p>
                                                <div  style="border-style: dashed; border-radius: 10px; height: 75px; margin-top: -15px; padding: 5px">
                                                    <div class="row" id="filedisplay" style="display:none; background-color:#28a7454d; border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                        <i style="padding-top: 12px; padding-bottom: 10px; padding-left:15px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                        <div class="col-10" style="height: 75px;">
                                                            <p class="col-12" id="filename" style="margin-left:-2px; margin-top: 12px; font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></p>
                                                            <p class="col-12" id="filesize" style="margin-left:-2px; margin-top: -20px; font-size: 12px"></p>
                                                        </div>
                                                        <div class="col-1">
                                                                <i style="margin-top: 20px; margin-bottom: 20px; margin-left: -25px; font-size: 20px; text-align: center;" class="fas fa-check"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Upload File" class="btn btn-outline-success btn-block" style="margin-top: 60px;" name="filesubmit">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body" style="height:550px; overflow-y: scroll">
                                        <p style="text-align: center; font-size:20px;" class="mb-4">Files you've been uploaded</p>

                                        <?php
                                            $query = "SELECT * FROM e_uploadfile WHERE status = 0 AND employee_id = '".$_SESSION['emp_id']."' ORDER BY id DESC";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            
                                            <div class="callout callout-success">
                                                <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                    <i style="padding-top: 12px; padding-bottom: 10px; padding-left:20px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                    <div class="col-10" style="height: 75px;">
                                                        <a href="../../filesupload/employee/posted/<?php echo $row['filename'];?>" target="_blank">
                                                            <p class="col-12 filename" style="margin-left:-2px; margin-top: 9px; font-size: 15px; color:#28a745; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                                        </a>  
                                                        <p class="col-12 filesize" style="margin-left:-2px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="../../ajaxemp/ajaxemp.php?deleteposted&id=<?=$row['id']?>" title="Delete" onclick="return confirm('Deleted Files. Still want to delete?')">
                                                            <i style="margin-top: 15px; margin-bottom: 10px; margin-left: -25px; font-size: 50px; text-align: center; color:red;" class="fas fa-trash-alt"></i>
                                                        </a> 
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
                            <div class="row justify-content-center mt-3">
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Archive Files</h3>
                                        </div>
                                        <div class="card-body" style="height:600px; overflow-y: scroll">
                                            <div class="row justify-content-center mt-2">
                                                <div class="col-md-10">

                                                <?php
                                                    $x = 1;
                                                    $query = "SELECT * FROM e_uploadfile WHERE status = 1 AND employee_id = '".$_SESSION['emp_id']."' ORDER BY id DESC";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    
                                                    <div class="callout callout-warning mt-2">
                                                        <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                            <i style="padding-top: 12px; padding-bottom: 10px; padding-left:20px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                            <div class="col-10" style="height: 75px;">
                                                                <a href="../../filesupload/employee/posted/<?php echo $row['filename'];?>" target="_blank">
                                                                    <p class="col-12 filename" style="margin-left:-2px; margin-top: 9px; font-size: 15px; color:orange; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                                                </a>  
                                                                <p class="col-12 filesize" style="margin-left:-2px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                                            </div>
                                                            <div class="col-1">
                                                                <a href="../../ajaxemp/ajaxemp.php?restoreDeletePosted&id=<?=$row['id']?>" title="Delete" onclick="return confirm('Restore Department. Still want to restore?')">
                                                                    <i style="margin-top: 15px; margin-bottom: 10px; margin-left: -25px; font-size: 50px; text-align: center; color:orange;" class="fas fa-redo-alt"></i>
                                                                </a> 
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
                                <!-- /.col -->
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
                var filesize = parseInt(input.files[0].size/1048576);
                console.log(filesize);
                if(input.files[0].size > 25000000) {
                    alert("Please upload file less than 25MB. Thanks!!");
                    $(this).val('');
                }else{
                outputname.innerHTML = '<strong>'+filename+'</strong>';
                outputsize.innerHTML = '<strong>'+filesize+' MB</strong>';
                
                document.getElementById('filedisplay').style.display = '';
                }
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

    </body>


<?php } else {
  
  header("location: ../../index.php");
 
}?>