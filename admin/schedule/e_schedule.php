<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    if (isset($_GET['eschedule'])) {
        $emp_id = $_GET['emp_id'];
        $week = $_GET['week'];
        $name = $_GET['name'];
        $option = "";
        $opt_status = "";

        $query = "SELECT * FROM `schedules` WHERE employee_id = '".$emp_id."' AND week = '".$week."'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $option = $row['options'];
                    $opt_status = $row['opt_status'];
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
        <title>Schedule | Admin</title>
      
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
                            <h1 class="h3 mb-4 text-gray-800">Schedule</h1>

                            <a href="schedule.php" class="btn btn-secondary btn-icon-split mb-4">
                            <span class="icon text-white">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="text">Back</span>
                            </a>

                            <div class="card">
                                <h5 class="card-header">Schedule Data</h5>
                                <div class="card-body">
                                <h5 class="card-title">Edit Schedule</h5>
                                <form action="../../ajaxadmin/ajaxadmin.php?submitEditSchedule" method="POST" >
                                    <div class="form-group row col-md-4">
                                    <label style="font-size: x-large; margin-bottom: -20px;"><strong><?=$name?></strong></label>
                                    <h3></h3>
                                    </div>
                                    <input style="margin-right: 5px;" type="radio" id="faculty" name="category" value="FACULTY" required <?=$option == "FACULTY" ? "checked": ""?>>
                                    <label style="margin-top: 12px; margin-right: 20px; font-size:18px;" for="faculty">FACULTY</label>
                                    <input style="margin-right: 5px;" type="radio" id="nonacademic" name="category" value="NON-ACADEMIC" <?=$option == "NON-ACADEMIC" ? "checked": ""?>>
                                    <label style="margin-top: 12px; margin-right: 20px; font-size:18px;" for="nonacademic">NON-ACADEMIC</label>
                                    <input style="margin-right: 5px;" type="radio" id="utility" name="category" value="UTILITY" <?=$option == "UTILITY" ? "checked": ""?>>
                                    <label style="margin-top: 12px; margin-right: 20px; font-size:18px;" for="utility">UTILITY</label>

                                    <div id="dropdownlist" style="<?=$option == "FACULTY" ? "display:block;" : "display:none;"?> margin-top:5px;">
                                        <select class="form-control" id="status" name="opt_status" style="width:31%">
                                            <option value="" disabled selected hidden>Status</option>
                                            <option value="Faculty" <?=$opt_status == "Faculty" ? "selected": ""?>>Faculty</option>
                                            <option value="Permanent" <?=$opt_status == "Permanent" ? "selected": ""?>>Permanent</option>
                                            <option value="Temporary" <?=$opt_status == "Temporary" ? "selected": ""?>>Temporary</option>
                                            <option value="Contractual" <?=$opt_status == "Contractual" ? "selected": ""?>>Contractual</option>
                                            <option value="Contractual Service" <?=$opt_status == "Contractual Service" ? "selected": ""?>>Contractual Service</option>
                                            <option value="Non-Academic" <?=$opt_status == "Non-Academic" ? "selected": ""?>>Non-Academic</option>
                                            <option value="Utility" <?=$opt_status == "Utility" ? "selected": ""?>>Utility</option>
                                        </select>
                                    </div>

                                    <div class="tab-pane" id="pickup"><br>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <div class="row justify-content-between" style="margin-bottom: 20px; margin-top: -15px; margin-left: 5px; margin-right: 5px;" >
                                                <label>Manage Schedule</label>
                                                <input  style="align-right" disabled type="week" name="week" value="<?=$week?>">
                                            </div>
                                            <table class="table table-bordered table-striped" style="margin-bottom:20px;">
                                                <thead>
                                                    <th style="width: 13%">Status</th>
                                                    <th style="width: 25%">Day</th>
                                                    <th style="width: 10%">Billable Hrs</th>
                                                    <th style="width: 30%">Start Time</th>
                                                    <th style="width: 30%">End Time</th>
                                                </thead>
                                                <tbody>

                                                <?php
                                                    $x = 1;
                                                    $query = "SELECT * FROM `schedules` WHERE employee_id = '".$emp_id."' AND week = '".$week."'";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>

                                                    <tr>
                                                        <input type="hidden" name="sched_id[]" value="<?=$row['sched_id']?>">
                                                    <td style="text-align:center;">
                                                                        <select class="form-control" id="sched_status" name="sched_status[]">
                                                                            <option value="REG" <?=$row['status'] == "REG" ? "selected": ""?>>AT WORK</option>
                                                                            <option value="REST" <?=$row['status'] == "REST" ? "selected": ""?>>OFF WORK</option>
                                                                        </select>
                                                        </td>
                                                        <td style="width: 25%"><?=$row['day']?></td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" required type="number" value="<?=$row['bill']?>" min="1" step="0.5" name="bill[]"></td>
                                                        <td style="width: 30%"><input type="time" value="<?=$row['start']?>" required id="mon_start" name="start[]"  min="00:00" max="23:59" class="form-control  startpicker"></td>
                                                        <td style="width: 30%"><input type="time" value="<?=$row['end']?>" required id="mon_end" name="end[]" class="form-control  endpicker"></td>
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


                                    
                                    <button type="submit" class="btn btn-success btn-icon-split mt-4 float-right">
                                    <span class="icon text-white">
                                        <i class="fas fa-plus-circle"></i>
                                    </span>
                                    <span class="text">Add to system</span>
                                    </button>
                                    
                                </form>
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

        <script>
            $(document).ready(function() {
                $("input[type='radio']").click(function() {
                    if ($(this).val() == "FACULTY") {
                        $("#dropdownlist").show();
                        $('#status').attr('required', true);
                    } else {
                        $("#dropdownlist").hide();
                        $('#status').attr('required', false);
                    }
                });
            });
        </script>

        <script type='text/javascript'>

            $(document).ready(function() {
                    
                $('select[name="sched_status[]"]').on('change',function(){
                    $next = $(this).closest('tr').find("[type='time']");
                    $next1 = $(this).closest('tr').find("[type='number']");
                    
                    var  status = $(this).val();

                    if(status == "REST"){       
                        $next.val('');
                        $next1.val('');    
                        $next.prop('readonly', true);
                        $next1.prop('readonly', true);
                        
                    }else{
                        $next.prop('readonly', false);
                        $next1.prop('readonly', false);
                    }  

                });
            });
        </script>

        <script>

            $('select[name="sched_status[]"]').change(function() {
                $next = $(this).closest('tr').find("[type='time']");
                $next1 = $(this).closest('tr').find("[type='number']");

                var  status = $(this).val();

                    if(status == "REST"){       
                        $next.val('');
                        $next1.val('');    
                        $next.prop('readonly', true);
                        $next1.prop('readonly', true);
                        
                    }else{
                        $next.prop('readonly', false);
                        $next1.prop('readonly', false);
                    }
            }).change(); //to trigger on load


            $('#selectAll').click(function (e) {
                $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
                $("#selectAll").change(function(){
                    $next = $(this).closest('table').find("[type='time']");
                    $next1 = $(this).closest('table').find("[type='number']");
                    $next.prop('disabled', !this.checked);
                    $next1.prop('disabled', !this.checked);
                    $next.val('');
                    $next1.val('');
                });
            });

            $(".disableRow").change(function(){
                $next = $(this).closest('tr').find("[type='time']");
                    $next1 = $(this).closest('tr').find("[type='number']");
                    $next.prop('disabled', !this.checked);
                    $next1.prop('disabled', !this.checked);
                    $next.val('');
                    $next1.val('');
                 
            });

            $(".startpicker").change(function() {
                var end = $(this).closest('tr').find("[id='mon_end']");
                end.attr('min',$(this).val());
            }).change();
            
        </script>

    </body>


<?php } else {
  
  header("location: ../../index.php");
 
}?>

