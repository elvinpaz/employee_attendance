<?php

session_start();
require '../../connection/connect.php';


if(isset($_SESSION['access']) && $_SESSION['access'] == "Admin"){

    if (isset($_GET['eschedule'])) {
        $sched_id = $_GET['sched_id'];
    

        $query = "SELECT employee.name, 
                         schedules.*
                    FROM schedules
                    LEFT JOIN employee ON schedules.employee_id = employee.id
                    WHERE sched_id='".$sched_id."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name=$row['name'];
                $week=$row['week'];
                $mon_bill=$row['mon_bill'];
                $tue_bill=$row['tue_bill'];
                $wed_bill=$row['wed_bill'];
                $thu_bill=$row['thu_bill'];
                $fri_bill=$row['fri_bill'];
                $sat_bill=$row['sat_bill'];
                $mon_start=$row['mon_start'];
                $tue_start=$row['tue_start'];
                $wed_start=$row['wed_start'];
                $thu_start=$row['thu_start'];
                $fri_start=$row['fri_start'];
                $sat_start=$row['sat_start'];
                $mon_end=$row['mon_end'];
                $tue_end=$row['tue_end'];
                $wed_end=$row['wed_end'];
                $thu_end=$row['thu_end'];
                $fri_end=$row['fri_end'];
                $sat_end=$row['sat_end'];
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

                                    <div class="tab-pane" id="pickup"><br>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <div class="row justify-content-between" style="margin-bottom: 20px; margin-top: -15px; margin-left: 5px; margin-right: 5px;" >
                                                <label>Pickup Schedule</label>
                                                <input  style="align-right" disabled type="week" name="week" value="<?=$week?>">
                                            </div>
                                            <table class="table table-bordered table-striped" style="margin-bottom:20px;">
                                                <thead>
                                                    <th style="padding-top:10px; text-align:center;"><input type="checkbox" name="disableRow" id="selectAll" checked/></th>
                                                    <th style="width: 25%">Day</th>
                                                    <th style="width: 10%">Billable Hrs</th>
                                                    <th style="width: 30%">Start Time</th>
                                                    <th style="width: 30%">End Time</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()"/></td>
                                                        <td style="width: 25%">Monday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_mon" id="bill_mon" value="<?=$mon_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$mon_start?>" id="mon_start" name="mon_start"  min="6" max="12" class="form-control  timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$mon_end?>" id="mon_end" name="mon_end" min="12" max="25" class="form-control  timepicker"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()"/></td>
                                                        <td style="width: 25%">Tuesday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_tue" id="bill_tue" value="<?=$tue_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$tue_start?>" id="tue_start" name="tue_start" class="form-control  timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$tue_end?>" id="tue_end" name="tue_end" class="form-control  timepicker"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()"/></td>
                                                        <td style="width: 25%">Wednesday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_wed" id="bill_wed" value="<?=$wed_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$wed_start?>" id="wed_start" name="wed_start" class="form-control  timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$wed_end?>" id="wed_end" name="wed_end" class="form-control  timepicker"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()"/></td>
                                                        <td style="width: 25%">Thursday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_thu" id="bill_thu" value="<?=$thu_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$thu_start?>" id="thu_start" name="thu_start" class="form-control  timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$thu_end?>" id="thu_end" name="thu_end" class="form-control  timepicker"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()" id="<?=$sched_id?>" value="<?=$sched_id?>"/></td>
                                                        <td style="width: 25%">Friday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_fri" id="bill_fri" value="<?=$fri_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$fri_start?>" id="fri_start" name="fri_start" class="form-control  timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$fri_end?>" id="fri_end" name="fri_end" class="form-control  timepicker"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:center;"><input type="checkbox" checked class="disableRow" name="disableRow[]" onchange="callFunction()" id="<?=$sched_id?>" value="<?=$sched_id?>"/></td>
                                                        <td style="width: 25%">Saturday</td>
                                                        <td style="text-align:center;"><input style="width: 60%; text-align: center;" type="number" name="bill_sat" id="bill_sat" value="<?=$sat_bill?>"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$sat_start?>" id="sat_start" name="sat_start" class="form-control timepicker"></td>
                                                        <td style="width: 30%"><input type="time" required value="<?=$sat_end?>" id="sat_end" name="sat_end" class="form-control timepicker"></td>
                                                    </tr>
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
                                    <input type="hidden" name="sched_id" value="<?=$sched_id?>">
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
        </script>

    </body>


<?php } else {
  
  header("location: index.php");
 
}?>

