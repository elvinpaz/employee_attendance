<?php
    session_start();
    require '../connection/connect.php';

?>
 
<!-- MODAL -->
    <!-- add designation -->
    <?php
        if (isset($_GET['adddesignation'])) {
            
            ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" autocomplete="off" class="form-control" placeholder="Enter Code" required/>
                            </div>

                        </div>

                    

            <?php
        }
    ?>

    <!-- view sent files by employee -->
    <?php
            if (isset($_GET['viewfiles'])) {
                $id = $_POST['id'];

                $query = "SELECT CONCAT_WS(' ', employee.name, employee.last_name) AS fullname 
                        FROM `employee` WHERE id = '".$id."'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fullname=$row['fullname'];
                            }
                        }

                ?>

                    <div class="box-body">
                        <h5>Employee's file manager</h5>
                        <h6 style="margin-top:-5px">Submitted files</h6>
                        <div class="row">
                            <i style="font-size: 30px; margin-left:15px; margin-right:10px;" class="fas fa-envelope"></i>
                            <h6 style="margin-top:5px">From: <?=$fullname?></h6>
                        </div>
                        <div  style="border-style: dashed; border-radius: 10px; height: 400px; margin-top: 10px; padding: 5px; overflow-y: scroll;">


                <?php
                        
                        $query = "SELECT * FROM `e_uploadfile` WHERE status = 0 AND e_uploadfile.employee_id = '".$id."' ORDER BY id DESC";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                
                ?>
                       
                        <div class="callout callout-success" style="margin-left:15px; margin-right:15px; margin-top:15px; height:25%">
                                <div class="row filedisplay" style="border-radius: 5px; height:100%; width: 100%; margin-left:0px; padding-top: -20px">
                                    <i style="margin-top: -5px; padding-bottom: 30px; padding-left:20px; padding-right:-10px; font-size: 35px" class="col-1 fas fa-file-alt"></i>
                                    <div class="col-10" style="height: 50px; margin-top:-15px; margin-left:-10px">
                                        <a href="../../filesupload/employee/posted/<?php echo $row['filename'];?>" target="_blank">
                                            <p class="col-12 filename" style="margin-left:-2px; margin-top: 9px; font-size: 15px; color:#28a745; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; width:70%"><strong><?php echo $row['filename'];?></strong></p>
                                        </a>  
                                        <p class="col-12 filesize" style="margin-left:-2px; margin-top: 0px; font-size: 12px"><?php echo $row['filesize'];?> KB</p>
                                    </div>
                                    <div class="col-1">
                                        <img src="../../assets/img/new.png" style="<?=$row['readnotif'] == 1 ? 'display: none;' : ''?>position: absolute; right: -538px; top: -25px; height:125px; width:125px; margin-right: 500px; margin-bottom: -10px;">
                                    </div>
                                    <p class="col-10" style="margin-top: -23px; margin-left: 5px; font-size: 15px;">Description: <?php echo $row['description'];?></p>
                                    <p class="col-10" style="margin-top: -20px; margin-left: 5px; font-size: 15px;">Date Uploaded: <?php echo date("M j, Y", strtotime($row['date']))." at ".date("H:i:s a", strtotime($row['date']));?></p>
                                </div>
                        </div>

                <?php
                            }
                        }

                       
                        $query = "SELECT * FROM e_uploadfile WHERE e_uploadfile.employee_id = '".$id."'";
                        $result  = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $update = "UPDATE e_uploadfile SET readnotif = 1, notif = 1 WHERE e_uploadfile.employee_id = '".$id."'";
                                mysqli_query($connection, $update);
                            }
                        }
       
                ?>
                        </div>
                <?php
            }
    ?>

    <!-- send requested files -->
    <?php
            if (isset($_GET['sendrequest'])) {
                $id = $_POST['id'];
                $filetype = "";

                $query = "SELECT * FROM e_requestfile WHERE e_requestfile.id = '".$id."'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                                $query = "SELECT e_requestfile.*, CONCAT_WS(' ', employee.name, employee.last_name)AS fullname FROM `e_requestfile`
                                LEFT JOIN `employee` ON employee.id = e_requestfile.employee_id WHERE e_requestfile.id = '".$id."'";
                                        $result = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $fullname=$row['fullname'];
                                                $empid=$row['employee_id'];
                                                if($row['filetype'] == "JPEG/PNG"){
                                                    $filetype = "image/*";
                                                } elseif($row['filetype'] == "PDF"){
                                                    $filetype = ".pdf";
                                                } elseif($row['filetype'] == "DOC/DOCX"){
                                                    $filetype = ".doc,.docx";
                                                } elseif($row['filetype'] == "XLS/XLSX"){
                                                    $filetype = ".xlsx,.xls";
                                                } elseif($row['filetype'] == "PPT/PPTX"){
                                                    $filetype = ".ppt,.pptx";
                                                } 
                                            }
                                        

        ?>

                <div class="card">
                    <div class="card-body" style="min-height:250px;">
                            <p style="text-align: start; font-size:20px;" class="mb-4">Submit files to: <b><?=$fullname?></b></p>
                            <p>Description:</p>
                            <input required class="col-12" style="height:40px; margin-top: -50px" type="text" name="filedescription" id="filedescription">
                            <div class="row" style="margin-bottom: 10px;">
                                <label class="col-2" type="button"  
                                    style="margin-bottom: -2px; margin-left:10px; margin-top: 10px; width: 75px; height:75px; padding-top: 15px; padding-bottom: 15px; padding-left:15px; padding-right:15px;" 
                                    for="fileupload"><i style="color:#154c79; font-size: 45px" class="fas fa-folder-open"></i>
                                </label>
                                <div class="col-9" style="height: 75px;">
                                    <p class="col-12" style="margin-left:-10px; margin-top: 25px;">Choose file to post</p>
                                    <p class="col-12" style="margin-left:-10px; margin-top: -18px; color:orange; font-size: 12px">you can upload multiple files at a time. </p>
                                    <p class="col-12" style="margin-left:-10px; margin-top: -18px; color:#28a745; font-size: 12px">Tips: Hold Ctrl and click files to select multiple file.</p>
                                </div>
                                <input required type="file" multiple name="fileupload[]"  id="fileupload" accept="<?=$filetype?>" style="margin-top: -15px; margin-left: -90px; opacity:0%; width: 100%; height:1px;" onchange="javascript:updateList()" oninvalid="this.setCustomValidity('Please choose a file')" oninput="this.setCustomValidity('')">
                            </div>
                            <p>Attached file:</p>
                            <div style="border-style: dashed; border-radius: 10px; min-height: 75px; max-height: 250px; margin-top: -15px; padding-left: 5px; padding-top: 5px; padding-right: 5px; padding-bottom: 5px; overflow-y: scroll;">
                            <div id="fileList"></div>
                            </div>
                            <input type="hidden" name="empid" value="<?=$empid?>">
                            <input type="hidden" name="reqid" value="<?=$id?>">
                            
                    </div>
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                


                    
        <?php
                    }
                }
        ?>
                <script>
                    $(function () {
                        $("#modal-request .close").click()
                    });
                </script>

    <?php

            }
    ?>


<!-- send requested files -->
    <?php
        if (isset($_GET['sendreject'])) {
            $id = $_POST['id'];     

    ?>

        <div class="box-body">
            <div class="form-group">
                <label>Reason:</label>
                <textarea id="reason" name="reason" rows="8" cols="50" style = "width: 100%; height:250px; padding:10px; font-size: 25px;" placeholder="Type something here..."></textarea>
            </div>
        </div>   
        <input type="hidden" name="reqid" value="<?=$id?>">  

    <?php

            }
    ?>

    <!-- add academic rank -->
    <?php
        if (isset($_GET['addrank'])) {
            
            ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" autocomplete="off" class="form-control" placeholder="Enter Code" required/>
                            </div>

                        </div>

                    

            <?php
        }
    ?>

    <!-- MODAL -->



<!-- INSERT -->
    <?php
        // insert new Department
        if (isset($_GET["insertNewDepartment"])) {
            $id=$_POST['d_id'];
            $name=$_POST['d_name'];
            
            $query = "INSERT INTO department(`id`, `name`, `status`)
                        VALUES ('".$id."','".$name."',1)";
            mysqli_query($connection, $query);
            header("location: ../admin/department/department.php");
        }

        // insert new Schedule
        if (isset($_GET["insertNewSchedule"])) {
            $emp_id=$_POST['emp_id'];
            $week=$_POST['week'];
            $category = $_POST['category'];
            $opt_status = "";
            if(isset($_POST['opt_status'])){
                $opt_status = $_POST['opt_status'];
            }
                
            

            echo $category;
            echo $opt_status;
            echo $_POST['schedoption'];

            if($_POST['schedoption'] == "previous"){

                $query = "SELECT * FROM `schedules` WHERE employee_id = 50 GROUP BY week ORDER BY sched_id DESC LIMIT 1";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $weekfinal = $row['week'];
                    }
                }

                $query = "SELECT * FROM schedules WHERE employee_id = '".$emp_id."' AND week = '".$weekfinal."'";
                $result  = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo "test";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "gumana";
                        $insertqry = "INSERT INTO `schedules`(`employee_id`, `date`, `day`, `start`, `end`, `week`, `bill`, `status`, `options`, `opt_status`) VALUES ('".$emp_id."','".$row['date']."','".$row['day']."','".$row['start']."','".$row['end']."','".$week."','".$row['bill']."','".$row['status']."','".$category."','".$opt_status."')";
                        mysqli_query($connection, $insertqry);
 
                        echo $insertqry."\n";
                    }

                }

                

                header("location: ../admin/schedule/schedule.php");


            }else{

            $bill_mon=$_POST['bill_mon'];
            $bill_tue=$_POST['bill_tue'];
            $bill_wed=$_POST['bill_wed'];
            $bill_thu=$_POST['bill_thu'];
            $bill_fri=$_POST['bill_fri'];
            $bill_sat=$_POST['bill_sat'];
            $mon_start=$_POST['mon_start'];
            $tue_start=$_POST['tue_start'];
            $wed_start=$_POST['wed_start'];
            $thu_start=$_POST['thu_start'];
            $fri_start=$_POST['fri_start'];
            $sat_start=$_POST['sat_start'];
            $mon_end=$_POST['mon_end'];
            $tue_end=$_POST['tue_end'];
            $wed_end=$_POST['wed_end'];
            $thu_end=$_POST['thu_end'];
            $fri_end=$_POST['fri_end'];
            $sat_end=$_POST['sat_end'];

            $date_mon = date("Y-m-d", strtotime($_POST['week']));
            $date_tue = date("Y-m-d", strtotime($_POST['week']." +1 day"));
            $date_wed = date("Y-m-d", strtotime($_POST['week']." +2 day"));
            $date_thu = date("Y-m-d", strtotime($_POST['week']." +3 day"));
            $date_fri = date("Y-m-d", strtotime($_POST['week']." +4 day"));
            $date_sat = date("Y-m-d", strtotime($_POST['week']." +5 day"));

            $day_mon = date('l', strtotime($date_mon));
            $day_tue = date('l', strtotime($date_tue));
            $day_wed = date('l', strtotime($date_wed));
            $day_thu = date('l', strtotime($date_thu));
            $day_fri = date('l', strtotime($date_fri));
            $day_sat = date('l', strtotime($date_sat));

            $datestart=array();
            array_push($datestart,$date_mon);
            array_push($datestart,$date_tue);
            array_push($datestart,$date_wed);
            array_push($datestart,$date_thu);
            array_push($datestart,$date_fri);
            array_push($datestart,$date_sat);

            $days=array();
            array_push($days,$day_mon);
            array_push($days,$day_tue);
            array_push($days,$day_wed);
            array_push($days,$day_thu);
            array_push($days,$day_fri);
            array_push($days,$day_sat);

            $sched_week=array();
            array_push($sched_week, $week=$_POST['week']);
            array_push($sched_week, $week=$_POST['week']);
            array_push($sched_week, $week=$_POST['week']);
            array_push($sched_week, $week=$_POST['week']);
            array_push($sched_week, $week=$_POST['week']);
            array_push($sched_week, $week=$_POST['week']);

            $bill=array();
            array_push($bill,$bill_mon);
            array_push($bill,$bill_tue);
            array_push($bill,$bill_wed);
            array_push($bill,$bill_thu);
            array_push($bill,$bill_fri);
            array_push($bill,$bill_sat);

            $start=array();
            array_push($start,$mon_start);
            array_push($start,$tue_start);
            array_push($start,$wed_start);
            array_push($start,$thu_start);
            array_push($start,$fri_start);
            array_push($start,$sat_start);

            $end=array();
            array_push($end,$mon_end);
            array_push($end,$tue_end);
            array_push($end,$wed_end);
            array_push($end,$thu_end);
            array_push($end,$fri_end);
            array_push($end,$sat_end);
            
            $array=array();
            array_push($array,$datestart);
            array_push($array,$days);
            array_push($array,$start);
            array_push($array,$end);
            array_push($array,$sched_week);
            array_push($array,$bill);
            array_push($array,$_POST['sched_status']);
            

                $query = "SELECT * FROM schedules WHERE employee_id = '".$emp_id."' AND week = '".$week."'";
                $result  = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) == 0) {

                    for($x = 0; $x < count($array[0]); $x++){

                        $insertqry = "INSERT INTO `schedules`(`employee_id`, `date`, `day`, `start`, `end`, `week`, `bill`, `status`, `options`, `opt_status`) VALUES ('".$emp_id."','".$array[0][$x]."','".$array[1][$x]."','".$array[2][$x]."','".$array[3][$x]."','".$array[4][$x]."','".$array[5][$x]."','".$array[6][$x]."','".$category."','".$opt_status."')";
                        mysqli_query($connection, $insertqry);

                    }
                    
                }

                header("location: ../admin/schedule/schedule.php");

            }

            
            
            
        }

        // insert new Location
        if (isset($_GET["insertNewLocation"])) {
            $name=$_POST['location'];
            
            $query = "INSERT INTO location(`name`, `status`)
                        VALUES ('".$name."',1)";
            mysqli_query($connection, $query);

            header("location: ../admin/location/location.php");
        }

        // insert new Designation
        if (isset($_GET["insertNewDesignation"])) {
            $name=$_POST['name'];
            $code=$_POST['code'];

            $query = "INSERT INTO position (`position_name`, `position_code`) VALUES ('".$name."', '".$code."')";
            mysqli_query($connection, $query);

            header("location: ../admin/designation/designation.php");
            
        }


         // insert new Rank
         if (isset($_GET["insertNewRank"])) {
            $name=$_POST['name'];
            $code=$_POST['code'];

            $query = "INSERT INTO academics (`academic_name`, `academic_code`,`is_deleted`) VALUES ('".$name."', '".$code."',1)";
            mysqli_query($connection, $query);

            header("location: ../admin/academicrank/academicrank.php");
            
        }

        // insert new Employee
        if (isset($_GET["insertNewEmployee"])) {
            $e_name=$_POST['e_fname'];
            $e_mname=$_POST['e_mname'];
            $e_lname=$_POST['e_lname'];
            $e_gender=$_POST['e_gender'];
            $email=$_POST['email'];
            $emp_status=$_POST['emp_status'];
            $mobile=$_POST['mobile'];
            $e_address=$_POST['e_address'];
            $place_birth=$_POST['place_birth'];
            $e_birth_date=$_POST['e_birth_date'];
            $e_position=$_POST['e_position'];
            $d_id=$_POST['d_id'];
            $e_academic=$_POST['e_academic'];
            $type_emp=$_POST['type_emp'];
            $e_status=$_POST['e_status'];
            $e_hire_date=$_POST['e_hire_date'];
            $plantilla=$_POST['plantilla'];
            $eligibility=$_POST['eligibility'];
            $tin_no=$_POST['tin_no'];
            $gsis_no=$_POST['gsis_no'];
            $pagibig_no=$_POST['pagibig_no'];

            $bd=$_POST['bd'];
            $bd_year=$_POST['bd_year'];
            $bd_school=$_POST['bd_school'];
            $md=$_POST['md'];
            $md_with=$_POST['md_with'];
            $md_year=$_POST['md_year'];
            $md_school=$_POST['md_school'];
            $dd=$_POST['dd'];
            $dd_with=$_POST['dd_with'];
            $dd_year=$_POST['dd_year'];
            $dd_school=$_POST['dd_school'];
            $other=$_POST['other'];
            $other_year=$_POST['other_year'];
            $other_school=$_POST['other_school'];

            $is_master=0;
            $is_doctorate=0;
            $is_other_degree=0;

            if (isset($_POST["is_master"])) {
                $is_master=1;
            }

            if (isset($_POST["is_doctorate"])) {
                $is_doctorate=1;
            }

            if (isset($_POST["is_other_degree"])) {
                $is_other_degree=1;
            }

    
            $query = "SELECT * FROM employee WHERE email = '".$email."'";
                $result = mysqli_query($connection, $query);

                $fileInfo = PATHINFO($_FILES["imgupload"]["name"]);
               
                if (mysqli_num_rows($result) == 0) {

                    if (empty($_FILES["imgupload"]["name"])){
                        $location="default.png";
                    
                    }
                    else{
                        if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
                            $newFilename = $fileInfo['filename']."_".$filetimestamp . "." . $fileInfo['extension'];
                            move_uploaded_file($_FILES["imgupload"]["tmp_name"], "../upload/" . $newFilename);
                            $location = $newFilename;
                          
                        
                        }
                        else{
                            $location="default.png";
                        
                        }
                    }

                        //Basic information query
                        $query = "INSERT INTO employee (
                         `name`,
                         `middle_name`,
                         `last_name`,
                         `email`,
                         `mobile_no`,
                         `address`,
                         `gender`,
                         `image`,
                         `birth_date`,
                         `hire_date`,
                         `position_id`,
                         `department_id`,
                         `academic_id`,
                         `place_birth`,
                         `type_emp`,
                         `status_emp`,
                         `plantilla`,
                         `eligibility`,
                         `tin_no`,
                         `gsis_no`,
                         `pagibig_no`,
                         `bacherlor_degree`,
                         `bs_year`,
                         `bs_school`,
                         `is_master`,
                         `is_doctorate`,
                         `is_other_degree`,
                         `master`,
                         `md_with`,
                         `md_year`,
                         `md_school`,
                         `doctorate`,
                         `dd_with`,
                         `dd_year`,
                         `dd_school`,
                         `other_degree`,
                         `other_year`,
                         `other_school`,
                         `is_active`) 
                                VALUES (
                                '".$e_name."', 
                                '".$e_mname."', 
                                '".$e_lname."', 
                                '".$email."', 
                                '".$mobile."', 
                                '".$e_address."', 
                                '".$e_gender."', 
                                '".$location."','
                                ".$e_birth_date."', 
                                '".$e_hire_date."', 
                                '".$e_position."', 
                                '".$d_id."', 
                                '".$e_academic."', 
                                '".$place_birth."', 
                                '".$type_emp."', 
                                '".$emp_status."', 
                                '".$plantilla."', 
                                '".$tin_no."', 
                                '".$eligibility."', 
                                '".$gsis_no."', 
                                '".$pagibig_no."', 
                                '".$bd."', 
                                '".$bd_year."', 
                                '".$bd_school."', 
                                '".$is_master."', 
                                '".$is_doctorate."', 
                                '".$is_other_degree."', 
                                '".$md."', 
                                '".$md_with."', 
                                '".$md_year."', 
                                '".$md_school."', 
                                '".$dd."', 
                                '".$dd_with."', 
                                '".$dd_year."', 
                                '".$dd_school."', 
                                '".$other."', 
                                '".$other_year."', 
                                '".$other_school."', 
                                '".$e_status."')";
                        mysqli_query($connection, 
                        $query);
                      
                        
                    header("location: ../admin/employee/employee.php");
                } else {
                    header("location: ../admin/employee/employee.php?employeerrorr=E-mail already exist.");
                }
            
        }

        // insert new User
        if (isset($_GET["insertNewUser"])) {
            $email=$_POST['u_username'];
            $password=$_POST['u_password'];
            $u_role=$_POST['u_role'];
            $emp_id=$_POST['emp_id'];

                $query = "INSERT INTO user (`email`, `password`, `employee_id`, `role`, `status`, `has_account`) 
                    VALUES ('".$email."', '".$password."', '".$emp_id."', '".$u_role."', 1, 1)";
                mysqli_query($connection, $query);

                header("location: ../admin/users/users.php");
            
        }

        // insert upload files
        if (isset($_GET["insertNewPostedFile"])) {
            $fileName = PATHINFO($_FILES['fileupload']['name']);
            $fileSize = intval($_FILES['fileupload']['size']/1024);
            $description = $_POST['filedescription'];
            $newFileName = $fileName['filename']."_".$filetimestamp.".".$fileName['extension'];
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], "../filesupload/admin/posted/".$newFileName);

            echo $newFileName;

            $query = "SELECT * FROM employee";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "INSERT INTO `fileupload`(`employee_id`, `filename`, `filesize`, `description`) 
                            VALUES ('".$row['id']."','".$newFileName."','".$fileSize."','".$description."') ";
                    mysqli_query($connection, $update);
                }
            }

            
            
            
            header("location: ../admin/postedfile/postedfile.php");

        }

        // insert sent requested files
        if (isset($_GET["insertNewRequestFile"])) {
            $totalfiles = count($_FILES['fileupload']['name']);
            $description = $_POST['filedescription'];
            $empid = $_POST['empid'];
            $id = $_POST['reqid'];


            // Looping over all files
            for($i=0;$i<$totalfiles;$i++){
                $fileName = PATHINFO($_FILES['fileupload']['name'][$i]);
                $fileSize = intval($_FILES['fileupload']['size'][$i]/1024);
                $newFileName = $fileName['filename']."_".$filetimestamp.".".$fileName['extension'];

                // Upload files and store in database
                if(move_uploaded_file($_FILES["fileupload"]["tmp_name"][$i],"../filesupload/admin/submitted/".$newFileName)){
                    // Image db insert sql
                    $insert = "INSERT INTO `filesubmit`(`employee_id`, `filename`, `filesize`, `description`) VALUES ('".$empid."','".$newFileName."','".$fileSize."','".$description."')";
                    mysqli_query($connection, $insert);
                }

            }

            $update = "UPDATE e_requestfile SET sent_status = 1 WHERE id = '".$id."' ";
            mysqli_query($connection, $update);

            header("location: ../admin/requestfile/requestfile.php");



        }

        // insert sent requested files
        if (isset($_GET["insertNewRejectFile"])) {
            
            $id = $_POST['reqid'];
            $note = $_POST['reason'];

            $update = "UPDATE e_requestfile SET sent_status = 2, reason = '".$note."' WHERE id = '".$id."' ";
            mysqli_query($connection, $update);

            header("location: ../admin/requestfile/requestfile.php");



        }

    ?>



<!-- EDIT -->
    <?php 
        // submit edit Department
        if (isset($_GET['submitEditDepartment'])) {

            $dept_id=$_POST['dept_id'];
            $d_id=$_POST['d_id'];
            $d_name=$_POST['d_name'];
            

            $query = "SELECT * FROM department WHERE dept_id = '".$dept_id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE department SET name = '".$d_name."', id = '".$d_id."' WHERE dept_id = '".$dept_id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/department/department.php");
        }

        // submit edit Schedule
        if (isset($_GET['submitEditSchedule'])) {

            $category = $_POST['category'];
            if(isset($_POST['opt_status'])){
                $opt_status = $_POST['opt_status'];
            }else{
                $opt_status = "";
            }
            

            $array=array();
            array_push($array,$_POST['sched_id']);
            array_push($array,$_POST['start']);
            array_push($array,$_POST['end']);
            array_push($array,$_POST['bill']);
            array_push($array,$_POST['sched_status']);



            print_r($array);
            
            for($x = 0; $x < count($array[0]); $x++){

                $query = "SELECT * FROM schedules WHERE sched_id = '".$array[0][$x]."'";
                $result  = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $update = "UPDATE `schedules` SET `start`='".$array[1][$x]."',`end`='".$array[2][$x]."',`bill`='".$array[3][$x]."',`status`='".$array[4][$x]."', `options`='".$category."', `opt_status`='".$opt_status."'
                                    WHERE sched_id = '".$array[0][$x]."' ";
                        mysqli_query($connection, $update);
                    }
                }
            
            }


            header("location: ../admin/schedule/schedule.php");
        }

        // submit edit Location
        if (isset($_GET['submitEditLocation'])) {

            $id=$_POST['id'];
            $name=$_POST['name'];

            $query = "SELECT * FROM location WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE location SET name = '".$name."' WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/location/location.php");
        }

        // submit edit Designation
        if (isset($_GET['submitEditDesignation'])) {

            $id=$_POST['id'];
            $name=$_POST['name'];
            $code=$_POST['code'];
            

            $query = "SELECT * FROM position WHERE position_id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE position SET position_name = '".$name."', position_code = '".$code."' WHERE position_id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/designation/designation.php");
        }


          // submit edit rank
          if (isset($_GET['submitEditRank'])) {

            $id=$_POST['id'];
            $name=$_POST['name'];
            $code=$_POST['code'];
            

            $query = "SELECT * FROM academics WHERE academic_id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE academics SET academic_name = '".$name."', academic_code = '".$code."' WHERE academic_id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/academicrank/academicrank.php");
        }
        // submit edit Employee
        if (isset($_GET['submitEditEmployee'])) {

            $id=$_POST['id'];
            $e_name=$_POST['e_fname'];
            $e_mname=$_POST['e_mname'];
            $e_lname=$_POST['e_lname'];
            $e_gender=$_POST['e_gender'];
            $emp_status=$_POST['emp_status'];
            $mobile=$_POST['mobile'];
            $e_address=$_POST['e_address'];
            $place_birth=$_POST['place_birth'];
            $e_birth_date=$_POST['e_birth_date'];
            $e_position=$_POST['e_position'];
            $d_id=$_POST['d_id'];
            $e_academic=$_POST['e_academic'];
            $type_emp=$_POST['type_emp'];
            $e_status=$_POST['e_status'];
            $e_hire_date=$_POST['e_hire_date'];
            $plantilla=$_POST['plantilla'];
            $eligibility=$_POST['eligibility'];
            $tin_no=$_POST['tin_no'];
            $gsis_no=$_POST['gsis_no'];
            $pagibig_no=$_POST['pagibig_no'];
            $dept_id = $_POST['d_id'];
    
            $bd=$_POST['bd'];
            $bd_year=$_POST['bd_year'];
            $bd_school=$_POST['bd_school'];
            $md=$_POST['md'];
            $md_with=$_POST['md_with'];
            $md_year=$_POST['md_year'];
            $md_school=$_POST['md_school'];
            $dd=$_POST['dd'];
            $dd_with=$_POST['dd_with'];
            $dd_year=$_POST['dd_year'];
            $dd_school=$_POST['dd_school'];
            $other=$_POST['other'];
            $other_year=$_POST['other_year'];
            $other_school=$_POST['other_school'];
            $fileInfo = PATHINFO($_FILES["imgupload"]["name"]);
            $imageprevious=$_POST['imageprevious'];

            echo $imageprevious;

            $is_master=0;
            $is_doctorate=0;
            $is_other_degree=0;

            if (isset($_POST["is_master"])) {
                $is_master=1;
            }

            if (isset($_POST["is_doctorate"])) {
                $is_doctorate=1;
            }

            if (isset($_POST["is_other_degree"])) {
                $is_other_degree=1;
            }

            if (empty($_FILES["imgupload"]["name"])){
                $location=$imageprevious;
        
            }
            else{
                if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
                    $newFilename = $fileInfo['filename'] ."_".$filetimestamp . "." . $fileInfo['extension'];
                    move_uploaded_file($_FILES["imgupload"]["tmp_name"], "../upload/" . $newFilename);
                    $location = $newFilename;
                }
                else{
                    $location=$imageprevious;
                }
            }

            echo $location;

            $query = "SELECT * FROM employee WHERE id = '".$id."' LIMIT 1";
                $result = mysqli_query($connection, $query);


                if (mysqli_num_rows($result) == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE employee 
                                    SET `name` = '".$e_name."', 
                                    middle_name = '".$e_mname."', 
                                    last_name = '".$e_lname."', 
                                    mobile_no = '".$mobile."', 
                                    address = '".$e_address."', 
                                    gender = '".$e_gender."',
                                    birth_date = '".$e_birth_date."', 
                                    hire_date = '".$e_hire_date."', 
                                    image = '".$location."', 
                                    position_id = '".$e_position."', 
                                    department_id = '".$dept_id."', 
                                    academic_id = '".$e_academic."', 
                                    place_birth = '".$place_birth."', 
                                    type_emp = '".$type_emp."', 
                                    status_emp = '".$emp_status."', 
                                    plantilla = '".$plantilla."', 
                                    eligibility = '".$eligibility."', 
                                    tin_no = '".$tin_no."', 
                                    gsis_no = '".$gsis_no."', 
                                    pagibig_no = '".$pagibig_no."', 
                                    bacherlor_degree = '".$bd."', 
                                    bs_year = '".$bd_year."', 
                                    bs_school = '".$bd_school."', 
                                    is_master = '".$is_master."', 
                                    is_doctorate = '".$is_doctorate."', 
                                    is_other_degree = '".$is_other_degree."', 
                                    master = '".$md."',
                                    md_with = '".$md_with."', 
                                    md_year = '".$md_year."', 
                                    md_school = '".$md_school."', 
                                    doctorate = '".$dd."', 
                                    dd_with = '".$dd_with."', 
                                    dd_year = '".$dd_year."', 
                                    dd_school = '".$dd_school."', 
                                    other_degree = '".$other."', 
                                    other_year = '".$other_year."', 
                                    other_school = '".$other_school."', 
                                    is_active = '".$e_status."' 
                                        WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);

                }
               
            }

            header("location: ../admin/employee/employee.php");
        }

        // submit edit User
        if (isset($_GET['submitEditUser'])) {

            $id=$_POST['id'];
            $u_password=$_POST['u_password'];
            $u_role=$_POST['u_role'];
            

            $query = "SELECT * FROM user WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE user SET password = '".$u_password."', role = '".$u_role."' WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/users/users.php");
        }

        // submit edit User
        if (isset($_GET['updatefilesreceived'])) {

            
            $update = "UPDATE e_uploadfile SET notif = 1";
            mysqli_query($connection, $update);
              
            


            header("location: ../admin/receivedfile/receivedfile.php");
        }

        // submit edit User
        if (isset($_GET['updatefilesrequest'])) {

            
            $update = "UPDATE e_requestfile SET notif = 1";
            mysqli_query($connection, $update);
              
            


            header("location: ../admin/requestfile/requestfile.php");
        }

        


    ?>


<!-- DELETE -->
    <?php

        //delete department
        if (isset($_GET['deleteDept'])) {
            $dept_id=$_GET['dept_id'];

            // $query = "SELECT * FROM department WHERE dept_id = '".$dept_id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE department SET status = 0 WHERE dept_id = '".$dept_id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM department WHERE dept_id = '".$dept_id."' ";
            mysqli_query($connection, $query);

            header("location: ../admin/department/department.php");
        }


        //delete schedule
        if (isset($_GET['deleteSched'])) {
            $emp_id=$_GET['emp_id'];
            $week=$_GET['week'];

            // $query = "SELECT * FROM schedules WHERE sched_id = '".$sched_id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE schedules SET status = 0 WHERE sched_id = '".$sched_id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM schedules WHERE employee_id = '".$emp_id."' AND week = '".$week."'";
            mysqli_query($connection, $query);

            header("location: ../admin/schedule/schedule.php");
        }

        //delete location
        if (isset($_GET['deleteLoc'])) {
            $id=$_GET['id'];

            // $query = "SELECT * FROM location WHERE id = '".$id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE location SET status = 0 WHERE id = '".$id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM location WHERE id = '".$id."' ";
            mysqli_query($connection, $query);

            header("location: ../admin/location/location.php");
        }

        //delete designation
        if (isset($_GET['deleteDesignation'])) {
            $id=$_GET['id'];

            // $query = "SELECT * FROM position WHERE position_id = '".$id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE position SET status = 0 WHERE position_id = '".$id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM position WHERE position_id = '".$id."' ";
            mysqli_query($connection, $query);

            header("location: ../admin/designation/designation.php");
        }


        
        //delete academis
        if (isset($_GET['deleteAcademic'])) {
            $id=$_GET['id'];

            // $query = "SELECT * FROM academics WHERE academic_id = '".$id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE academics SET is_deleted = 0 WHERE academic_id = '".$id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM academics WHERE academic_id = '".$id."' ";
            mysqli_query($connection, $query);

            header("location: ../admin/academicrank/academicrank.php");
        }
        //delete employee
        if (isset($_GET['deleteEmployee'])) {
            $id=$_GET['id'];

            $query = "SELECT * FROM employee WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE employee SET is_active = 0 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                    $updates = "UPDATE user SET has_account = 0 WHERE employee_id = '".$id."' ";
                    mysqli_query($connection, $updates);
                }
            }

            header("location: ../admin/employee/employee.php");
        }

        //delete user
        if (isset($_GET['deleteuser'])) {
            $id=$_GET['id'];

            // $query = "SELECT * FROM user WHERE id = '".$id."' ";
            // $result  = mysqli_query($connection, $query);
            // if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $update = "UPDATE user SET status = 0 WHERE id = '".$id."' ";
            //         mysqli_query($connection, $update);
            //     }
            // }

            $query = "DELETE FROM user WHERE id = '".$id."' ";
            mysqli_query($connection, $query);

            header("location: ../admin/users/users.php");
        }

        //delete user
        if (isset($_GET['deleteposted'])) {
            $date=$_GET['date'];

            $query = "SELECT * FROM fileupload WHERE date = '".$date."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE fileupload SET status = 1 WHERE date = '".$date."' ";
                    mysqli_query($connection, $update);
                }
            }

            // $query = "DELETE FROM user WHERE id = '".$id."' ";
            // mysqli_query($connection, $query);

            header("location: ../admin/postedfile/postedfile.php");
        }


        //delete user
        if (isset($_GET['deletesubmitted'])) {
            $id=$_GET['id'];

            $query = "SELECT * FROM filesubmit WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE filesubmit SET status = 1 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            // $query = "DELETE FROM user WHERE id = '".$id."' ";
            // mysqli_query($connection, $query);

            header("location: ../admin/requestfile/requestfile.php");
        }

        


    ?>


<!-- RESTORE DELETE -->
    
    <?php 
        // restore delete Department
        if (isset($_GET['restoreDeleteDept'])) {
            $dept_id=$_GET['dept_id'];
            

            $query = "SELECT * FROM department WHERE dept_id = '".$dept_id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE department SET status = 1 WHERE dept_id = '".$dept_id."' ";
                    mysqli_query($connection, $update);
                }
            }
            
            


            header("location: ../admin/department/department.php");
        }


        // restore delete Schedule
        if (isset($_GET['restoreDeleteSched'])) {
            $sched_id=$_GET['sched_id'];
            

            $query = "SELECT * FROM schedules WHERE sched_id = '".$sched_id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE schedules SET status = 1 WHERE sched_id = '".$sched_id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/schedule/schedule.php");
        }

        // restore delete Location
        if (isset($_GET['restoreDeleteLoc'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM location WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE location SET status = 1 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/location/location.php");
        }

        // restore delete Designation
        if (isset($_GET['restoreDeleteDesignation'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM position WHERE position_id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE position SET status = 1 WHERE position_id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/designation/designation.php");
        }


        
        // restore delete academic

        if (isset($_GET['restoreDeleteAcademic'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM academics WHERE academic_id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE academics SET is_deleted = 1 WHERE academic_id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }


            header("location: ../admin/academicrank/academicrank.php");
        }

        // restore delete Employee
        if (isset($_GET['restoreDeleteEmployee'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM employee WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE employee SET is_active = 1 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                    $updates = "UPDATE user SET has_account = 1 WHERE employee_id = '".$id."' ";
                    mysqli_query($connection, $updates);
                }
            }

            header("location: ../admin/employee/employee.php");
        }

        // restore delete User
        if (isset($_GET['restoreDeleteUser'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM user WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE user SET status = 1 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/users/users.php");
        }


        // restore delete User
        if (isset($_GET['restoreDeletePosted'])) {
            $date=$_GET['date'];
            

            $query = "SELECT * FROM fileupload WHERE date = '".$date."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE fileupload SET status = 0 WHERE date = '".$date."' ";
                    mysqli_query($connection, $update);
                }
            }

            // $query = "DELETE FROM user WHERE id = '".$id."' ";
            // mysqli_query($connection, $query);

            header("location: ../admin/postedfile/postedfile.php");
        }


        // restore delete User
        if (isset($_GET['restoreDeleteSubmitted'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM filesubmit WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE filesubmit SET status = 0 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            // $query = "DELETE FROM user WHERE id = '".$id."' ";
            // mysqli_query($connection, $query);

            header("location: ../admin/requestfile/requestfile.php");
        }
    

    ?>  