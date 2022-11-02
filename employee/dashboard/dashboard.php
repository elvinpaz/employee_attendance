<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Employee"){


        $timestamp = date("H:i", strtotime($todaytimestamp));




        $query = "SELECT * FROM employee WHERE id = '".$_SESSION['emp_id']."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
               
                $name = $row['name']." ".$row['last_name'];
        
            }
        }

        $start = "";
        $end = "";
        $hrs = 0;
        $mins = 0;
        $schedstatus = "";
        $attendancestatus = "";
        $schedattend_status = "";
        $location = "";
        $time_in = "";
        $time_out = "";
        $in_status = "";
        $out_status = "";
        $image = "";

        

        $query = "SELECT schedules.*, 
                        CONCAT(schedules.date, ' ', schedules.start) AS shift_start, 
                        CONCAT(schedules.date, ' ', schedules.end) AS shift_end, 
                        schedules.status AS sched_status,
                        IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.end <> '' AND schedules.end <= '".$timestamp."', 'ABSENT', '')) AS attendance,
                        attendances.* 
                        FROM `schedules`
                        LEFT JOIN `attendances` ON attendances.employee_id = schedules.employee_id AND attendances.date = schedules.date  
                        WHERE schedules.date = '".$daytoday."' AND schedules.employee_id = '".$_SESSION['emp_id']."' ";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $schedstatus = $row['sched_status'];

                $start = date("h:i A", strtotime($row['shift_start']));
                $end = date("h:i A", strtotime($row['shift_end']));

                $daytimestart = $row['shift_start'];
                $daytimeend = $row['shift_end'];
                
                $hrs = date('H', strtotime($end));
                $mins = date('i', strtotime($end))+1;

                $attendancestatus = $row['status'];

                $location = $row['location'];
                $time_in = $row['time_in'];
                $time_out = $row['time_out'];
                
                $schedattend_status = $row['attendance'];

                $in_status = $row['timein_status'];
                $out_status = $row['timeout_status'];

                $image = $row['image'];

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
        <title>CVSU | Employee Dashboard</title>
      
        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <!-- Custom styles for this template-->
        <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <!-- Date range -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />


        
      
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
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                                <h5>Employee's Daily Time Record</h5>

                            </div>

                            <!-- content -->
                            <form action="../../ajaxemp/ajaxemp.php?insertNewAttendance" method="POST" enctype="multipart/form-data">
                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <img id="profileimg" src="../../upload/employeeimage/<?=$image?>" class="card-img-top card-img-bottom mb-3" style="height: 200px; max-width: 270px;" <?= $image == '' ? 'hidden':''?>>
                                                <label type="button" class="btn btn-outline-success btn-block" style="margin-bottom: -2px" <?=($attendancestatus == 'IN' || $attendancestatus == 'OUT' || $schedstatus == 'REST' || $schedattend_status == 'ABSENT') ? '' : 'for="imgupload"' ?>>Click me to upload image</label>
                                                <input type="file" required name="imgupload" id="imgupload" accept="image/*" style="margin-top: -5px; opacity:0%; width: 100%; height:1px;" oninvalid="this.setCustomValidity('Please upload image')" oninput="this.setCustomValidity('')"
                                                <?=($attendancestatus == 'IN' || $attendancestatus == 'OUT' || $schedstatus == 'REST' || $schedattend_status == 'ABSENT') ? 'disabled' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body" style="height:180px;">
                                            
                                            <div class="row">
                                                <div class="col-5 justify-content-center">
                                                    <div class="row justify-content-center" style="margin-left:5px;">
                                                        <div style=" width: 140px; height: 140px; border: 4px solid green; border-radius: 50%;">
                                                            <div id="timeindetails">
                                                                <?php
                                                                
                                                                    if($schedattend_status == 'ABSENT'){

                                                                ?>

                                                                    <h4 style="text-align: center; margin-top: 40%; font-weight: bolder; color: red;">ABSENT</h4>

                                                                <?php
                                                                    }
                                                                ?>
                                                                <p style="font-size: 13px; text-align: center; margin-top: 20%;"><strong><?=$attendancestatus == "IN" ? "TIMED-IN" : ""?><?=$attendancestatus == "OUT" ? "TIMED-OUT" : ""?></strong></p>
                                                                <h4 style="text-align: center; margin-top: -5%;  font-weight: bolder;"><?=$attendancestatus == 'IN' ? date("h:i A",strtotime($time_in)) : ""?><?=$attendancestatus == 'OUT' ? date("h:i A",strtotime($time_out)) : ""?></h4>
                                                                <p id="inout_status" style="font-size: 13px;  text-align: center; margin-top: 10%;"><strong><?=$attendancestatus == "IN" ? $in_status : ""?><?=$attendancestatus == "OUT" ? $out_status : ""?></strong></p>
                                                            </div>
                                                        </div>                                                                                  
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="row" >
                                                        <div class="col-12" style="margin-top: 3px;">
                                                            <h6><strong>Official Date and Time:</strong></h6>
                                                        </div>
                                                        <div class="col-12" style="margin-top: -4px;">
                                                            <p style="font-size: 15px; line-height: 12px;"><?=$empdate?></p>
                                                       
                                                            <p style="font-size: 16px; line-height: 1px;" id="clock"></p>
                                                        
                                                            
                                                            
                                                            
                                                                <div class="col-row" style="margin-top: 20px;">
                                                                    
                                                                    <label style="font-size: 15px;">Location:</label>
                                                                    <select style="width:105px; height:23px; font-size: 12px; margin-left: 5px;" name="location" id="location" required <?=($attendancestatus == 'IN' || $attendancestatus == 'OUT' || $schedstatus == 'REST' || $schedattend_status == 'ABSENT') ? 'disabled' : '' ?>>
                                                                            <option value="" disabled selected hidden></option>
                                                                            
                                                                            <?php
                                                                                $query = "SELECT * FROM location WHERE status = 1";
                                                                                $result = mysqli_query($connection, $query);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                            ?>
                                                                                    
                                                                                    <option required value="<?=$row['name']?>" <?=($location == $row['name'] && ($schedstatus == 'REST' || $attendancestatus == 'IN' || $attendancestatus == 'OUT')) ? "selected": ""?> ><?=$row['name']?></option>
                                                                                    
                                                                            <?php
                                                                                }
                                                                            }
                                                                            
                                                                            ?>
                                                                
                                                                    </select>

                                                                    <input type="hidden" name="empid" value="<?=$_SESSION['emp_id']?>">
                                                                    <input type="hidden" name="daystartss" value="<?=$daytimestart?>">
                                                                    <input type="hidden" name="dayendss" value="<?=$daytimeend?>">
                                                                    <input type="hidden" name="timein" value="<?=$time_in?>">
                                                                    <input type="hidden" name="timeout" value="<?=$time_out?>">

                                                                    <button type="submit" name="time_in" id="time_in" class="btn btn-success" style="height: 30px; width: 175px; font-size: 13px; margin-top: 3px; <?=($attendancestatus == 'IN' || $attendancestatus == 'OUT') ? 'display:none' : 'display:block' ?>" <?=($schedstatus == "REST" || $schedattend_status == "ABSENT") ? 'disabled' : '' ?>>
                                                                        <span class="text"><strong>TIME IN</strong></span>
                                                                    </button>
                                                                    <button type="submit" name="time_out" id="time_out" class="btn btn-success" style="height: 30px; width: 175px; font-size: 13px; margin-top: 3px; <?=($attendancestatus == NULL) ? 'display:none' : 'display:block' ?>" <?=($attendancestatus == "OUT") ? 'disabled' : '' ?>>
                                                                        <span class="text"><strong>TIME OUT</strong></span>
                                                                    </button>

                                                                            
                                                                
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body" style="height:180px; margin-left: 20px; margin-right: 20px;">
                                            
                                            <p style="text-align: center; font-weight: bold; margin-top: -5px;">Your schedule for today:</p>
                                            <p style=" text-align: center; margin-top: -10px; margin-left: 30px; margin-right: 30px; padding-top: 15px; padding-left: 1px; padding-right: 1px; padding-bottom: 15px; font-size: 15px; line-height: 12px; background-color: green; color: #fff; height: 40px; width: 80%;"><?=$empdate?></p>
                                            
                                            <div class="row justify-content-center">

                                                <?php
                                                if($schedstatus == "REG"){
                                                
                                                ?>

                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-body" style="height:60px; width: 100%; margin-left: auto; margin-right: auto;">
                                                            
                                                                <p style="color: #1cc88a; width: 100%; font-size: 10px; margin-top: -5px;"><strong>SCHEDULED TIME IN:</strong></p>
                                                                <p style="color: #1cc88a;  font-size: 14px; margin-top: -15px;"><strong><?=$start?></strong></p>

                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card">
                                                        <div class="card-body" style="height:60px; width: 100%; margin-left: auto; margin-right: auto;">
                                                            
                                                            <p style="color: #1cc88a; width: 100%; font-size: 9px; margin-top: -5px;"><strong>SCHEDULED TIME OUT:</strong></p>
                                                            <p style="color: #1cc88a; font-size: 14px; margin-top: -15px;"><strong><?=$end?></strong></p>

                                                            
                                                        </div>
                                                        </div>
                                                    </div>

                                                <?php
                                                
                                                } else {
                                                
                                                ?>


                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body" style="height:60px; margin-left: auto; margin-right: auto;">
                                                            
                                                                <p style="color: #1cc88a; font-size: 20px; margin-top: -5px;"><strong>NO SCHEDULE FOR TODAY</strong></p>
                                                                
                                                                

                                                                
                                                            </div>
                                                        </div>
                                                    </div>


                                                <?php
                                                
                                                }
                                                
                                                ?>




                                            </div>
                                            

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                            </div>
                            <!-- content -->

                            <!-- content -->
                            <div class="mt-4 mb-2 row justify-content-center">
                               
                                <div class="col-lg-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table  cellspacing="0"  width="100%">
                                                    <tbody ><tr>
                                                        <td style="float:right; margin-bottom: 5px;"><input style="width: 180px; height: 28px; font-size: 13px;"type="text" id="min" name="min"></td>
                                                        <td style="float:right; padding-top: 2px; margin-right: 10px; margin-bottom: 10px; font-size: 15px;">Minimum date:</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td style="float:right; margin-bottom: 20px;"><input style="width: 180px; height: 28px; font-size: 13px;"type="text" id="max" name="max"></td>
                                                        <td style="float:right; padding-top: 2px; margin-right: 10px; margin-bottom: 10px; font-size: 15px;">Maximum date:</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                    <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="9">
                                    <div class="row">
                                        <div class="col">
                                            <p style="float:left; margin-bottom: 1px; font-size: 20px;"><?=$name?></p>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th class="align-middle">Date</th>
                                <th class="align-middle">Location</th>
                                <th class="align-middle">Timed-In</th>
                                <th class="align-middle">Status-In</th>
                                <th class="align-middle">Timed-Out</th>
                                <th class="align-middle">Status-Out</th>
                                <th class="align-middle">Late</th>
                                <th class="align-middle">Undertime</th>
                                <th class="align-middle">Overtime</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $query = "SELECT schedules.*, 
                            CONCAT(schedules.date, ' ', schedules.start) AS shift_start, 
                            CONCAT(schedules.date, ' ', schedules.end) AS shift_end, 
                            IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) AS attendances,
                            schedules.status AS sched_status, 
                            schedules.date AS sched_date, 
                            attendances.*,
                            attendances.status AS attend_status
                            FROM `schedules`
                            LEFT JOIN `attendances` ON attendances.employee_id = schedules.employee_id AND attendances.date = schedules.date  
                            WHERE schedules.date <= '".$daytoday."' AND schedules.employee_id = '".$_SESSION['emp_id']."' AND 
                            IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.end >= '".$timestamp."' AND schedules.date = '".$daytoday."', '', 'ABSENT')) <> ''
                            ORDER BY schedules.date DESC";
                                $result = mysqli_query($connection, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {

                                     
                                        
                                        if($row['attendances']=='ABSENT'){
                                           
                            
                            ?>
                                        <tr>
                                            <td style="text-align: center;"><?=date("M d, Y",strtotime($row['sched_date']))?></td>
                                            <td colspan="8" style="text-align: center; color:red"><strong><---------- ABSENT ----------></strong></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                        </tr>
                            <?php
                                        } elseif($row['attend_status'] =='IN' && $row['time_out'] == '' && $row['sched_date'] < $daytoday) {
                                            
                            ?>            
                            
                                        <tr>
                                            <td style="text-align: center;"><?=date("M d, Y",strtotime($row['sched_date']))?></td>
                                            <td style="text-align: center;"><?=$row['location']?></td>
                                            <td style="text-align: center;"><?=($row['time_in'] == "") ? "" : date("h:i A",strtotime($row['time_in']))?></td>
                                            <td style="text-align: center;<?=$row['timein_status'] == "LATE" ? "color:orange;" : "color:#1cc88a;"?>"><?=$row['timein_status']?></td>
                                            <td colspan="2" style="text-align: center; color:orange"><strong>TIME OUT MISSING</strong></td>
                                            <td hidden></td>
                                            <td style="text-align: center;"><?=$row['late_duration']?></td>
                                            <td style="text-align: center;"><?=$row['undertime_duration']?></td>
                                            <td style="text-align: center;"><?=$row['overtime_duration']?></td>
                                        </tr>


                            <?php
                                        } elseif($row['attendances']=='REST') {
                                            
                            ?>            
                            
                                        <tr>
                                        <td style="text-align: center;"><?=date("M d, Y",strtotime($row['sched_date']))?></td>
                                            <td colspan="8" style="text-align: center; color:#1cc88a"><strong><---------- REST DAY ----------></strong></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                            <td hidden></td>
                                        </tr>


                            <?php
                                            
                                        } else {
                                                 
                            ?>
                                        <tr>
                                            <td style="text-align: center;"><?=date("M d, Y",strtotime($row['sched_date']))?></td>
                                            <td style="text-align: center;"><?=$row['location']?></td>
                                            <td style="text-align: center;"><?=($row['time_in'] == "") ? "" : date("h:i A",strtotime($row['time_in']))?></td>
                                            <td style="text-align: center;<?=$row['timein_status'] == "LATE" ? "color:orange;" : "color:#1cc88a;"?>"><?=$row['timein_status']?></td>
                                            <td style="text-align: center;"><?=($row['time_out'] == "") ? "" : date("h:i A",strtotime($row['time_out']))?></td>
                                            <td style="text-align: center;<?=$row['timeout_status'] == "UNDERTIME" ? "color:orange;" : "color:#1cc88a;"?>"><?=$row['timeout_status']?></td>
                                            <td style="text-align: center;"><?=$row['late_duration']?></td>
                                            <td style="text-align: center;"><?=$row['undertime_duration']?></td>
                                            <td style="text-align: center;"><?=$row['overtime_duration']?></td>
                                        </tr>


                            <?php
                                        }
                                    }
                                }
                            ?>

                        </tbody>
                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>


                            </div>
                            <!-- content -->





                           
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
        <!-- Date range -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

       

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

         <!-- filter table -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

        

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profileimg').attr('src', e.target.result);
                        $('#profileimg').removeAttr("hidden")
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgupload").change(function(){
                readURL(this);
            });
        </script>
        

        <script type="text/javascript">

            var minDate, maxDate;

            $(function() {

                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'left',
                    locale: {
                        cancelLabel: 'Clear'
                    }
        
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                    // minDate = picker.startDate.format('MM-DD-YYYY');
                    // maxDate = picker.endDate.format('MM-DD-YYYY');
                    // console.log(minDate);

                });

                

                $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            });
        </script>

        <script>
            $(function () {

                $("#example1").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false, "ordering":false,
                "buttons": ["print"],
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                
            });

            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[0] );

                    
            
                    if (
                        ( min === null && max === null ) ||
                        ( min === null && date <= max ) ||
                        ( min <= date   && max === null ) ||
                        ( min <= date   && date <= max )
                    ) {
                        return true;
                    }
                    return false;

                    
                }
            );

            
            
            $(document).ready(function() {
                // Create date inputs
                minDate = new DateTime($('#min'), {
                    format: 'MMMM DD, YYYY'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'MMMM DD, YYYY'
                });
            
                // DataTables initialisation
                var table = $('#example1').DataTable();
            
                // Refilter the table
                $('#min, #max').on('change', function () {
                    table.draw();
                });
            });


            function SwitchButtons(buttonId) {
                var hideBtn, showBtn;
                if (buttonId == 'time_in') {
                    showBtn = 'time_out';
                    hideBtn = 'time_in';
                } else {
                    showBtn = 'time_in';
                    hideBtn = 'time_out';
                }
                
                document.getElementById(hideBtn).style.display = 'none'; //step 2 :additional feature hide button
                document.getElementById(showBtn).style.display = ''; //step 3:additional feature show button


                }
        </script>

        
        <script type="text/javascript">
            var currenttime = '<?php echo $tz_time;?>'; // Timestamp of the timezone you want to use, in this case, it's server time
            var servertime=new Date(currenttime);
            function padlength(l){
                var output=(l.toString().length==1)? "0"+l : l;
                return output;
            }
            function digitalClock(){
                servertime.setSeconds(servertime.getSeconds()+1);
                // var timestring=padlength(servertime.getHours())+":"+padlength(servertime.getMinutes())+":"+padlength(servertime.getSeconds());
                // var ampms = (servertime.getHours() >= 12) ? 'pm' : 'am';

                var hours = servertime.getHours();
                var minutes = servertime.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes + ':' + padlength(servertime.getSeconds()) +' ' + ampm;




                
                document.getElementById("clock").innerHTML=strTime;
            }
            window.onload=function(){
            setInterval("digitalClock()", 1000);
            }
        </script>


        <script>
           
            function refreshAt(hours, minutes, seconds) {
                var now = new Date();
                var then = new Date();

                if(now.getHours() > hours ||
                (now.getHours() == hours && now.getMinutes() > minutes) ||
                    now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
                    then.setDate(now.getDate() + 1);
                }
                then.setHours(hours);
                then.setMinutes(minutes);
                then.setSeconds(seconds);

                var timeout = (then.getTime() - now.getTime());

                
                    setTimeout(function() { window.location.reload(true); }, timeout);
                
                
            }
                refreshAt(<?php echo $hrs?>,<?php echo $mins?>,0);
                refreshAt(24,00,00); //Will refresh the page at 12:00am
            

          
            

            
        </script>


        <!-- <script>
            function refreshAt(hours, minutes, seconds) {
                var now = new Date();
                var then = new Date();

                if(now.getHours() > hours ||
                (now.getHours() == hours && now.getMinutes() > minutes) ||
                    now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
                    then.setDate(now.getDate() + 1);
                }
                then.setHours(hours);
                then.setMinutes(minutes);
                then.setSeconds(seconds);

                var timeout = (then.getTime() - now.getTime());
                setTimeout(function() { window.location.reload(true); }, timeout);
            }
            refreshAt(5,47,30); //Will refresh the page at 12:00am
        </script> -->
        
        


    </body>


<?php } else {
  
  header("location: ../../index.php");
 
}?>