<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    $timestamp = date("H:i", strtotime($todaytimestamp));
    $emp_id="";
    $start="";
    $end="";

    $late = array();
    $under = array();
    $over = array();
    $render = array();

    if (isset($_POST["submit"])) {
        $emp_id=$_POST['emp_id'];
        $start=$_POST['start'];
        $end=$_POST['end'];
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
        <title>Users | Admin</title>
      
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

                            <!-- Page Heading  -->
                            <h1 class="h3 mb-4 text-gray-800">Daily Time Record</h1>

                            <div class="row justify-content-center">

                                <div class="col-lg-7 ml-auto mb-3 float-right">
                                    <form action="" method="POST">
                                        <div class="row">
                                        <div class="col-3 offset-lg-1">
                                            <input type="date" name="start" value="<?=$start?>" class="form-control">
                                                    </div>
                                        <div class="col-3">
                                            <input type="date" name="end" value="<?=$end?>" class="form-control">
                                                    </div>
                                        <div class="col-3">
                                            <select name="emp_id" id="emp_id" class="form-control" required>
                                                <option value="" disabled selected hidden></option>
                                        
                                                <?php
                                                    $query = "SELECT * FROM employee WHERE is_active = 1 AND employee.id != 25 ORDER BY name ASC";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        
                                                        <option required value="<?=$row['id']?>" <?=$emp_id == $row['id'] ? "selected": ""?>><?=$row['name']." ". $row['last_name']?></option>
                                                        
                                                <?php
                                                    }
                                                }
                                                ?>
                                    
                                            </select>
                                            
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" name="submit" class="btn btn-success btn-fill btn-block">Show</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            

                            <div class="row justify-content-center">

                                <div class="col-12">
                                    
                                    <table class="table table-bordered table-striped" id="example1" width="100%">
                                        <thead>
                                            <tr>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle notexport">Photo</th>
                                            <th class="align-middle notexport">Location</th>
                                            <th class="align-middle">Timed-In</th>
                                            <th class="align-middle">Status-In</th>
                                            <th class="align-middle">Timed-Out</th>
                                            <th class="align-middle">Status-Out</th>
                                            <th class="align-middle">Bill Hrs</th>
                                            <th class="align-middle">Late</th>
                                            <th class="align-middle">Undertime</th>
                                            <th class="align-middle">Overtime</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            $billtotal = "";
                                            $latetotal = "";
                                            $undertimetotal = "";
                                            $overtimetotal = "";
                                            $absenttotal = "";
                                            $totalrender = "";
                                            $name="";
                                            $startdate="";
                                            $enddate="";
                                            
                                            if (isset($_POST["submit"])) {
                                                $emp_id=$_POST['emp_id'];
                                                $start=$_POST['start'];
                                                $end=$_POST['end'];

                                                $startdate = date("M d, Y",strtotime($start));
                                                $enddate = date("M d, Y",strtotime($end));

                                                $query = "SELECT * FROM employee WHERE id = '".$emp_id."'";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    
                                                        $name = $row['name']." ".$row['last_name'];
                                                
                                                    }
                                                }

                                                

                                                $query1 = "SELECT SUM(schedules.bill) AS totalbill, 
                                                    COUNT(IF(schedules.attendances = 'ABSENT', schedules.attendances, NULL )) AS totalabsent, 
                                                    SEC_TO_TIME(SUM(TIME_TO_SEC(late_duration))) as totallates,
                                                    SEC_TO_TIME(SUM(TIME_TO_SEC(undertime_duration))) as totalundertime,
                                                    SEC_TO_TIME(SUM(TIME_TO_SEC(overtime_duration))) as totalovertime,
                                                    SEC_TO_TIME(SUM(TIME_TO_SEC(total_render))) as totalrendered  
                                                        FROM (SELECT schedules.employee_id as empid, schedules.bill, 
                                                        CONCAT(schedules.date, ' ', schedules.start) AS shift_start, 
                                                        CONCAT(schedules.date, ' ', schedules.end) AS shift_end, 
                                                        IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) AS attendances,
                                                        schedules.status AS sched_status, 
                                                        schedules.date AS sched_date, 
                                                        attendances.*,
                                                        attendances.status AS attend_status
                                                        FROM `schedules`
                                                        LEFT JOIN `attendances` ON attendances.employee_id = schedules.employee_id AND attendances.date = schedules.date  
                                                        WHERE (schedules.date >= '".$start."' AND schedules.date <= '".$end."') AND schedules.employee_id = '".$emp_id."' AND 
                                                        IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) <> '' 
                                                        AND (schedules.date <= '".$daytoday."' AND IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) <> 'REST')
                                                        ORDER BY schedules.date DESC)schedules ";
                                                $result = mysqli_query($connection, $query1);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $billtotal = $row['totalbill'];
                                                        $latetotal = $row['totallates'];
                                                        $undertimetotal = $row['totalundertime'];
                                                        $overtimetotal = $row['totalovertime'];
                                                        $absenttotal = $row['totalabsent'];
                                                        $totalrender = $row['totalrendered'];
                                                        
                                                    
                                                    }
                                                }

                                               
                                                
                                                

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
                                                    WHERE (schedules.date >= '".$start."' AND schedules.date <= '".$end."') AND schedules.employee_id = '".$emp_id."' AND 
                                                    IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) <> '' 
                                                    AND (schedules.date <= '".$daytoday."' AND IF(attendances.status IS NOT NULL, 'PRESENT', IF(schedules.status = 'REST', 'REST', IF(schedules.end <> '' AND schedules.end >= '".$timestamp."' AND schedules.date >= '".$daytoday."', '', 'ABSENT'))) <> 'REST')
                                                    ORDER BY schedules.date DESC";
                                                $result = mysqli_query($connection, $query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        
                                                        array_push($late,$row['late_duration']);
                                                        array_push($under,$row['undertime_duration']);
                                                        array_push($over,$row['overtime_duration']);
                                                        array_push($render,$row['total_render']);
                                                        

                                                        if($row['attendances']=='ABSENT'){
                                            
                                            ?>
                                                            <tr>
                                                                <td style="text-align: center;"><?=date("m-d-Y",strtotime($row['sched_date']))?></td>
                                                                <td colspan="10" style="text-align: center; color:red"><strong> ABSENT </strong></td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                                <td hidden>ABSENT</td>
                                                            </tr>
                                            <?php
                                                        } elseif($row['attendances']=='REST') {
                                                            
                                            ?>       

                                                            <tr>
                                                                <td style="text-align: center;"><?=date("m-d-Y",strtotime($row['sched_date']))?></td>
                                                                <td colspan="10" style="text-align: center; color:#1cc88a"><strong> REST DAY </strong></td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                                <td hidden>REST DAY</td>
                                                            </tr>


                                            <?php
                                                            
                                                        } else {
                                                                
                                            ?>

                                                            <tr>
                                                                <td style="text-align: center;"><?=date("m-d-Y",strtotime($row['sched_date']))?></td>
                                                                <td class=" text-center"><img src="../../upload/employeeimage/<?=$row['image']?>" style="width: 55px; height:55px" class="img-rounded"></td>
                                                                <td style="text-align: center;"><?=$row['location']?></td>
                                                                <td style="text-align: center;"><?=($row['time_in'] == "") ? "" : date("h:i A",strtotime($row['time_in']))?></td>
                                                                <td style="text-align: center;<?=$row['timein_status'] == "LATE" ? "color:orange;" : "color:#1cc88a;"?>"><?=$row['timein_status']?></td>
                                                                <td style="text-align: center;"><?=($row['time_out'] == "") ? "" : date("h:i A",strtotime($row['time_out']))?></td>
                                                                <td style="text-align: center;<?=$row['timeout_status'] == "UNDERTIME" ? "color:orange;" : "color:#1cc88a;"?>"><?=$row['timeout_status']?></td>
                                                                <td style="text-align: center;"><?=$row['bill']?></td>
                                                                <td style="text-align: center;"><?=$row['late_duration']?></td>
                                                                <td style="text-align: center;"><?=$row['undertime_duration']?></td>
                                                                <td style="text-align: center;"><?=$row['overtime_duration']?></td>
                                                            </tr>

                                            <?php
                                                            }
                                                        }
                                                    }
                                                }

                                                
                                            ?>
                                                            
                                        </tbody>
                                        
                                            
                                            
                                    </table>

                                    <?php
                                        
                                        function explode_time($time) { //explode time and convert into seconds
                                            $time = explode(':', $time);
                                            $time = (int) $time[0] * 3600 + (int) $time[1] * 60 + $time[2];
                                            return $time;
                                        }

                                        function second_to_hhmm($time) { //convert seconds to hh:mm
                                            $hour = floor($time / 3600);
                                            $minute = strval(floor(($time % 3600) / 60));
                                            $secs = strval(floor((($time % 3600) / 60) / 60));
                                            if ($hour == 0) {
                                                $hour = "00";

                                            }elseif ($hour <= 9) {
                                                $hour = "0".$hour;

                                            }else {
                                                $hour = $hour;
                                            }
                                            if ($minute == 0) {
                                                $minute = "00";

                                            }elseif ($minute <= 9) {
                                                $minute = "0".$minute;

                                            }else {
                                                $minute = $minute;
                                            }
                                            if ($secs == 0) {
                                                $secs = "00";

                                            }elseif ($secs <= 9) {
                                                $secs = "0".$secs;

                                            }else {
                                                $secs = $secs;
                                            }
                                            $time = $hour . ":" . $minute. ":" .$secs;
                                            return $time;
                                        }

                                        $latedurations = 0;

                                        foreach ($late as $time_val) {
                                            if (empty($time_val)) {
                                                continue;
                                            }
                                            $latedurations +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
                                        }

                                        $underdurations = 0;

                                        foreach ($under as $time_val) {
                                            if (empty($time_val)) {
                                                continue;
                                            }
                                            $underdurations +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
                                        }

                                        $overdurations = 0;

                                        foreach ($over as $time_val) {
                                            if (empty($time_val)) {
                                                continue;
                                            }
                                            $overdurations +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
                                        }

                                        $renderdurations = 0;

                                        foreach ($render as $time_val) {
                                            if (empty($time_val)) {
                                                continue;
                                            }
                                            $renderdurations +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
                                        }

                                        $renderdurationss = second_to_hhmm($renderdurations);
                                        $latedurationss = second_to_hhmm($latedurations);
                                        $underdurationss = second_to_hhmm($underdurations);
                                        $overdurationss = second_to_hhmm($overdurations);
                                        
                                    ?>

                                    
                                    



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

                var render = <?php echo json_encode($renderdurationss)?>;
                var late = <?php echo json_encode($latedurationss)?>;
                var under = <?php echo json_encode($underdurationss)?>;
                var over = <?php echo json_encode($overdurationss)?>;
                var bill = <?php echo json_encode($billtotal)?>;
                var absent = <?php echo json_encode($absenttotal)?>;

                $("#example1").DataTable({
                scrollX: true,
                dom: 'Bfrtip',
                "buttons": [
                            {
                                extend: 'print',
                                text: 'Print',
                                title:'',
                                messageBottom:

                                        '<div class="mb-3 float-left"><br><br><h5>Total rendered time: <strong>'+render+'</strong></h5><h5>Total late time: <strong>'+late+'</strong></h5><h5>Total undertime: <strong>'+under+'</strong></h5><h5>Total overtime: <strong>'+over+'</strong><h5>Total Working Hours: <strong>'+bill+'</strong><h5>Total Absent: <strong>'+absent+'</strong></h5><br></div>',

                                footer: true,
                                className: 'btn btn-info',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                },
                                customize: function ( win ) {
                                    $(win.document.body)
                                        .css( 'font-size', '8pt' )
                                        .prepend(
                                            '<img src="https://i.ibb.co/b6MshdM/cvsu-bacoor.png" style="display: block; margin-left: auto; margin-right: auto; width: 520px;"/><br>',
                                            '<h2>Daily Time Record</h2>',
                                            '<h5>Employee Name:<strong><?php echo "  ".$name?></strong></h5>',
                                            '<h5>From:<strong><?php echo "  ".$startdate?></strong></h5>',
                                            '<h5>To:<strong><?php echo "  ".$enddate?></strong></h5><br>',
                                            '<h4><strong>Attendance</strong></h4><br>',
                                            
                                        );
                                    
                                    $(win.document.body).find( 'table' )
                                        .addClass( 'compact' )
                                        .css( 'font-size', 'inherit' );
                                    
                                }
                            }
                        ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>


    </body>

</html>

<?php } else {
  
  header("location: ../../index.php");
 
}?>