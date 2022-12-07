<?php
    session_start();
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


// insert upload files
if (isset($_GET["insertNewPostedFile"])) {
    $fileName = PATHINFO($_FILES['fileupload']['name']);
    $fileSize = intval($_FILES['fileupload']['size']/1024);
    $description = $_POST['filedescription'];
    $newFileName = $fileName['filename']."_".$filetimestamp.".".$fileName['extension'];
    move_uploaded_file($_FILES["fileupload"]["tmp_name"], "../filesupload/employee/posted/".$newFileName);

    echo $newFileName;

    
    
            $update = "INSERT INTO `e_uploadfile`(`employee_id`, `filename`, `filesize`, `description`) 
                    VALUES ('".$_SESSION['emp_id']."','".$newFileName."','".$fileSize."','".$description."') ";
            mysqli_query($connection, $update);
        

    
    
    
    header("location: ../employee/uploadfile/uploadfile.php");

}


//delete user
if (isset($_GET['deleteposted'])) {
    $id=$_GET['id'];

    $query = "SELECT * FROM e_uploadfile WHERE id = '".$id."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE e_uploadfile SET status = 1 WHERE id = '".$id."' ";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/uploadfile/uploadfile.php");
}




// restore delete User
if (isset($_GET['restoreDeletePosted'])) {
    $id=$_GET['id'];
    

    $query = "SELECT * FROM e_uploadfile WHERE id = '".$id."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE e_uploadfile SET status = 0 WHERE id = '".$id."' ";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/uploadfile/uploadfile.php");
}



?>



<?php
        if (isset($_GET['requestfiles'])) {
            
            ?>
                        <div class="box-body">
                            

                            <div class="form-group">
                                <label>File type:</label>
                                <select class="form-control" id="filetype" name="filetype" required>
                                    <option disabled selected></option>
                                    <option value="JPEG/PNG">JPEG/PNG</option>
                                    <option value="PDF">PDF</option>
                                    <option value="DOC/DOCX">DOC/DOCX</option>
                                    <option value="XLS/XLSX">XLS/XLSX</option>
                                    <option value="PPT/PPTX">PPT/PPTX</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" autocomplete="off" class="form-control" required>
                            </div>

                        </div>

                    

            <?php
        }
?>


<?php


// insert new Designation
if (isset($_GET["insertNewRequest"])) {
    $filetype=$_POST['filetype'];
    $description=$_POST['description'];

    $query = "INSERT INTO `e_requestfile`(`employee_id`, `filetype`, `description`) 
        VALUES ('".$_SESSION['emp_id']."','".$filetype."','".$description."')";
    mysqli_query($connection, $query);

    echo $query;

    header("location: ../employee/receivedfile/receivedfile.php");
    
}


//delete request
if (isset($_GET['deleteRequest'])) {
    $id=$_GET['id'];

    // $query = "SELECT * FROM department WHERE dept_id = '".$dept_id."' ";
    // $result  = mysqli_query($connection, $query);
    // if (mysqli_num_rows($result) > 0) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $update = "UPDATE department SET status = 0 WHERE dept_id = '".$dept_id."' ";
    //         mysqli_query($connection, $update);
    //     }
    // }

    $query = "DELETE FROM e_requestfile WHERE id = '".$id."' ";
    mysqli_query($connection, $query);

    header("location: ../employee/receivedfile/receivedfile.php");
}


//delete admin submitted files
if (isset($_GET['deleteAdminSubmitted'])) {
    $id=$_GET['id'];

    $query = "SELECT * FROM filesubmit WHERE id = '".$id."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE filesubmit SET e_status = 1 WHERE id = '".$id."' ";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/receivedfile/receivedfile.php");
}

// restore admin submitted files
if (isset($_GET['restoreDeleteSubmitted'])) {
    $id=$_GET['id'];

    $query = "SELECT * FROM filesubmit WHERE id = '".$id."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE filesubmit SET e_status = 0 WHERE id = '".$id."' ";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/receivedfile/receivedfile.php");
}


// restore admin submitted files
if (isset($_GET['updateadminpostnotif'])) {

    $query = "SELECT * FROM fileupload WHERE employee_id = '".$_SESSION['emp_id']."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE fileupload SET notif = 1 WHERE employee_id = '".$_SESSION['emp_id']."'";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/adminpostedfile/adminpostedfile.php");
}


// restore admin submitted files
if (isset($_GET['updateadminsubmitnotif'])) {

    $query = "SELECT * FROM filesubmit WHERE employee_id = '".$_SESSION['emp_id']."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $update = "UPDATE filesubmit SET notif = 1 WHERE employee_id = '".$_SESSION['emp_id']."'";
            mysqli_query($connection, $update);
        }
    }

    // $query = "DELETE FROM user WHERE id = '".$id."' ";
    // mysqli_query($connection, $query);

    header("location: ../employee/receivedfile/receivedfile.php");
}


// submit edit User
if (isset($_GET['submitEditPass'])) {

    $id=$_POST['id'];
    $curpass=$_POST['curpass'];
    $newpass=$_POST['newpass'];
    $conpass=$_POST['conpass'];

    
    

    $query = "SELECT * FROM user WHERE employee_id = '".$id."' AND password = '".$curpass."' ";
    $result  = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {

        if($newpass == $conpass){
            while ($row = mysqli_fetch_assoc($result)) {
                $update = "UPDATE user SET password = '".$conpass."' WHERE employee_id = '".$id."' ";
                mysqli_query($connection, $update);
                header("location: ../employee/cpass/e_users.php?usermsg");
            }
        } else {

            header("location: ../employee/cpass/e_users.php?usermsg=Password not match!");

        }

        
    } else {
        header("location: ../employee/cpass/e_users.php?usermsg=Invalid Password!");
    }


    
}





?>


