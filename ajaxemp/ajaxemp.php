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
        $time_in=$_POST['timein'];
        $fileInfo = PATHINFO($_FILES["imgupload"]["name"]);

        $query = "SELECT name, last_name FROM employee WHERE id = '".$empid."'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $name = $row['name']."-".$row['last_name'];

            }
        }
        


    if (isset($_POST["time_in"])) {

        if (empty($_FILES["imgupload"]["name"])){
            $image="default.png";
    
        }
        else{
            if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
                $newFilename = $name. "_" .$daytoday. "." . $fileInfo['extension'];
                move_uploaded_file($_FILES["imgupload"]["tmp_name"], "../upload/employeeimage/" . $newFilename);
                $image = $newFilename;
            }
            else{
                $image="default.png";
            }
        }

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

        $query = "INSERT INTO `attendances`(`employee_id`, `image`, `time_in`, `date`, `timein_status`, `late_duration`, `location`, `status`) 
            VALUES ('".$empid."', '".$image."', '".$date."','".$daytoday."','".$in_status."','".$lateduration."','".$location."','IN')";
        mysqli_query($connection, $query);
        header("location: ../employee/dashboard/dashboard.php");
    }

    if (isset($_POST["time_out"])) {
        $timeins = new DateTime($time_in);//start time
        $timeout = new DateTime($todaytimestamp);//end time
        $shiftend = new DateTime($dayends);//end shift
        $undertime = $shiftend->diff($timeout);
        $overtime = $timeout->diff($shiftend);
        $render = $timeins->diff($timeout);
        // $gethoursduration = $interval->format('%H');
        // echo $interval->format(($gethoursduration == '00') ? '%i minutes' : '%H hour(s) %i minutes');
        $undertimeduration = "";
        $overtimeduration = "";
        $totalrenderduration = $render->format('%H:%i:00');

        if($todaytimestamp < $dayends){
            $out_status = 'UNDERTIME';
            $undertimeduration = $undertime->format('%H:%i:00');
        }else if($todaytimestamp > $dayends){ 
            $out_status = 'OVERTIME';
            $overtimeduration = $overtime->format('%H:%i:00');
        }else{
            $out_status = 'ON TIME';
        }

        $query = "UPDATE `attendances` SET `time_out`='".$date."',`timeout_status`='".$out_status."',`undertime_duration`='".$undertimeduration."',`overtime_duration`='".$overtimeduration."',`total_render`='".$totalrenderduration."',`status`= 'OUT' WHERE employee_id = '".$empid."' AND date = '".$daytoday."' AND status = 'IN'";
        mysqli_query($connection, $query);
    
        header("location: ../employee/dashboard/dashboard.php");
    }
}



?>