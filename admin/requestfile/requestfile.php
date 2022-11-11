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

                            <h1 class="h3 mb-4 text-gray-800">Request Files</h1>
                            <p style="margin-top: -25px;">Files requested by employee.</p>

                                

                            <div class="row justify-content-center mt-5">
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body" style="height:550px; overflow-y: scroll">
                                        <p style="text-align: center; font-size:20px;" class="mb-3">Requested Files</p>

                                        <?php
                                           
                                            $query = "SELECT e_requestfile.*, CONCAT_WS(' ', employee.name, employee.last_name)AS fullname FROM `e_requestfile`
                                                LEFT JOIN `employee` ON employee.id = e_requestfile.employee_id
                                                WHERE status = 0 AND sent_status = 0 ORDER BY id DESC";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                            <div class="card" style="margin-bottom: 20px; padding-right: 10px;">
                                                <div class="card-body" >
                                                    <div class="row justify-content-end">
                                                        <p style="margin-top:-10px;"><b><?=date("F j, Y g:i A",strtotime($row['date']))?></b></p>
                                                    </div>
                                                    <p style="margin-top:0px;">Employee: <b><?=$row['fullname']?></b> </p>
                                                    <p style="margin-top:-15px;">File type: <b><?=$row['filetype']?></b> </p>
                                                    <p style="margin-top:-15px;">Description: <b><?=$row['description']?></b></p>
                                                    <img src="../../assets/img/newrev.png" style="<?=$row['readnotif'] == 1 ? 'display: none;' : ''?>position: absolute; left: -9px; top: -9px; height:100px; width:100px;">
                                                    <div class="row justify-content-end">
                                                        <button id="<?=$row['id'];?>" name="requestfiles" type="button" class="btn btn-primary requestfiles" style="font-size: 12px; margin-top:-5px">Send Files</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }
                                        ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body" style="height:550px; overflow-y: scroll">
                                        <p style="text-align: center; font-size:20px;" class="mb-4">Submitted Files</p>

                                        <?php
                                            $x = 1;
                                            $query = "SELECT filesubmit.*, CONCAT_WS(' ', employee.name, employee.last_name)AS fullname 
                                            FROM filesubmit
                                            LEFT JOIN `employee` ON employee.id = filesubmit.employee_id 
                                            WHERE status = 0 ORDER BY id DESC";
                                            $result = mysqli_query($connection, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            
                                            <div class="callout callout-success">
                                                <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                    <i style="padding-top: 12px; padding-bottom: 10px; padding-left:20px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                    <div class="col-10" style="height: 75px;">
                                                        <a href="../../filesupload/admin/submitted/<?php echo $row['filename'];?>" target="_blank">
                                                            <p class="col-12 filename" style="margin-left:-2px; margin-top: 9px; font-size: 15px; color:#28a745; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                                        </a>  
                                                        <p class="col-12 filesize" style="margin-left:-2px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="../../ajaxadmin/ajaxadmin.php?deletesubmitted&id=<?=$row['id']?>" title="Delete" onclick="return confirm('Deleted Files. Still want to delete?')">
                                                            <i style="margin-top: 15px; margin-bottom: 10px; margin-left: -25px; font-size: 50px; text-align: center; color:red;" class="fas fa-trash-alt"></i>
                                                        </a> 
                                                    </div>
                                                    <p class="col-10" style="margin-top: -23px; margin-left: 5px; font-size: 15px;">Submitted to: <b><?php echo $row['fullname'];?></b></p>
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
                                                    $query = "SELECT filesubmit.*, CONCAT_WS(' ', employee.name, employee.last_name)AS fullname 
                                                    FROM filesubmit
                                                    LEFT JOIN `employee` ON employee.id = filesubmit.employee_id 
                                                    WHERE status = 1 ORDER BY id DESC";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    
                                                    <div class="callout callout-warning mt-2">
                                                        <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px">
                                                            <i style="padding-top: 12px; padding-bottom: 10px; padding-left:20px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                                            <div class="col-10" style="height: 75px;">
                                                                <a href="../../filesupload/admin/<?php echo $row['filename'];?>" target="_blank">
                                                                    <p class="col-12 filename" style="margin-left:-2px; margin-top: 9px; font-size: 15px; color:orange; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                                                </a>  
                                                                <p class="col-12 filesize" style="margin-left:-2px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                                            </div>
                                                            <div class="col-1">
                                                                <a href="../../ajaxadmin/ajaxadmin.php?restoreDeleteSubmitted&id=<?=$row['id']?>" title="Delete" onclick="return confirm('Restore Department. Still want to restore?')">
                                                                    <i style="margin-top: 15px; margin-bottom: 10px; margin-left: -25px; font-size: 50px; text-align: center; color:orange;" class="fas fa-redo-alt"></i>
                                                                </a> 
                                                            </div>
                                                            <p class="col-10" style="margin-top: -23px; margin-left: 5px; font-size: 15px;">Submitted to: <b><?php echo $row['fullname'];?></b></p>
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

                    <!-- modal for new Adviser  -->

                    <div class="modal fade" id="modal-request" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                <form action="../../ajaxadmin/ajaxadmin.php?insertNewRequestFile" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body" id="requestfiles">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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

        <script type="text/javascript">
            updateList = function() {
                var input = document.getElementById('fileupload');
                var output = document.getElementById('fileList');
                

              
                for (var i = 0; i < input.files.length; ++i) {
                       
                        output.innerHTML += '<div class="row" id="filedisplay" style="margin-bottom:5px; background-color:#28a7454d; border-radius: 5px; height:100%; width: 100%; margin-left:0px"><i style="padding-top: 12px; padding-bottom: 10px; padding-left:15px; padding-right:15px; font-size: 35px" class="col-1 fas fa-file-alt"></i><div class="col-10" style="height: 75px;"><p class="col-12" id="filename'+i+'" style="margin-left:-2px; margin-top: 12px; font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></p><p class="col-12" id="filesize'+i+'" style="margin-left:-2px; margin-top: -20px; font-size: 12px"></p></div><div class="col-1"><i style="margin-top: 20px; margin-bottom: 20px; margin-left: -25px; font-size: 20px; text-align: center;" class="fas fa-check"></i></div></div>';

                        var outputname = document.getElementById('filename'+i);
                        var outputsize = document.getElementById('filesize'+i);
                        var filename = input.files[i].name;
                        var filesize = parseInt(input.files[i].size/1024);
                        outputname.innerHTML = '<strong>'+filename+'</strong>';
                        outputsize.innerHTML = '<strong>'+filesize+' KB</strong>';
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

        <script>
            $(document).on('click', '.requestfiles', function(){  
                var id = $(this).attr("id");
                $.ajax({  
                    url:"../../ajaxadmin/ajaxadmin.php?sendrequest",  
                    method:"post",  
                    data:{"id":id},  
                    success:function(data){  
                            $('#requestfiles').html(data);  
                            $('#modal-request').modal("show");  
                    }  
                });  
            });
        </script>


        <?php
          
                    $update = "UPDATE e_requestfile SET readnotif = 1";
                    mysqli_query($connection, $update);
              
        ?>

    </body>


<?php } else {
  
  header("location: index.php");
 
}?>