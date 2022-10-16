<?php

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
            

            $query = "SELECT * FROM schedules WHERE employee_id = '".$emp_id."'";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE schedules 
                            SET mon_start = '".$mon_start."', tue_start = '".$tue_start."', wed_start = '".$wed_start."', thu_start = '".$thu_start."', fri_start = '".$fri_start."', sat_start = '".$sat_start."', 
                                mon_end = '".$mon_end."', tue_end = '".$tue_end."', wed_end = '".$wed_end."', thu_end = '".$thu_end."', fri_end = '".$fri_end."', sat_end = '".$sat_end."',
                                status = 1, created_at = '".$date."'
                            WHERE employee_id = '".$emp_id."' ";
                    mysqli_query($connection, $update);
                }
            } else {

                $insertqry = "INSERT INTO schedules (employee_id, mon_start, mon_end, tue_start, tue_end, wed_start, wed_end, thu_start, thu_end, fri_start, fri_end, sat_start, sat_end, status, created_at)
                                VALUES ('".$emp_id."', '".$mon_start."', '".$mon_end."', '".$tue_start."', '".$tue_end."', '".$wed_start."', '".$wed_end."', '".$thu_start."', '".$thu_end."', '".$fri_start."', '".$fri_end."', '".$sat_start."', '".$sat_end."', 1,'".$date."')";
                        mysqli_query($connection, $insertqry);

            }

            header("location: ../admin/schedule/schedule.php");
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
                            $newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
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

            $query = "INSERT INTO user (`position_name`, `position_code`) VALUES ('".$name."', '".$code."')";
            mysqli_query($connection, $query);

            header("location: ../admin/designation/designation.php");
            
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

            $sched_id=$_POST['sched_id'];
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
            

            $query = "SELECT * FROM schedules WHERE sched_id = '".$sched_id."'";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE schedules 
                            SET mon_start = '".$mon_start."', tue_start = '".$tue_start."', wed_start = '".$wed_start."', thu_start = '".$thu_start."', fri_start = '".$fri_start."', sat_start = '".$sat_start."', 
                                mon_end = '".$mon_end."', tue_end = '".$tue_end."', wed_end = '".$wed_end."', thu_end = '".$thu_end."', fri_end = '".$fri_end."', sat_end = '".$sat_end."',
                                status = 1, created_at = '".$date."'
                                WHERE sched_id = '".$sched_id."' ";
                    mysqli_query($connection, $update);
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
                $location="default.png";
        
            }
            else{
                if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
                    $newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
                    move_uploaded_file($_FILES["imgupload"]["tmp_name"], "../upload/" . $newFilename);
                    $location = $newFilename;
                }
                else{
                    $location="default.png";
                }
            }



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

            // header("location: ../admin/employee/employee.php");
        }


    ?>


<!-- DELETE -->
    <?php

        //delete department
        if (isset($_GET['deleteDept'])) {
            $dept_id=$_GET['dept_id'];

            $query = "SELECT * FROM department WHERE dept_id = '".$dept_id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE department SET status = 0 WHERE dept_id = '".$dept_id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/department/department.php");
        }


        //delete schedule
        if (isset($_GET['deleteSched'])) {
            $sched_id=$_GET['sched_id'];

            $query = "SELECT * FROM schedules WHERE sched_id = '".$sched_id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE schedules SET status = 0 WHERE sched_id = '".$sched_id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/schedule/schedule.php");
        }

        //delete location
        if (isset($_GET['deleteLoc'])) {
            $id=$_GET['id'];

            $query = "SELECT * FROM location WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE location SET status = 0 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/location/location.php");
        }

        //delete designation
        if (isset($_GET['deleteDesignation'])) {
            $id=$_GET['id'];

            $query = "SELECT * FROM position WHERE position_id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE position SET status = 0 WHERE position_id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/designation/designation.php");
        }

        //delete employee
        if (isset($_GET['deleteemployee'])) {
            $id=$_GET['id'];

            $query = "SELECT * FROM employee WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE employee SET is_active = 1 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/employee/employee.php");
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

        // restore delete Employee
        if (isset($_GET['restoreDeleteEmployee'])) {
            $id=$_GET['id'];
            

            $query = "SELECT * FROM employee WHERE id = '".$id."' ";
            $result  = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $update = "UPDATE employee SET is_active = 0 WHERE id = '".$id."' ";
                    mysqli_query($connection, $update);
                }
            }

            header("location: ../admin/employee/employee.php");
        }
    

    ?>  