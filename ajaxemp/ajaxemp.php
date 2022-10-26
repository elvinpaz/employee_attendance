<?php

    require '../connection/connect.php';

?>


<?php

// insert ATTENDANCE
if (isset($_GET["insertNewAttendance"])) {

        $empid=$_POST['empid'];
        $location=$_POST['location'];
        $daystarts=$_POST['daystartss'];
        $dayends=$_POST['dayendss'];


    if (isset($_POST["time_in"])) {

        $timein = new DateTime($todaytimestamp);//start time
        $shiftstart = new DateTime($daystarts);//start shift
        $late = $timein->diff($shiftstart);
        // $gethoursduration = $interval->format('%H');
        // echo $interval->format(($gethoursduration == '00') ? '%i minutes' : '%H hour(s) %i minutes');
        $lateduration = "";

        if($todaytimestamp > $daystarts){
            $in_status = 'LATE';
            $lateduration = $late->format('%H:%i:00');
        }else {
            $in_status = 'ON TIME';
        }

        $query = "INSERT INTO `attendances`(`employee_id`, `time_in`, `date`, `timein_status`, `late_duration`, `location`) 
            VALUES ('".$empid."','".$date."','".$daytoday."','".$in_status."','".$lateduration."','".$location."')";
        mysqli_query($connection, $query);
        header("location: ../employee/dashboard/dashboard.php");
    }

    if (isset($_POST["time_out"])) {

        $timeout = new DateTime($todaytimestamp);//end time
        $shiftend = new DateTime($dayends);//end shift
        $undertime = $shiftend->diff($timeout);
        $overtime = $timeout->diff($shiftend);
        // $gethoursduration = $interval->format('%H');
        // echo $interval->format(($gethoursduration == '00') ? '%i minutes' : '%H hour(s) %i minutes');
        $undertimeduration = "";
        $overtimeduration = "";

        if($todaytimestamp < $dayends){
            $out_status = 'UNDERTIME';
            $undertimeduration = $undertime->format('%H:%i:00');
        }else if($todaytimestamp > $dayends){ 
            $out_status = 'OVERTIME';
            $overtimeduration = $overtime->format('%H:%i:00');
        }else{
            $out_status = 'ON TIME';
        }

        $query = "UPDATE `attendances` SET `time_out`='".$date."',`timeout_status`='".$out_status."',`undertime_duration`='".$undertimeduration."',`overtime_duration`='".$overtimeduration."',`status`= 1 WHERE employee_id = '".$empid."' AND date = '".$daytoday."' AND status = 0";
        mysqli_query($connection, $query);
    
        header("location: ../employee/dashboard/dashboard.php");
    }

    if (isset($_GET["Absent"])) {

        if($_GET['shift'] == 1){

            $query = "INSERT INTO `attendances`(`employee_id`, `date`, `status`) VALUES ('".$_GET['emp']."','".$_GET['date']."', 3)";
            mysqli_query($connection, $query);
        
            header("location: ../employee/dashboard/dashboard.php");

        }
        header("location: ../employee/dashboard/dashboard.php");
        


    }
}



?>