<?php

    require '../connection/connect.php';

?>
 
<!-- VIEW -->




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

        // submit edit Department
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
    

    ?>  